<?php

declare(strict_types=1);


namespace Abacus\ModuleBuilder\Business\Concerns;

trait HasName
{
    private string $name;

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
