<?php

declare(strict_types=1);


namespace Abacus\ModuleBuilder\Business\Contracts;

interface ModuleInterface
{
    public function getName(): string;

    public function setName(string $name): void;

    public function getTranslated(): bool;

    public function setTranslated(bool $translated): void;
}
