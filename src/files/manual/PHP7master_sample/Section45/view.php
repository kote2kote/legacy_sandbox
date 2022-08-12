<!DOCTYPE html>
<html lang="ja">
<head>
<title>PHPのテスト</title>
</head>
<body>
<?php
$file_dir  = 'C:\xampp\htdocs\image\\';// Windows
//$file_dir  = '/Applications/XAMPP/xamppfiles/htdocs/image/'; // Mac
//$file_dir  = '/opt/lampp/htdocs/image/';// Linux

$file_path = $file_dir . $_FILES["uploadfile"]["name"];
if (move_uploaded_file($_FILES["uploadfile"]["tmp_name"], $file_path)) {
$img_dir   = "/image/";
$img_path  = $img_dir. $_FILES["uploadfile"]["name"];
$size      = getimagesize($file_path);
?>
ファイルアップロードを完了しました。<br>
<img src="<?=$img_path?>" <?=$size[3]?>><br>
<strong><?=$_POST["comment"]?></strong><br>
<?php
} else {
?>
正常にアップロード処理されませんでした。<br>
<?php
}
?>
</body>
</html>