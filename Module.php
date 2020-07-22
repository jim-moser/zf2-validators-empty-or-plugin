<?php
namespace JimMoser\Validator;

use Laminas\ModuleManager\Feature\AutoloaderProviderInterface;
use Laminas\ModuleManager\Feature\ConfigProviderInterface;

/**
 * Laminas 2 Module class for JimMoser\Validator module.
 * 
 * This class and the configuration files it references serve two purposes.
 * 1. It provides configuration to Laminas\Validator\ValidatorPluginManager to 
 *    register the validators provided in the jim-moser\zf2-validators-empty-or
 *    package.
 * 2. It provides configuration to Laminas\Loader\ClassMapAutoloader for 
 *    autoloading the classes in the jim-moser\zf2-validators-empty-or package. 
 *    This is only needed and used if Composer autoloading is not being used.
 *
 * @author    Jim Moser <jmoser@epicride.info>
 * @link      http://github.com/jim-moser/zf2-validators-empty-or-plugin for 
 *            source repository.
 * @copyright Copyright (c) July 9, 2016 Jim Moser
 * @license   LICENSE.txt at http://github.com/
 *            jim-moser/zf2-validators-empty-or-plugin  
 *            New BSD License
 *
 */
class Module implements AutoloaderProviderInterface,
                        ConfigProviderInterface
{
    /**
     * @inheritdoc
     */
    public function getAutoloaderConfig()
    {
        return array(
            // ClassMapAutoLoader used if Composer autoloading not used.
            'Laminas\Loader\ClassMapAutoloader' => array(
                dirname(__DIR__) . 
                            '/zf2-validators-empty-or/autoload_classmap.php',
            ),
            
            // StandardAutoLoader used if Composer autoloading not used.
            /*
            'Laminas\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => dirname(__DIR__) . 
                                                '/zf2-validators-empty-or/src',
                ),
            ),
            */
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