<?php
include("db.php");

//--------------------------------------------------
//カテゴリ処理(DB)
//--------------------------------------------------
$sql = "
		SELECT
		 * 
		FROM
		 $category_table
		 ORDER BY id ASC
		";
$res = mysql_query($sql, $conn);

$num=1;
while($row = mysql_fetch_array($res)) {
	$categoly_id[$num] = $row["id"];
	$categoly_name[$num] = $row[$category_field];
	$num++;
}

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
	$name_message = requiredCheck($name,"");
	$zipcode1_message = requiredCheck($zipcode1,"");
	$zipcode2_message = requiredCheck($zipcode2,"");
	$adress1_message = requiredCheck($adress1,"");
	$adress2_message = requiredCheck($adress2,"");
	$adress3_message = requiredCheck($adress3,"");
	$email_message = requiredCheck($email,"");
	$category_message = requiredCheck($category,"");
	$faq_naiyou_message = requiredCheck($faq_naiyou,"");
	$notes_message = requiredCheck($notes,"");
	
	//どれか一つでもエラーが出たらフラグを0に
	if ($name_message || $zipcode1_message || $zipcode2_message || $adress1_message || $adress2_message || $adress3_message || $email_message || $category_message || $notes_message || $faq_naiyou_message) {
		$kakunin = 0;
	}


	
	if($kakunin == 1){
	//DBの文字コードに変換処理が必要なもの
	//$name = euc_out($name);
	//$bikou = euc_out($bikou);
	//----------SQL処理
	$date = strtotime("now");
	$sql = "
	INSERT INTO
	  ".$main_table."
	  (
	  	name,
		zipcode1,
		zipcode2,
		adress1,
		adress2,
		adress3,
		email,
		faq_categoly,
		faq_naiyou,
    	notes,
   		modified,
  		created
	  )
	 VALUES
	 (
	    '$name',
		'$zipcode1',
		'$zipcode2',
		'$adress1',
		'$adress2',
		'$adress3',
		'$email',
		'$category',
		'$notes',
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
