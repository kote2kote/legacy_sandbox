<?php
require("../php/common.php");
require("../php/CheckUtil.php");
require("../php/DB.php");
include("db.php");

$id = $_GET['bid'];
$mode = $_GET['mode'];

//--------------------------------------------------
//delete処理
//--------------------------------------------------
if($mode=="delete"){
$sql = "DELETE FROM $sql_table_name WHERE id='$id'";
	mysql_query($sql, $conn) or die("削除できませんでした");
	header("Location: index.php");
} else {
	exit();
}
?>
