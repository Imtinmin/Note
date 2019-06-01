<?php
class controller{
	protected $model = NULL; //兼容以前cp操作
	protected $layout = NULL; //布局视图
	private $_data = array();
	
	protected function init(){
		if(!file_exists(BASE_PATH . 'apps/install/install.lock') && api('install','ifexist')) $this->redirect(url('install/index/index'));
	}
	
	public function __construct(){
		if( 1 != config('APP_STATE') ){
			$this->error('该应用尚未开启!');
		}
		$this->model = model('base')->model;
		$this->init();
	}

	public function __get($name){
		return isset( $this->_data[$name] ) ? $this->_data[$name] : NULL;
	}

	public function __set($name, $value){
		$this->_data[$name] = $value;
	}
	
	protected function view(){
		static $view = NULL;
		if( empty($view) ){
			$tpconfig=config('TPL');
			$tppath=BASE_PATH . 'apps/' . config('_APP_NAME') .'/view/';
			if(is_mobile() && !empty($tpconfig['TPL_TEMPLATE_PATH_MOBILE'])){//移动端判断
			   $tpconfig['TPL_TEMPLATE_PATH']=$tppath.$tpconfig['TPL_TEMPLATE_PATH_MOBILE'].'/';
			   unset($tpconfig['TPL_TEMPLATE_PATH_MOBILE']);
			   $tpconfig['TPL_CACHE_PATH']=$tpconfig['TPL_CACHE_PATH'].'/mobile/';
			}else{
			   $tpconfig['TPL_TEMPLATE_PATH']=empty($tpconfig['TPL_TEMPLATE_PATH'])? $tppath : $tppath.$tpconfig['TPL_TEMPLATE_PATH'].'/';
			   $tpconfig['TPL_CACHE_PATH']=$tpconfig['TPL_CACHE_PATH'].'/pc/';
			} 
			$view = new cpTemplate($tpconfig);
		}
		return $view;
	}
	//模板赋值
	protected function assign($name, $value){
		return $this->view()->assign($name, $value);
	}
	
	protected function display($tpl = '', $return = false, $is_tpl = true ){
		if( $is_tpl ){
			$tpl = empty($tpl) ? CONTROLLER_NAME . '_'. ACTION_NAME : $tpl;
			if( $is_tpl && $this->layout ){
				$this->__template_file = $tpl;
				$tpl = $this->layout;
			}
		}
		$this->view()->assign( $this->_data );
		return $this->view()->display($tpl, $return, $is_tpl).cpright();
	}
	//获取分页查询limit
	protected function pageLimit($url, $num = 10){
		$url = str_replace(urlencode('{page}'), '{page}', $url);
		$page = is_object($this->pager['obj']) ? $this->pager['obj'] : new Page();	
		$cur_page = $page->getCurPage($url);
		$limit_start = ($cur_page-1) * $num;
		$limit = $limit_start.','.$num;
		$this->pager = array('obj'=>$page, 'url'=>$url, 'num'=>$num, 'cur_page'=>$cur_page, 'limit'=>$limit);
		return $limit;
	}
	
	//分页结果显示
	protected function pageShow($count,$pageBarNum=10,$mode=1){
		return $this->pager['obj'] ->show($this->pager['url'], $count, $this->pager['num'],$pageBarNum,$mode);
	}
	
	protected function isPost(){
		if($_SERVER['REQUEST_METHOD']=='POST'){
			if(config('TOKEN_ON')){
				session_starts();
               $name = '__hash__';
               $checkdata=$_POST[$name];
               if(empty($checkdata) || !isset($_SESSION[$name])) { 
                   throw new Exception('令牌数据无效~', 404);
               }
               // 令牌验证
               list($key,$value)  =  explode('_',$checkdata);
               if(!($value && $_SESSION[$name][$key] === $value)) { 
                   throw new Exception('非法数据提交~', 404);
               }
               unset($_SESSION[$name][$key]);
			} 
			return true;
		}
		return false;
	}
	
