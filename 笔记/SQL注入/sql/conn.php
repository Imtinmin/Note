<?php
	

$GLOBALS['conn'] = new mysqli('localhost','root','','blind');

function query($sql){
	$result = $GLOBALS['conn']->query($sql);
	return $result;
}

