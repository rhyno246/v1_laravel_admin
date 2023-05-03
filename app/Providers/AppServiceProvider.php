<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('file_extension', function ($value, $parameters, $validator) {
            if (!$value instanceof UploadedFile) {
                return false;
            }
    
            $extensions = implode(',', $parameters);
            $validator->addReplacer('file_extension', function (
                $message
            ) use ($extensions) {
                return \str_replace(':values', $extensions, $message);
            });
    
            $extension = strtolower($value->getClientOriginalExtension());
    
            return $extension !== '' && in_array($extension, $parameters);
        });
    }
}
