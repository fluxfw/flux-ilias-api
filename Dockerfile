ARG FLUX_AUTOLOAD_API_IMAGE=docker-registry.fluxpublisher.ch/flux-autoload-api
ARG FLUX_ILIAS_BASE_API_IMAGE=docker-registry.fluxpublisher.ch/flux-ilias-base-api
ARG FLUX_NAMESPACE_CHANGER_IMAGE=docker-registry.fluxpublisher.ch/flux-namespace-changer
ARG FLUX_REST_API_IMAGE=docker-registry.fluxpublisher.ch/flux-rest-api

FROM $FLUX_AUTOLOAD_API_IMAGE:v2022-06-22-1 AS flux_autoload_api
FROM $FLUX_ILIAS_BASE_API_IMAGE:v2022-07-05-1 AS flux_ilias_base_api
FROM $FLUX_REST_API_IMAGE:v2022-06-29-2 AS flux_rest_api

FROM $FLUX_NAMESPACE_CHANGER_IMAGE:v2022-06-23-1 AS build_namespaces

COPY --from=flux_autoload_api /flux-autoload-api /code/flux-autoload-api
RUN change-namespace /code/flux-autoload-api FluxAutoloadApi FluxIliasApi\\Libs\\FluxAutoloadApi

COPY --from=flux_ilias_base_api /flux-ilias-base-api /code/flux-ilias-base-api
RUN change-namespace /code/flux-ilias-base-api FluxIliasBaseApi FluxIliasApi\\Libs\\FluxIliasBaseApi

COPY --from=flux_rest_api /flux-rest-api /code/flux-rest-api
RUN change-namespace /code/flux-rest-api FluxRestApi FluxIliasApi\\Libs\\FluxRestApi

FROM alpine:latest AS build

COPY --from=build_namespaces /code/flux-autoload-api /build/flux-ilias-api/libs/flux-autoload-api
COPY --from=build_namespaces /code/flux-ilias-base-api /build/flux-ilias-api/libs/flux-ilias-base-api
COPY --from=build_namespaces /code/flux-rest-api /build/flux-ilias-api/libs/flux-rest-api
COPY . /build/flux-ilias-api

RUN (cd /build && tar -czf flux-ilias-api.tar.gz flux-ilias-api)

FROM scratch

LABEL org.opencontainers.image.source="https://github.com/flux-eco/flux-ilias-api"
LABEL maintainer="fluxlabs <support@fluxlabs.ch> (https://fluxlabs.ch)"
LABEL flux-docker-registry-rest-api-build-path="/flux-ilias-api.tar.gz"

COPY --from=build /build /

ARG COMMIT_SHA
LABEL org.opencontainers.image.revision="$COMMIT_SHA"
