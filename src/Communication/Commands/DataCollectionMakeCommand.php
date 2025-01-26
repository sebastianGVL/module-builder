<?php

declare(strict_types=1);


namespace Abacus\ModuleBuilder\Communication\Commands;

use Abacus\ModuleBuilder\Business\Concerns\HasStubs;
use Illuminate\Console\GeneratorCommand;

class DataCollectionMakeCommand extends GeneratorCommand
{
    use HasStubs;

    protected $name = 'abacus:make:data-collection';

    protected $description = 'Create a new data collection class';

    protected $type = 'DataCollection';

    protected function getStub(): string
    {
        return $this->resolveStubPath(__DIR__, "/stubs/business/data/datacollectionclass.stub");
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace . '\Business\Shared\Data';
    }
}
