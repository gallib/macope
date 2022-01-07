<?php

namespace App\Importer;

class ImportDataFactory
{
    /**
     * Instanciate an import data class depending on given file.
     *
     * @param  string  $filepath
     * @return \Gallib\Macope\Importer\ImportDataInterface
     */
    public static function create($filepath)
    {
        $factory = new PostFinanceImport($filepath);

        if ($factory->isValid()) {
            return $factory;
        }

        $factory = new MigrosBankImport($filepath);

        if ($factory->isValid()) {
            return $factory;
        }

        throw new \InvalidArgumentException('File is not valid');
    }
}
