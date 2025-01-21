<?php

declare(strict_types=1);


namespace Abacus\ModuleBuilder\Business\Handlers;

use Abacus\ModuleBuilder\Business\Contracts\ModuleInterface;
use Illuminate\Console\Command;

abstract class AbstractHandler
{
    private ?AbstractHandler $successor = null;

    public function __construct(protected readonly Command $command)
    {
    }

    public function getSuccessor(): ?AbstractHandler
    {
        return $this->successor;
    }

    public function setSuccessor(AbstractHandler $handler): void
    {
        $this->successor = $handler;
    }

    final public function handle(ModuleInterface $module): ModuleInterface
    {
        $response = $this->process($module);

        if ($response && $this->successor) {
            $this->successor->handle($response);
        }

        return $response;
    }

    abstract protected function process(ModuleInterface $module): ModuleInterface;
}
