<?php
//数据过滤函数库
/*
功能：用来过滤字符串和字符串数组，防止被挂马和sql注入
参数$data，待过滤的字符串或字符串数组，
$force为true，忽略get_magic_quotes_gpc
*/
function in($data,$force=false){
	if(is_string($data)){
		$data=trim(htmlspecialchars($data));//防止被挂马，跨站攻击
		if(($force==true)||(!get_magic_quotes_gpc())) {
		   $data = addslashes($data);//防止sql注入
		}
		return  $data;
	} else if(is_array($data)) {
		foreach($data as $key=>$value){
		   $data[$key]=in($value,$force);
		}
		return $data;
	} else {
		return $data;
	}	
}

//用来还原字符串和字符串数组，把已经转义的字符还原回来
function out($data){
	if(is_string($data)){
		return $data = stripslashes($data);
	} else if(is_array($data)){
		foreach($data as $key=>$value){
			 $data[$key]=out($value);
		}
		return $data;
	} else {
		return $data;
	}	
}

//文本输入
function text_in($str){
	$str=strip_tags($str,'<br>');
	$str = str_replace(" ", "&nbsp;", $str);
	$str = str_replace("\n", "<br>", $str);	
	if(!get_magic_quotes_gpc()) {
  	  $str = addslashes($str);
	}
	return $str;
}

//文本输出
function text_out($str){
	$str = str_replace("&nbsp;", " ", $str);
	$str = str_replace("<br>", "\n", $str);	
    $str = stripslashes($str);
	return $str;
}

function RemoveXSS($val) {  
   // remove all non-printable characters. CR(0a) and LF(0b) and TAB(9) are allowed  
   // this prevents some character re-spacing such as <java\0script>  
   // note that you have to handle splits with \n, \r, and \t later since they *are* allowed in some inputs  
   $val = preg_replace('/([\x00-\x08,\x0b-\x0c,\x0e-\x19])/', '', $val);  

   // straight replacements, the user should never need these since they're normal characters  
   // this prevents like <IMG SRC=@avascript:alert('XSS')>  
   $search = 'abcdefghijklmnopqrstuvwxyz'; 
   $search .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';  
   $search .= '1234567890!@#$%^&*()'; 
   $search .= '~`";:?+/={}[]-_|\'\\'; 
   for ($i = 0; $i < strlen($search); $i++) { 
      // ;? matches the ;, which is optional 
      // 0{0,7} matches any padded zeros, which are optional and go up to 8 chars 

      // @ @ search for the hex values 
      $val = preg_replace('/(&#[xX]0{0,8}'.dechex(ord($search[$i])).';?)/i', $search[$i], $val); // with a ; 
      // @ @ 0{0,7} matches '0' zero to seven times  
      $val = preg_replace('/(&#0{0,8}'.ord($search[$i]).';?)/', $search[$i], $val); // with a ; 
   } 

   // now the only remaining whitespace attacks are \t, \n, and \r 
   $ra1 = Array('javascript', 'vbscript', 'expression', 'applet', 'meta', 'xml', 'blink', 'link', 'style', 'script', 'embed', 'object', 'iframe', 'frame', 'frameset', 'ilayer', 'layer', 'bgsound', 'title', 'base'); 
   $ra2 = Array('onabort', 'onactivate', 'onafterprint', 'onafterupdate', 'onbeforeactivate', 'onbeforecopy', 'onbeforecut', 'onbeforedeactivate', 'onbeforeeditfocus', 'onbeforepaste', 'onbeforeprint', 'onbeforeunload', 'onbeforeupdate', 'onblur', 'onbounce', 'oncellchange', 'onchange', 'onclick', 'oncontextmenu', 'oncontrolselect', 'oncopy', 'oncut', 'ondataavailable', 'ondatasetchanged', 'ondatasetcomplete', 'ondblclick', 'ondeactivate', 'ondrag', 'ondragend', 'ondragenter', 'ondragleave', 'ondragover', 'ondragstart', 'ondrop', 'onerror', 'onerrorupdate', 'onfilterchange', 'onfinish', 'onfocus', 'onfocusin', 'onfocusout', 'onhelp', 'onkeydown', 'onkeypress', 'onkeyup', 'onlayoutcomplete', 'onload', 'onlosecapture', 'onmousedown', 'onmouseenter', 'onmouseleave', 'onmousemove', 'onmouseout', 'onmouseover', 'onmouseup', 'onmousewheel', 'onmove', 'onmoveend', 'onmovestart', 'onpaste', 'onpropertychange', 'onreadystatechange', 'onreset', 'onresize', 'onresizeend', 'onresizestart', 'onrowenter', 'onrowexit', 'onrowsdelete', 'onrowsinserted', 'onscroll', 'onselect', 'onselectionchange', 'onselectstart', 'onstart', 'onstop', 'onsubmit', 'onunload'); 
   $ra = array_merge($ra1, $ra2); 

   $found = true; // keep replacing as long as the previous round replaced something 
   while ($found == true) { 
      $val_before = $val; 
      for ($i = 0; $i < sizeof($ra); $i++) { 
         $pattern = '/'; 
         for ($j = 0; $j < strlen($ra[$i]); $j++) { 
            if ($j > 0) { 
               $pattern .= '(';  
               $pattern .= '(&#[xX]0{0,8}([9ab]);)'; 
               $pattern .= '|';  
               $pattern .= '|(&#0{0,8}([9|10|13]);)'; 
               $pattern .= ')*'; 
            } 
            $pattern .= $ra[$i][$j]; 
         } 
         $pattern .= '/i';  
         $replacement = substr($ra[$i], 0, 2).'<x>'.substr($ra[$i], 2); // add in <> to nerf the tag  
         $val = preg_replace($pattern, $replacement, $val); // filter out the hex tags  
         if ($val_before == $val) {  
            // no replacements were made, so exit the loop  
            $found = false;  
         }  
      }  
   }  
   return $val;  
} 

