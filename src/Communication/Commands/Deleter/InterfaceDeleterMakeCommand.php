<?php

declare(strict_types=1);


namespace Abacus\ModuleBuilder\Communication\Commands\Deleter;

use Abacus\ModuleBuilder\Business\Concerns\HasStubs;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

class InterfaceDeleterMakeCommand extends GeneratorCommand
{
    use HasStubs;
    
    protected $name = 'abacus:make:interface:deleter';

    protected $description = 'Create a new interface deleter';

    protected $type = 'InterfaceDeleter';

    protected function getStub(): string
    {
        return $this->resolveStubPath(__DIR__, '/stubs/interfacedeleter.stub');
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace . '\Persistence\Shared\Services\Deleter';
    }

    protected function getPath($name)
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);

        return $this->laravel['path'] . '/' . str_replace('\\', '/', $name) . 'DeleterInterface.php';
    }
}
