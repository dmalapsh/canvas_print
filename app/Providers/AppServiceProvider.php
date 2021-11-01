<?php

namespace App\Providers;


use App\Http\Controllers\UserControllerOld;
use App\Observers\ProjectCommentObserver;
use App\Observers\ProjectMessageObserver;
use App\Observers\ProjectObserver;
use App\Project;
use App\ProjectComment;
use App\ProjectMessage;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class  AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(191);
    }


    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//        ProjectComment::observe(ProjectCommentObserver::class);
//	    Relation::morphMap([
//		    'comment' => 'App\ProjectComment',
//		    'massage' => 'App\ProjectMessage',
//	    ]);


    }
}
