<?php

namespace App\Services;

interface UploadStatisticsServiceInterface
{
    /**
     * Insert upload statistics into a database
     *
     * @param string $ipAddress
     *
     * @return void
     */
    public function insertUploadStatistics(string $ipAddress): void;
}
