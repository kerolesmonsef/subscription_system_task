<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->add_response_statuses();
    }

    private function add_response_statuses()
    {
        Response::macro("success", function (array $extra = []) {
            return response()->json(array_merge([
                'status' => 'success',
            ], $extra), 200);
        });

        Response::macro("fail", function (array $extra = [],$code = 400) {
            return response()->json(array_merge([
                'status' => 'fail',
            ], $extra), $code);
        });
    }
}
