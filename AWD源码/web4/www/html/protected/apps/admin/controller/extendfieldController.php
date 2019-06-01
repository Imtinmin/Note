<?php
class extendfieldController extends commonController
{
	// 扩展表
	public function index()
	{
		$list = model('extend')->select('pid=0','','id desc');
		$this->list=$list;
		$this->display();
	}

	// 添加扩展表
	public function tableadd()
	{
		if (!$this->isPost()) {
			$this->display();
		}else{
			$data = array();
			$data['name'] = in($_POST['tname']); //用途描述
			$data['type'] = intval($_POST['type']);//类型
			$data['tableinfo'] = 'extend_' . in($_POST['tableinfo']); //表名
			//验证数据
			if (empty($data['name'])||empty($_POST['tableinfo'])) {
				$this->error('请填写完整的信息~');
			}
			if(model('extend')->addtable($data['tableinfo'],$data['type'])){ //创建表操作
				if(model('extend')->insert($data)) //插入表数据
				$this->success('表添加成功~');
				else $this->error('表信息写入失败~');
			}else  $this->error('创建表失败~');
		}
	}

	// 修改扩展表
	public function tableedit()
	{
		if (!$this->isPost()) {
			$id = intval($_GET['id']);
			$info = model('extend')->find('id='.$id,'id,name,tableinfo');
			$this->info=$info;
			$this->display();
		}else{
			if (empty($_POST['tname']) || empty($_POST['id'])) $this->error('信息不完整');
			$data = array();
			$data['name'] = in($_POST['tname']); //表名称
			$condition = array();
			$condition['id'] = $_POST['id'];
			model('extend')->update($condition,$data);
			$this->success('拓展表修改成功~');
		}
	}

	// 删除扩展表
	public function tabledel()
	{
		$id = intval($_GET['id']);
		if (empty($id)) $this->error('ID传输错误！');
		$info = model('extend')->find("id='{$id}'",'tableinfo'); //获取当前表信息
		if(model('extend')->deltable($info['tableinfo'])){
			if(model('extend')->delete("id='{$id}' OR pid='{$id}'"))//删除记录信息
			$this->success('拓展表'.$info['tableinfo'].'删除成功！');
			else $this->error('拓展表'.$info['tableinfo'].'记录信息删除失败');
		}else $this->error('拓展表'.$info['tableinfo'].'删除失败');

	}

	// 字段列表
	public function fieldlist()
	{
		$id = intval($_GET['id']);
		$condition['id'] = $id;
		$condition2['pid'] = $id;
		$info = model('extend')->find($condition); //获取当前表信息
		$list = model('extend')->select($condition2,'','norder DESC,id DESC'); //获取当前表的字段
		$this->info= $info;
		$this->list=$list;
		$this->display();
	}

	// 添加字段
	public function fieldadd()
	{
		if (!$this->isPost()) {
			$id = intval($_GET['id']);
			if(empty($id)) $this->error('ID传输错误！');
			$info=model('extend')->find("id={$id}",'id,tableinfo');
			$this->info= $info;
			$this->display();
		}else{
			if(empty($_POST['tname'])||empty($_POST['tableinfo'])||empty($_POST['type'])||empty($_POST['pid'])) $this->error('信息没有填写完整~');
			$data = array();
			$data['name'] = in($_POST['tname']); //字段描述
			$data['tableinfo'] = in($_POST['tableinfo']); //字段名
			$data['type'] = in($_POST['type']); //字段类型
			$data['defvalue'] = in($_POST['defvalue']); //默认值
			$data['pid'] = intval($_POST['pid']); //所属表
			$data['ifsearch'] = intval($_POST['ifsearch']); 
			$data['norder'] = intval($_POST['norder']); //排序

			$condition['id'] = $data['pid'];
			$condition['pid']=0;
			$info = model('extend')->find($condition,'id,type,tableinfo'); //获取当前表信息
			if(!$info['type']){//附属表
                 $nofields=array('sort','account','title','places','color','picture','keywords','description','content','method','tpcontent','norder','recmd','hits','ispass','origin','addtime','extfield','photolist','conlist');
			     if (in_array($data['tableinfo'],$nofields)) $this->error('添加的附属表字段与主字段重名~');
			}
			//如果为大型文本
			if($data['type']==3) $type='text';
			else $type='varchar(250)';
			// $prefix=config('DB_PREFIX');
			// $sql="alter table {$prefix}{$info['tableinfo']} ADD `{$data['tableinfo']}` {$type} NOT NULL ";
			if(model('extend')->addfield($info['tableinfo'],$data['tableinfo'],$type)){
				if(model('extend')->insert($data)) //插入表数据
				$this->success('字段添加成功',url('extendfield/fieldlist',array('id'=>$info['id'])));
				else $this->error('写入字段信息失败~');
			}else $this->error('创建字段失败~');
		}
	}

