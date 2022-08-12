<!DOCTYPE html>
<html lang="ja">
<head>
<title>PHPのテスト</title>
</head>
<body>

<?php
print $_POST["onamae"] . "さん、こんにちは！";
// セキュリティを強化した書き方です。
// print htmlspecialchars($_POST["onamae"], ENT_QUOTES) . "さん、こんにちは！";
?>

</body>
</html>
