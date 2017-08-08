<?php

namespace Gallib\Macope\App\Importer;

use Illuminate\Http\UploadedFile;

class ImportDataFactory
{
    /**
     * Instanciate an import data class depending on given file
     *
     * @param  \Illuminate\Http\UploadedFile $uploadedFile
     * @return \Gallib\Macope\App\Importer\ImportDataInterface
     */
    public static function create(UploadedFile $uploadedFile)
    {
        $factory = null;

        if (ImportPostFinanceData::isFileValid($uploadedFile)) {
            $factory = new ImportPostFinanceData($uploadedFile);
        } elseif (ImportMigrosBankData::isFileValid($uploadedFile)) {
            $factory = new ImportMigrosBankData($uploadedFile);
        } else {
            $filename = $uploadedFile->getClientOriginalName();
            throw new \InvalidArgumentException("$filename is not a valid file");
        }

        return $factory;
    }
}
