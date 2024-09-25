<?php

namespace App\Providers;

use App\Interfaces\CityRepositoryInterface;
use App\Interfaces\CountryRepositoryInterface;
use App\Interfaces\EmployeRepositoryInterface;
use App\Interfaces\PositionRepositoryInterface;
use App\Repositories\CityRepository;
use App\Repositories\CountryRepository;
use App\Repositories\EmployeRepository;
use App\Repositories\PositionRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(CityRepositoryInterface::class, CityRepository::class);
        $this->app->bind(CountryRepositoryInterface::class, CountryRepository::class);
        $this->app->bind(EmployeRepositoryInterface::class, EmployeRepository::class);
        $this->app->bind(PositionRepositoryInterface::class, PositionRepository::class);
    }
}
