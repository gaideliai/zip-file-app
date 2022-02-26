<?php

namespace App\Services;

interface FileServiceInterface
{
    /**
     * Archive uploaded files
     *
     * @param array $files
     *
     * @return string
     */
    public function archiveFiles(array $files): string;
}
