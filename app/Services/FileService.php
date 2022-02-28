<?php

namespace App\Services;

use Exception;
use InvalidArgumentException;

class FileService implements FileServiceInterface
{
    /**
     * Archive uploaded files
     *
     * @param array $files
     * @param string $zipMethod
     *
     * @return string
     */
    public function archiveFiles(array $files, string $zipMethod): string
    {
        try {
            $fileZipperClass = $this->resolveFileZipper($zipMethod);

            $filePath = (new $fileZipperClass)->generateZipFile($files);
        } catch (Exception $e) {
            throw $e;
        }

        return $filePath;
    }

    /**
     * Map zip method to zipper class
     *
     * @param string $zipMethod
     *
     * @return string
     */
    private function resolveFileZipper(string $zipMethod): string
    {
        return match ($zipMethod) {
            'ZipArchive' => 'App\\FileZippers\\ZipArchiveFileZipper',
            'Foo' => 'App\\FileZippers\\FooFileZipper',
            default => throw new InvalidArgumentException("Invalid zip method $zipMethod")
        };
    }
}