	//直接跳转
	protected function redirect( $url, $code=302) {
		header('location:' . $url, true, $code);
		exit;
	}
	//弹出信息
	protected function alert($msg){
		if (!headers_sent()) header("Content-type: text/html; charset=utf-8");
		echo "<script>alert('$msg');</script>";
	}
	 //操作成功之后跳转,默认三秒钟跳转
	protected  function success($msg,$url=NULL,$waitSecond=3,$scripts='')
	{
		if (!headers_sent()) header("Content-type: text/html; charset=utf-8");
		if($url===NULL) $url=url(CONTROLLER_NAME.'/index');
		echo "<!DOCTYPE><html><head><meta http-equiv='Refresh' content='".$waitSecond.";URL=".$url."'>";
		echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
        echo '<link href="'.__PUBLIC__.'/css/bootstrap.css" rel="stylesheet" type="text/css" /><link href="'.__PUBLIC__.'/css/alert.css" rel="stylesheet" type="text/css" /></head><body>'; 
        echo '<div class="modal-dialog modal-lg" role="document">';
        echo '<div class="modal-content">';
        echo '<div class="modal-header">';
        echo '<h4 class="modal-title text-primary"> YXcms成功提示</h4>';
        echo '</div><div class="modal-body"><p class="mescon"><span class="glyphicon glyphicon-ok text-primary"></span> ';
        echo $msg;
        echo '</p></div><div class="modal-footer"><a href="'.$url.'" class="btn btn-primary ">确定</a></div></div></div></body></html>';
		exit;
	}
	
	protected function error($msg,$url=NULL,$back=1)
	{		
		if (!headers_sent()) header("Content-type: text/html; charset=utf-8");
		if($url==NULL) $jump= "history.go(-{$back});";
		else $jump= "window.location.href='$url';";
        echo "<!DOCTYPE><html><head><meta http-equiv='Refresh' content='".$waitSecond.";URL=".$url."'>";
		echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
        echo '<link href="'.__PUBLIC__.'/css/bootstrap.css" rel="stylesheet" type="text/css" /><link href="'.__PUBLIC__.'/css/alert.css" rel="stylesheet" type="text/css" /></head><body>'; 
        echo '<div class="modal-dialog " role="document">';
        echo '<div class="modal-content">';
        echo '<div class="modal-header">';
        echo '<h4 class="modal-title text-danger"> YXcms失败提示</h4>';
        echo '</div><div class="modal-body"><p class="mescon"><span class="glyphicon glyphicon-remove text-danger"></span> ';
        echo $msg;
        echo '</p></div><div class="modal-footer">';
        if($url==NULL) echo '<button  href="'.$url.'" class="btn btn-danger " onClick="history.go(-1);">确定</button>';
		else echo '<a href="'.$url.'" class="btn btn-danger ">确定</a>';
        echo '</div></div></div></body></html>';
		exit;
	}
	protected  function jump($msg,$urly=NULL,$ymes,$urln=NULL,$nmes,$waitSecond=3)
	{
        if (!headers_sent()) header("Content-type: text/html; charset=utf-8");
		if($url===NULL) $url=url(CONTROLLER_NAME.'/index');
		echo "<!DOCTYPE><html><head><meta http-equiv='Refresh' content='".$waitSecond.";URL=".$url."'>";
		echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
        echo '<link href="'.__PUBLIC__.'/css/bootstrap.css" rel="stylesheet" type="text/css" /><link href="'.__PUBLIC__.'/css/alert.css" rel="stylesheet" type="text/css" /></head><body>'; 
        echo '<div class="modal-dialog modal-lg" role="document">';
        echo '<div class="modal-content">';
        echo '<div class="modal-header">';
        echo '<h4 class="modal-title text-primary"> YXcms提示</h4>';
        echo '</div><div class="modal-body"><p class="mescon"> ';
        echo $msg;
        echo '</p></div><div class="modal-footer"><a href="'.$urly.'" class="btn btn-primary ">'.$ymes.'</a><a href="'.$urln.'" class="btn btn-info ">'.$nmes.'</a></div></div></div></body></html>';
		exit;
	}
}