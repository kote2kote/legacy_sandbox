<!DOCTYPE html>
<html lang="ja">
<head>
<title>PHPのテスト</title>
</head>
<body>

<?php

if(isset($_POST["gender"]) && ($_POST["gender"] == "男" || $_POST["gender"] == "女") ){
    print "性別：<br>";
    print $_POST["gender"];
}else{
    print "性別を選んでください。<br>";
}
?>

</body>
</html>
