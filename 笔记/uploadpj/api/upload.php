<?php

/**
 * @author: Imtinmin
 * @Date:   2019-08-25 21:28:50
 * @Last Modified by:   Imtinmin
 * @Last Modified time: 2019-08-26 00:03:24
 */
require_once('config.php');


if(@$_FILES['fileTest']['tmp_name']){
	$filename = $_FILES['fileTest']['name'];
	//var_dump();
	//echo UPLOADDIR;
	move_uploaded_file($_FILES['fileTest']['tmp_name'], UPLOADDIR.$filename);
	if(UPLOAD_ERR_OK === 0){
		echo json_encode(array('status' => 'success','url' => substr(UPLOADDIR,1).$filename));
	}else{
		//echo json_encode(array('status' => 'fail','msg' => '上传失败'));
		http_response_code(500);
	}
}else{
	echo json_encode(array('status' => 'fail','msg' => '请选择文件'));
}