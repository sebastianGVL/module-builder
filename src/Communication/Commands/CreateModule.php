<?php

declare(strict_types=1);


namespace Abacus\ModuleBuilder\Communication\Commands;

use Abacus\ModuleBuilder\Business\Services\CreateModuleCommandService;
use Illuminate\Console\Command;

class CreateModule extends Command
{
    /** @var string */
    protected $signature = 'abacus:create:module {name} {--translated}';

    /** @var string */
    protected $description = 'Creates a module';

    public function handle(CreateModuleCommandService $moduleCommandService): void
    {
        $translated = $this->option('translated');

        $moduleCommandService->setHandlers($translated, $this->argument('name'), $this);
    }
}
