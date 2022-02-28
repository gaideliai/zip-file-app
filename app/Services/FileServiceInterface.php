<?php

namespace App\Services;

interface FileServiceInterface
{
    /**
     * Archive uploaded files
     *
     * @param array $files
     * @param string $zipMethod
     *
     * @return string
     */
    public function archiveFiles(array $files, string $zipMethod): string;
}
