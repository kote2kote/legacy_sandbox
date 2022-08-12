<?php
//--------------------------------------------------
//include
//--------------------------------------------------
require("../php/DB.php");
require("../php/CheckUtil.php");
require("../php/common.php");
include("db.php");

$bid = $_GET['bid'];
$mode = $_GET['mode'];

//--------------------------------------------------
//delete処理
//--------------------------------------------------
if($mode=="delete"){
$sql = "DELETE FROM $sql_table_name WHERE id='$bid'";
	mysql_query($sql, $conn) or die("削除できませんでした");
	mysql_free_result($res);
	header("Location: index.php");
} else if($mode=="up"){

} else if($mode=="down"){

} else {
//exit();
}
?>