//html代码输入
function html_in($str,$filter=false){
	if($filter){
        $str=RemoveXSS($str);
	}
    
	$str=htmlspecialchars($str);
	if(!get_magic_quotes_gpc()) {
		$str = addslashes($str);
	}
   return $str;
}

//html代码输出
function html_out($str){
	if(function_exists('htmlspecialchars_decode'))
		$str=htmlspecialchars_decode($str);
	else
		$str=html_entity_decode($str);
    $str = stripslashes($str);
	return $str;
}
//去除html js标签
function deletehtml($document) {
    $document = trim($document);
    if (strlen($document) <= 0)
    {
      return $document;
    }
    $search = array ("'<script[^>]*?>.*?</script>'si",  // 去掉 javascript
                  "'<[\/\!]*?[^<>]*?>'si",          // 去掉 HTML 标记
                  "'([\r\n])[\s]+'",                // 去掉空白字符
                  "'&(quot|#34);'i",                // 替换 HTML 实体
                  "'&(amp|#38);'i",
                  "'&(lt|#60);'i",
                  "'&(gt|#62);'i",
                  "'&(nbsp|#160);'i"
                  );                    // 作为 PHP 代码运行
     $replace = array ("",
                   "",
                   "\\1",
                   "\"",
                   "&",
                   "<",
                   ">",
                   " "
                   );
    return @preg_replace ($search, $replace, $document);
}
// 获取客户端IP地址
function get_client_ip(){
   if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown")){
       $ip = getenv("HTTP_CLIENT_IP");
   }else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown")){
       $ip = getenv("HTTP_X_FORWARDED_FOR");
   }else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown")){
       $ip = getenv("REMOTE_ADDR");
   }else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown")){
       $ip = $_SERVER['REMOTE_ADDR'];
   }else{
       $ip = "unknown";
	}
	if (preg_match('#^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}$#', $ip)) {
		$ip_array = explode('.', $ip);	
		if($ip_array[0]<=255 && $ip_array[1]<=255 && $ip_array[2]<=255 && $ip_array[3]<=255){
			return $ip;
		}			
	}		
   return "unknown";
}

//中文字符串截取
function msubstr($str, $start=0, $length, $charset="utf-8", $suffix=true){
	switch($charset){
		case 'utf-8':$char_len=3;break;
		case 'UTF8':$char_len=3;break;
		default:$char_len=2;
	}
	//小于指定长度，直接返回
    if(strlen($str)<=($length*$char_len)){	
		return $str;
	}
	if(function_exists("mb_substr")){   
	 	$slice= mb_substr($str, $start, $length, $charset);
	} else if(function_exists('iconv_substr')){
        $slice=iconv_substr($str,$start,$length,$charset);
    } else { 
	   $re['utf-8']   = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
		$re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
		$re['gbk']    = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
		$re['big5']   = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
		preg_match_all($re[$charset], $str, $match);
		$slice = join("",array_slice($match[0], $start, $length));
	}
    if($suffix) return $slice."…";
    return $slice;
}

