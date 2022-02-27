<?php

namespace App\Services;

use Carbon\Carbon;
use Exception;
use ZipArchive;

class FileService implements FileServiceInterface
{
    /**
     * Archive uploaded files
     *
     * @param array $files
     *
     * @return string
     */
    public function archiveFiles(array $files): string
    {
        try {
            $zip = new ZipArchive();

            $directoryPath = sys_get_temp_dir() . '/zipFiles/';
            $this->bootstrapDirectory($directoryPath);

            $todaysDate = Carbon::today()->toDateString();
            $fileName = "zip-$todaysDate.zip";

            if ($zip->open("$directoryPath/$fileName", ZipArchive::CREATE) === true) {
                foreach ($files as $file) {
                    $zip->addFile($file->path(), $file->getClientOriginalName());
                }

                $zip->close();
            }
        } catch (Exception $e) {
            throw $e;
        }

        return $directoryPath . $fileName;
    }

    /**
     * Create directory if it doesn't exist
     *
     * @param string $directory
     *
     * @return void
     */
    private function bootstrapDirectory(string $directory): void
    {
        if (!file_exists($directory)) {
            mkdir($directory);
        }
    }
}
