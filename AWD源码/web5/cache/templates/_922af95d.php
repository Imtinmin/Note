<?php defined('IN_MET') or exit('No permission'); ?>
<?php
    $cid = 0;
    if($cid == 0){
        $cid = $data['classnow'];
    }

    $num = $c['met_job_list'];
    $order = "no_order";
    $result = load::sys_class('label', 'new')->get('job')->get_list_page($cid, $data['page']);
    $sub = count($result);

     foreach($result as $index=>$v):
        $v['sub']      = $sub;
        $v['_index']   = $index;
        $v['_first']   = $index == 0 ? true:false;
        $v['_last']    = $index == ($sub-1) ? true : false;
?>
<div class="card card-shadow">
	<h4 class='card-title p-0 font-size-24'><?php echo $v['position'];?></h4>
	<p class="card-metas font-size-12 blue-grey-400">
		<span class='m-r-10'><?php echo $v['addtime'];?></span>
		<span class='m-r-10'>
			<i class="icon wb-map m-r-5" aria-hidden="true"></i>
			<?php echo $v['place'];?>
		</span>
		<span class='m-r-10'>
			<i class="icon wb-user m-r-5" aria-hidden="true"></i>
			<?php echo $v['count'];?>
		</span>
		<span>
			<i class="icon wb-payment m-r-5" aria-hidden="true"></i>
			<?php echo $v['deal'];?>
		</span>
	</p>
	<hr>
	<div class="met-editor clearfix">
		<?php echo $v['content'];?>
	</div>
	<hr>
	<div class="card-body-footer m-t-0">
		<a class="btn btn-outline btn-squared btn-primary met-job-cvbtn" href="javascript:;" data-toggle="modal" data-target="#met-job-cv" data-jobid="<?php echo $v['id'];?>" data-cvurl="cv.php?lang=cn&selected"><?php echo $lang['cvtitle'];?></a>
	</div>
</div>
<?php endforeach;?>