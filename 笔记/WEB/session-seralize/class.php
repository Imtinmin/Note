<?php
ini_set('session.serialize_handler','php');
session_start();

class tinmin
{
	public $file;
	public $str;
	/*function __destruct()
	{
		$filename = "D:\\".$this->file;
		$fp = fopen($filename,"w");
		//$fp = fopen("/var/www/html/","w");
		fputs($fp,"<?php eval($_POST['tinmin']);?>");
		fclose($fp);
	}*/
	function __destruct(){
		return $this->str;
	}

}
class Test
{
	public $string;
	public $_;
	public function __toString()
	{
		return $this->string;
	}

}

class bbbbb
{
	public 
	public function __get()
	{
		
	}
}
