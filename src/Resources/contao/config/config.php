<?php

/**
 *
 * Copyright (c) 2005-2017 Jonny Spitzner
 *
 * @license LGPL-3.0+
 */

/**
 * Back end modules
 */
array_insert($GLOBALS['BE_MOD']['content'], 100, array
(
	'vegas' => array
	(
		'tables' => array('tl_vegas','tl_vegas_slides')
	)
));

/**
 * Front end modules
 */
array_insert($GLOBALS['TL_CTE'], 1, array
(
	'includes' => array
	(
		'vegas'    => 'VegasViewer'
	)
));

array_insert($GLOBALS['FE_MOD'], 2, array
(
	'miscellaneous' => array
	(
		'vegas'    => 'ModuleVegas'
	)
));