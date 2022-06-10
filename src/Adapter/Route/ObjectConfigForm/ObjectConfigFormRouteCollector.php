<?php

namespace FluxIliasApi\Adapter\Route\ObjectConfigForm;

use FluxIliasApi\Adapter\Object\ObjectDto;
use FluxIliasApi\Channel\ObjectConfigForm\Port\ObjectConfigFormService;
use FluxIliasApi\Channel\Proxy\Port\ProxyService;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Route\Collector\RouteCollector;
use ilGlobalTemplateInterface;
use ilLocatorGUI;

class ObjectConfigFormRouteCollector implements RouteCollector
{

    private ilGlobalTemplateInterface $ilias_global_template;
    private ilLocatorGUI $ilias_locator;
    private ObjectDto $object;
    private ObjectConfigFormService $object_config_form_service;
    private ProxyService $proxy_service;


    private function __construct(
        /*private readonly*/ ObjectConfigFormService $object_config_form_service,
        /*private readonly*/ ProxyService $proxy_service,
        /*private readonly*/ ilGlobalTemplateInterface $ilias_global_template,
        /*private readonly*/ ilLocatorGUI $ilias_locator,
        /*private readonly*/ ObjectDto $object
    ) {
        $this->object_config_form_service = $object_config_form_service;
        $this->proxy_service = $proxy_service;
        $this->ilias_global_template = $ilias_global_template;
        $this->ilias_locator = $ilias_locator;
        $this->object = $object;
    }


    public static function new(
        ObjectConfigFormService $object_config_form_service,
        ProxyService $proxy_service,
        ilGlobalTemplateInterface $ilias_global_template,
        ilLocatorGUI $ilias_locator,
        ObjectDto $object
    ) : /*static*/ self
    {
        return new static(
            $object_config_form_service,
            $proxy_service,
            $ilias_global_template,
            $ilias_locator,
            $object
        );
    }


    public function collectRoutes() : array
    {
        return [
            ObjectConfigFormRoute::new(
                $this->proxy_service,
                $this->ilias_global_template,
                $this->ilias_locator,
                $this->object
            ),
            GetObjectConfigFormValuesRoute::new(
                $this->object_config_form_service,
                $this->object
            ),
            StoreObjectConfigFormValuesRoute::new(
                $this->object_config_form_service,
                $this->object
            )
        ];
    }
}
