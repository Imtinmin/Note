<?php if(!defined('APP_NAME')) exit;?>
<script type="text/javascript" src="__PUBLIC__/js/jquery.skygqCheckAjaxform.js"></script>
<script type="text/javascript">
//菜单效果开始
$(function(){
 //表单验证
	var items_array = [
	    { name:"tname",simple:"姓名",focusMsg:'必填'},
		{ name:"tel",type:'telephone',require:false,simple:"手机号",focusMsg:'非必填'},
		{ name:"qq",type:'qq',require:false,simple:"QQ号",focusMsg:'非必填'},
		{ name:"content",simple:"留言内容",focusMsg:'必填'}
	];
	$("#info").skygqCheckAjaxForm({
		items			: items_array
	});
});
</script>
<div class="jumbotron">
  <div class="container subhead">
    <h1>YXcms VIP demo</h1>
    <p class="lead">该模板使用的是目前最流行的Bootstrap前端框架，其简单灵巧结合了JQuery，我很喜欢</p>
  </div>
</div>

<div class="container clearfix">
   <div class="row-fluid">
      <div class="{if !empty($list)}span6 {else}span12 {/if} mt50">
         <div class="well">
           <form class="form-horizontal" action=""  method="post" id="info">
              <div class="control-group">
                <label class="control-label" for="inputEmail">姓名:</label><div class="controls"><input type="text" name="tname" value=""  maxlength="20"></div>
              </div>
              <div class="control-group">
                <label class="control-label" for="inputEmail">联系电话:</label><div class="controls"><input type="text" name="tel" value=""  maxlength="20"></div>
              </div>
              <div class="control-group">
                <label class="control-label" for="inputEmail">QQ号码:</label><div class="controls"><input class="minput" type="text" name="qq" value=""  maxlength="20"></div>
              </div>
              <div class="control-group">
                <label class="control-label" for="inputEmail">留言内容:</label><div class="controls"><textarea name="content" cols="30" rows="4"></textarea></div>
              </div>
              <div class="control-group">
                <label class="control-label" for="inputEmail">验证码:</label><div class="controls"><input class="minput"  type="text" name="checkcode" id="checkcode" >&nbsp;<img src="{url('index/verify')}" height="20" width="50" style=" cursor:hand;" alt="如果您无法识别验证码，请点图片更换" onClick="fleshVerify()" id="verifyImg"/></div>
              </div>
              <div class="control-group">
                 <div class="controls"><button type="submit" class="btn btn-success">留言</button></div>
              </div>
           </form>
         </div>
      </div>
      {if !empty($list)}
       <div class="span6 mt50">
         <div class="well">
           <div class="accordion" id="accordion2">
           {loop $list $key $vo}
              <div class="accordion-group">
                 <div class="accordion-heading">
                     <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse{$key}">
                         <i class="icon-edit"></i>&nbsp;留言者：{$vo['tname']}&nbsp;&nbsp;&nbsp;  IP:{$vo['ip']} &nbsp;&nbsp;&nbsp; 留言时间:{date($vo['addtime'],Y-m-d H:m:i)}
                     </a>
                 </div>
                <div id="collapse{$key}" class="accordion-body collapse in">
                    <div class="accordion-inner">
                        <p>{html_out($vo['content'])}</p>
                        <p class="text-success">回复内容：{$vo['reply']}</p>
                    </div>
                </div>
             </div>
          {/loop}
           </div>
            <div class="pagelist yx-u">{$page}</div>
         </div>
       </div>
      {/if}
   </div>
</div>
