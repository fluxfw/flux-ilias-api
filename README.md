# flux-ilias-api

ILIAS Api

## Installation

Hint: Use `latest` as `%tag%` (or omit it) for get the latest build

### Non-Composer

```dockerfile
COPY --from=docker-registry.fluxpublisher.ch/flux-ilias-api:%tag% /flux-ilias-api /%path%/libs/flux-ilias-api
```

or

```dockerfile
RUN (mkdir -p /%path%/libs/flux-ilias-api && cd /%path%/libs/flux-ilias-api && wget -O - https://docker-registry.fluxpublisher.ch/api/get-build-archive/flux-ilias-api.tar.gz?tag=%tag% | tar -xz --strip-components=1)
```

or

Download https://docker-registry.fluxpublisher.ch/api/get-build-archive/flux-ilias-api.tar.gz?tag=%tag% and extract it to `/%path%/libs/flux-ilias-api`

Hint: If you use `wget` without pipe use `--content-disposition` to get the correct file name

#### Usage

```php
require_once __DIR__ . "/%path%/libs/flux-ilias-api/autoload.php";
```

### Composer

```json
{
    "repositories": [
        {
            "type": "package",
            "package": {
                "name": "flux/flux-ilias-api",
                "version": "%tag%",
                "dist": {
                    "url": "https://docker-registry.fluxpublisher.ch/api/get-build-archive/flux-ilias-api.tar.gz?tag=%tag%",
                    "type": "tar"
                },
                "autoload": {
                    "files": [
                        "autoload.php"
                    ]
                }
            }
        }
    ],
    "require": {
        "flux/flux-ilias-api": "*"
    }
}
```

## Example

Look at [flux-ilias-rest-api](https://github.com/flux-caps/flux-ilias-rest-api)
