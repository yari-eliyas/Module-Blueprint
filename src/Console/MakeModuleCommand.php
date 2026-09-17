<?php

namespace EYari\ModuleBlueprint\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use RuntimeException;

class MakeModuleCommand extends Command
{
    protected $signature = 'module:make
        {name : The module name}
        {--force : Overwrite an existing module}';

    protected $description = 'Create a Laravel module with controllers, models, migrations, routes, views and a service provider';

    public function __construct(private readonly Filesystem $files)
    {
        parent::__construct();
    }

    public function handle(): int
    {
        $input = trim((string) $this->argument('name'));
        $name = Str::studly($input);

        if ($name === '') {
            $this->error('Module name cannot be empty.');
            return self::FAILURE;
        }

        if (! preg_match('/^[A-Za-z][A-Za-z0-9_]*$/', $name)) {
            $this->error('Module name must start with a letter and contain only letters, numbers or underscores.');
            return self::FAILURE;
        }

        $modulePath = base_path("app/Modules/{$name}");

        if ($this->files->isDirectory($modulePath) && ! $this->option('force')) {
            $this->error("Module '{$name}' already exists. Use --force to overwrite generated files.");
            return self::FAILURE;
        }

        $this->createDirectories($modulePath);
        $this->createFiles($modulePath, $name);

        $this->components->info("Module '{$name}' created successfully.");
        $this->line("<fg=gray>Path:</> {$modulePath}");

        return self::SUCCESS;
    }

    protected function createDirectories(string $modulePath): void
    {
        foreach ([
            'Controller',
            'Models',
            'Migrate',
            'Router',
            'Views',
            'Services',
            'Helper',
            'Validator',
            'Providers',
        ] as $directory) {
            $this->files->makeDirectory("{$modulePath}/{$directory}", 0755, true, true);
        }
    }

    protected function createFiles(string $modulePath, string $name): void
    {
        $stubPath = __DIR__ . '/../stubs/Module';
        $replacements = [
            '{{moduleName}}' => $name,
            '{{lowerModuleName}}' => Str::snake($name),
        ];

        $files = [
            "Controller/{$name}Controller.php" => 'Controller/Controller.php.stub',
            "Models/{$name}.php" => 'Models/Model.php.stub',
            "Migrate/" . date('Y_m_d_His') . "_create_" . Str::snake($name) . "_table.php" => 'Migrate/Migrate.php.stub',
            'Router/web.php' => 'Router/web.php.stub',
            "Providers/{$name}ServiceProvider.php" => 'Providers/ModuleServiceProvider.php.stub',
            'Views/index.blade.php' => 'Views/index.blade.php.stub',
        ];

        foreach ($files as $destination => $stub) {
            $stubFile = "{$stubPath}/{$stub}";

            if (! $this->files->exists($stubFile)) {
                throw new RuntimeException("Missing module stub: {$stub}");
            }

            $destinationFile = "{$modulePath}/{$destination}";
            if ($this->files->exists($destinationFile) && ! $this->option('force')) {
                continue;
            }

            $content = str_replace(
                array_keys($replacements),
                array_values($replacements),
                $this->files->get($stubFile)
            );

            $this->files->put($destinationFile, $content);
        }
    }
}
