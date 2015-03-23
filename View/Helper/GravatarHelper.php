<?php

/**
 * 
 */
class GravatarHelper extends AppHelper{

	// Load core Html helper
	public $helpers = array('Html');

	// Default settings for the helper
	private $_settings = array(
		'secure'=>false,
		'extension'=>'',
		'size'=>'80',
		'default'=>'mm',
		'forcedefault'=>false,
		'rating'=>'g',
		'image-options'=>array('class'=>'gravatar')
		);

	/**
	 * GravatarHelper constructor. Used to merge default settings and user's settings.
	 */
	public function __construct(View $view, $settings=array()){
		parent::__construct($view,$settings);
		if(isset($settings['image-options'])){
			$settings['image-options'] = array_merge($settings['image-options'],$this->_settings['image-options']);
		}
		$this->_settings = array_merge($this->_settings,$settings);
		$this->_settings = $this->checkSettings($this->_settings);
	}

	/**
	 * 
	 */
	public function gravatar($email,$options=array()){
		if(isset($options['image-options'])){
			$options['image-options'] = array_merge($this->_settings['image-options'],$options['image-options']);
		}
		$options = array_merge($this->_settings,$options);
		$options = $this->checkSettings($options);

		// init url
		$url = 'http://www.gravatar.com/avatar/'.md5($email);
		if($options['secure']===true){
			$url = str_replace('http', 'https', $url);
		}

		// generate options
		if(!empty($options['extension'])){
			$url .= $options['extension'];
		}
		$datas = array(
			's'=>$options['size']
			);
		if(!empty($options['default'])){
			$datas['d'] = urlencode($options['default']);
		}
		if($options['forcedefault']===true){
			$datas['f'] = 'y';
		}
		if(!empty($options['rating'])){
			$datas['r'] = $options['rating'];
		}

		$url .= '?' . http_build_query($datas);

		return $this->Html->image($url,$options['image-options']);
	}

	/**
	 * 
	 */
	private function checkSettings($settings){
		// check extension
		if(!empty($settings['extension']) && !in_array(strtolower($settings['extension']), array('.jpg','.jpeg','.gif','.png'))){
			$settings['extension'] = '';
		}

		// check size. In documentation say it's beetween 1 and 2048
		if(empty($settings['size']) || $settings['size'] < 1 || $settings['size'] > 2048 ){
			$settings['size'] = 80;
		}

		// check rating option
		if(!empty($settings['rating']) && !in_array($settings['rating'], array('g','pg','r','x'))){
			$settings['rating'] = 'g';
		}

		return $settings;
	}

}
