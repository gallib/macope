<?php

namespace App\Contracts\Importers;

use Illuminate\Http\UploadedFile;

interface ImportData
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
