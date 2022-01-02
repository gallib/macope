<?php

namespace App\Importer;

use App\Contracts\Importers\ImportData;
use App\Models\Account;
use App\Models\JournalEntry;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class MigrosBankImport implements ImportData, WithCustomCsvSettings
{
    use Importable;

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

        $accountNumber = isset($data[2][0]) && strpos($data[2][0], ': ') !== false ? explode(': ', $data[2][0])[1] : null;

        $account = Account::where('account_number', $accountNumber)->first();

        if (! ($account instanceof Account)) {
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

        $accountNumber = explode(': ', $data[2][0])[1];

        $account = Account::where('account_number', $accountNumber)->first();

        $data = array_slice($data, 12);
        $data = array_reverse($data);

        foreach ($data as $key => $value) {
            $date = Carbon::createFromFormat('d.m.y', $value[3]);

            $entryData = [
                'date'       => $date->toDateString(),
                'text'       => $value[1],
                'credit'     => $value[2] >= 0 ? number_format(abs($value[2]), 2, '.', '') : null,
                'debit'      => $value[2] < 0 ? number_format(abs($value[2]), 2, '.', '') : null,
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
