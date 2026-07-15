<?php

namespace EYari\ModuleBlueprint;

use Illuminate\Support\ServiceProvider;

class ModuleBlueprintServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->registerModuleProviders();

        $this->commands([
            Console\MakeModuleCommand::class,
        ]);
    }

    public function boot()
    {
       
    }

    protected function registerModuleProviders(): void
    {
        $modulePath = base_path('app/Modules');
        if (!is_dir($modulePath)) {
            return;
        }

        $modules = glob($modulePath . '/*', GLOB_ONLYDIR);
        foreach ($modules as $module) {
            $providerFile = $module . '/Providers/' . basename($module) . 'ServiceProvider.php';
            if (file_exists($providerFile)) {
                $providerClass = 'App\\Modules\\' . basename($module) . '\\Providers\\' . basename($module) . 'ServiceProvider';
                if (class_exists($providerClass)) {
                    $this->app->register($providerClass);
                }
            }
        }
    }
}