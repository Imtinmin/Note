<?php
class seoController extends commonController
{
	public function sitemap()
	{
		if(!$this->isPost()){
           $this->display();
		}else{
        
           $maptag = new Sitemap();
           $i=1;
           $rewrite=config('REWRITE');
           $domain=empty($rewrite)?"http://".$_SERVER['HTTP_HOST']:'';
           $num=intval($_POST['num']);
           $num=$num>0?$num:1;
           //首页
           $maptag->AddItem($domain.url('default/index/index'),intval($_POST['index']['priority']),$_POST['index']['changefreq']);
           //栏目
           $list=model('sort')->select("ifmenu='1'",'id,deep,name,ename,path,norder,method,url,type,extendid,ifmenu');
		   if(!empty($list)){
		   	 $list=re_sort($list);
		   	 $newList=array();
			 foreach ($list as $vo)
			 {
			 	$newList[$vo['id']]['ename']=$vo['ename'];
				$url=$domain.getURl($vo['type'],$vo['method'],$vo['url'],$vo['id'],$vo['extendid'],$vo['ename']);
				$maptag->AddItem($url,intval($_POST['list']['priority']),$_POST['list']['changefreq']);
				$i++;
			 }
			 //文章
			 if($i<$num){
			 	 $count=$num-$i;
                 $list=model('news')->select($where,'id,title,places,sort,addtime,method','recmd DESC,norder desc,id DESC',"0,$count");
                 if(!empty($list)){
			        foreach ($list as $vo)
			        {
			           $pid=substr($vo['sort'],-6);
			           $url=Check::url($vo['method'])?$vo['method']:url($vo['method'],array('col'=>$newList[$pid]['ename'],'id'=>$vo['id']));
			           $url=$domain.$url;
			       	   $maptag->AddItem($url,intval($_POST['list']['priority']),$_POST['list']['changefreq']);
			       	   // if($i>=$num) break;
			       	   $i++;
			        }	
		         }
		     }
		     //图集
			 if($i<$num){
			 	 $count=$num-$i;
                 $list=model('photo')->select($where,'id,title,places,sort,addtime,method','recmd DESC,norder desc,id DESC',"0,$count");
                 if(!empty($list)){
			        foreach ($list as $vo)
			        {
			           $pid=substr($vo['sort'],-6);
			           $url=Check::url($vo['method'])?$vo['method']:url($vo['method'],array('col'=>$newList[$pid]['ename'],'id'=>$vo['id']));
			           $url=$domain.$url;
			       	   $maptag->AddItem($url,intval($_POST['list']['priority']),$_POST['list']['changefreq']);
			       	   // if($i>=$num) break;
			       	   $i++;
			        }
		         }
		     }
		   }
		   //$maptag->Build();
		   // $maptag->Show();
		   $maptag->SaveToFile(BASE_PATH.'../sitemap.xml');
		   $this->success('根目录下"sitemap.xml"已经生成~',url("seo/sitemap"));
		}
	}
}