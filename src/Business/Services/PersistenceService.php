<?php

declare(strict_types=1);


namespace Abacus\ModuleBuilder\Business\Services;

use Abacus\ModuleBuilder\Business\Contracts\ModuleInterface;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class PersistenceService
{
    private const PERSISTENCE_PATH_ROOT = 'App\\Persistence\\%s\\';

    private const MIGRATION_PATH_ROOT = '/app/Persistence/%s/database/migrations';

    public function createModel(Command $command, ModuleInterface $module): void
    {
        $command->call(
            'make:model',
            ['name' => $this->getBasePath($module) . $module->getName()]
        );

        if ($module->getTranslated()) {
            $command->call(
                'make:model',
                ['name' => $this->getBasePath($module) . $module->getName() . 'Translation']
            );
        }
    }

    public function createMigration(Command $command, ModuleInterface $module): void
    {
        $command->call(
            'make:migration',
            [
                'name' => $this->getMigrationName($module),
                '--path' => $this->getMigrationPath($module)
            ]
        );
    }


    public function createSaver(Command $command, ModuleInterface $module): void
    {
        $creatorCommands = [
            'abacus:make:interface:saver',
            'abacus:make:abstract:saver',
            'abacus:make:saver'
        ];

        foreach ($creatorCommands as $creatorCommand) {
            $command->call(
                $creatorCommand,
                [
                    'name' => $this->getBasePath($module) . 'Services\\Saver\\' . $module->getName(),
                ]
            );
        }

        if ($module->getTranslated()) {
            foreach ($creatorCommands as $creatorCommand) {
                $command->call(
                    $creatorCommand,
                    [
                        'name' => $this->getBasePath($module) . 'Services\\TranslaterSaver\\' . $module->getName(),
                        '--translated' => true
                    ]
                );
            }
        }
    }

    public function createUpdater(Command $command, ModuleInterface $module): void
    {
        $creatorCommands = [
            'abacus:make:interface:updater',
            'abacus:make:abstract:updater',
            'abacus:make:updater'
        ];

        foreach ($creatorCommands as $creatorCommand) {
            $command->call(
                $creatorCommand,
                ['name' => $this->getBasePath($module) . 'Services\\Updater\\' . $module->getName()]
            );
        }
    }

    public function createDeleter(Command $command, ModuleInterface $module): void
    {
        $deleterCommands = [
            'abacus:make:interface:deleter',
            'abacus:make:deleter'
        ];

        foreach ($deleterCommands as $deleterCommand) {
            $command->call(
                $deleterCommand,
                ['name' => $this->getBasePath($module) . 'Services\\Deleter\\' . $module->getName()]
            );
        }
    }

    private function getBasePath(ModuleInterface $module): string
    {
        return sprintf(self::PERSISTENCE_PATH_ROOT, $module->getName());
    }

    private function getMigrationPath(ModuleInterface $module): string
    {
        return sprintf(self::MIGRATION_PATH_ROOT, $module->getName());
    }

    private function getMigrationName(ModuleInterface $module): string
    {
        return 'create_' . Str::plural($this->convertSnakeCase($module->getName())) . '_table';
    }

    private function convertSnakeCase(string $input): string
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $input));
    }
}
