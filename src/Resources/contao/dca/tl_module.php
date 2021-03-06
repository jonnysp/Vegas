<?php 

$GLOBALS['TL_DCA']['tl_module']['palettes']['vegas'] = '{title_legend},name,vegas,type;';

$GLOBALS['TL_DCA']['tl_module']['fields']['vegas'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['vegas'],
	'inputType'               => 'select',
	'options_callback'        => array('tl_module_vegas', 'getVegas'),
	'eval'                    => array('mandatory'=>true, 'chosen'=>true, 'submitOnChange'=>true,'tl_class'=>'w50'),
	'wizard' 				  => array(array('tl_module_vegas', 'editVegas')),
	'sql'                     => "int(10) unsigned NOT NULL default '0'"
);

class tl_module_vegas extends Backend 
{

	public function getVegas()
	{
		$objVegas =  \VegasModel::findAll();
		$arrVegas = array();
		if(isset($objVegas)){
			foreach ($objVegas as $itemVegas)
			{
				$arrVegas[$itemVegas->id] = '[ID ' . $itemVegas->id . '] - '. $itemVegas->title;
			}
		}

		return $arrVegas;
	}

	public function editVegas(DataContainer $dc)
	{
		$this->loadLanguageFile('tl_vegas');
		return ($dc->value < 1) ? '' : ' <a href="contao/main.php?do=vegas&amp;act=edit&amp;id=' . $dc->value . '&amp;popup=1&amp;nb=1&amp;rt=' . REQUEST_TOKEN . '" title="' . sprintf(StringUtil::specialchars($GLOBALS['TL_LANG']['tl_vegas']['edit'][1]), $dc->value) . '" onclick="Backend.openModalIframe({\'title\':\'' . StringUtil::specialchars(str_replace("'", "\\'", sprintf($GLOBALS['TL_LANG']['tl_vegas']['edit'][1], $dc->value))) . '\',\'url\':this.href});return false">' . Image::getHtml('alias.svg', $GLOBALS['TL_LANG']['tl_vegas']['edit'][0]) . '</a>';
	}

}