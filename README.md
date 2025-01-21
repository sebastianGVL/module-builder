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
