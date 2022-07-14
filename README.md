# flux-ilias-api

ILIAS Api

## Installation

### Native

#### Download

```dockerfile
RUN (mkdir -p /%path%/libs/flux-ilias-api && cd /%path%/libs/flux-ilias-api && wget -O - https://github.com/fluxfw/flux-ilias-api/releases/download/%tag%/flux-ilias-api-%tag%-build.tar.gz | tar -xz --strip-components=1)
```

or

Download https://github.com/fluxfw/flux-ilias-api/releases/download/%tag%/flux-ilias-api-%tag%-build.tar.gz and extract it to `/%path%/libs/flux-ilias-api`

#### Load

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
                    "url": "https://github.com/fluxfw/flux-ilias-api/releases/download/%tag%/flux-ilias-api-%tag%-build.tar.gz",
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

Look at [flux-ilias-rest-api](https://github.com/fluxfw/flux-ilias-rest-api)
