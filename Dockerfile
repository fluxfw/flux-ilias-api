FROM php:8.2-cli-alpine AS build

RUN (mkdir -p /flux-namespace-changer && cd /flux-namespace-changer && wget -O - https://github.com/fluxfw/flux-namespace-changer/releases/download/v2022-07-12-1/flux-namespace-changer-v2022-07-12-1-build.tar.gz | tar -xz --strip-components=1)

RUN (mkdir -p /build/flux-ilias-api/libs/flux-autoload-api && cd /build/flux-ilias-api/libs/flux-autoload-api && wget -O - https://github.com/fluxfw/flux-autoload-api/releases/download/v2022-12-12-1/flux-autoload-api-v2022-12-12-1-build.tar.gz | tar -xz --strip-components=1 && /flux-namespace-changer/bin/change-namespace.php . FluxAutoloadApi FluxIliasApi\\Libs\\FluxAutoloadApi)

RUN (mkdir -p /build/flux-ilias-api/libs/flux-ilias-base-api && cd /build/flux-ilias-api/libs/flux-ilias-base-api && wget -O - https://github.com/fluxfw/flux-ilias-base-api/releases/download/v2022-12-12-1/flux-ilias-base-api-v2022-12-12-1-build.tar.gz | tar -xz --strip-components=1 && /flux-namespace-changer/bin/change-namespace.php . FluxIliasBaseApi FluxIliasApi\\Libs\\FluxIliasBaseApi)

RUN (mkdir -p /build/flux-ilias-api/libs/flux-rest-api && cd /build/flux-ilias-api/libs/flux-rest-api && wget -O - https://github.com/fluxfw/flux-rest-api/releases/download/v2022-12-12-1/flux-rest-api-v2022-12-12-1-build.tar.gz | tar -xz --strip-components=1 && /flux-namespace-changer/bin/change-namespace.php . FluxRestApi FluxIliasApi\\Libs\\FluxRestApi)

RUN (mkdir -p /tmp/flux-authentication-frontend-api && cd /tmp/flux-authentication-frontend-api && wget -O - https://github.com/fluxfw/flux-authentication-frontend-api/archive/refs/tags/v2022-12-13-1.tar.gz | tar -xz --strip-components=1) && mkdir -p /build/flux-ilias-api/src/Service/Login/Command/static && cp /tmp/flux-authentication-frontend-api/src/Adapter/Authentication/AuthenticationSuccess.html /build/flux-ilias-api/src/Service/Login/Command/static/AuthenticationSuccess.html && cp /tmp/flux-authentication-frontend-api/src/Adapter/Authentication/AuthenticationSuccess.mjs /build/flux-ilias-api/src/Service/Login/Command/static/AuthenticationSuccess.mjs && cp /tmp/flux-authentication-frontend-api/src/Adapter/Authentication/AUTHENTICATION_SUCCESS.mjs /build/flux-ilias-api/src/Service/Login/Command/static/AUTHENTICATION_SUCCESS.mjs && rm -rf /tmp/flux-authentication-frontend-api

COPY . /build/flux-ilias-api

FROM scratch

COPY --from=build /build /
