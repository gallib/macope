<?php

namespace App\Importer;

use App\Contracts\Importers\ImportData;
use App\Models\Account;
use App\Models\JournalEntry;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class PostFinanceImport implements ImportData, WithCustomCsvSettings
{
    use Importable;

    /**
     * @var string
     */
    const ENTRY_DATE_TEXT = 'Date de comptabilisation';

    /**
     * @var string
     */
    const DISCLAIMER_TEXT = 'Disclaimer:';

    /**
     * @var string
     */
    protected $filepath;

    /**
     * Create a new instance.
     *
     * @param  string  $filepath
     * @return void
     */
    public function __construct($filepath)
    {
        $this->filepath = $filepath;
    }

    /**
     * Return whether the given file is valid or not.
     *
     * @return bool
     */
    public function isValid(): bool
    {
        try {
            $data = $this->toArray($this->filepath);
        } catch (\Exception $e) {
            return false;
        }

        $data = reset($data);

        $iban = $data[1][1] ?? null;
        $currency = $data[2][1] ?? null;
        $header = $data[3][0] ?? null;

        end($data);

        $disclaimer = prev($data);
        $account = Account::where('iban', $iban)->first();

        if (! ($account instanceof Account) || $account->currency !== $currency || $header !== self::ENTRY_DATE_TEXT || $disclaimer[0] !== self::DISCLAIMER_TEXT) {
            return false;
        }

        return true;
    }

    /**
     * Import entries from file.
     *
     * @return bool
     */
    public function import(): bool
    {
        if (! $this->isValid(true)) {
            throw new \InvalidArgumentException("{$this->filepath->getClientOriginalName()} is not a valid file.");
        }

        $data = $this->toArray($this->filepath);
        $data = reset($data);
        $account = Account::where('iban', $data[1][1])->first();

        // Clean data and sort by asc order
        $data = array_slice($data, 4);
        array_splice($data, -3);
        $data = array_reverse($data);

        $batch = uniqid('', true);

        foreach ($data as $value) {
            try {
                $format = strpos($value[0], '-') !== false ? 'Y-m-d' : 'd.m.Y';
                $date = Carbon::createFromFormat($format, $value[0]);
            } catch (\InvalidArgumentException $e) {
                continue;
            }

            $entryData = [
                'date'       => $date->toDateString(),
                'text'       => $value[1],
                'credit'     => is_null($value[2]) ? null : number_format($value[2], 2, '.', ''),
                'debit'      => is_null($value[3]) ? null : number_format(abs($value[3]), 2, '.', ''),
                'batch'      => $batch,
                'account_id' => $account->id,
            ];

            $entry = JournalEntry::findByHashOrCreate($entryData);
        }

        return true;
    }

    /**
     * Getter for csv settings.
     *
     * @return array
     */
    public function getCsvSettings(): array
    {
        return [
            'input_encoding' => 'Windows-1252',
            'delimiter' => ';',
        ];
    }
}
