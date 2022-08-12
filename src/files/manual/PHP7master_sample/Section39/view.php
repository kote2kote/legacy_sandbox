<!DOCTYPE html>
<html lang="ja">
<head>
<title>PHPのテスト</title>
</head>
<body>
<?php
//if(isset($_POST["hobby"]) && is_array($_POST["hobby"]) && count($_POST["hobby"]) >= 1){
if(isset($_POST["hobby"])){
    $hobby  = implode('と', $_POST["hobby"]);
    print "私の趣味は";
    print $hobby;
    print "です。";
}else{
   print "私の趣味はありません。";
}
?>

</body>
</html>
