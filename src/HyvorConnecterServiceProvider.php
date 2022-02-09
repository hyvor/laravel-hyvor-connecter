<?php
namespace Hyvor\HyvorConnecter;

use Illuminate\Support\ServiceProvider;

class HyvorConnecterServiceProvider extends ServiceProvider {

    public function register() {

        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'hyvorconnecter');

    }

    public function boot() {
        
    }

}