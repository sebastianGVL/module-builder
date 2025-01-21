<?php

declare(strict_types=1);


namespace Abacus\ModuleBuilder\Communication\Commands;

use Abacus\ModuleBuilder\Business\Concerns\HasStubs;
use Illuminate\Console\GeneratorCommand;

class DataMakeCommand extends GeneratorCommand
{
    use HasStubs;
    
    protected $name = 'abacus:make:data';

    protected $description = 'Create a new data class';

    protected $type = 'Data';

    protected function getOptions()
    {
        return [
            ['--translated']
        ];
    }

    protected function getStub(): string
    {
        $class = $this->option('translated') ? 'translateddataclass.stub' : 'dataclass.stub';

        return $this->resolveStubPath("/stubs/business/data/" . $class);
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace . '\Business\Shared\Data';
    }
}
