<?php

namespace App\FileZippers;

interface FileZipperInterface
{
    /**
     * Generate zip file
     *
     * @param array $files
     *
     * @return string
     */
    public function generateZipFile(array $files): string;
}
