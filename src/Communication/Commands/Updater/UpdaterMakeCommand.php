<?php

declare(strict_types=1);


namespace Abacus\ModuleBuilder\Communication\Commands\Updater;

use Abacus\ModuleBuilder\Business\Concerns\HasStubs;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

class UpdaterMakeCommand extends GeneratorCommand
{
    use HasStubs;
    
    protected $name = 'abacus:make:updater';

    protected $description = 'Create a new updater class';

    protected $type = 'Updater';

    protected function getStub(): string
    {
        return $this->resolveStubPath(__DIR__, '/stubs/updaterclass.stub');
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace . '\Persistence\Shared\Services\Updater';
    }

    protected function getPath($name)
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);

        return $this->laravel['path'].'/'.str_replace('\\', '/', $name).'Updater.php';
    }
}
