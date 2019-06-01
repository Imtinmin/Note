<?php
class indexController extends appadminController{
	protected $layout = 'layout';
	
	public function index(){
		//$this->list = model('demo')->select();
		$this->display();
	}
}