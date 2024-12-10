<?php

/*
 * Copyright (c) 2005-2024 Jonny Spitzner
 *
 * @license LGPL-3.0+
*/

 use Vegas\Model\VegasModel;
 use Vegas\Model\VegasSlidesModel;
 use Contao\ArrayUtil;
 use Contao\System;
 use Symfony\Component\HttpFoundation\Request;

$GLOBALS['TL_MODELS']['tl_vegas'] = VegasModel::class;
$GLOBALS['TL_MODELS']['tl_vegas_slides'] = VegasSlidesModel::class;

ArrayUtil::arrayInsert($GLOBALS['BE_MOD']['vegas'], 100, array
(
	'vegas' => array('tables' => array('tl_vegas','tl_vegas_slides'))
));


/**
 * Style sheet
 */
if (System::getContainer()->get('contao.routing.scope_matcher')
	->isBackendRequest(System::getContainer()->get('request_stack')->getCurrentRequest() ?? Request::create(''))
)  
{
	$GLOBALS['TL_CSS'][] = 'bundles/jonnyspvegas/vegas/vegasbe.css|static';
};


///**
// * Front end modules
// */
ArrayUtil::arrayInsert($GLOBALS['TL_CTE'], 1, array
	(
		'includes' 	=> array
			(
		'vegas'    => 'VegasViewer'
		)
	)
);


ArrayUtil::arrayInsert($GLOBALS['FE_MOD'], 2, array
	(
		'miscellaneous' => array
		(
			'vegas'    => 'ModuleVegas'
		)
	)
);