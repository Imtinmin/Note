<?php
	header("Content-Type: text/html;charset=utf-8");
    session_start();
	require_once('check.php');

	if(!isset($_FILES['file'])){
        $data['message'] = '没有文件';
    }else{
        echo "收到文件";
        $file_type = array('.php','.asp','.aspx','.jsp','.jspx','.php3');        //不允许通过的格式
        $filepath="./upload/";     //上传路径
        $ext = '.'.pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION); //扩展名

        if(in_array($ext,$file_type)){
            $data['message'] ='格式错误';
            echo json_encode($data);
            exit(-1);
        }


        $news = time();
        $newname = $news.'-'.md5(md5($news.$ext)).$ext;
        $tmp_name=$_FILES['file']['tmp_name'];
        $filename=$filepath.$newname;
        $refile = substr($filename,1);

        if(move_uploaded_file($tmp_name,$filename))
        {
            $data['success'] = 1;
            $data['message'] = '成功';
            $data['url'] = $filename;
            # 注意打印了文件名
        }
        else
            $data['message']='上传失败!';
	}
	
	echo json_encode($data);
?>