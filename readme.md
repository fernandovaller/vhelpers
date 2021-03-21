# Helpers

Conjunto de helpers que auxiliam nas funcionalidades dos sistemas

## Installation

```bash
composer require fernandovaller/vhelpers
```
### mask

Formata um valor conforme o padrão de mascara informado

```php
use FVCode\VHelpers\Helper;

$cpf = '92454026066';

echo Helper::mask($cpf, '###.###.###-##');
// 924.540.260-66;
```

### dateBR

Converte uma data no padrão US para o padrão BR

```php
$date = '2021-03-14';

$date_in_br = Helper::dateBR($date);
// 14/03/2021
```

### dateTranslateUsToBr

Traduz a descrição de Dias e Meses em US para BR

```php
$description_us = 'Monday, 14 March 2021';

echo Helper::dateTranslateUsToBr($description_us);
// Segunda, 14 Março 2021;
```

### redirect

Força o redirecionamento para uma URL

```php
$url = 'www.google.com';

Helper::redirect($url);
```
