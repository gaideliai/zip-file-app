<?php

namespace App\Repositories;

use App\Models\UploadStatistics;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UploadStatisticsRepository implements UploadStatisticsRepositoryInterface
{
    /**
     * Method to update or create UploadStatistics
     *
     * @param string $ipAddress
     *
     * @return UploadStatistics|null
     */
    public function updateOrCreate(string $ipAddress): ?UploadStatistics
    {
        return UploadStatistics::updateOrCreate(
            [
                'ip_address' => $ipAddress,
                'usage_date' => DB::raw('CAST(CURRENT_TIMESTAMP AS DATE)')
            ],
            [
                'ip_address' => $ipAddress,
                'usage_count_per_day' => DB::raw('usage_count_per_day + 1'),
                'usage_date' => Carbon::now()->toDateString()
            ]
        );
    }
}
