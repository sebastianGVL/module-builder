#### Module builder created to escape the boilerplating when creating new modules, based on 3-layer app   
1. Business ( Provider, Data, Creator, Facade )
2. Communication ( Controller, Request )
3. Persistence ( Model, Migration, Saver, Updater, Deleter )

#### The core principle
This package is organized the same way the modules are generated, across that,   
it uses chain responsability for the factory services to generate the classes.

#### How to use
To generate a new whole module, for example CarModule, you would type into the terminal.   
If you want it to be translated, you add the --translated option to the command.

```bash
php artisan abacus:create:module Car
```
   
Don't forget to update your `bootstrap/providers.php`

```php
<?php

use App\Providers\AppServiceProvider;
use App\Business\Car\CarServiceProvider;

return [
    AppServiceProvider::class,
    CarServiceProvider::class,
];

```

PS: In case your default controller is moved from default location,update the Communication/{module}/Controllers/*Controller.php accordingly.

```php
<?php

declare(strict_types=1);

namespace App\Communication\Car\Controllers;

use App\Business\Car\Data\CarData;
use App\Business\Car\Facades\CarFacade;
use App\Communication\Car\Requests\CarRequest;
use App\Http\Controllers\Controller; // <- Check this

class CarController extends Controller
{
    public function __construct(private readonly CarFacade $facade)
    {
    }

    public function store(CarRequest $request): int
    {
        return $this->facade->store(CarData::fromRequest($request));
    }

    public function update(int $id, CarRequest $request): int
    {
        return $this->facade->update($id, CarData::fromRequest($request));
    }

    public function delete(int $id): ?bool
    {
        return $this->facade->delete($id);
    }
}
```
