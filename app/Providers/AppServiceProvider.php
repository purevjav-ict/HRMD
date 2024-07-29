<?php

namespace App\Providers;
use App\Models\Settings;
use App\Models\Leave;
use App\Models\Project;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;

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
        Paginator::useBootstrap();
         view()->composer('*', function ($view) {
            $view->with('ver','1.8');
        });


        $settings=Settings::all();

        foreach ($settings as $settingss => $values) {
            $field=$values->field;
            $content=$values->value;
            View::share($field,$content);
            view()->share($field,$content);


            //for Controller
         $this->app->singleton('.$field.', function ($content) {
          return $content;
        });


           }


         /* Badges */
         $leave_count=Leave::Where('status', '=', '0')->count();
         View::share('leave_count', $leave_count);
         $project_count=Project::Where('status', '=', '0')->count();
         View::share('project_count', $project_count);
    }
}
