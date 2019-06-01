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

        <form action="" method="post" id="info" >
        <div class="margin-top">
          <table class="table table-bordered">
         {for $i=1;$i<count($tableinfo);$i++}
             <tr><td align="left">
             {if $tableinfo[$i]['type']==1} <!--单行文本-->
                <input type="text" name="{$tableinfo[$i]['tableinfo']}" value="" class="input" placeholder="{$tableinfo[$i]['name']}">
             {elseif $tableinfo[$i]['type']==2}<!--多行文本-->
                <textarea name="{$tableinfo[$i]['tableinfo']}" class="input" rows="5" cols="4" placeholder="{$tableinfo[$i]['name']}"></textarea>
             {elseif $tableinfo[$i]['type']==3}<!--大型文本-->
                <textarea class="editori input" name="{$tableinfo[$i]['tableinfo']}" style="width:100%;height:250px;visibility:hidden;" placeholder="{$tableinfo[$i]['name']}"></textarea>
             {elseif $tableinfo[$i]['type']==4}<!--下拉列表(可改造为单选按钮)-->
                <select name="{$tableinfo[$i]['tableinfo']}" class="input" >
                   <?php $chooses=explode("\r\n",$tableinfo[$i]['defvalue']); ?>
                   {loop $chooses $vo}
                       <?php $voar=explode(",",$vo);?>
                       <option value="{$voar[0]}">{$voar[1]}</option>
                   {/loop}
                </select>
             {elseif $tableinfo[$i]['type']==5}<!--上传框（用户可以上传文件，不建议使用）-->
                  <input name="{$tableinfo[$i]['tableinfo']}" id="{$tableinfo[$i]['tableinfo']}" type="text" class="input"  value="" />
                  <iframe scrolling="no"; frameborder="0" src="{url("extend/file",array('inputName'=>$tableinfo[$i]['tableinfo']))}" style="width:300px; height:30px;"></iframe>
             {elseif $tableinfo[$i]['type']==6}<!--多选按钮-->
                   <?php $chooses=explode("\r\n",$tableinfo[$i]['defvalue']); ?>
                   {loop $chooses $vo}
                       <?php $voar=explode(",",$vo);?>
                       {$voar[1]} <input type="checkbox" name="{$tableinfo[$i]['tableinfo']}[]" value="{$voar[0]}" class="input" />
                   {/loop}
             {/if}
             </td></tr>
          {/for}
		        <tr>
                <td>
                <input type="text" name="checkcode" id="checkcode" class="input input-auto" size="4" placeholder="验证码">&nbsp;<img src="{url('index/verify')}" border="0"  height="28" width="55" style=" cursor:hand;" alt="如果您无法识别验证码，请点图片更换" onClick="fleshVerify()" id="verifyImg"/>
                </td>
             </tr>
             <tr>
				  <td align="left"> <input type="submit" value="提交" class="button"></td>
			  </tr>
          </table>
	      </form>

      <div class="table-responsive margin-top">
        <table class="table table-bordered">
               <tr>
               {for $i=1;$i<count($tableinfo);$i++}
                  <th> {$tableinfo[$i]['name']} </th>
			    {/for} 
               </tr>
               
               {loop $list $vo}
                 <tr>
                  {for $i=1;$i<count($tableinfo);$i++}
                   <td> {html_out($vo[$tableinfo[$i]['tableinfo']])} </td>
			      {/for} 
                 </tr>
               {/loop}
               
             </table>
        </div>
        <div class="pagelist">{$page}</div>
  </div>
</div>
<script language="javascript">
fleshVerify();
</script>
    