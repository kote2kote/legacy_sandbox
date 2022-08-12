<?php
//--------------------------------------------------
//include
//--------------------------------------------------
require("../php/DB.php");
require("../php/CheckUtil.php");
require("../php/common.php");
include("db.php");

//--------------------------------------------------
//POST処理
//--------------------------------------------------
$kakunin = 0;//確認フラグ。初回アクセス時・エラー確認時は0。
if ($_SERVER["REQUEST_METHOD"]  == "POST") {
	$kakunin = 1;//確認フラグ
	
	//----------データ処理
    foreach($_POST as $k => $v){
        // 「magic_quotes_gpc = On」のときはエスケープ解除
        if (get_magic_quotes_gpc()) {
            $v = stripslashes($v);
        }
        $v = htmlspecialchars($v);
        $$k = $v;
    }
	//必須項目チェック
	$shurui_message = requiredCheck($shurui,"");
	
	//どれか一つでもエラーが出たらフラグを0に
	if ($shurui_message) {
		$kakunin = 0;
	}


	
	if($kakunin == 1){
	//DBの文字コードに変換処理が必要なもの
	/*
	$name = euc_out($name);
	$bikou = euc_out($bikou);
	*/
	
	//----------SQL処理
	$date = strtotime("now");
	$sql = "
	UPDATE
	  $sql_table_name
	 SET
	    shurui='$shurui',
		modified='$date'
	WHERE 
		id='$id'
	";
	mysql_query($sql, $conn) or die("登録できませんでした");
	header("Location: index.php");
	}
	
} else {
   //exit();
}

?>
