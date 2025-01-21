<?php

declare(strict_types=1);


namespace Abacus\ModuleBuilder\Business\Services;

use Abacus\ModuleBuilder\Business\Contracts\ModuleInterface;
use Illuminate\Console\Command;

class BusinessService
{
    private const DATA_SUFFIX = 'Data';
    private const DATA_COLLECTION_SUFFIX = 'DataCollection';

    private const BUSINESS_PATH_ROOT = 'App\\Business\\%s\\';

    public function createData(Command $command, ModuleInterface $module): void
    {
        $baseName = $this->getBasePath($module) . self::DATA_SUFFIX . '\\' . $module->getName();

        if ($module->getTranslated()) {
            $command->call(
                'abacus:make:data-collection',
                [
                    'name' => $baseName . 'Translation' . self::DATA_COLLECTION_SUFFIX
                ]
            );
        }

        $command->call('abacus:make:data', ['name' => $baseName . self::DATA_SUFFIX]);
        $command->call(
            'abacus:make:data',
            ['name' => $baseName . 'Translation' . self::DATA_SUFFIX, '--translated' => true]
        );
    }

    public function createProvider(Command $command, ModuleInterface $module): void
    {
        $options = [
            'name' => $this->getBasePath($module) . $module->getName()
        ];

        if ($module->getTranslated()) {
            $options['--translated'] = true;
        }

        $command->call('abacus:make:provider', $options);
    }

    public function createCreator(Command $command, ModuleInterface $module): void
    {
        $creatorCommands = [
            'abacus:make:interface:creator',
            'abacus:make:abstract:creator',
            'abacus:make:creator'
        ];
        foreach ($creatorCommands as $creatorCommand) {
            $command->call(
                $creatorCommand,
                ['name' => $this->getBasePath($module) . 'Services\\Creator\\' . $module->getName()]
            );
        }

        if ($module->getTranslated()) {
            foreach ($creatorCommands as $creatorCommand) {
                $command->call(
                    $creatorCommand,
                    [
                        'name' => $this->getBasePath($module) . 'Services\\TranslaterCreator\\' . $module->getName(),
                        '--translated' => true
                    ]
                );
            }
        }
    }

    public function createFacade(Command $command, ModuleInterface $module): void
    {
        $options = [
            'name' => $this->getBasePath($module) . 'Facades\\' . $module->getName()
        ];

        if ($module->getTranslated()) {
            $options['--translated'] = true;
        }

        $command->call('abacus:make:facade', $options);
    }

    private function getBasePath(ModuleInterface $module): string
    {
        return sprintf(self::BUSINESS_PATH_ROOT, $module->getName());
    }
}
