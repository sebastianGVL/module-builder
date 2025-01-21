<?php

namespace Abacus\ModuleBuilder\Communication\Commands;

use Abacus\ModuleBuilder\Business\Concerns\HasStubs;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

class ControllerMakeCommand extends GeneratorCommand
{
    use HasStubs;
    
    protected $name = 'abacus:make:controller';

    protected $description = 'Create a new controller class';

    protected $type = 'Controller';

    protected function getStub(): string
    {
        return $this->resolveStubPath('/stubs/communication/controllers/controllerclass.stub');
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace . '\Communication\Shared\Controller';
    }

    protected function getPath($name)
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);

        return $this->laravel['path'] . '/' . str_replace('\\', '/', $name) . 'Controller.php';
    }
}
