<?php

namespace App\Contracts\Importers;

interface ImportData
{
    /**
     * Return whether the given file is valid or not.
     *
     * @return bool
     */
    public function isValid(): bool;

    /**
     * Import entries from file.
     *
     * @return bool
     */
    public function import(): bool;
}
