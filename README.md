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


Note: to test the plugin locally, see [CONTRIBUTING.md](CONTRIBUTING.md)

1. [Install Sylius](https://docs.sylius.com/en/latest/book/installation/installation.html)
2. Install **Mercanet Plugin**: `composer require arcange/mercanet-bnp-paribas-plugin`
3. Register the bundle:

```php
<?php

// config/bundles.php

return [
    // ...
    Arcange\SyliusMercanetBnpParibasPlugin\ArcangeSyliusMercanetBnpParibasPlugin::class => ['all' => true],
];
```


## Credit

Based on fork of https://github.com/BitBagCommerce/SyliusMercanetBnpParibasPlugin.

## License

This plugin's source code is completely free and released under the terms of the MIT license.
