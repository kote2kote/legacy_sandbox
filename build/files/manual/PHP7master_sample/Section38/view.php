<!DOCTYPE html>
<html lang="ja">
<head>
<title>PHPのテスト</title>
</head>
<body>

<?php
if ( isset($_POST["confirm"]) ) {
?>

<?php
// 確認ボタンが押されたとき
print $_POST["onamae"] . "さんからのメッセージ";
print "<br><br>";
print "本文：<br>";
print nl2br($_POST["honbun"], false);
?>


<?php
} elseif ( isset($_POST["back"]) ) {
// 戻るボタンが押されたとき
?>

<div style="font-size:14px">テキスト送信のテスト</div>
<form name="form1" method="post" action="confirm.php">
名前：<br>
<input type="text" name="onamae" value="<?=$_POST["onamae"]?>">
<br>
本文：<br>
<textarea name="honbun" cols="30" rows="5"><?=$_POST["honbun"]?></textarea>
<br>
<input type="submit" value="送　信">
<input type="hidden" name="user_id" value="<?=$_POST["user_id"]?>">
</form>

<?php
} else {
// 上記条件以外のとき
?>

エラーです。<br>
<a href="form.html">form.html</a>からアクセスしてください。

<?php
}
?>

</body>
</html>