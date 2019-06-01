<?php if(!defined('APP_NAME')) exit;?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="__PUBLIC__/admin/css/back.css" type=text/css rel=stylesheet>
<script type="text/javascript" src="__PUBLIC__/js/jquery.js"></script>
<script language="javascript">
function CheckAll(form) { //复选框全选/取消
	for (var i=0;i<form.elements.length;i++) { 
		var e = form.elements[i]; 
		if (e.Name != "chkAll"&&e.disabled!=true) 
		e.checked = form.chkAll.checked; 
	} 
  } 
$(function ($) { 
	//行颜色效果
	$('.all_cont tr').hover(
	function () {
        $(this).children().css('background-color', '#f2f2f2');
	},
	function () {
        $(this).children().css('background-color', '#fff');
	}
	);
	//ajax操作
	 $('.del').click(function(){
			if(confirm('删除将不可恢复~')){
			var delobj=$(this).parent().parent();
			var id=delobj.attr('id');
			$.get("{url('adminorder/del')}", {id:id},
   				function(data){
					if(data==1){
                      delobj.remove();
					}else alert(data);
   			});
			}
	  });
  });
</script>
<title>订单列表</title>
</head>
<body>
<div class="contener">
<div class="list_head_m">
           <div class="list_head_ml">你当前的位置：【订单列表】</div>
           <div class="list_head_mr">
           </div>
        </div>

         <table width="100%" border="0" cellpadding="0" cellspacing="1"  class="all_cont" >
           <tr>
            <td colspan="5" align="left">
               <form action="{url('adminorder/index')}" method="GET" >
                 <div style="float:left"> 搜索：
                  <select name="stype">
                     <option value="1">订单号</option>
                     <option value="2">账户</option>
                  </select>
                  </div>
                 <div style="float:left"> <input type="text" name="keyword" size="20"> </div>
                  <input name="r" type="hidden" value="{$_GET['r']}" />
                  <div style="float:left"><input class="btn btn-success  btn-small" type="submit" value="搜索"></div>
               </form> 
            </td>
            <td colspan="2" align="right">
               <a class="lock" href="{url('adminorder/index',array('state'=>0))}">未付款</a>
               <a class="lock" href="{url('adminorder/index',array('state'=>1))}">等发货</a>
               <a class="lock" href="{url('adminorder/index',array('state'=>2))}">等收货</a>
               <a class="lock" href="{url('adminorder/index',array('state'=>3))}">交易完成</a>
            </td>
          </tr>
         <form action="{url('adminorder/del')}" method="post" onSubmit="return confirm('删除不可以恢复~确定要删除吗？');"> 
          <tr>
              <th align="center" width="10%"><input type="checkbox" name="chkAll" value="checkbox" onClick="CheckAll(this.form)"/></th>
              <th width="20%">订单号</th>
              <th width="15%">账户</th>
              <th width="15%">总价</th>
              <th width="20%">下单时间</th>
              <th width="10%">状态</th>
              <th width="10%">管理选项</th>
          </tr>
            {loop $list $val}
              <tr id="{$val['id']}">
                  <td align="center" width="10%"><input type="checkbox" name="delid[]" value="{$val['id']}" {if $val['state']==1 || $val['state']==2} disabled="disabled" {/if} /></td>
                  <td align="center">{$val['ordernum']}</td>
                  <td align="center">{$val['account']}</td>
                  <td align="center"><font color="#CC0000">￥{number_format($val['total'],2)}</font></td>
                  <td align="center">{date($val['ordertime'],Y-m-d H:i:s)}</td>
                  <td align="center"><font color="green">{if $val['state']==0}未支付{elseif $val['state']==1}等待发货{elseif $val['state']==2}等待确认收货{elseif $val['state']==3}交易完成{/if}</font></td>
                  <td align="center"><a class="edt" href="{url('adminorder/detail',array('id'=>$val['id']))}">管理</a>{if $val['state']!=1 && $val['state']!=2}<div class="del">删除</div>{/if}</td>
              </tr>
            {/loop}
            <tr>
             <td align="center" width="10%"><input type="submit" class="btn btn-small"  value="删除"></td>
             <td colspan="6"><div class="pagelist">{$page}</div></td>
            </tr>
          </form>  
        </table>
   </div>
</body>
</html>