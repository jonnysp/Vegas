<?php

/*
 * Copyright (c) 2005-2024 Jonny Spitzner
 *
 * @license LGPL-3.0+
*/

use Contao\DC_Table;
use Contao\DataContainer;
use Contao\Backend;
use Contao\FilesModel;
use Contao\Image;
use Contao\System;
use Contao\Image\ResizeConfiguration;

/**
 * Table tl_recipes
 */
$GLOBALS['TL_DCA']['tl_vegas_slides'] = array
(

// Config
	'config' => array
	(
		'dataContainer'              => DC_Table::class, 
		'ptable'                     => 'tl_vegas',
		'enableVersioning'           => true,
		'markAsCopy'                 => 'title',
		'sql' => array
		(
			'keys' => array
			(
				'id' => 'primary',
				'pid,published' => 'index'
			)
		)
	),
	

// List
	'list' => array
	(
        'sorting' => array
        (
           'mode'                    => DataContainer::MODE_PARENT,
		   'fields'                  => array('sorting'),
		   'panelLayout'             => 'filter;search,limit',
		   'headerFields'            => array('title','target','preload','autoplay','looop','shuffle','delay','timer','overlay','align','valign','cover','color','transition','transitionDuration','firstTransition','firstTransitionDuration','animation','animationDuration'),
		   'defaultSearchField'      => 'title',
		   'disableGrouping'         => true,
			'child_record_callback'   => array('tl_vegas_slides', 'listVegasSlides')
        ),
		'label' => array
		(
			'fields'                  => array('title'),
			'format'                  => '%s'
		)

	),

	// Palettes
	'palettes' => array
	(
		'default'         => '{general_legend},title,published,src;{display_legend},align,valign;{transition_legend},transition,transitionDuration;{animation_legend},animation,animationDuration;',
	),


	// Fields
	'fields' => array
	(
		'id' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL auto_increment"
		),

		'pid' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL default 0"
		),
		
		'sorting' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL default 0"
		),

		'tstamp' => array
		(
			'sql'                     => ['type' => 'integer','notnull' => false, 'unsigned' => true,'default' => '0','fixed' => true]
		),
		'title' => array
		(
			'label'    				=> &$GLOBALS['TL_LANG']['tl_vegas_slides']['title'],
			'search'              	=> true,
			'inputType'          	=> 'text',
			'eval'                  => array('mandatory'=>true, 'maxlength'=>128, 'tl_class'=>'w50','allowHtml'=>true,'preserveTags'=>true),
			'sql'            		=> "varchar(256) NOT NULL default ''"
		),
		'src' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_vegas_slides']['src'],
			'inputType'               => 'fileTree',
			'eval'                    => array('fieldType'=>'radio', 'files'=>true, 'filesOnly'=>true, 'extensions'=>'%contao.image.valid_extensions%'),
			'sql'                     => ['type' => 'binary','notnull' => false,'length' => 16,'fixed' => true]
		),

        'transition' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_vegas_slides']['transition'],
            'inputType'               => 'select',
            'sorting'                 => true,
            'flag'                    => 1,
            'options'                 => array('fade','fade2','slideLeft','slideLeft2','slideRight','slideRight2','slideUp','slideUp2','slideDown','slideDown2','zoomIn','zoomIn2','zoomOut','zoomOut2','swirlLeft','swirlLeft2','swirlRight','swirlRight2','burn','burn2','blur','blur2','flash','flash2'),
            'reference'               => &$GLOBALS['TL_LANG']['tl_vegas_slides'],
            'eval'                    => array('includeBlankOption' => true,'tl_class'=> 'w50'),                
            'sql'                     => "varchar(128) NOT NULL default ''"
        ),

   		'transitionDuration' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_vegas_slides']['transitionDuration'],
            'inputType'               => 'select',
            'sorting'                 => true,
            'flag'                    => 1,
            'options'                 => array('1','1000','2000','3000','4000','5000','6000','7000','8000','9000','10000','auto'),
            'reference'               => &$GLOBALS['TL_LANG']['tl_vegas_slides'],
            'eval'                    => array('includeBlankOption' => true,'tl_class'=> 'w50'),                
            'sql'                     => "varchar(128) NOT NULL default ''"
        ),

        'animation' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_vegas_slides']['animation'],
            'inputType'               => 'select',
            'sorting'                 => true,
            'flag'                    => 1,
            'options'                 => array('kenburns','kenburnsUp','kenburnsDown','kenburnsRight','kenburnsLeft','kenburnsUpLeft','kenburnsUpRight','kenburnsDownLeft','kenburnsDownRight','random'),
            'reference'               => &$GLOBALS['TL_LANG']['tl_vegas_slides'],
            'eval'                    => array('includeBlankOption' => true,'tl_class'=> 'w50'),                
            'sql'                     => "varchar(128) NOT NULL default ''"
        ),
 		'animationDuration' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_vegas_slides']['animationDuration'],
            'inputType'               => 'select',
            'sorting'                 => true,
            'flag'                    => 1,
            'options'                 => array('1','1000','2000','3000','4000','5000','6000','7000','8000','9000','10000','auto'),
            'reference'               => &$GLOBALS['TL_LANG']['tl_vegas_slides'],
            'eval'                    => array('includeBlankOption' => true,'tl_class'=> 'w50'),                
            'sql'                     => "varchar(128) NOT NULL default ''"
        ),   
		'published' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_vegas_slides']['toggle'],
			'inputType'               => 'checkbox',
			'toggle'                  => true,
			'filter'                  => true,
			'eval'                    => array('submitOnChange'=>true, 'doNotCopy'=>true, 'tl_class'=>'w50 m12'),
			'sql'                     => array('type' => 'boolean', 'default' => false)
		),

		'align' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_vegas_slides']['align'],
            'inputType'               => 'select',
            'sorting'                 => true,
            'flag'                    => 1,
            'options'                 => array('center','top','right','bottom','left'),
            'reference'               => &$GLOBALS['TL_LANG']['tl_vegas_slides'],
            'eval'                    => array('includeBlankOption' => false,'tl_class'=> 'w50'),                
            'sql'                     => "varchar(128) NOT NULL default 'center'"
        ),

        'valign' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_vegas_slides']['valign'],
            'inputType'               => 'select',
            'sorting'                 => true,
            'flag'                    => 1,
            'options'                 => array('center','top','right','bottom','left'),
            'reference'               => &$GLOBALS['TL_LANG']['tl_vegas_slides'],
            'eval'                    => array('includeBlankOption' => false,'tl_class'=> 'w50'),                
            'sql'                     => "varchar(128) NOT NULL default 'center'"
        )

	)
);