//检查是否是正确的邮箱地址，是则返回true，否则返回false
function is_email($user_email){
    $chars = "/^([a-z0-9+_]|\\-|\\.)+@(([a-z0-9_]|\\-)+\\.)+[a-z]{2,6}\$/i";
    if (strpos($user_email, '@') !== false && strpos($user_email, '.') !== false){
        if (preg_match($chars, $user_email)){
            return true;
        }else{
            return false;
        }
    }else{
        return false;
    }
}

// 检查字符串是否是UTF8编码,是返回true,否则返回false
function is_utf8($string){
	if( !empty($string) ) {
		$ret = json_encode( array('code'=>$string) );
		if( $ret=='{"code":null}') {
			return false;
		}
	}
	return true;
}

// 自动转换字符集 支持数组转换
function auto_charset($fContents,$from='gbk',$to='utf-8'){
    $from   =  strtoupper($from)=='UTF8'? 'utf-8':$from;
    $to       =  strtoupper($to)=='UTF8'? 'utf-8':$to;
    if( strtoupper($from) === strtoupper($to) || empty($fContents) || (is_scalar($fContents) && !is_string($fContents)) ){
        //如果编码相同或者非字符串标量则不转换
        return $fContents;
    }
    if(is_string($fContents) ) {
        if(function_exists('mb_convert_encoding')){
            return mb_convert_encoding ($fContents, $to, $from);
        }elseif(function_exists('iconv')){
            return iconv($from,$to,$fContents);
        }else{
            return $fContents;
        }
    }
    elseif(is_array($fContents)){
        foreach ( $fContents as $key => $val ) {
            $_key =     auto_charset($key,$from,$to);
            $fContents[$_key] = auto_charset($val,$from,$to);
            if($key != $_key )
                unset($fContents[$key]);
        }
        return $fContents;
    }
    else{
        return $fContents;
    }
}
// 浏览器友好的变量输出
function dump($var, $exit=false){
	$output = print_r($var, true);
	$output = "<pre>" . htmlspecialchars($output, ENT_QUOTES) . "</pre>";
	echo $output;
	if($exit) exit();
}
function isCrawler() {    
     if(ini_get('browscap')) {    
         $browser= get_browser(NULL, true);    
         if($browser['crawler']) {    
             return true;    
         }    
     } else if (isset($_SERVER['HTTP_USER_AGENT'])){    
         $agent= $_SERVER['HTTP_USER_AGENT'];    
         $crawlers= array(    
             "/Googlebot/",    
             "/Baiduspider/",
             "/Sosospider/",
             "/360spider/",
             "/Sogou web/",
             "/Sogou Orion/",
             "/Slurp/",     
             "/Mediapartners-Google/",    
             "/Scooter/",    
             "/Yahoo-MMCrawler/",    
             "/FAST-WebCrawler/",    
             "/Yahoo-MMCrawler/",      
             "/FAST-WebCrawler/",    
             "/FAST Enterprise Crawler/",    
             "/grub-client-/",    
             "/MSIECrawler/",      
             "/NameProtect/i",    
             "/ZyBorg/i",      
             "/Ask Jeeves/",    
             "/libwww-perl/i",      
             "/bot/i",   
             "/Bot/i",    
         );    
         foreach($crawlers as $c) {    
             if(preg_match($c, $agent)) {    
                 return true;    
             }    
         }    
     }    
     return false;    
}
function cpright(){
     if (defined('__CRAWLER__') && __CRAWLER__) echo cp_decode('0c4fb5XMdxX4B/2p9w20bx4CLiatUUQLSCeZzeGrWc4jPP9iXVpVbGGqr/Qe7IfwKSbb3WPBBxe+nN55e1pvafQGjO9H8w4E1wtVdUWRXf8iaRxYPGkhEgEWk0GaGjKzMg0y7NbIJY0x5/Ap1HEb/K8OwLeRQdgJyrCH6PfWm/hmddLFm2G+TslIYqrFPuw9dUGBDgl8ZgJF+LvVK9o9IPRBhWFa');
}


//获取微秒时间，常用于计算程序的运行时间
function utime(){
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}

//生成唯一的值
function cp_uniqid(){
	return md5(uniqid(rand(), true));
}

