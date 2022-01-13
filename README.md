<p align="center">
    <a href="https://agencearcange.fr" target="_blank">
        <img src="https://media.agencearcange.fr/sylius-arcange.gif" />
    </a>
</p>

<h1 align="center">Mercanet BNP Paribas payment plugin</h1>

[![Build](https://github.com/agencearcange/SyliusMercanetBnpParibasPlugin/actions/workflows/build.yaml/badge.svg?branch=v1)](https://github.com/agencearcange/SyliusMercanetBnpParibasPlugin/actions/workflows/build.yaml)

## Install

### Requirements

This version (v1) support Sylius 1.7

| Package | Version |
| --- |---------|
| PHP | ^7.4    |
| Sylius | 1.7     |

----
```bash
$ composer require arcange/sylius-mercanet-bnp-paribas-plugin
```

Add plugin dependencies to your config/bundles.php file:
```php
<?php

// config/bundles.php

return [
    // ...
    Arcange\SyliusMercanetBnpParibasPlugin\ArcangeSyliusMercanetBnpParibasPlugin::class => ['all' => true],
];
```

## Usage

Go to the payment methods in your admin panel. Now you should be able to add new payment method for Mercanet BNP Paribas gateway.

Note: to test the plugin locally, see [CONTRIBUTING.md](CONTRIBUTING.md)

## Credit

Based on fork of https://github.com/BitBagCommerce/SyliusMercanetBnpParibasPlugin.

## License

This plugin's source code is completely free and released under the terms of the MIT license.