	// 编辑字段
	public function fieldedit()
	{
		if (!$this->isPost()) {
			$id = intval($_GET['id']);
			if (empty($id)) $this->error('ID传输错误！');
			$info = model('extend')->find("id='{$id}'"); //获取当前字段信息
			$this->info=$info;
			$this->display();
		}else{
			$data = array();
			$data['name'] = in($_POST['tname']); //字段描述
			$data['defvalue'] = in($_POST['defvalue']); //默认值
			$data['ifsearch'] = intval($_POST['ifsearch']); 
			$data['norder'] = intval($_POST['norder']); //排序
			$condition=array();
			$condition['id'] = $_POST['id'];
			$info = model('extend')->find($condition,'pid'); //获取当前表信息
			model('extend')->update($condition,$data);
			$this->success('字段信息修改成功',url('extendfield/fieldlist',array('id'=>$info['pid'])));
		}
	}

	// 删除字段
	public function fielddel()
	{
		$id = intval($_GET['id']);
		if (empty($id)) $this->error('ID传输错误！');
		$fieldinfo = model('extend')->find("id='{$id}'",'pid,tableinfo'); //获取当前表字段信息
		$condition['id'] = $fieldinfo['pid'];
		$tableinfo = model('extend')->find($condition,'tableinfo'); //获取当前表字段信息
		// $prefix=config('DB_PREFIX');
		//$sql="alter table {$prefix}{$tableinfo['tableinfo']} DROP COLUMN {$fieldinfo['tableinfo']}";
		if(model('extend')->delfield($tableinfo['tableinfo'],$fieldinfo['tableinfo'])){ //删除字段
			if(model('extend')->delete("id='{$id}'"))
			    $this->success('字段删除成功~',url('extendfield/fieldlist',array('id'=>$fieldinfo['pid'])));
			else $this->error('字段信息删除失败~');
		} else $this->error('字段删除失败~');

	}
	