class tl_vegas_slides extends Backend{
	
	public function listVegasSlides($arrRow)	{
		$this->loadLanguageFile('tl_vegas_slides');
		
		$imagestring = '';

		$objFile = FilesModel::findByUuid($arrRow['src']);
		$projectDir = System::getContainer()->getParameter('kernel.project_dir');
		if ($objFile !== null && file_exists($projectDir . '/' . $objFile->path))
		{
		
			if ($objFile !== null && file_exists($projectDir . '/' . $objFile->path))
			{
				$imagestring = Image::getHtml(
					System::getContainer()
						->get('contao.image.factory')
						->create(
							$projectDir . '/' . $objFile->path, 
							(new ResizeConfiguration())
								->setWidth(100)
								->setHeight(80)
								->setMode(ResizeConfiguration::MODE_BOX)
								->setZoomLevel(100)
						)
						->getUrl($projectDir), '', 'style="float:left;"'
					);
			}
	
		}

	
		return $imagestring. '
			   <table style="margin-left:110px;" class="tl_header_table">
               <tr><th><span class="tl_label">'.$GLOBALS['TL_LANG']['tl_vegas_slides']['title'][0].':</span></th><th>'.$arrRow['title']. '</th></tr>
 			   <tr><td><span class="tl_label">'.$GLOBALS['TL_LANG']['tl_vegas_slides']['transition'][0].':</span></td><td>'.$arrRow['transition']. '</td></tr>
 			   <tr><td><span class="tl_label">'.$GLOBALS['TL_LANG']['tl_vegas_slides']['animation'][0].':</span></td><td>'.$arrRow['animation']. '</td></tr>
 			   <tr><td><span class="tl_label">'.$GLOBALS['TL_LANG']['tl_vegas_slides']['align'][0].':</span></td><td>'.$GLOBALS['TL_LANG']['tl_vegas_slides'][$arrRow['align']][0]. '</td></tr>
 			   <tr><td><span class="tl_label">'.$GLOBALS['TL_LANG']['tl_vegas_slides']['valign'][0].':</span></td><td>'.$GLOBALS['TL_LANG']['tl_vegas_slides'][$arrRow['valign']][0]. '</td></tr>
			   </table>';

	}

}
