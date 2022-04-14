ARG ALPINE_IMAGE=alpine:latest
ARG FLUX_AUTOLOAD_API_IMAGE=docker-registry.fluxpublisher.ch/flux-autoload/api:latest
ARG FLUX_LEGACY_ENUM_IMAGE=docker-registry.fluxpublisher.ch/flux-enum/legacy:latest
ARG FLUX_NAMESPACE_CHANGER_IMAGE=docker-registry.fluxpublisher.ch/flux-namespace-changer:latest
ARG FLUX_REST_API_IMAGE=docker-registry.fluxpublisher.ch/flux-rest/api:latest

FROM $FLUX_AUTOLOAD_API_IMAGE AS flux_autoload_api
FROM $FLUX_NAMESPACE_CHANGER_IMAGE AS flux_autoload_api_build
ENV FLUX_NAMESPACE_CHANGER_FROM_NAMESPACE FluxAutoloadApi
ENV FLUX_NAMESPACE_CHANGER_TO_NAMESPACE FluxIliasApi\\Libs\\FluxAutoloadApi
COPY --from=flux_autoload_api /flux-autoload-api /code
RUN $FLUX_NAMESPACE_CHANGER_BIN

FROM $FLUX_LEGACY_ENUM_IMAGE AS flux_legacy_enum
FROM $FLUX_NAMESPACE_CHANGER_IMAGE AS flux_legacy_enum_build
ENV FLUX_NAMESPACE_CHANGER_FROM_NAMESPACE FluxLegacyEnum
ENV FLUX_NAMESPACE_CHANGER_TO_NAMESPACE FluxIliasApi\\Libs\\FluxLegacyEnum
COPY --from=flux_legacy_enum /flux-legacy-enum /code
RUN $FLUX_NAMESPACE_CHANGER_BIN

FROM $FLUX_REST_API_IMAGE AS flux_rest_api
FROM $FLUX_NAMESPACE_CHANGER_IMAGE AS flux_rest_api_build
ENV FLUX_NAMESPACE_CHANGER_FROM_NAMESPACE FluxRestApi
ENV FLUX_NAMESPACE_CHANGER_TO_NAMESPACE FluxIliasApi\\Libs\\FluxRestApi
COPY --from=flux_rest_api /flux-rest-api /code
RUN $FLUX_NAMESPACE_CHANGER_BIN

FROM $ALPINE_IMAGE AS build

COPY --from=flux_autoload_api_build /code /flux-ilias-api/libs/flux-autoload-api
COPY --from=flux_legacy_enum_build /code /flux-ilias-api/libs/flux-legacy-enum
COPY --from=flux_rest_api_build /code /flux-ilias-api/libs/flux-rest-api
COPY . /flux-ilias-api

FROM scratch

LABEL org.opencontainers.image.source="https://github.com/flux-eco/flux-ilias-api"
LABEL maintainer="fluxlabs <support@fluxlabs.ch> (https://fluxlabs.ch)"

COPY --from=build /flux-ilias-api /flux-ilias-api