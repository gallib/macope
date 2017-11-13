<?php

namespace Gallib\Macope\App\Importer;

use Carbon\Carbon;
use Gallib\Macope\App\Account;
use Gallib\Macope\App\JournalEntry;
use Excel;
use Illuminate\Http\UploadedFile;

class ImportPostFinanceData implements ImportDataInterface
{
    /**
     * @var string
     */
    const DELIMITER = ';';

    /**
     * @var boolean
     */
    const HEADING = false;

    /**
     * @var \Illuminate\Http\UploadedFile
     */
    protected $uploadedFile;

    /**
     * Create a new instance
     *
     * @param \Illuminate\Http\UploadedFile $uploadedFile
     * @return void
     */
    public function __construct(UploadedFile $uploadedFile)
    {
        if (!self::isFileValid($uploadedFile)) {
            $filename = $uploadedFile->getClientOriginalName();
            throw new \InvalidArgumentException("$filename is not a valid file.");
        }

        $this->uploadedFile = $uploadedFile;
    }

    /**
     * Return whether the given file is valid or not
     *
     * @param  \Illuminate\Http\UploadedFile $uploadedFile
     * @return boolean
     */
    public static function isFileValid(UploadedFile $uploadedFile)
    {
        // Get original config
        $delimiter = \Config::get('excel.csv.delimiter');
        $heading   = \Config::get('excel.import.heading');

        // Set config for that file
        \Config::set('excel.csv.delimiter', self::DELIMITER);
        \Config::set('excel.import.heading', self::HEADING);

        $data = Excel::load($uploadedFile->path(), 'Windows-1252')->get()->toArray();

        $iban     = isset($data[1][1]) ? $data[1][1] : null;
        $currency = isset($data[2][1]) ? $data[2][1] : null;

        end($data);
        $beforeLast = prev($data);

        $account = Account::where('iban', $data[1][1])->first();

        if (!($account instanceof Account) || $account->currency !== $currency || $beforeLast[0] !== 'Disclaimer:') {
            return false;
        }

        // Reset config
        \Config::set('excel.csv.delimiter', $delimiter);
        \Config::set('excel.import.heading', $heading);

        return true;
    }

    /**
     * Import accounting entries in the given file
     *
     * @return boolean
     */
    public function import()
    {
        // Get original config
        $delimiter = \Config::get('excel.csv.delimiter');
        $heading   = \Config::get('excel.import.heading');

        // Set config for that file
        \Config::set('excel.csv.delimiter', self::DELIMITER);
        \Config::set('excel.import.heading', self::HEADING);

        $data    = Excel::load($this->uploadedFile->path(), 'Windows-1252')->get()->toArray();
        $account = Account::where('iban', $data[1][1])->first();

        // Clean data and sort by asc order
        $data = array_slice($data, 5);
        array_splice($data, -3);
        $data = array_reverse($data);

        $start = Carbon::now();

        foreach ($data as $key => $value) {
            try {
                $format = strpos($value[0], '-') !== false ? 'Y-m-d' : 'd.m.Y';
                $date   = Carbon::createFromFormat($format, $value[0]);
            } catch (\InvalidArgumentException $e) {
                continue;
            }

            $entryData = [
                'date'       => $date->toDateString(),
                'text'       => $value[1],
                'credit'     => $value[2],
                'debit'      => is_null($value[3]) ? null : abs($value[3]),
                'account_id' => $account->id
            ];

            $entry = JournalEntry::where($entryData)->first();

            if (is_null($entry) || $start->lt($entry->created_at)) {
                $entry = JournalEntry::create($entryData);
            }
        }

        // Reset config
        \Config::set('excel.csv.delimiter', $delimiter);
        \Config::set('excel.import.heading', $heading);

        return true;
    }
}
