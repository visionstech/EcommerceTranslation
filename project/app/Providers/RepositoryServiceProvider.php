<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            "App\Repositories\\CommonRepositoryInterface",
            "App\Repositories\\CommonRepository"
        );
        
        /*
        $models = [
            'Publisher',
            'User',
        ];
        
        foreach ($models as $model) {
            $this->app->bind(
                "App\Contracts\\{$model}Interface",
                "App\Repositories\\{$model}Repository"
            );
        }
        */
    }
}
?>
