 <?php if(!defined('APP_NAME')) exit;?>   
       <script type="text/javascript">
        //重载验证码
         function fleshVerify()
        {
            var timenow = new Date().getTime();
            document.getElementById('verifyImg').src= "{url('index/verify')}/"+timenow;
        }
       </script>
        <!--评论表单-->
        <div class="padding line-small height-little border-top border-dotted">
            <form method="post" action="{$sorts['100027']['url']}"  id="info" >
             <input type="hidden" name="type" value="1"><!--评论的类型,用于区分于其他图集、单页等评论-->
             <input type="hidden" name="title" value="{$info['title']}"><!--标题-->
             <input type="hidden" name="sortname" value="{$sorts[$pid]['name']}"><!--分类-->
             <input type="hidden" name="aid" value="{$info['id']}"> <!--资讯ID-->
             <input type="hidden" name="comby" value="{$auth['nickname']}"><!--会员登陆后的昵称-->
                <textarea rows="4" class="input" placeholder="评论内容" name="comcontent"></textarea><br>
                <input type="text" size="6"  class="input input-auto" placeholder="验证码" name="checkcode" id="checkcode"/> <img src="{url('index/verify')}" width="60" height="30" style=" cursor:hand;" alt="如果您无法识别验证码，请点图片更换" onClick="fleshVerify()" id="verifyImg">
                <input type="submit" class="button bg-blue float-right" value="评论">
            </form>
            <ul class="list-group list-striped margin-top">
            {comment:{extable=(extend_conment) order=(id desc) where=(aid=#$info['id']# AND type='1' AND ispass='1')}}<!--如果不需要后台审核就显示则 去掉"AND ispass='1'"-->
                <li>{if empty($comment['comby'])} "游客" {else} "{$comment['comby']}" {/if}    IP:{$comment['ip']}     <span class="float-right text-gray">{date($comment['addtime'],Y-m-d H:m:i)}</span></li>
                <li class="text-indent"><p>{html_out($comment['comcontent'])}</p> <p class="text-dot">{$comment['backcontent']}</p></li>
            {/comment} 
            </ul>
         </div>    
<script language="javascript">
fleshVerify();
</script>