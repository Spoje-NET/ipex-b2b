# AGENTS.md - Working AI Reference for ipex-b2b

## Project Overview
**Type**: PHP Library / Debian Package  
**Purpose**: PHP client library for the [IPEX B2B REST API](https://restapi.ipex.cz/documentation) — enables read/write operations on the IPEX VoIP system (customers, calls, services, SIM cards, rights, tokens)  
**License**: MIT  
**Status**: Active  
**Repository**: https://github.com/Spoje-NET/ipex-b2b  
**Packagist**: `spojenet/ipexb2b`  
**Debian package**: `php-spojenet-ipex-b2b`  
**Current version**: 1.2.0

## Key Technologies
- PHP >= 8.0 (ext-curl required)
- [vitexsoftware/ease-core](https://github.com/VitexSoftware/ease-core) — logging, base `Brick` class
- Composer (PSR-4 autoloading, namespace `IPEXB2B\`)
- Debian packaging (`debhelper-compat 13`, `pkg-php-tools`)
- PHPUnit, PHPStan, php-cs-fixer

## Repository Structure
```
ipex-b2b/
├── src/IPEXB2B/          # Library source (PSR-4, namespace IPEXB2B\)
│   ├── ApiClient.php     # Base cURL/REST client; all sections extend this
│   ├── Token.php         # Bearer-token authentication
│   ├── Calls.php         # /calls section
│   ├── Customers.php     # /customers section
│   ├── Rights.php        # /rights section
│   ├── Services.php      # /services section
│   └── Voip.php          # /voip section (credit top-up, numbers)
├── tests/src/IPEXB2B/    # PHPUnit tests
│   ├── ApiClientTest.php
│   └── CallsTest.php
├── Examples/             # Runnable usage examples
├── debian/               # Debian packaging files
│   ├── control           # Package metadata
│   ├── autoload.php      # Static Debian autoloader (replaces phpab/composer-debian)
│   ├── Jenkinsfile       # CI pipeline
│   └── Jenkinsfile.release
├── composer.json         # Package: spojenet/ipexb2b
├── phpunit.xml
├── phpstan-default.neon.dist
└── Makefile
```

## Configuration

Set via PHP constants or pass as `$options` array to the constructor:

```php
define('IPEX_URL',      'https://restapi.ipex.cz');
define('IPEX_LOGIN',    'firma_api');
define('IPEX_PASSWORD', 'secret');
```

Constructor options override constants:

```php
$client = new \IPEXB2B\Rights(null, [
    'url'      => 'https://testapi.ipex.cz',
    'user'     => 'resttest',
    'password' => 'secret',
]);
```

## Development Workflow

### Setup
```bash
composer install
```

### Testing
```bash
make tests
# or
vendor/bin/phpunit tests
```

### Static Analysis
```bash
make static-code-analysis
# regenerate baseline:
make static-code-analysis-baseline
```

### Code Style
```bash
make cs   # runs php-cs-fixer
```

### Debian Build
```bash
dpkg-buildpackage -b -uc
```

## Architecture Notes

- `ApiClient` extends `Ease\Brick` and uses the `Ease\Logger\Logging` trait.
- Authentication is token-based (`Token` class, singleton via `Token::instanced()`). The token is injected as an `Authorization` header on every request.
- Subclasses set `$this->section` to the API path segment (e.g. `'voip'`, `'customers'`). `getSectionURL()` builds `{url}/v1/{section}`.
- `requestData($urlSuffix, $method, $format)` is the main entry point for all HTTP calls.
- The Debian autoloader (`debian/autoload.php`) is a static file — do **not** regenerate it with `phpab` or `composer-debian`.

## API Documentation
- REST API reference: https://restapi.ipex.cz/documentation
