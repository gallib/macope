<?php

namespace Gallib\Macope\Importer;

use Illuminate\Http\UploadedFile;

interface ImportDataInterface
{
    /**
     * Return whether the given file is valid or not.
     *
     * @param  \Illuminate\Http\UploadedFile $uploadedFile
     * @return bool
     */
    public static function isFileValid(UploadedFile $uploadedFile);

    /**
     * Import the given file.
     *
     * @return bool
     */
    public function import();
}
