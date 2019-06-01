<?php
class filesController extends commonController
{
	public function index()
	{
	   $dirget=in($_GET['dirget']);
	   $urls=str_replace(',','/',$dirget);
	   $dirs=str_replace(',','/',$dirget);
	   $dirs=empty($dirs)?ROOT_PATH.'upload':ROOT_PATH.'upload'.$dirs;
       if(is_dir($dirs)){
		 $dir = opendir($dirs);
		 $i=0;
		 while(false!=$file=readdir($dir)){
			if($file!='.' && $file!='..'){
				$arr_file1[$i]['name']=$file;
				$path=$dirs."/".$file;
				if(is_dir($path)) $arr_file1[$i]['type']=1;
				else{
			        $arr_file1[$i]['size']=ceil(filesize($path)/1024);
			        $arr_file1[$i]['time']=date("Y-m-d H:i:s",fileatime($path));

			        $names=explode('.',$file);
			        $names[1]=strtolower($names[1]);
			        $allowType=explode(',',strtolower(config('allowType')));
			        if(in_array($names[1],$allowType)){
                       if($names[1]='jpg' || $names[1]='bmp' || $names[1]='gif' ||$names[1]='png') $arr_file1[$i]['type']=2;
                       else $arr_file1[$i]['type']=3;
			        }else $arr_file1[$i]['type']=4;
				}
			    $i++;
			}
		  }
	   }
	   closedir($dir);
	   $this->upload=__UPLOAD__;   
	   $this->dirget=$dirget;//文件路径
	   $this->urls=$urls.'/';//URL路径
	   $this->list=$arr_file1;
	   //面包屑
	   $FilesArr=explode(',', $dirget);
	   $daohang='<a href="'.url('files/index').'">upload</a>';
	   for($i=1;$i<count($FilesArr);$i++){
	   	 $pl=strpos($dirget,','.$FilesArr[$i]);
	   	 $len=strlen($FilesArr[$i]);
	   	 $dirdao=substr($dirget,0,$pl+$len+1);
	   	 $daohang.=' > <a href="'.url('files/index',array('dirget'=>$dirdao)).'">'.$FilesArr[$i].'</a>';
	   }
	   $this->daohang=$daohang;
	   $this->display();
	}

	public function del()
	{
	   $dirs=in($_GET['fname']);
	   $dirs=str_replace(',','/',$dirs);
	   $dirs=ROOT_PATH.'upload'.$dirs;
	   if(is_dir($dirs)){del_dir($dirs); echo 1;} 
	   elseif(file_exists($dirs)){
	   	 if(unlink($dirs)) echo 1;
	   }else echo '文件不存在'; 
	}
}