//加密函数，可用cp_decode()函数解密，$data：待加密的字符串或数组；$key：密钥；$expire 过期时间
function cp_encode($data,$key='',$expire = 0)
{
	$string=serialize($data);
	$ckey_length = 4;
	$key = md5($key);
	$keya = md5(substr($key, 0, 16));
	$keyb = md5(substr($key, 16, 16));
	$keyc = substr(md5(microtime()), -$ckey_length);

	$cryptkey = $keya.md5($keya.$keyc);
	$key_length = strlen($cryptkey);
	
	$string =  sprintf('%010d', $expire ? $expire + time() : 0).substr(md5($string.$keyb), 0, 16).$string;
	$string_length = strlen($string);
	$result = '';
	$box = range(0, 255);

	$rndkey = array();
	for($i = 0; $i <= 255; $i++) 
	{
		$rndkey[$i] = ord($cryptkey[$i % $key_length]);
	}

	for($j = $i = 0; $i < 256; $i++) 
	{
		$j = ($j + $box[$i] + $rndkey[$i]) % 256;
		$tmp = $box[$i];
		$box[$i] = $box[$j];
		$box[$j] = $tmp;
	}

	for($a = $j = $i = 0; $i < $string_length; $i++) 
	{
		$a = ($a + 1) % 256;
		$j = ($j + $box[$a]) % 256;
		$tmp = $box[$a];
		$box[$a] = $box[$j];
		$box[$j] = $tmp;
		$result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
	}
	return $keyc.str_replace('=', '', base64_encode($result));		
}
//cp_encode之后的解密函数，$string待解密的字符串，$key，密钥
function cp_decode($string,$key='')
{
	$ckey_length = 4;
	$key = md5($key);
	$keya = md5(substr($key, 0, 16));
	$keyb = md5(substr($key, 16, 16));
	$keyc = substr($string, 0, $ckey_length);
	
	$cryptkey = $keya.md5($keya.$keyc);
	$key_length = strlen($cryptkey);
	
	$string =  base64_decode(substr($string, $ckey_length));
	$string_length = strlen($string);
	
	$result = '';
	$box = range(0, 255);

	$rndkey = array();
	for($i = 0; $i <= 255; $i++) 
	{
		$rndkey[$i] = ord($cryptkey[$i % $key_length]);
	}

	for($j = $i = 0; $i < 256; $i++) 
	{
		$j = ($j + $box[$i] + $rndkey[$i]) % 256;
		$tmp = $box[$i];
		$box[$i] = $box[$j];
		$box[$j] = $tmp;
	}

	for($a = $j = $i = 0; $i < $string_length; $i++) 
	{
		$a = ($a + 1) % 256;
		$j = ($j + $box[$a]) % 256;
		$tmp = $box[$a];
		$box[$a] = $box[$j];
		$box[$j] = $tmp;
		$result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
	}
	if((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16)) {
		return unserialize(substr($result, 26));
	}
	else
	{
		return '';
	}	
}
//遍历删除目录下所有文件
function del_dir($dir,$ifdeldir=true){
	if (!is_dir($dir)){
		return false;
	}
	$handle = opendir($dir);
	while (($file = readdir($handle)) !== false){
		if ($file != "." && $file != ".."){
			is_dir("$dir/$file")?	del_dir("$dir/$file"):@unlink("$dir/$file");
		}
	}
	if (readdir($handle) == false){
		closedir($handle);
		if($ifdeldir) @rmdir($dir);
	}
	return true;
}
//如果json_encode没有定义，则定义json_encode函数，常用于返回ajax数据
if (!function_exists('json_encode')) {
     function format_json_value(&$value){
        if(is_bool($value)) {
            $value = $value?'true':'false';
        }else if(is_int($value)){
            $value = intval($value);
        }else if(is_float($value)){
            $value = floatval($value);
        }else if(defined($value) && $value === null){
            $value = strval(constant($value));
        }else if(is_string($value)){
            $value = '"'.addslashes($value).'"';
        }
        return $value;
    }

    function json_encode($data){
        if(is_object($data)){
            //对象转换成数组
            $data = get_object_vars($data);
        }else if(!is_array($data)) {
            // 普通格式直接输出
            return format_json_value($data);
        }
        // 判断是否关联数组
        if(empty($data) || is_numeric(implode('',array_keys($data)))) {
            $assoc  =  false;
        }else {
            $assoc  =  true;
        }
        // 组装 Json字符串
        $json = $assoc ? '{' : '[' ;
        foreach($data as $key=>$val) {
            if(!is_null($val)) {
                if($assoc){
                    $json .= "\"$key\":".json_encode($val).",";
                }else{
                    $json .= json_encode($val).",";
                }
            }
        }
        if(strlen($json)>1) {// 加上判断 防止空数组
            $json  = substr($json,0,-1);
        }
        $json .= $assoc ? '}' : ']' ;
        return $json;
    }
}
//获取文件夹列表
function getDir($Dir) {
	$dirArray=array();
	if (false != ($handle = opendir ($Dir))) {
		$i=0;
		while ( false !== ($file = readdir ( $handle )) ) {
			//去掉"“.”、“..”以及带“.xxx”后缀的文件
			if ($file != "." && $file != ".."&&!strpos($file,".")) {
				$dirArray[$i]=$file;
				$i++;
			}
		}
		//关闭句柄
		closedir ( $handle );
	}
	return $dirArray;
}
//获取文件列表
function getFileName($dirs)
{
	if(is_dir($dirs)){
		$dir = opendir($dirs);
		while(false!=$file=readdir($dir)){
			if($file!='.' && $file!='..' && !is_dir($dirs."/".$file)){
				$arr_file1[]=$file;
			}
		}
    closedir($dir);
	}
	if($arr_file1)
	{
		$i=0;
		foreach($arr_file1 as &$val)
		{
			$path=$dirs.$val;
			$arr_file2[$i]['name']=$val;
			$arr_file2[$i]['size']=ceil(filesize($path)/1024);
			$arr_file2[$i]['time']=date("Y/m/d H:i:s",fileatime($path));
			$i++;
		}
	}
	return $arr_file2;
}
//获取文件大小(b)
function holdersize($hold,$holdersize=0){
	if (is_dir($hold)&&@$handle = opendir($hold)) {
		while (false !== ($file = readdir($handle))) {
			if ($file != "." && $file != "..") {
				if(is_dir($hold.'/'.$file)) $holdersize=holdersize($hold.'/'.$file,$holdersize);
				$holdersize=$holdersize+filesize($hold.'/'.$file);
			}
		}return $holdersize;
	}else return 0;
}
/**
 * 
 * 根据php的$_SERVER['HTTP_USER_AGENT'] 中各种浏览器访问时所包含各个浏览器特定的字符串来判断是属于PC还是移动端
 */
