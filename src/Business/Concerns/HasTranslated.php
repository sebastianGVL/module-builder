<?php

declare(strict_types=1);

namespace Abacus\ModuleBuilder\Business\Concerns;

trait HasTranslated
{
    private bool $translated;

    public function setTranslated(bool $translated): void
    {
        $this->translated = $translated;
    }

    public function getTranslated(): bool
    {
        return $this->translated;
    }
}
