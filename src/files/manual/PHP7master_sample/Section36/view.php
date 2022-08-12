<!DOCTYPE html>
<html lang="ja">
<head>
<title>PHPのテスト</title>
</head>
<body>

<?php
print $_POST["onamae"] . "さんからのメッセージ";
print "<br><br>";
print "本文：<br>";
print nl2br($_POST["honbun"], false);
?>


</body>
</html>