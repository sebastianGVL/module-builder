<?php

declare(strict_types=1);



namespace Abacus\ModuleBuilder\Communication\Commands\Updater;

use Abacus\ModuleBuilder\Business\Concerns\HasStubs;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

class AbstractUpdaterMakeCommand extends GeneratorCommand
{
    use HasStubs;
    
    protected $name = 'abacus:make:abstract:updater';

    protected $description = 'Create a new abstract updater class';

    protected $type = 'AbstractUpdater';

    protected function getStub(): string
    {
        return $this->resolveStubPath(__DIR__, '/stubs/abstractupdaterclass.stub');
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace . '\Persistence\Shared\Services\Updater';
    }

    protected function getPath($name)
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);

        $name = explode('\\', $name);
        $name[array_key_last($name)] = 'Abstract' . $name[array_key_last($name)];
        $name = implode('\\', $name);

        return $this->laravel['path'] . '/' . str_replace('\\', '/', $name) . 'Updater.php';
    }
}
