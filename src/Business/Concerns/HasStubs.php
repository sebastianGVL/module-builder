<?php

declare(strict_types= 1);

namespace Abacus\ModuleBuilder\Business\Concerns;

trait HasStubs 
{
    protected function resolveStubPath(string $stub): string
    {
        return file_exists($customPath = $this->laravel->basePath(trim($stub, '/')))
            ? $customPath
            : __DIR__ . $stub;
    }
}
