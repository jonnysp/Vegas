<?php 

/*
 * Copyright (c) 2005-2024 Jonny Spitzner
 *
 * @license LGPL-3.0+
*/

use Contao\System;
use Contao\Backend;
use Vegas\Model\VegasModel;
use Contao\DataContainer;
use Contao\StringUtil;
use Contao\Image;

$GLOBALS['TL_DCA']['tl_module']['palettes']['vegas'] = '{title_legend},name,vegas,type;';

$GLOBALS['TL_DCA']['tl_module']['fields']['vegas'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['vegas'],
	'inputType'               => 'select',
	'options_callback'        => array('tl_module_vegas', 'getVegas'),
	'eval'                    => array('includeBlankOption' => true,'mandatory'=>true, 'chosen'=>true, 'submitOnChange'=>true,'tl_class'=>'w50'),
	'wizard' 				  => array(array('tl_module_vegas', 'editVegas')),
	'sql'                     => "int(10) unsigned NOT NULL default '0'"
);

class tl_module_vegas extends Backend 
{

	public function getVegas(): array
	{
		$arrVegas = array();
		
		if ($objVegas = VegasModel::findAll())
		{
			foreach ($objVegas as $itemVegas)
			{
				$arrVegas[$itemVegas->id] =' [ID ' . $itemVegas->id . '] - '. $itemVegas->title  ;
			}
		}

		return $arrVegas;
	}

	public function editVegas(DataContainer $dc): string
	{
		$this->loadLanguageFile('tl_vegas');
		$title = sprintf($GLOBALS['TL_LANG']['tl_vegas']['editheader'][1], $dc->value);
		$href = System::getContainer()->get('router')->generate('contao_backend', array('do'=>'vegas', 'table'=>'tl_vegas','act'=>'edit', 'id'=>$dc->value , 'popup'=>'1', 'nb'=>'1'));

		return ' <a href="' . StringUtil::specialcharsUrl($href) . '" title="' . StringUtil::specialchars($title) . '" onclick="Backend.openModalIframe({\'title\':\'' . StringUtil::specialchars(str_replace("'", "\\'", $title)) . '\',\'url\':this.href});return false">' . Image::getHtml('alias.svg', $title) . '</a>';

	}

}