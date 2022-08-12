<?php
mb_language("uni");
mb_internal_encoding("utf-8");
mb_http_input("auto");
mb_http_output("utf-8");

//--------------------------------------------------
//DB接続
//--------------------------------------------------
$host = "localhost";
$usr = "test";
$password = "test";
$select_db = "form_test2";


if (!$conn = mysql_connect($host, $usr, $password)){
    die("データベース接続エラー.<br />");
}

mysql_select_db($select_db, $conn);
mysql_query("set names utf8", $conn);
?>