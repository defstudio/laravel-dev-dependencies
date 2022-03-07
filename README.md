# laravel-tools

## Installation
You can install this package via Composer:

`composer require --dev defstudio/laravel-dev-dependencies`

## Setup

### Publishing Assets

### Composer Scripts
Add the following scripts to composer.json

```
"php-cs-fixer": "php-cs-fixer fix -v --config=./.php-cs-fixer.php",
"lint": "@php-cs-fixer",
"test:lint": "@php-cs-fixer --dry-run",
"test:types": "php ./vendor/bin/phpstan analyse --ansi --memory-limit=-1",
"test:mutation": "./vendor/bin/infection --test-framework=pest --show-mutations",
"test": "php ./vendor/bin/pest --colors=always --parallel",
"x-ray": "./vendor/bin/x-ray .",
"update:snapshots": "php ./vendor/bin/pest --colors=always -d --update-snapshots",
"test:all": [
    "@test:lint",
    "@test:types",
    "@test",
    "@x-ray".
]
```
