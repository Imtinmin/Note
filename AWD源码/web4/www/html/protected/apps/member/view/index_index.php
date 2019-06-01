<?php if(!defined('APP_NAME')) exit;?>
<SCRIPT type=text/javascript src="__PUBLICAPP__/js/jquery.layout.js"></SCRIPT>
<SCRIPT type=text/javascript src="__PUBLIC__/artDialog/jquery.artDialog.js"></SCRIPT>
<SCRIPT type=text/javascript src="__PUBLIC__/artDialog/plugins/iframeTools.js"></SCRIPT>
<SCRIPT type="text/javascript"> 
var menulist={$menulist};
function showleftmenu(target){//左侧菜单
	 var leftmenu='';
	 var channels=menulist[target].channels;
	 for(var i in channels){
		 if(channels[i].pages.length>0){
		   leftmenu+='<div class="menubg_1 cursor">'+channels[i].channel+'</div><ul class="none">';
		   for(var j in channels[i].pages){
			 leftmenu+='<li><a href="'+channels[i].pages[j].url+'" target="main">'+channels[i].pages[j].name+'</a></li>';
		   }
		    leftmenu+='</ul>';
		 }
	 }
	 var lmenu=$('#menu');
	 lmenu.html(leftmenu);
	 if(target!=0) {$("#main").attr("src",channels[0].pages[0].url); }
	 else {$("#main").attr("src",'{$act}'); }
	 
	 lmenu.find('DIV').first().attr('class','menubg_2');
	 lmenu.find('UL').first().show();
	 lmenu.find('DIV').click(function(){
		lmenu.find('DIV').attr('class','menubg_1');
		lmenu.find('UL').hide();
		$(this).attr('class','menubg_2');
		$(this).next().show();
	});
}  

function showtopmenu(){//顶部菜单
     var topmenu='';
	 for(var i in menulist){
		 var flag=0;
		 for(var j in menulist[i].channels){ if(menulist[i].channels[j].pages.length) flag=1;}
		 if(flag) topmenu+='<li id="'+i+'"><a  href="#">'+menulist[i].title+'</a></li>';
	}
	$('#topmenu').html(topmenu);
	//顶部菜单处理
	var topmenu=$('.topmenu li');
	topmenu.first().addClass("now");//初始第一个为选中样式
	topmenu.click(function(){
		showleftmenu($(this).attr('id'));//显示左菜单
		topmenu.removeClass("now");
		$(this).addClass("now");
	});
}

var myLayout;
$(document).ready(function(){
myLayout=$("body").layout({west__minSize:40,spacing_open:4,spacing_closed:4,east__initClosed:true,north__spacing_open:0,south__spacing_open:0,togglerLength_open:30,togglerLength_closed:60});
$("#refreash").click(function(){ 
		  window.main.location.reload();
});
     showtopmenu();//显示顶部菜单
     showleftmenu($('.topmenu li').first().attr('id'));//显示默认左侧菜单
  
});
</SCRIPT>
<BODY style="MARGIN: 0px" scroll=no>
<DIV class=ui-layout-north>
<table class="header" width="100%">
  <tr>
    <td class="logo"></td>
    <td class="hright">
      <div class="hrighttop">
        <DIV class=right_func>
           <A class=bb href="{url('default/index/index')}" target="_blank">
              <i class="icon-home icon-white"></i> 网站主页
           </A>
           <A class=cc id="refreash" href="javascript:void();">
               <i class="icon-refresh icon-white"></i> 刷新内页
           </A>
           {if $auth}
           <A class=aa href="{url('infor/password')}" target="main">
              <i class="icon-wrench icon-white"></i> 修改密码
           </A>
           <A class=dd href="{url('index/logout',array('url'=>url('default/index/index')))}" >
              <i class="icon-remove icon-white"></i> 注销登录
           </A>
           {else}
           <A class=dd href="{url('index/login')}" >
              <i class="icon-user icon-white"></i> 会员登录
           </A>
           <A class=dd href="{url('index/regist')}" >
              <i class="icon-edit icon-white"></i> 会员注册
           </A>
           {/if}
        </DIV>
     </div>
     <ul class="topmenu" id="topmenu">

     </ul>
   </td>
  </tr>
   
</table>
</DIV>
 
<DIV class=ui-layout-west>
   <DIV id=menu>
        
   </DIV>
</DIV>
<DIV class=ui-layout-center>
  <IFRAME style="OVERFLOW: visible" id="main" height="100%" src="{$act}" frameBorder=0 width="100%" name="main" scrolling=yes></IFRAME>
</DIV>