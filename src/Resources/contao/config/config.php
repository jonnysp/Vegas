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
