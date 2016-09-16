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

* [jim-moser/zf2-validators-empty-or](https://github.com/jim-moser/zf2-validators-empty-or/)
* [jim-moser/zf2-validators-empty-or-test](https://github.com/jim-moser/zf2-validators-empty-or-test/)
* [jim-moser/zf2-validators-empty-or-plugin](https://github.com/jim-moser/zf2-validators-empty-or-plugin/)
* [jim-moser/zf2-validators-empty-or-plugin-test](https://github.com/jim-moser/zf2-validators-empty-or-plugin-test/)
	
A brief description of the related packages listed above can be found in the 
README.md file for the 
[jim-moser/zf2-validators-empty-or](https://github.com/jim-moser/zf2-validators-empty-or/) 
package.

#Installation

##Alternative 1: Installation with Composer

1. For an existing Zend Framework installation, move into the parent of the 
	vendor directory. This directory should contain an existing composer.json 
	file. For a new installation, move into the directory you would like to 
	contain the vendor directory.

		$ cd <parent_path_of_vendor>	
	
2. Run the following command which will update the composer.json file, install 
	the zf2-validators-empty-or-plugin package and its dependencies into their 
	respective directories under the vendor directory, and update the composer 
	autoloading files.
	
		$ composer require jim-moser/zf2-validators-empty-or-plugin

##Alternative 2: Manual Installation to Vendor Directory

Note that since this installation method does not setup Composer autoloading, 
autoloading will need to be setup in some other manner. The installation 
instructions below use the Module.php file in 
jim-moser/zf2-validators-empty-or-plugin and the test\bootstrap.php file in 
jim-moser/zf2-validators-empty-or-plugin-test to setup autoloading. The packages 
will need to be installed into a complete Zend Framework 2 installation for this 
to work. Using a skeleton Zend Framework application is recommended.

1. Create vendor directory.

	$ mkdir vendor

2. Download and install Zend Framework 2.
	
Download Zend Framework 2 archive from 
http://framework.zend.com/downloads/archives.

	$ curl http://packages.zendframework.com/releases/ZendFramework-2.4.9/ZendFramework-2.4.9.zip

Unpack archive.

	$ unzip ZendFramework-2.4.9.zip
		
Create a vendor/ZF2 directory.

	$ mkdir ZF2
 
Move unpacked contents into the vendor/ZF2 directory.

	$ mv ZendFramework-2.4.9 ZF2

3. Use git clone or other method to copy files from the git repositories to the 
	vendor/<vendor_name>/<package_name>	directories for each of	the following 
	packages.
	
* jim-moser/zf2-validators-empty-or
* jim-moser/zf2-validators-empty-or-test
* jim-moser/zf2-validators-empty-or-plugin
* jim-moser/zf2-validators-empty-or-plugin-test

	For example copy the files from the jim-moser/zf2-validators-empty-or 
	repository to the vendor/jim-moser/zf2-validators-empty-or/ directory. 

4. Edit the application configuration file to notify the module manager about 
	the module.

	The Module.php file provided with this package provides configuration to a
	Zend Framework autoloader to allow auto loading of the classes from the
	jim-moser/zf2-validators-empty-or package without Composer autoloading.
	The Zend Framework module manager needs to be made aware that this package 
	is a Zend Framework module for the Zend autoloader to receive this 
	configuration. Follow the instructions in the [Module Manager Configuration](#module_manager) 
	section below to notify the module manager of this module.

5. Setup unit testing.
	
	The phpunit.xml file in the jim-moser\validators-empty-or-test package 
	depends on Composer autoloading which is not being used here. In order to 
	use the autoloading setup in the module file, rename the 
	phpunit.xml.no\_composer.dist file to phpunit.xml.
	
###<a name="module_manager"></a>Module Manager Configuration

The Zend Framework module manager needs to be made aware that this package is a 
Zend Framework module in order for the validator plugin manager to receive the 
configuration from this package. This is accomplished by adding the module name 
to the \['modules'\] array and the module name and path to the 
\['module\_listener\_options'\]\['module\_paths'\] array of the array returned 
by the application's config/application.config.php file.

	<?php
	// config/application.config.php
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
	
#Validator Plugin Manager Usage In Validator Chains

This package's Module.php file adds configuration (see the 
config/module.config.php file) to allow the validator plugin manager to obtain 
instances of the validators provided by the jim-moser/zf2-validators-empty-or 
package from their names. The validator plugin manager must be obtained from the 
service manager for it to receive this configuration.

Some classes such as Zend/Validator/ValidatorChain, JimMoser/Validator/OrChain, 
and JimMoser/Validator/VerboseOrChain by default will directly instantiate new 
Zend/Validator/ValidatorPluginManager instances using the keyword "new" instead 
of obtaining an instance from the service manager. ValidatorPluginManager 
instances created directly with the keyword "new" will not receive the 
application configuration during construction and thus will not be aware of the 
validators from the jim-moser/zf2-validators-empty-or package. You should inject 
a validator plugin manager pulled from the service manager into objects such as 
ValidatorChain objects to ensure a fully configured validator plugin manager is 
used.

Beware that serializing and then deserializing an object such as a 
Zend/Validator/ValidatorChain will cause an injected validator plugin manager 
to be replaced with one created with the keyword "new".