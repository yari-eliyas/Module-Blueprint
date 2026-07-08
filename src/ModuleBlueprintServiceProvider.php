<?php

namespace EYari\ModuleBlueprint;

use Illuminate\Support\ServiceProvider;

class ModuleBlueprintServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->commands([
            Console\MakeModuleCommand::class,
        ]);
    }

    public function boot()
    {
        // می‌توانید در آینده فایل‌های کانفیگ یا ویو را هم بارگذاری کنید
    }
}