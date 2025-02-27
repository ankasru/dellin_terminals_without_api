# dellin_terminals_without_api

Salvation from the constantly falling Dellin Api /v1/public/request_terminals.json
## Install
```console
composer require ankasru/dellin_terminals_without_api dev-main
``` 
## Usage
```php
use Ankas\DellinTerminalsWithoutApi\TerminalsGetter;

$terminalsGetter = new TerminalsGetter();
$terminals = $terminalsGetter->getTerminalsByCode('7400000100000000000000000');
```