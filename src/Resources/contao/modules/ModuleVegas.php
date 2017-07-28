<?php

class ModuleVegas extends Module {
	
	protected $strTemplate = 'mod_vegas';
	
	public function generate() {
		if(TL_MODE == 'BE') {
			$objVegas = \VegasModel::findByPK($this->vegas);
			$objT = new BackendTemplate('be_wildcard');
			$objT->wildcard = '### Vegas ###';
			return($objT->parse());
		}
		
		return(parent::generate());
	}
	
	protected function compile() {

		$GLOBALS['TL_JAVASCRIPT'][] = 'bundles/jonnyspvegas/vegas/vegas.min.js';
		$GLOBALS['TL_CSS'][] = 		  'bundles/jonnyspvegas/vegas/vegas.css';

		$config = '';

		$vegas = \VegasModel::findByPK($this->vegas);

		$config .= '$("'.$vegas->target.'").vegas(';
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
				$slides['overlay']= $this->Environment->base.'bundles/jonnyspvegas/vegas/overlays/'.$vegas->overlay.'.png';
			}

			$images = \VegasSlidesModel::findBy(array('pid=?'),array($vegas->id),array('order'=>'sorting ASC'));
			if (isset($images)){
				foreach ($images as $key => $value) {

					$slide['src'] = $this->Environment->base.\FilesModel::findByPk($value->src)->path;
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

