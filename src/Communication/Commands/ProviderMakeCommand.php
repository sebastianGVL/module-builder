<?php

declare(strict_types=1);


namespace Abacus\ModuleBuilder\Communication\Commands;

use Abacus\ModuleBuilder\Business\Concerns\HasStubs;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

class ProviderMakeCommand extends GeneratorCommand
{
    use HasStubs;

    protected $name = 'abacus:make:provider';

    protected $description = 'Create a new provider';

    protected $type = 'Provider';


    protected function getStub(): string
    {
        $class = $this->option('translated') ? 'translatedproviderclass.stub' : 'providerclass.stub';

        return $this->resolveStubPath(__DIR__ ,"/stubs/business/providers/" . $class);
    }

    protected function getOptions()
    {
        return [
            ['--translated']
        ];
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace . '\Business\Shared';
    }

    protected function getPath($name)
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);

        return $this->laravel['path'] . '/' . str_replace('\\', '/', $name) . 'ServiceProvider.php';
    }
}
