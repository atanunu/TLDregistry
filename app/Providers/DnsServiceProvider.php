<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use App\Dns\TopologyManager;
class DnsServiceProvider extends ServiceProvider
{
    public function register(){ $this->app->singleton(TopologyManager::class,fn($app)=>new TopologyManager(config('dns'))); }
}
