<?php

$GLOBALS['TL_DCA']['tl_vegas'] = array
(
 
    // Config
    'config' => array
    (
        'dataContainer'               => 'Table',
        'ctable'                      => array('tl_vegas_slides'),
        'enableVersioning'            => true,
        'sql'                         => array (
                'keys'                => array(
                'id'                  => 'primary'
                )
            )
    ),
 
    // List
    'list' => array
    (
        'sorting' => array
        (
            'mode'                    => 2,
            'disableGrouping'         => true,
            //'fields'                  => array('title'),
            'panelLayout'             => 'filter;search,limit'
        ),
 
        'label' => array
        (

            'fields'                  => array('title','target','transition','animation'),
            'showColumns'             => true
 
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
            'editheader' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_vegas']['editheader'],
                'href'                => 'table=tl_vegas_slides',
                'icon'                => 'sizes.svg'
            ),

            'edit' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_vegas']['edit'],
                'href'                => 'act=edit',
                'icon'                => 'edit.svg'
            ),
 
            'copy' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_vegas']['copy'],
                'href'                => 'act=copy',
                'icon'                => 'copy.svg'
            ),
 
            'delete' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_vegas']['delete'],
                'href'                => 'act=delete',
                'icon'                => 'delete.svg',
                'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
            ),
 
            'show' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_vegas']['show'],
                'href'                => 'act=show',
                'icon'                => 'show.svg'
            )

        )
    ),
 
    // Palettes
    'palettes' => array
    (
        'default' => '{general_legend},title,target,delay,preload,autoplay,looop,shuffle;{display_legend},timer,overlay,align,valign,cover,color;{transition_legend},transition,transitionDuration,firstTransition,firstTransitionDuration;{animation_legend},animation,animationDuration;'
    ),

    // Fields
    'fields' => array
    (
        'id' => array
        (
            'sql'                     => "int(10) unsigned NOT NULL auto_increment"
        ),
 
        'tstamp' => array
        (
            'sql'                     => "int(10) unsigned NOT NULL default '0'"
        ),
 
        'title' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_vegas']['title'],
            'search'                  => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w100'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),

        'target' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_vegas']['target'],
            'inputType'               => 'text',
            'eval'                    => array( 'mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50', 'decodeEntities'=>false, 'allowHtml'=>false),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),

        'preload' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_vegas']['preload'],
            'inputType'               => 'checkbox',
            'isBoolean'               => true,
            'eval'                    => array( 'tl_class'=>'w50'),
            'sql'                     => "char(1) NOT NULL default '0'"
        ),
      
        'timer' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_vegas']['timer'],
            'inputType'               => 'checkbox',
            'isBoolean'               => true,
            'eval'                    => array( 'tl_class'=>'w50'),
            'sql'                     => "char(1) NOT NULL default '1'"
        ),
      
        'autoplay' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_vegas']['autoplay'],
            'inputType'               => 'checkbox',
            'isBoolean'               => true,
            'eval'                    => array( 'tl_class'=>'w50'),
            'sql'                     => "char(1) NOT NULL default '1'"
        ),
      
        'looop' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_vegas']['looop'],
            'inputType'               => 'checkbox',
            'isBoolean'               => true,
            'eval'                    => array( 'tl_class'=>'w50'),
            'sql'                     => "char(1) NOT NULL default '1'"
        ),
      
        'shuffle' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_vegas']['shuffle'],
            'inputType'               => 'checkbox',
            'isBoolean'               => true,
            'eval'                    => array( 'tl_class'=>'w50'),
            'sql'                     => "char(1) NOT NULL default '0'"
        ),    

        'delay' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_vegas']['delay'],
            'default'                 => 5000,
            'inputType'               => 'text',
            'eval'                    => array( 'mandatory' => true,'tl_class'=>'w50','rgxp'=>'natural'),
            'sql'                     => "int(10) NOT NULL default '5000'"
        ),

        'overlay' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_vegas']['overlay'],
            'inputType'               => 'select',
            'sorting'                 => true,
            'flag'                    => 1,
            'options'                 => array('01', '02', '03', '04', '05', '06', '07', '08', '09'),
            'reference'               => &$GLOBALS['TL_LANG']['tl_vegas'],
            'eval'                    => array('includeBlankOption' => true,'tl_class'=> 'w50'),                
            'sql'                     => "varchar(128) NOT NULL default ''"
        ),

        'transition' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_vegas']['transition'],
            'inputType'               => 'select',
            'sorting'                 => true,
            'flag'                    => 1,
            'options'                 => array('fade','fade2','slideLeft','slideLeft2','slideRight','slideRight2','slideUp','slideUp2','slideDown','slideDown2','zoomIn','zoomIn2','zoomOut','zoomOut2','swirlLeft','swirlLeft2','swirlRight','swirlRight2','burn','burn2','blur','blur2','flash','flash2'),
            'reference'               => &$GLOBALS['TL_LANG']['tl_vegas'],
            'eval'                    => array('includeBlankOption' => false,'mandatory' => true,'tl_class'=> 'w50'),                
            'sql'                     => "varchar(128) NOT NULL default 'fade'"
        ),

        'transitionDuration' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_vegas']['transitionDuration'],
            'inputType'               => 'select',
            'sorting'                 => true,
            'flag'                    => 1,
            'options'                 => array('1','1000','2000','3000','4000','5000','6000','7000','8000','9000','10000','auto'),
            'reference'               => &$GLOBALS['TL_LANG']['tl_vegas'],
            'eval'                    => array('includeBlankOption' => false,'tl_class'=> 'w50'),                
            'sql'                     => "varchar(128) NOT NULL default '1000'"
        ),


        'firstTransition' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_vegas']['firstTransition'],
            'inputType'               => 'select',
            'sorting'                 => true,
            'flag'                    => 1,
            'options'                 => array('fade','fade2','slideLeft','slideLeft2','slideRight','slideRight2','slideUp','slideUp2','slideDown','slideDown2','zoomIn','zoomIn2','zoomOut','zoomOut2','swirlLeft','swirlLeft2','swirlRight','swirlRight2','burn','burn2','blur','blur2','flash','flash2'),
            'reference'               => &$GLOBALS['TL_LANG']['tl_vegas'],
            'eval'                    => array('includeBlankOption' => true,'tl_class'=> 'w50'),                
            'sql'                     => "varchar(128) NOT NULL default ''"
        ),


        'firstTransitionDuration' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_vegas']['firstTransitionDuration'],
            'inputType'               => 'select',
            'sorting'                 => true,
            'flag'                    => 1,
            'options'                 => array('1','1000','2000','3000','4000','5000','6000','7000','8000','9000','10000','auto'),
            'reference'               => &$GLOBALS['TL_LANG']['tl_vegas'],
            'eval'                    => array('includeBlankOption' => true,'tl_class'=> 'w50'),                
            'sql'                     => "varchar(128) NOT NULL default ''"
        ),

        'animation' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_vegas']['animation'],
            'inputType'               => 'select',
            'sorting'                 => true,
            'flag'                    => 1,
            'options'                 => array('kenburns','kenburnsUp','kenburnsDown','kenburnsRight','kenburnsLeft','kenburnsUpLeft','kenburnsUpRight','kenburnsDownLeft','kenburnsDownRight','random'),
            'reference'               => &$GLOBALS['TL_LANG']['tl_vegas'],
            'eval'                    => array('includeBlankOption' => true,'tl_class'=> 'w50'),                
            'sql'                     => "varchar(128) NOT NULL default ''"
        ),

        'animationDuration' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_vegas']['animationDuration'],
            'inputType'               => 'select',
            'sorting'                 => true,
            'flag'                    => 1,
            'options'                 => array('1','1000','2000','3000','4000','5000','6000','7000','8000','9000','10000','auto'),
            'reference'               => &$GLOBALS['TL_LANG']['tl_vegas'],
            'eval'                    => array('includeBlankOption' => false,'tl_class'=> 'w50'),                
            'sql'                     => "varchar(128) NOT NULL default 'auto'"
        ),       

        'align' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_vegas']['align'],
            'inputType'               => 'select',
            'sorting'                 => true,
            'flag'                    => 1,
            'options'                 => array('center','top','right','bottom','left'),
            'reference'               => &$GLOBALS['TL_LANG']['tl_vegas'],
            'eval'                    => array('includeBlankOption' => false,'tl_class'=> 'w50'),                
            'sql'                     => "varchar(128) NOT NULL default 'center'"
        ),

        'valign' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_vegas']['valign'],
            'inputType'               => 'select',
            'sorting'                 => true,
            'flag'                    => 1,
            'options'                 => array('center','top','right','bottom','left'),
            'reference'               => &$GLOBALS['TL_LANG']['tl_vegas'],
            'eval'                    => array('includeBlankOption' => false,'tl_class'=> 'w50'),                
            'sql'                     => "varchar(128) NOT NULL default 'center'"
        ),

        'cover' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_vegas']['cover'],
            'inputType'               => 'select',
            'sorting'                 => true,
            'flag'                    => 1,
            'options'                 => array('true','false','repeat'),
            'reference'               => &$GLOBALS['TL_LANG']['tl_vegas'],
            'eval'                    => array('includeBlankOption' => false,'tl_class'=> 'w50'),                
            'sql'                     => "varchar(128) NOT NULL default 'true'"
        ),

        'color' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_vegas']['color'],
            'inputType'               => 'text',
            'eval'                    => array('maxlength'=>6, 'size'=>1, 'colorpicker'=>true, 'isHexColor'=>true, 'decodeEntities'=>true, 'tl_class'=>'w50 wizard'),
            'sql'                     => "varchar(64) NOT NULL default ''"
        )
    )
);
 
