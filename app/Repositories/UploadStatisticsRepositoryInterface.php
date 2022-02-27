<?php

namespace App\Repositories;

use App\Models\UploadStatistics;

interface UploadStatisticsRepositoryInterface
{
    /**
     * Method to update or create UploadStatistics
     *
     * @param string $ipAddress
     *
     * @return UploadStatistics|null
     */
    public function updateOrCreate(string $ipAddress): ?UploadStatistics;
}
