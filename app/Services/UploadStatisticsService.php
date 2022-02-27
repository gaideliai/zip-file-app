<?php

namespace App\Services;

use App\Repositories\UploadStatisticsRepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class UploadStatisticsService implements UploadStatisticsServiceInterface
{
    /**
     * UploadStatisticsService constructor.
     *
     * @param UploadStatisticsRepositoryInterface $uploadStatisticsRepository
     */
    public function __construct(
        private UploadStatisticsRepositoryInterface $uploadStatisticsRepository
    ) {
    }
    /**
     * Insert upload statistics into a database
     *
     * @param string $ipAddress
     *
     * @return void
     */
    public function insertUploadStatistics(string $ipAddress): void
    {
        DB::beginTransaction();
        try {
            $uploadStatistics = $this->uploadStatisticsRepository->updateOrCreate($ipAddress);

            if (!$uploadStatistics) {
                throw new ModelNotFoundException("UploadStatistics after creation");
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            throw $e;
        }
    }
}