    //文件上传
	public function file()
	{
		header("content-type:text/html; charset=utf-8");
		if (!$this->isPost()) {
			$this->inputName = in($_GET['inputName']);
			$this->display();
		}else{
			if (empty($_FILES['fileField']['name'])){
				$this->error('未选择文件');
			}
			$upload= $this->upload(ROOT_PATH.'/upload/extend/'.date('Y-m-d').'/',config('fileupSize'), config('allowType'));
			$upload->saveRule = date('ymdhis') . mt_rand(); //命名规范
			$upload->upload(); //上传
			$info = $upload->getUploadFileInfo(); //返回信息 Array ( [0] => Array ( [name] => 未命名.jpg [type] => image/pjpeg [size] => 53241 [key] => Filedata [extension] => jpg [savepath] => ../../../upload/2011-12-17/ [savename] => 1112170727041127335395.jpg ) )
			$errorinfo=$upload->getErrorMsg();
			if(!empty($errorinfo)) echo '<a style="font-size:12px; color:#333" href="'.url('extendfield/file').'/&inputName='.$_POST['inputName'].'">'.$errorinfo.'</a>';
			else {
				echo '上传成功~<a style="font-size:12px; color:#333" href="'.url('extendfield/file',array('inputName'=>$_POST['inputName'])).'">点击重新上传</a>';
				echo '<script>parent.$("#'.$_POST['inputName'].'").val("'.__ROOT__.'/upload/extend/'.date('Y-m-d').'/'.$info[0]['savename'].'")</script>';
			}
		}

	}
	//自定义表中信息列表
	public function meslist()
	{
		$pid=intval($_GET['id']);
		if(!$this->checkConPower('extend',$pid)) $this->error('您没有权限管理此独立表内容~');//用户管理权限
        $tableinfo = model('extend')->select("id='{$pid}' OR pid='{$pid}'",'id,tableinfo,name','pid,norder DESC');
        if(empty($tableinfo)) $this->error('找不到自定义表信息~');
        $tablename=$tableinfo[0]['tableinfo'];
        $this->tableinfo=$tableinfo;

        $listRows=10;//每页显示的信息条数
		$url=url('extendfield/meslist',array('id'=>$pid,'page'=>'{page}'));
		$limit=$this->pageLimit($url,$listRows);
        $count=model('extend')->Extcount($tablename);//获取行数

        $list=model('extend')->Extselect($tablename,'','id desc',$limit);
        $this->list=$list;
        $this->tableid=$pid;
        $this->page=$this->pageShow($count);
        $this->display();
	}
	//自定义表中信息添加
	public function mesadd()
	{
		$tableid=intval($_GET['tabid']);
        $tableinfo = model('extend')->select("id='{$tableid}' OR pid='{$tableid}'",'id,tableinfo,name,type,defvalue','pid,norder DESC');
        if(empty($tableinfo)) $this->error('找不到自定义表信息~');
        $this->tableinfo=$tableinfo;
		$this->tableid=$tableid;

		if(!$this->isPost()){
           $this->display();
		}else{
           session_starts();
           for($i=1;$i<count($tableinfo);$i++){
            if(is_array($_POST[$tableinfo[$i]['tableinfo']]))
              $data[$tableinfo[$i]['tableinfo']]=implode(',',$_POST[$tableinfo[$i]['tableinfo']]);
            else
              $data[$tableinfo[$i]['tableinfo']]=html_in($_POST[$tableinfo[$i]['tableinfo']]);
           }
           $data['ip']=get_client_ip();
           $data['ispass']=0;
           $data['addtime']=time();
           if(model('extend')->Extin($tableinfo[0]['tableinfo'],$data)) $this->success('提交成功请等待审核~',url('extendfield/meslist',array('id'=>$tableid)));
           else $this->error('提交失败~');
         }
      }
	//自定义表中信息编辑
	public function mesedit()
	{
        $tableid=intval($_GET['tabid']);
        if(!$this->checkConPower('extend',$tableid)) $this->error('您没有权限管理此独立表内容~');
        $id=intval($_GET['id']);//信息id
        if(empty($tableid) || empty($id) ) $this->error('参数错误~');
        $tableinfo = model('extend')->select("id='{$tableid}' OR pid='{$tableid}'",'id,tableinfo,name,type,defvalue','pid,norder DESC');
        if(empty($tableinfo)) $this->error('自定义表不存在~');
        if (!$this->isPost()) {
           $info=model('extend')->Extfind($tableinfo[0]['tableinfo'],"id='{$id}'");
           $this->info=$info;
           $this->tableid=$tableid;
           $this->id=$id;
           $this->tableinfo=$tableinfo;
           $this->display();
        }else{
           for($i=1;$i<count($tableinfo);$i++){
           	if(is_array($_POST[$tableinfo[$i]['tableinfo']]))
           	  $data[$tableinfo[$i]['tableinfo']]=implode(',',$_POST[$tableinfo[$i]['tableinfo']]);
           	else
           	  $data[$tableinfo[$i]['tableinfo']]=html_in($_POST[$tableinfo[$i]['tableinfo']]);
           }
           if(model('extend')->Extup($tableinfo[0]['tableinfo'],"id='{$id}'",$data)) $this->success('修改成功~',url('extendfield/meslist',array('id'=>$tableid)));
           else $this->error('信息修改失败~');
         }
	}
	//自定义表中信息删除
	public function mesdel()
	{
		$tableid=intval($_GET['tabid']);
        if(!$this->checkConPower('extend',$tableid)) $this->error('您没有权限管理此独立表内容~');
		if(empty($_POST['delid'])) $this->error('您没有选择~');
		 $delid=implode(',',in($_POST['delid']));

        $tableinfo = model('extend')->find("id='{$tableid}'",'tableinfo');
        if(empty($tableinfo)) $this->error('未知表~');

        if(model('extend')->Extdel($tableinfo['tableinfo'],'id in ('.$delid.')'))
			$this->success('删除成功~',url('extendfield/meslist',array('id'=>$tableid)));
		else $this->error('删除失败~');
	}

	public function meslock()
   {
        $tableid=intval($_GET['tabid']);
        if(!$this->checkConPower('extend',$tableid)) $this->error('您没有权限管理此独立表内容~');
        $id=intval($_GET['id']);
        if(empty($tableid) || empty($id)) {echo '参数错误~';rerurn;}

        $tableinfo = model('extend')->find("id='{$tableid}'",'tableinfo');
        if(empty($tableinfo)) $this->error('未知表~');

		$lock['ispass']=intval($_GET['ispass']);
		if(model('extend')->Extup($tableinfo['tableinfo'],"id='{$id}'",$lock))
		echo 1;
		else echo '操作失败~';
   }
}