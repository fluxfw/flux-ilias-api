ARG FLUX_AUTOLOAD_API_IMAGE=docker-registry.fluxpublisher.ch/flux-autoload/api
ARG FLUX_LEGACY_ENUM_IMAGE=docker-registry.fluxpublisher.ch/flux-enum/legacy
ARG FLUX_NAMESPACE_CHANGER_IMAGE=docker-registry.fluxpublisher.ch/flux-namespace-changer
ARG FLUX_REST_API_IMAGE=docker-registry.fluxpublisher.ch/flux-rest/api

FROM $FLUX_AUTOLOAD_API_IMAGE:latest AS flux_autoload_api
FROM $FLUX_LEGACY_ENUM_IMAGE:latest AS flux_legacy_enum
FROM $FLUX_REST_API_IMAGE:latest AS flux_rest_api

FROM $FLUX_NAMESPACE_CHANGER_IMAGE:latest AS build_namespaces

COPY --from=flux_autoload_api /flux-autoload-api /code/flux-autoload-api
RUN change-namespace /code/flux-autoload-api FluxAutoloadApi FluxIliasApi\\Libs\\FluxAutoloadApi

COPY --from=flux_legacy_enum /flux-legacy-enum /code/flux-legacy-enum
RUN change-namespace /code/flux-legacy-enum FluxLegacyEnum FluxIliasApi\\Libs\\FluxLegacyEnum

COPY --from=flux_rest_api /flux-rest-api /code/flux-rest-api
RUN change-namespace /code/flux-rest-api FluxRestApi FluxIliasApi\\Libs\\FluxRestApi

FROM alpine:latest AS build

COPY --from=build_namespaces /code/flux-autoload-api /flux-ilias-api/libs/flux-autoload-api
COPY --from=build_namespaces /code/flux-legacy-enum /flux-ilias-api/libs/flux-legacy-enum
COPY --from=build_namespaces /code/flux-rest-api /flux-ilias-api/libs/flux-rest-api
COPY . /flux-ilias-api

FROM scratch

LABEL org.opencontainers.image.source="https://github.com/flux-eco/flux-ilias-api"
LABEL maintainer="fluxlabs <support@fluxlabs.ch> (https://fluxlabs.ch)"

COPY --from=build /flux-ilias-api /flux-ilias-api

ARG COMMIT_SHA
LABEL org.opencontainers.image.revision="$COMMIT_SHA"
