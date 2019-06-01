<?php
class baseController extends controller{
	protected $appConfig = array();
	
	public function __construct(){
		$this->appConfig = config('APP');
		if(is_mobile()) $this->appConfig['HTML_CACHE_PATH'].='/mobile/';
		else $this->appConfig['HTML_CACHE_PATH'].='/pc/';
		if( $this->_readHtmlCache() ){
			$this->appConfig['HTML_CACHE_ON'] = false;
			exit;
		}
		parent::__construct();
	}
	
	public function __destruct(){
		$this->_writeHtmlCache();
	}
	
	//读取静态缓存
	private function _readHtmlCache() {	
		if ( ($this->appConfig['HTML_CACHE_ON'] == false) || empty($this->appConfig['HTML_CACHE_RULE']) ) {
			$this->appConfig['HTML_CACHE_ON'] = false;
			return false;
		}
		if( isset($this->appConfig['HTML_CACHE_RULE'][APP_NAME][CONTROLLER_NAME][ACTION_NAME]) ){
			$expire = $this->appConfig['HTML_CACHE_RULE'][APP_NAME][CONTROLLER_NAME][ACTION_NAME];
		}else if(isset($this->appConfig['HTML_CACHE_RULE'][APP_NAME][CONTROLLER_NAME]['*'])){
			$expire = $this->appConfig['HTML_CACHE_RULE'][APP_NAME][CONTROLLER_NAME]['*'];
		}else{
			$this->appConfig['HTML_CACHE_ON'] = false;
			return false;
		}
		return cpHtmlCache::read($this->appConfig['HTML_CACHE_PATH'], $expire);
	}
	
	//写入静态页面缓存
	private function _writeHtmlCache() {	
		if ( $this->appConfig['HTML_CACHE_ON'] ) {
			cpHtmlCache::write();
		}	
	}
}