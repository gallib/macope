<?php

namespace Gallib\Macope\App\Importer;

use Illuminate\Http\UploadedFile;

interface ImportDataInterface
{
    /**
     * Return whether the given file is valid or not
     *
     * @param  \Illuminate\Http\UploadedFile $uploadedFile
     * @return boolean
     */
    public static function isFileValid(UploadedFile $uploadedFile);

    /**
     * Import the given file
     *
     * @return boolean
     */
    public function import();
}
