<?php

declare(strict_types=1);


namespace Abacus\ModuleBuilder\Communication\Commands;

use Abacus\ModuleBuilder\Business\Concerns\HasStubs;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

class FacadeMakeCommand extends GeneratorCommand
{
    use HasStubs;

    protected $name = 'abacus:make:facade';

    protected $description = 'Create a new facade';

    protected $type = 'Facade';

    protected function getOptions()
    {
        return [
            ['--translated']
        ];
    }

    protected function getStub(): string
    {
        $class = $this->option('translated') ? 'translatedfacadeclass.stub' : 'facadeclass.stub';

        return $this->resolveStubPath(__DIR__, "/stubs/business/facades/" . $class);
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace . '\Business\Shared\Facades';
    }

    protected function getPath($name)
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);

        return $this->laravel['path'] . '/' . str_replace('\\', '/', $name) . 'Facade.php';
    }
}
