<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Stall\StallRepository;
use App\Repositories\Stall\EloquentStall;
use App\Repositories\Icecream\IcecreamRepository;
use App\Repositories\Icecream\EloquentIcecream;
use App\Repositories\Opinion\OpinionRepository;
use App\Repositories\Opinion\EloquentOpinion;
use App\Repositories\User\UserRepository;
use App\Repositories\User\EloquentUser;
use App\Repositories\Vote\VoteRepository;
use App\Repositories\Vote\EloquentVote;
use App\Repositories\Rate\RateRepository;
use App\Repositories\Rate\EloquentRate;
use App\Models\Stall;
use App\Observers\StallObserver;

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
        //
        $this->app->singleton(StallRepository::class, EloquentStall::class);
        $this->app->singleton(IcecreamRepository::class, EloquentIcecream::class);
        $this->app->singleton(OpinionRepository::class, EloquentOpinion::class);
        $this->app->singleton(UserRepository::class, EloquentUser::class);
        $this->app->singleton(VoteRepository::class, EloquentVote::class);
        $this->app->singleton(RateRepository::class, EloquentRate::class);
        Stall::observe(StallObserver::class);
    }
}
