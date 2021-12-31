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
        $data = $this->toArray($this->filepath);
        $data = reset($data);

        $iban = isset($data[1][1]) ? $data[1][1] : null;
        $currency = isset($data[2][1]) ? $data[2][1] : null;

        end($data);

        $disclaimer = prev($data);
        $account = Account::where('iban', $iban)->first();

        if (! ($account instanceof Account) || $account->currency !== $currency || $disclaimer[0] !== 'Disclaimer:') {
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
        $data = array_slice($data, 5);
        array_splice($data, -3);
        $data = array_reverse($data);

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
