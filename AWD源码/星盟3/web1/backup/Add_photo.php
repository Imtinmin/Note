<?php
    session_start();
    require_once('check.php');
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title> - jqGird</title>
 

</head>

<body class="gray-bg">
    
                        <h5>上传图片</h5>

<form action="upload.php" method="post" enctype="multipart/form-data"> 
  <input type="file" name="file"/> 
  <input type="submit" value="提交"> 
</form> 
 
    <script>
        $(function(){
            var $upcode = $("#up-code");

            $upcode.on(
                "change",function(){
                    var obj = document.getElementById("up-code");
                    name = obj.files[0].name
                    if(obj.files[0]){
                        $("#up-code-show").val(name);
                    }
                }
            );
        });
    </script>
</body>

</html>