<?php

namespace EYari\ModuleBlueprint;

use Illuminate\Support\ServiceProvider;

class ModuleBlueprintServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->commands([
            Console\MakeModuleCommand::class,
        ]);

        $this->registerModuleProviders();
    }

    protected function registerModuleProviders(): void
    {
        $modulePath = base_path('app/Modules');

        if (! is_dir($modulePath)) {
            return;
        }

        foreach (glob($modulePath . '/*', GLOB_ONLYDIR) ?: [] as $module) {
            $moduleName = basename($module);
            $providerFile = "{$module}/Providers/{$moduleName}ServiceProvider.php";
            $providerClass = "App\\Modules\\{$moduleName}\\Providers\\{$moduleName}ServiceProvider";

            if (is_file($providerFile) && class_exists($providerClass)) {
                $this->app->register($providerClass);
            }
        }
    }
}