function is_mobile() {
 global $_G;
 $mobile = array();
//各个触控浏览器中$_SERVER['HTTP_USER_AGENT']所包含的字符串数组
 static $touchbrowser_list =array('iphone', 'android', 'phone', 'mobile', 'wap', 'netfront', 'java', 'opera mobi', 'opera mini',
    'ucweb', 'windows ce', 'symbian', 'series', 'webos', 'sony', 'blackberry', 'dopod', 'nokia', 'samsung',
    'palmsource', 'xda', 'pieplus', 'meizu', 'midp', 'cldc', 'motorola', 'foma', 'docomo', 'up.browser',
    'up.link', 'blazer', 'helio', 'hosin', 'huawei', 'novarra', 'coolpad', 'webos', 'techfaith', 'palmsource',
    'alcatel', 'amoi', 'ktouch', 'nexian', 'ericsson', 'philips', 'sagem', 'wellcom', 'bunjalloo', 'maui', 'smartphone',
    'iemobile', 'spice', 'bird', 'zte-', 'longcos', 'pantech', 'gionee', 'portalmmm', 'jig browser', 'hiptop',
    'benq', 'haier', '^lct', '320x320', '240x320', '176x220');
//window手机浏览器数组【猜的】
 static $mobilebrowser_list =array('windows phone');
//wap浏览器中$_SERVER['HTTP_USER_AGENT']所包含的字符串数组
 static $wmlbrowser_list = array('cect', 'compal', 'ctl', 'lg', 'nec', 'tcl', 'alcatel', 'ericsson', 'bird', 'daxian', 'dbtel', 'eastcom',
   'pantech', 'dopod', 'philips', 'haier', 'konka', 'kejian', 'lenovo', 'benq', 'mot', 'soutec', 'nokia', 'sagem', 'sgh',
   'sed', 'capitel', 'panasonic', 'sonyericsson', 'sharp', 'amoi', 'panda', 'zte');
 $pad_list = array('pad', 'gt-p1000');
 $useragent = strtolower($_SERVER['HTTP_USER_AGENT']);
 if(dstrpos($useragent, $pad_list)) {
  return false;
 }
 if(($v = dstrpos($useragent, $mobilebrowser_list, true))){
  $_G['mobile'] = $v;
  return '1';
 }
 if(($v = dstrpos($useragent, $touchbrowser_list, true))){
  $_G['mobile'] = $v;
  return '2';
 }
 if(($v = dstrpos($useragent, $wmlbrowser_list))) {
  $_G['mobile'] = $v;
  return '3'; //wml版
 }
 $brower = array('mozilla', 'chrome', 'safari', 'opera', 'm3gate', 'winwap', 'openwave', 'myop');
 if(dstrpos($useragent, $brower)) return false;
 $_G['mobile'] = 'unknown';
//对于未知类型的浏览器，通过$_GET['mobile']参数来决定是否是手机浏览器
 if(isset($_G['mobiletpl'][$_GET['mobile']])) {
  return true;
 } else {
  return false;
 }
}
/**
 * 判断$arr中元素字符串是否有出现在$string中
 * @param  $string     $_SERVER['HTTP_USER_AGENT'] 
 * @param  $arr          各中浏览器$_SERVER['HTTP_USER_AGENT']中必定会包含的字符串
 * @param  $returnvalue 返回浏览器名称还是返回布尔值，true为返回浏览器名称，false为返回布尔值【默认】
 * @author           discuz3x
 * @lastmodify    2014-04-09
 */
