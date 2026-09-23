# AFS Logistic SDK

[![Latest Version on Packagist](https://img.shields.io/packagist/v/smart-dato/afs-logistic-sdk.svg?style=flat-square)](https://packagist.org/packages/smart-dato/afs-logistic-sdk)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/smart-dato/afs-logistic-sdk/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/smart-dato/afs-logistic-sdk/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/smart-dato/afs-logistic-sdk/code-style.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/smart-dato/afs-logistic-sdk/actions?query=workflow%3A%22Code+style%22+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/smart-dato/afs-logistic-sdk.svg?style=flat-square)](https://packagist.org/packages/smart-dato/afs-logistic-sdk)

A Laravel package for looking up shipment tracking through the AFS Logistic public data service API.

## Requirements

- PHP 8.2+
- Laravel 10 – 13

## Installation

```bash
composer require smart-dato/afs-logistic-sdk
```

Publish the config file:

```bash
php artisan vendor:publish --tag="afs-logistic-sdk-config"
```

## Configuration

```dotenv
AFS_LOGISTIC_TRACKING=https://shippingnet01.ondot.at/afs/dataservice/publicapi/v1/shipment/retrieve
```

> **Set `AFS_LOGISTIC_TRACKING` explicitly.** The default in the published config contains a stray space (`…ondot.at /afs/…`), so requests fail if you rely on it.

The config also defines `AFS_LOGISTIC_URI`, which the package does not currently use.

## Usage

Construct the client with your AFS credentials:

```php
use SmartDato\AfsLogistic\AfsLogistic;

$afs = new AfsLogistic(
    clientId: 'your-client-id',
    orgunitId: 'your-orgunit-id',
    authToken: 'your-auth-token',
);

$shipment = $afs->tracking('your-shipment-number');
```

`tracking()` looks the shipment up by its matching number and returns the decoded JSON response. It requests the shipment's codes, status, number and pickup/delivery carrier IDs, plus each collo's codes, status, number, tracking number and tracking link.

The credentials have no config fallback, so the `AfsLogistic` facade resolves a client without them — construct it directly as above.

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [SmartDato](https://github.com/smart-dato)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
