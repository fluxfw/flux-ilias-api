# flux-api

ILIAS Api

## Installation

```dockerfile
COPY --from=docker-registry.fluxpublisher.ch/flux-ilias-api/api:latest /flux-ilias-api /%path%/libs/flux-ilias-api
```

## Usage

```php
require_once __DIR__ . "/%path%/libs/flux-ilias-api/autoload.php";
```

```php
IliasApi::new();
```

## Example

Look at [flux-ilias-rest-api](https://github.com/fluxapps/flux-ilias-rest-api)
