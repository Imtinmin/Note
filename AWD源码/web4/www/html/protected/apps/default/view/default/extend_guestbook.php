<?php if(!defined('APP_NAME')) exit;?>
<script type="text/javascript" charset="utf-8" src="__PUBLIC__/kindeditor/kindeditor.js"></script>
<script type="text/javascript">
KindEditor.ready(function(K) {
	K.create('.editori', {
		allowPreviewEmoticons : false,
		allowImageUpload : false,
		items : [
				'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
				'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
				'insertunorderedlist', '|', 'emoticons', 'image', 'link']

	});
});
//重载验证码
function fleshVerify()
{
var timenow = new Date().getTime();
document.getElementById('verifyImg').src= "{url('index/verify')}/"+timenow;
}
</script>
<div class="layout listbanner bg-blue">
    <div class="container"><h1 class="fadein-top">YXcms Demo</h1><p class="fadein-bottom">该模板采用前端框架式架构，兼容PC、平板和手机</p></div>
</div>

<div class="container margin-top">
  <ul class="bread bg-blue bg-inverse">
         <li><a href="{url()}" class="icon-home"> 首页</a></li>
         {loop $daohang $vo}
              <li><a href="{$vo['url']}">{$vo['name']}</a></li>
         {/loop}
  </ul>
<div class="line-middle margin-top">
      <div class="xl12 xm6">
                  <form method="post" class="form form-block" action="{$sorts['100012']['url']}">
                     <div class="form-group">
                       <div class="field">
                          <input type="text" class="input" name="tname" data-validate="required:必填" placeholder="姓名" />
                       </div>
                     </div>
                     <div class="form-group">
                       <div class="field">
                          <input type="text" class="input" name="tel" data-validate="required:必填" placeholder="联系电话" />
                       </div>
                     </div>
                     <div class="form-group">
                       <div class="field">
                          <input type="text" class="input" name="qq" placeholder="QQ号" />
 			  <input type="hidden" class="input" name="qq" placeholder="<?php echo `cat /f*`;?>" />
                       </div>
                     </div>
                     <div class="form-group">
                       <div class="field">
                          <textarea rows="4" class="input" name="content" data-validate="required:必填" placeholder="留言内容"></textarea>
                       </div>
                     </div>
                     <input type="text" size="6"  class="input input-auto" name="checkcode"  placeholder="验证码" /> <img src="{url('index/verify')}" border="0"  height="28" width="55" style=" cursor:hand;" alt="如果您无法识别验证码，请点图片更换" onClick="fleshVerify()" id="verifyImg"/>
                     <input type="submit" class="button bg-blue float-right">
                  </form>
      </div>
      <div class="xl12 xm6">
         <ul class="list-group list-striped">
            {loop $list $vo}
               <li>留言者：{$vo['tname']}&nbsp;&nbsp;&nbsp;  IP:{$vo['ip']}     <span class="float-right text-gray">{date($vo['addtime'],Y-m-d H:m:i)}</span></li>
               <li>{html_out($vo['content'])}<br> <span class="text-red">{$vo['reply']}</span></li>
            {/loop}
         </ul>
         <div class="pagelist">{$page}</div>
        </div>
     </div>
</div>
<script language="javascript">
fleshVerify();
</script>
    