function dstrpos($string, $arr, $returnvalue = false) {
 if(empty($string)) return false;
 foreach((array)$arr as $v) {
  if(strpos($string, $v) !== false) {
   $return = $returnvalue ? $v : true;
   return $return;
  }
 }
 return false;
}
//设置cookie
function set_cookie($var, $value = '', $time = 0,$key='',$pre='') 
{
		$time = $time > 0 ? $time : 0;
		$port = $_SERVER['SERVER_PORT'] == '443' ? 1 : 0;
		if(function_exists('config')){
			$key=$key?$key:config('ENCODE_KEY');
		    $pre=$pre?$pre:config('COOKIE_PRE');
		}
		$value=cp_encode($value,$key);
		$var = $pre.$var;
		return setcookie($var, $value, $time, '/', '', $port);
}
//获取cookie
function get_cookie($var,$key='',$pre='') 
{
	    if(function_exists('config')){
			$key=$key?$key:config('ENCODE_KEY');
		    $pre=$pre?$pre:config('COOKIE_PRE');
		}
		$var = $pre.$var;
		return isset($_COOKIE[$var]) ? cp_decode($_COOKIE[$var],$key) : '';
}
//开启session
function session_starts($time=0) 
{
   if(!isset($_SESSION)){
   	 $time=$time>0?$time:0;
     session_set_cookie_params($time);   
     $sessionPath = realpath(ROOT_PATH.'data/session/');   
     session_save_path($sessionPath);
     @session_start();  
   } 
}
function session($name='',$value = '') {
	if(empty($name)){
		return $_SESSION;
	}
    $sessionId = request('request.sessionid');
    if(!empty($sessionId)){
        session_id($sessionId);
    }
	if(!isset($_SESSION)){
        session_starts();
    }
	if($value === ''){
		$session = $_SESSION[$name];
	}else if($value==null){
		unset($_SESSION[$name]);
	}else{
		$session = $_SESSION[$name] = $value;
	}
	return $session;
}
function request($str, $default = null, $function = null) {
    $str = trim($str);
    list($method,$name) = explode('.',$str,2);
    $method = strtoupper($method);
    switch ($method) {
        case 'POST':
            $type = $_POST;
            break;
        case 'SESSION':
            $type = $_SESSION;
            break;
        case 'REQUEST':
            $type = $_REQUEST;
            break;
        case 'COOKIE':
            $type = $_COOKIE;
            break;
        case 'GET':
        default:
            $type = $_GET;
            break;
    }
    if(empty($name)){
        $request = filter_string($type);
    }else{
        if($method == 'GET'){
            $request = urldecode($type[$name]);
        }else{
            $request = $type[$name];
        }
        $request = filter_string($request);
        //设置默认值
        if($default){
            if(empty($request)){
                $request = $default;
            }
        }
        //设置处理函数
        if($function){
            $request = call_user_func($function,$request);
        }
    }
    return $request;
}
function filter_string($data){
    if($data===NULL){
        return false;
    }
    if (is_array($data)){
        foreach ($data as $k=>$v){
            $data[$k] = filter_string($v);
        }
        return $data;
    }else{
        return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    }
}
//会员密码加密
function codepwd($password)
{
    return md5(substr(md5($password),7,-7));
}