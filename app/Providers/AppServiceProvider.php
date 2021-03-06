<?php

namespace App\Providers;

use App\Repositories\UploadStatisticsRepository;
use App\Repositories\UploadStatisticsRepositoryInterface;
use App\Services\FileService;
use App\Services\FileServiceInterface;
use App\Services\UploadStatisticsService;
use App\Services\UploadStatisticsServiceInterface;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            FileServiceInterface::class,
            FileService::class,
        );

        $this->app->bind(
            UploadStatisticsServiceInterface::class,
            UploadStatisticsService::class,
        );

        $this->app->bind(
            UploadStatisticsRepositoryInterface::class,
            UploadStatisticsRepository::class,
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('max_uploaded_file_size', function ($attribute, $value, $parameters, $validator) {
            $validator->addReplacer('max_uploaded_file_size', function($message, $attribute, $rule, $parameters){
                return str_replace([':max'], $parameters, $message);
            });

            $total_size = array_reduce($value, function ($sum, $item) {
                $sum += filesize($item->path());
                return $sum;
            });

            return $total_size < $parameters[0] * 1024 * 1024;
        },
            "The total size of uploaded files must not exceed :maxM."
        );
    }
}
