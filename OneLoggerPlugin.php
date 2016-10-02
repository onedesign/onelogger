<?php

namespace Craft;

class OneLoggerPlugin extends BasePlugin {

    public function getName() {
        return Craft::t('One Logger');
    }

    public function getVersion() {
        return '1.0';
    }

    public function getSchemaVersion() {
        return '1.0.0';
    }

    public function getDeveloper() {
        return 'One Design Company';
    }

    public function getDeveloperUrl() {
        return 'https://onedesigncompany.com';
    }

    public function init() {
        Craft::import('plugins.onelogger.loggers.OneLogger_StdOut');
        $logger = new OneLogger_StdOut();
        $logger->init();
        $routes = craft()->log->getRoutes();
        $routes[] = $logger;
        craft()->log->setRoutes($routes);
    }
}
