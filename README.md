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
AFS_LOGISTIC_CLIENT_ID=your-client-id
AFS_LOGISTIC_ORGUNIT_ID=your-orgunit-id
AFS_LOGISTIC_AUTH_TOKEN=your-auth-token
```

Requests go to `{AFS_LOGISTIC_URI}/afs/dataservice/publicapi/v1/shipment/retrieve`, with `AFS_LOGISTIC_URI` defaulting to `https://shippingnet01.ondot.at`. Set `AFS_LOGISTIC_TRACKING` to override the full endpoint URL.

## Usage

```php
use SmartDato\AfsLogistic\Facades\AfsLogistic;

$shipment = AfsLogistic::tracking('your-shipment-number');
```

Or pass the credentials explicitly; any you leave out fall back to the config:

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
