<?php

namespace Gallib\Macope\App\Importer;

use Carbon\Carbon;
use Gallib\Macope\App\Account;
use Gallib\Macope\App\JournalEntry;
use Excel;
use Illuminate\Http\UploadedFile;

class ImportMigrosBankData implements ImportDataInterface
{
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
        $data = Excel::load($uploadedFile->path(), 'Windows-1252')->get()->toArray();

        $accountNumber = isset($data[2][0]) && strpos($data[2][0], ': ') !== false ? explode(': ', $data[2][0])[1] : null;

        $account = Account::where('account_number', $accountNumber)->first();

        if (!($account instanceof Account)) {
            return false;
        }

        return true;
    }

    /**
     * Import accounting entries in the given file
     *
     * @return boolean
     */
    public function import()
    {
        $data    = Excel::load($this->uploadedFile->path(), 'Windows-1252')->get()->toArray();
        $accountNumber = explode(': ', $data[2][0])[1];

        $account = Account::where('account_number', $accountNumber)->first();

        $data = array_slice($data, 12);
        $data = array_reverse($data);

        foreach ($data as $key => $value) {
            $date = Carbon::createFromFormat('d.m.y', $value[3]);

            $entryData = [
                'date'       => $date->toDateString(),
                'text'       => $value[1],
                'credit'     => $value[2] >= 0 ? abs($value[2]) : null,
                'debit'      => $value[2] < 0 ? abs($value[2]) : null,
                'account_id' => $account->id
            ];

            $entry = JournalEntry::where($entryData)->first();

            if (is_null($entry)) {
                $entry = JournalEntry::create($entryData);
            }
        }

        return true;
    }
}
