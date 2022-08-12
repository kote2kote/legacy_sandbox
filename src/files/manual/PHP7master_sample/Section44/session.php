<?php
session_start();

$count = 1;
if (isset($_SESSION["count"])) {
	$count = $_SESSION["count"];
	$count++;
}
$_SESSION["count"] = $count;

?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>セッション変数のテスト</title>
</head>
<body>
セッション変数のテスト<br>
<br>
<?php
if ($count == 1) {
?>
はじめての訪問です。<br>
<br>
セッション変数にデータがありません。<br>
このページをリロードしてください。<br>


<?php
} else {
?>

あなたの訪問は<?=$count?>回目です。<br>

<?php
}
?>

</body>
</html>
