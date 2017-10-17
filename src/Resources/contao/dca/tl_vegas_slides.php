<?php


/**
 * Table tl_recipes
 */
$GLOBALS['TL_DCA']['tl_vegas_slides'] = array
(

// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'ptable'                      => 'tl_vegas',
		'enableVersioning'            => true,
		'sql' => array
		(
			'keys' => array
			(
				'id' => 'primary',
				'pid' => 'index'
			)
		)
	),
	

// List
	'list' => array
	(
        'sorting' => array
        (
           'mode'                    => 4,
		   'headerFields'            => array('title','target','preload','autoplay','looop','shuffle','delay','timer','overlay','align','valign','cover','color','transition','transitionDuration','firstTransition','firstTransitionDuration','animation','animationDuration'),
		   'fields'                  => array('sorting'),
		   'disableGrouping'         => true,
		   'panelLayout'             => 'filter;sort,search,limit',
		   'child_record_callback'   => array('tl_vegas_slides', 'generateReferenzRow')
        ),


		'global_operations' => array
		(
			'all' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'                => 'act=select',
				'class'               => 'header_edit_all',
				'attributes'          => 'onclick="Backend.getScrollOffset()" accesskey="e"'
			)
		),
		
		'operations' => array
		(

			'edit' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_vegas_slides']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.svg'
				
			),
			

			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_vegas_slides']['copy'],
				'href'                => 'act=copy',
				'icon'                => 'copy.svg'
			),

			'cut' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_vegas_slides']['cut'],
				'href'                => 'act=paste&amp;mode=cut',
				'icon'                => 'cut.svg'
			),

			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_vegas_slides']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.svg',
				'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
			),

			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_vegas_slides']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.svg'
			),

			'toggle' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_vegas_slides']['toggle'],
				'icon'                => 'visible.svg',
				'attributes'          => 'onclick="Backend.getScrollOffset();return AjaxRequest.toggleVisibility(this,%s)"',
				'button_callback'     => array('tl_vegas_slides', 'toggleIcon')
			)
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
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		
		'sorting' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),

		'tstamp' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
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
			'eval'                    => array( 'tl_class'=>'clr','mandatory'=>true,'fieldType'=>'radio', 'files'=>true, 'filesOnly'=>true, 'extensions'=>$GLOBALS['TL_CONFIG']['validImageTypes']),
			'sql'                     => "binary(16) NULL",
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
			'eval'                    => array('submitOnChange'=>true, 'doNotCopy'=>true, 'tl_class'=>'w50'),
			'sql'                     => "char(1) NOT NULL default ''"
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

use Contao\Image\ResizeConfiguration;

class tl_vegas_slides extends Backend{
	
	public function generateReferenzRow($arrRow)	{
		$this->loadLanguageFile('tl_vegas_slides');
		
		$imagestring = '';
		$imagemodel = \FilesModel::findByUuid($arrRow['src'])->path;
		if ($imagemodel){
			$imagefile = new \File($imagemodel,true);
			if ($imagefile->exists()){
				$imagestring = \Image::getHtml(\System::getContainer()->get('contao.image.image_factory')->create(TL_ROOT . '/' . rawurldecode(\FilesModel::findByUuid($arrRow['src'])->path), (new ResizeConfiguration())->setWidth(100)->setHeight(80)->setMode(ResizeConfiguration::MODE_BOX)->setZoomLevel(100))->getUrl(TL_ROOT), '', 'style="float:left;"');
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


	public function toggleIcon($row, $href, $label, $title, $icon, $attributes)
	{
		if (strlen(Input::get('tid')))
		{
			$this->toggleVisibility(Input::get('tid'), (Input::get('state') == 1), (@func_get_arg(12) ?: null));
			$this->redirect($this->getReferer());
		}

		$href .= '&amp;tid='.$row['id'].'&amp;state='.($row['published'] ? '' : 1);

		if (!$row['published'])
		{
			$icon = 'invisible.gif';
		}

		return '<a href="'.$this->addToUrl($href).'" title="'.StringUtil::specialchars($title).'"'.$attributes.'>'.Image::getHtml($icon, $label).'</a> ';
	}


	public function toggleVisibility($intId, $blnVisible, DataContainer $dc=null)
	{

		Input::setGet('id', $intId);
		Input::setGet('act', 'toggle');

		// Trigger the save_callback
		if (is_array($GLOBALS['TL_DCA']['tl_vegas_slides']['fields']['published']['save_callback']))
		{
			foreach ($GLOBALS['TL_DCA']['tl_vegas_slides']['fields']['published']['save_callback'] as $callback)
			{
				if (is_array($callback))
				{
					$this->import($callback[0]);
					$blnVisible = $this->$callback[0]->$callback[1]($blnVisible, ($dc ?: $this));
				}
				elseif (is_callable($callback))
				{
					$blnVisible = $callback($blnVisible, ($dc ?: $this));
				}
			}
		}

		// Update the database
		$this->Database->prepare("UPDATE tl_vegas_slides SET tstamp=". time() .", published='" . ($blnVisible ? 1 : '') . "' WHERE id=?")->execute($intId);

	}

}
