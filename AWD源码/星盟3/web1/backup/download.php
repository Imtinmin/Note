
<?php
#var_dump($_REQUEST['filename']);

$filename = $_REQUEST['filename'];

#echo "<hr>" + $filename + "<hr>";
$myfile = fopen($filename, "r");

$context = fread($myfile,filesize($filename));
if(!$context){

	echo "<h3>No Such Filename :</h3>";
	echo "</h3><h4>";
	echo dirname(__FILE__);
	echo '\\';
	echo $filename;
	echo "</h4>";
	#+"<br>" + "<h3>"+dirname(__FILE__) + "/" + + "<h3>";
}
echo $context;

fclose($myfile);
?>
