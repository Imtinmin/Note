<?php
class cpTemplate {
	public $config =array(); //配置
	protected $vars = array();//存放变量信息
	protected $_replace = array();
	
	public function __construct($config = array()) {
		$this->config = array_merge(cpConfig::get('TPL'), (array)$config);//参数配置	
		$this->assign('cpTemplate', $this);
		$this->_replace = array(
				'str' => array( 'search' => array(),
								'replace' => array()
							),
				'reg' => array( 'search' => array("/__[A-Z]+__/",	//替换常量
												"/{(\\$[a-zA-Z_]\w*(?:\[[\w\.\"\'\[\]\$]+\])*)}/i",	//替换变量
												"/{include\s*file=\"(.*)\"}/i",	//递归解析模板包含
												),
								'replace' => array("<?php echo $0; ?>",
												 "<?php echo $1; ?>",
												 "<?php \$cpTemplate->display(\"$1\"); ?>",
												)					   
							)
		);
	}
	
	//模板赋值
	public function assign($name, $value = '') {
		if( is_array($name) ){
			foreach($name as $k => $v){
				$this->vars[$k] = $v;
			}
		} else {
			$this->vars[$name] = $value;
		}
	}

	//执行模板解析输出
	public function display($tpl = '', $return = false, $is_tpl = true ) {
		//如果没有设置模板，则调用当前模块的当前操作模板
		if ( $is_tpl &&  ($tpl == "") && (!empty($_GET['_module'])) && (!empty($_GET['_action'])) ) {
			$tpl = $_GET['_module'] . "/" . $_GET['_action'];
		}
		if( $return ){
			if ( ob_get_level() ){
				ob_end_flush();
				flush(); 
			} 
			ob_start();
		}
		extract($this->vars, EXTR_OVERWRITE);
		if ( $is_tpl && $this->config['TPL_CACHE_ON'] ) {
			define('YXCMS', true);
			$tplFile = $this->config['TPL_TEMPLATE_PATH'] . $tpl . $this->config['TPL_TEMPLATE_SUFFIX'];
			$cacheFile = $this->config['TPL_CACHE_PATH'] . md5($tplFile) . $this->config['TPL_CACHE_SUFFIX'];
			
			if ( !file_exists($tplFile) ) {
				throw new Exception($tplFile . "模板文件不存在");
			}
			//普通的文件缓存
			if ( empty($this->config['TPL_CACHE_TYPE']) ) {
				if ( !is_dir($this->config['TPL_CACHE_PATH']) ) {
					@mkdir($this->config['TPL_CACHE_PATH'], 0777, true);	
				}
				if ( (!file_exists($cacheFile)) || (filemtime($tplFile) > filemtime($cacheFile)) ) {
					file_put_contents($cacheFile, "<?php if (!defined('YXCMS')) exit;?>" . $this->compile($tpl));//写入缓存
				}
				include( $cacheFile );//加载编译后的模板缓存
				
			} else {
				//支持memcache等缓存
				$tpl_key = md5( realpath($tplFile) );
				$tpl_time_key = $tpl_key.'_time';
				static $cache = NULL;
				$cache = is_object($cache) ? $cache : new cpCache($this->config, $this->config['TPL_CACHE_TYPE']);
				$compile_content = $cache->get( $tpl_key );
				if ( empty($compile_content) || (filemtime($tplFile) > $cache->get($tpl_time_key)) ) {
					$compile_content = $this->compile($tpl);
					$cache->set($tpl_key, $compile_content, 3600*24*365);	//缓存编译内容
					$cache->set($tpl_time_key, time(), 3600*24*365);	//缓存编译内容
				}
				
			}
		} else {
			$compile_content=$this->compile( $tpl, $is_tpl);
		}
		
		if($this->config['TOKEN_ON']){//是否开启令牌验证
			 session_starts();
			 $tokenName  = '__hash__';
             if(!isset($_SESSION[$tokenName])) {
                 $_SESSION[$tokenName]  = array();
             }
             // 标识当前页面唯一性
             $tokenKey = md5(md5($_SERVER['REQUEST_URI'].$this->config['TOKEN_KEY']).chr(rand(97, 122)));
             $tokenValue = cp_encode(mt_rand());
             $_SESSION[$tokenName][$tokenKey]   =  $tokenValue;
             if(isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"])=="xmlhttprequest")//jquery判断是否ajax提交
                 header($tokenName.': '.$tokenKey.'_'.$tokenValue); //ajax需要获得这个header并替换页面中meta中的token值
             
            $input_token = '<input type="hidden" name="'.$tokenName.'" value="'.$tokenKey.'_'.$tokenValue.'" />';
            $meta_token = '<meta name="'.$tokenName.'" content="'.$tokenKey.'_'.$tokenValue.'" />';
            $ajax_taken = ",'__hash__':'".$tokenKey."_".$tokenValue."'";
            if(preg_match('/<\/form(\s*)>/is',$compile_content,$match)) {
                // 智能生成表单令牌隐藏域
                $compile_content = str_replace($match[0],$input_token.$match[0],$compile_content);
            }
            $compile_content = str_replace('<!--TOKEN-->',$ajax_taken,$compile_content);
            $compile_content = str_ireplace('</head>',$meta_token.'</head>',$compile_content);
		}else{
			$compile_content = str_replace('<!--TOKEN-->','',$compile_content);
		}

        eval('?>' . $compile_content);
		if( $return ){
			$content = ob_get_contents();
			ob_end_clean();
			return $content;
		}
	}	
	
	//自定义添加标签
	public function addTags($tags = array(), $reg = false) {
		$flag = $reg ? 'reg' : 'str';
		foreach($tags as $k => $v) {
			$this->_replace[$flag]['search'][] = $k;
			$this->_replace[$flag]['replace'][] = $v;
		}
	}
	
	//模板编译核心
	protected function compile( $tpl, $is_tpl = true ) {
		if( $is_tpl ){
			$tplFile = $this->config['TPL_TEMPLATE_PATH'] . $tpl . $this->config['TPL_TEMPLATE_SUFFIX'];
			if ( !file_exists($tplFile) ) {
				throw new Exception($tplFile . "模板文件不存在");
			}
			$template = file_get_contents( $tplFile );
		} else {
			extract($this->vars, EXTR_OVERWRITE);
			$template = $tpl;
		}
		
		//如果自定义模板标签解析函数tpl_parse_ext($template)存在，则执行
		if ( function_exists('tpl_parse_ext') ) {
			$template = tpl_parse_ext($template);
		}
		$template = str_replace($this->_replace['str']['search'], $this->_replace['str']['replace'], $template);
		$template = preg_replace($this->_replace['reg']['search'], $this->_replace['reg']['replace'], $template);
		return $template;
	}
}