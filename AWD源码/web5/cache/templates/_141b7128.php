<?php defined('IN_MET') or exit('No permission'); ?>
<?php
    $cid = 0;
    if($cid == 0){
        $cid = $data['classnow'];
    }
    $num = $c['met_message_list'];
    $order = "no_order";
    $result = load::sys_class('label', 'new')->get('message')->get_list_page($cid, $data['page']);

    $sub = count($result);
     foreach($result as $index=>$v):
        $v['sub']      = $sub;
        $v['_index']   = $index;
        $v['_first']   = $index == 0 ? true:false;
        $v['_last']    = $index == (count($result)-1) ? true : false;
        $v['met_fd_content'] = load::sys_class('label', 'new')->get('message')->get_module_value('met_fd_content',$cid);
        
?>
<li class="list-group-item">
	<div class="media">
		<div class="media-left block pull-xs-left p-r-0">
			<i class="icon wb-user-circle blue-grey-400"></i>
		</div>
		<div class="media-body block pull-xs-left">
			<h4 class="media-heading font-weight-300 blue-grey-500">
				<small class="pull-xs-right"><?php echo $v['addtime'];?></small>
				<?php echo $v['name'];?>
			</h4>
			<p class='m-b-0'><?php echo $v['content'];?></p>
			    <?php if($v[useinfo]){ ?>
			<div class="content well m-t-10 m-b-0"><?php echo $v['useinfo'];?></div>
			<?php }else{ ?>
			<div class="content well m-t-10 m-b-0"><?php echo $v['met_fd_content'];?></div>
			<?php } ?>
		</div>
	</div>
</li>
<?php endforeach;?>