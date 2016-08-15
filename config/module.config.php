<?php
return array(
    // For use by Zend\Validator\ValidatorPluginManager.
    'validators' => array(
    	'invokables' => array(
	    	'EmptyValidator' => 'JimMoser\Validator\EmptyValidator',
            'OrChain' => 'JimMoser\Validator\OrChain',
            'VerboseOrChain' => 'JimMoser\Validator\VerboseOrChain',
    	),
    ),
    'shared' => array(
        'EmptyValidator' => false,
        'OrChain' => false,
        'VerboseOrChain' => false,
    ),
);
