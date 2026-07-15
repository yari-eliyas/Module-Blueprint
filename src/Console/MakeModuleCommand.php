<?php

namespace EYari\ModuleBlueprint\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class MakeModuleCommand extends Command
{
  
    protected $signature = 'module:make {name}';

    protected $description = 'Create a new module with custom structure (Controller, Model, Migrate, Router, Services, Helper, Validator)';

    protected Filesystem $files;

    public function __construct(Filesystem $files)
    {
        parent::__construct();
        $this->files = $files;
    }

    public function handle()
    {
        $name = $this->argument('name');
        $name = ucfirst($name); // StudlyCase

        $modulePath = base_path("app/Modules/{$name}");

        if ($this->files->exists($modulePath)) {
            $this->error("Module '{$name}' already exists!");
            return 1;
        }

        $this->createDirectories($modulePath);
        $this->createFiles($modulePath, $name);

        $this->info("✅ Module '{$name}' created successfully!");
        $this->info("📂 Path: {$modulePath}");
    }

    protected function createDirectories(string $modulePath): void
    {
        $directories = [
            'Controller',
            'Models',
            'Migrate',
            'Router',
            'Views',
            'Services',
            'Helper',
            'Validator',
            'Providers'
        ];

        foreach ($directories as $dir) {
            $this->files->makeDirectory("{$modulePath}/{$dir}", 0755, true, true);
        }
    }

    protected function createFiles(string $modulePath, string $name): void
    {
        $stubPath = __DIR__.'/../stubs/Module';

     
        $controllerStub = $this->files->get("{$stubPath}/Controller/Controller.php.stub");
        $controllerContent = str_replace('{{moduleName}}', $name, $controllerStub);
        $this->files->put("{$modulePath}/Controller/{$name}Controller.php", $controllerContent);

        
        $modelStub = $this->files->get("{$stubPath}/Models/Model.php.stub");
        $modelContent = str_replace('{{moduleName}}', $name, $modelStub);
        $this->files->put("{$modulePath}/Models/{$name}.php", $modelContent);

      
        $migrationStub = $this->files->get("{$stubPath}/Migrate/Migrate.php.stub");
        $migrationContent = str_replace('{{moduleName}}', $name, $migrationStub);
        $timestamp = date('Y_m_d_His');
        $this->files->put("{$modulePath}/Migrate/{$timestamp}_create_{$name}_table.php", $migrationContent);

   
        $routerStub = $this->files->get("{$stubPath}/Router/web.php.stub");
        $routerContent = str_replace('{{moduleName}}', $name, $routerStub);
        $this->files->put("{$modulePath}/Router/web.php", $routerContent);

    
        $providerStub = $this->files->get("{$stubPath}/Providers/ModuleServiceProvider.php.stub");
        $providerContent = str_replace('{{moduleName}}', $name, $providerStub);
        $providerContent = str_replace('{{lowerModuleName}}', strtolower($name), $providerContent);
        $this->files->put("{$modulePath}/Providers/{$name}ServiceProvider.php", $providerContent);


        $viewStub = $this->files->get("{$stubPath}/Views/index.blade.php.stub");
        $viewContent = str_replace('{{moduleName}}', $name, $viewStub);
        $this->files->put("{$modulePath}/Views/index.blade.php", $viewContent);

    }
}