<?php

namespace FluxIliasApi\Adapter\Route\FluxIliasRestObjectForm;

use FluxIliasApi\Adapter\FluxIliasRestObject\FluxIliasRestObjectDto;
use FluxIliasApi\Channel\FluxIliasRestObject\Port\FluxIliasRestObjectService;
use FluxIliasApi\Channel\Proxy\Port\ProxyService;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Route\Collector\RouteCollector;
use ilGlobalTemplateInterface;
use ilLocatorGUI;

class FluxIliasRestObjectConfigFormRouteCollector implements RouteCollector
{

    private FluxIliasRestObjectService $flux_ilias_rest_object_service;
    private ilGlobalTemplateInterface $ilias_global_template;
    private ilLocatorGUI $ilias_locator;
    private FluxIliasRestObjectDto $object;
    private ProxyService $proxy_service;


    private function __construct(
        /*private readonly*/ FluxIliasRestObjectService $flux_ilias_rest_object_service,
        /*private readonly*/ ProxyService $proxy_service,
        /*private readonly*/ ilGlobalTemplateInterface $ilias_global_template,
        /*private readonly*/ ilLocatorGUI $ilias_locator,
        /*private readonly*/ FluxIliasRestObjectDto $object
    ) {
        $this->flux_ilias_rest_object_service = $flux_ilias_rest_object_service;
        $this->proxy_service = $proxy_service;
        $this->ilias_global_template = $ilias_global_template;
        $this->ilias_locator = $ilias_locator;
        $this->object = $object;
    }


    public static function new(
        FluxIliasRestObjectService $flux_ilias_rest_object_service,
        ProxyService $proxy_service,
        ilGlobalTemplateInterface $ilias_global_template,
        ilLocatorGUI $ilias_locator,
        FluxIliasRestObjectDto $object
    ) : /*static*/ self
    {
        return new static(
            $flux_ilias_rest_object_service,
            $proxy_service,
            $ilias_global_template,
            $ilias_locator,
            $object
        );
    }


    public function collectRoutes() : array
    {
        return [
            FluxIliasRestObjectConfigFormRoute::new(
                $this->flux_ilias_rest_object_service,
                $this->proxy_service,
                $this->ilias_global_template,
                $this->ilias_locator,
                $this->object
            ),
            GetFluxIliasRestObjectConfigFormValuesRoute::new(
                $this->flux_ilias_rest_object_service,
                $this->object
            ),
            StoreFluxIliasRestObjectConfigFormValuesRoute::new(
                $this->flux_ilias_rest_object_service,
                $this->object
            )
        ];
    }
}
