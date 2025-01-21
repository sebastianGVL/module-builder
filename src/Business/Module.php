<?php

declare(strict_types=1);

namespace Abacus\ModuleBuilder\Business;

use Abacus\ModuleBuilder\Business\Concerns\HasName;
use Abacus\ModuleBuilder\Business\Concerns\HasTranslated;
use Abacus\ModuleBuilder\Business\Contracts\ModuleInterface;

class Module implements ModuleInterface
{
    use HasName;
    use HasTranslated;
}
