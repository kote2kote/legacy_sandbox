<?php
//--------------------------------------------------
//include
//--------------------------------------------------
require("../php/DB.php");
require("../php/CheckUtil.php");
require("../php/common.php");
include("db.php");

//--------------------------------------------------
//カテゴリ処理(DB)
//--------------------------------------------------
$sql = "
		SELECT
		 * 
		FROM
		 $sql_table_name
		 ORDER BY id ASC
		";
$res = mysql_query($sql, $conn);
$result_count = mysql_num_rows($res);
$order_num = $result_count +1;


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
	//値チェック
	$new_message = requiredCheck($new,"");
	
	//どれか一つでもエラーが出たらフラグを0に
	if ($new_message ) {
		$kakunin = 0;
	}


	
	if($kakunin == 1){
	//DBの文字コードに変換処理が必要なもの
	$date = strtotime("now");
	//----------SQL処理
	//$date = strtotime("now");
	$sql = "
	INSERT INTO
	  $sql_table_name
	  (
	  	shurui,
    order_num,
    notes,
    modified,
    created
	  )
	 VALUES
	 (
	    '$new',
		'$order_num',
		'',
		'$date',
		'$date'
	  )
	";
	mysql_query($sql, $conn) or die("登録できませんでした");
	header("Location: index.php");
	}
	
} else {
  // exit();
}

?>
