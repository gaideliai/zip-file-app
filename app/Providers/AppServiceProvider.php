<?php

namespace App\Providers;

use App\Services\FileService;
use App\Services\FileServiceInterface;
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

            return $total_size < $parameters[0] * 1024;
        },
            "The total size of uploaded files must not exceed :maxM."
        );
    }
}
