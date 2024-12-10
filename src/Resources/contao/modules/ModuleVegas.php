<?php

/*
 * Copyright (c) 2005-2024 Jonny Spitzner
 *
 * @license LGPL-3.0+
*/

use Contao\BackendTemplate;
use Contao\StringUtil;
use Contao\System;
use Contao\FilesModel;
use Contao\File;
use Contao\Environment;
use Contao\Module;
use Vegas\Model\VegasModel;
use Vegas\Model\VegasSlidesModel;


class ModuleVegas extends Module {
	
	protected $strTemplate = 'mod_vegas';
	
	public function generate(): string
	{
		$request = System::getContainer()->get('request_stack')->getCurrentRequest();

		if ($request && System::getContainer()->get('contao.routing.scope_matcher')->isBackendRequest($request))
		{
			$objVegas = VegasModel::findByPK($this->vegas);
			$objTemplate = new BackendTemplate('be_wildcard');
			$objTemplate->wildcard = '### Vegas ###';

			if (null !== $objVegas)
			{
				$objTemplate->title =  $objVegas->title;
			}
			
			return($objTemplate->parse());
		}
		
		return parent::generate();
	}



	protected function compile() {

		$GLOBALS['TL_JAVASCRIPT'][] = 'bundles/jonnyspvegas/vegas/vegas.min.js';
		$GLOBALS['TL_CSS'][] = 		  'bundles/jonnyspvegas/vegas/vegas.css';

		$config = '';

		if (null === ($vegas = VegasModel::findByPK($this->vegas)))
		{
			$this->Template->vegasconfig = $config;
			return;
		}

		$config .= '$("'.html_entity_decode($vegas->target).'").vegas(';
			$slides['preload'] = boolval($vegas->preload);
			$slides['timer'] = boolval($vegas->timer);
			$slides['autoplay'] = boolval($vegas->autoplay);
			$slides['delay'] = (int)$vegas->delay;
			$slides['loop']=boolval($vegas->looop);
			$slides['shuffle'] = boolval($vegas->shuffle);
			$slides['transition'] = $vegas->transition;
			$slides['animation'] = $vegas->animation;
			$slides['align'] = $vegas->align;
			$slides['valign'] = $vegas->valign;
			$slides['cover'] = ($vegas->cover =='true' || $vegas->cover == 'false') ? boolval($vegas->cover) : $vegas->cover ;
			$slides['transitionDuration'] = (is_numeric($vegas->transitionDuration)) ? intval($vegas->transitionDuration) : $vegas->transitionDuration;
			$slides['animationDuration'] = (is_numeric($vegas->animationDuration)) ? intval($vegas->animationDuration) : $vegas->animationDuration;
			
			if($vegas->firstTransition <> ''){
				$slides['firstTransition'] = (is_numeric($vegas->firstTransition)) ? intval($vegas->firstTransition) : $vegas->firstTransition;
			}

			if($vegas->firstTransitionDuration <> ''){
				$slides['firstTransitionDuration'] = (is_numeric($vegas->firstTransitionDuration)) ? intval($vegas->firstTransitionDuration) : $vegas->firstTransitionDuration;
			}

			if($vegas->color <> ''){
				$slides['color'] = '#'.$vegas->color;
			}

			if($vegas->overlay <> ''){
				$slides['overlay']= Environment::get('base').'bundles/jonnyspvegas/vegas/overlays/'.$vegas->overlay.'.png';
			}

			$images = VegasSlidesModel::findBy(array('pid=?', 'published=?'),array($vegas->id, '1'),array('order'=>'sorting ASC'));
			if (null !== $images)
			{
				foreach ($images as $key => $value) {

					$slide['src'] = Environment::get('base').FilesModel::findByPk($value->src)->path;
					$slide['align'] = $value->align;
					$slide['valign'] = $value->valign;
					if($value->transition <> ''){
						$slide['transition'] = $value->transition;
					}
					if($value->animation <> ''){
						$slide['animation'] = $value->animation;
					}

					$slides['slides'][] = $slide;
					unset($slide);
				}
			}
			$config .= json_encode($slides);
			
			unset($slides);
		
		$config .='	);';

		$this->Template->vegasconfig = $config;
	}
}

