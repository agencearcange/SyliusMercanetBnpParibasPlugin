<p align="center">
    <a href="https://agencearcange.fr" target="_blank">
        <img src="https://media.agencearcange.fr/sylius-arcange.gif" />
    </a>
</p>

<h1 align="center">Mercanet BNP Paribas payment plugin</h1>

![](https://github.com/agencearcange/SyliusMercanetBnpParibasPlugin/workflows/Quality%20Assurance/badge.svg)


## Features

## Install

Note: to test the plugin locally, see [CONTRIBUTING.md](CONTRIBUTING.md)

1. [Install Sylius](https://docs.sylius.com/en/latest/book/installation/installation.html)
2. Install **Arcange FromDatabase Plugin**: `composer require arcange/mercanet-bnp-paribas-plugin`
3. Register the bundle:

```php
<?php

// config/bundles.php

return [
    // ...
    Arcange\MercanetBnpParibasPlugin\ArcangeMercanetBnpParibasPlugin::class => ['all' => true],
];
```
