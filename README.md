#Overview

This package contains a Module.php file and configuration file for configuring 
the Zend Framework 2 validator plugin manager 
(Zend/Validator/ValidatorPluginManager) to use the validators from the 
jim-moser/zf2-validators-empty-or package. Use this package if you would like a 
Zendframework application to be able to retrieve instances of the validators 
provided by the jim-moser/zf2-validators-empty-or package from the Zendframework 
validator plugin manager.

This package depends on the jim-moser/zf2-validators-empty-or package so you can 
simply add this package to the application's composer.json file if you want both 
this package and the jim-moser/zf2-validators-empty-or package. 

This package was split from the jim-moser/zf2-validators-empty-or package in 
order to reduce that package's dependencies to the minimum required to use the 
provided validators.

This package depends directly on the zendframework/zendframework package in 
addition to the jim-moser/zf2-validators-empty-or package.
		
The code provided by this package only depends directly on code and classes 
provided by the jim-moser/zf2-validators-empty-or package and its' dependencies, 
and the zendframework/zend-modules package. However it appears that the code 
within zend-modules and/or its' dependencies has many dependencies on code and 
classes within various zendframework packages not specified as dependencies 
within the composer.json files of zend-modules and its' dependencies. To prevent 
this issue from causing problems, the jim-moser/zf2-validators-empty-or-plugin 
package was given a dependency on the zendframework/zendframework package which 
installs all of Zend Framework 2.

Related packages:
	- jim-moser/zf2-validators-empty-or
	- jim-moser/zf2-validators-empty-or-test
	- jim-moser/zf2-validators-empty-or-plugin
	- jim-moser/zf2-validators-empty-or-plugin-test
	
A brief description of the related packages listed above can be found in the 
README.md file for the jim-moser/zf2-validators-empty-or package available at 
[Github] (https://github.com/jim-moser/zf2-validators-emtpy-or/README.md). 

#Installation

1. Move to desired installation directory.

	To install into an existing Zend Framework 2 installation that was installed 
	using Composer, locate the `composer.json` file located in the directory 
	containing the vendor directory and move into that directory. 
	
	Otherwise if creating a new installation, move into the directory that you  
	would like to contain the vendor directory.

		$ cd <parent_path_of_vendor>	
	
2. Use composer to update or create the application's composer.json file and 
	install the	jim-moser/zf2-validators-empty-or-plugin package and its 
	dependencies.

		$ composer require jim-moser/zf2-validators-empty-or-plugin
	
This should first update the composer.json file and then install the 
zf2-validators-empty-or package into the 
vendor/jim-moser/zf2-validators-empty-or directory, install the 
zf2-validators-empty-or-plugin package into the 
vendor/jim-moser/zf2-validators-empty-or-plugin directory, and update the 
composer autoloading files (vendor/composer/autoload_classmap.php and/or 
autoload_psr4.php) such that the added validators should now be accessible from 
within your Zend Framework application.

###Configuring the Validator Plugin Manager

The Zend Framework module manager needs to be made aware that this package is a 
Zend Framework module in order for the validator plugin manager to receive the 
configuration from this package. This is accomplished by adding the module name 
to the ['modules'] array and the module name and path to the 
['module_listener_options']['module_paths'] array of the array returned by the 
application's config/application.config.php file.

	<?php
	return array(
		'modules' => array(
			'Application',
			'JimMoser\EmptyOrValidatorsModule',	//Add this line.
			...
		),
		'module_listener_options' => array(
			'module_paths' => array(
				'JimMoser\EmptyOrValidatorsModule' => './vendor/jim-moser/zf2-validators-empty-or'	//Add this line.
			),
		),
	);
	
#Validator Plugin Manager Cautions

This package's Module.php file adds configuration (see the 
config/module.config.php file) to allow the validator plugin manager to obtain 
instances of the validators provided by the jim-moser/zf2-validators-empty-or 
package from their names. The validator plugin manager must be obtained from the 
service manager for it to receive this configuration.

Some classes such as Zend/Validator/ValidatorChain by default will directly 
instantiate new Zend/Validator/ValidatorPluginManager instances using the 
keyword "new" instead of obtaining an instance from the service manager. 
ValidatorPluginManager instances created directly with the keyword "new" will 
not receive the application configuration during construction and thus will not 
be aware of the validators from the jim-moser/zf2-validators-empty-or package. 
You should inject a validator plugin manager pulled from the service manager 
into objects such as ValidatorChain objects to ensure a fully configured 
validator plugin manager is used.

Beware that serializing and then deserializing an object such as a 
Zend/Validator/ValidatorChain will cause an injected validator plugin manager 
to be replaced with one created with the keyword "new".