<?php
namespace JimMoser\Validator;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

class Module implements AutoloaderProviderInterface,
                        ConfigProviderInterface
{
    /**
     * @inheritdoc
     */
    public function getAutoloaderConfig()
    {
        return array(
            /*
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            */
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    //To do. Use ClassMapAutoloader instead.
                    __NAMESPACE__ => __DIR__ . '/src',
                    __NAMESPACE__ . 'Test' => __DIR__ . '/test',
                ),
            ),
        );
    }
    
    /**
     * @inheritdoc
     */
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
}