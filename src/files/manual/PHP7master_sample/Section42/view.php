<!DOCTYPE html>
<html lang="ja">
<head>
<title>PHPのテスト</title>
</head>
<body>

<?php
if(isset($_POST["hobby"])){
    print "私の趣味は以下のとおりです。<br><br>";
    foreach($_POST["hobby"] as $hobby)
    {
        print $hobby;
        print "<br>";
    }
}else{
   print "私の趣味はありません。";
}
?>

</body>
</html>
