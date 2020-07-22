<?php
use JimMoser\Validator\EmptyValidator;
use JimMoser\Validator\OrChain;
use JimMoser\Validator\VerboseOrChain;

return array(
    // For use by Laminas\Validator\ValidatorPluginManager.
    'validators' => array(
    	'invokables' => array(
	    	'EmptyValidator' => EmptyValidator::class,
            'OrChain' => OrChain::class,
            'VerboseOrChain' => VerboseOrChain::class,
    	),
    ),
    'shared' => array(
        'EmptyValidator' => false,
        'OrChain' => false,
        'VerboseOrChain' => false,
    ),
);