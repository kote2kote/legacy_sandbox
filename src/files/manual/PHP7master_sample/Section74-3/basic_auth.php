<?php
if( empty($_SERVER['PHP_AUTH_USER']) || empty($_SERVER['PHP_AUTH_PW']) ){
    header("WWW-Authenticate: Basic realm=\"Member Only\"");
    header("HTTP/1.0 401 Unauthorized");
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>Basic認証のテスト</title>
</head>
<body>
Basic認証のテスト<br>
<br>
キャンセルされました。

</body>
</html>

<?php
} else {
    if($_SERVER['PHP_AUTH_USER'] == "sample" && $_SERVER['PHP_AUTH_PW'] == "password") {
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>Basic認証のテスト</title>
</head>
<body>
Basic認証のテスト<br>
<br>
こんにちは、<?=$_SERVER['PHP_AUTH_USER']?>さん。

</body>
</html>
<?php
    } else {
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>Basic認証のテスト</title>
</head>
<body>
Basic認証のテスト<br>
<br>

ユーザID、またはパスワードが違います。

</body>
</html>
<?php    
    }
}