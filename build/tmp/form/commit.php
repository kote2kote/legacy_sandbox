<?php
require_once("DB.php");

echo '<pre>';
var_dump($_REQUEST);
echo '</pre>';



// if ($_SERVER["REQUEST_METHOD"] == "POST") {
// $kakunin = 1;
// foreach($_POST as $k => $v){
// // 「magic_quotes_gpc = On」のときはエスケープ解除
// if (get_magic_quotes_gpc()) {
// $v = stripslashes($v);
// }
// $v = htmlspecialchars($v);
// $$k = $v;
// }
// }
// else {
// // exit();
// }
// $date = strtotime("now");
// $date2 = date("Y/m/d H:i:s",strtotime("now"));
// /*********DB接続**********/
// //フィールド
// $host = "localhost";
// $usr = "test";
// $password = "test";
// $select_db = "form_test2";

// //mysqliオブジェクト
// $db=new mysqli($host,$usr,$password,$select_db);
// $stt=$db->prepare("set names utf8");
// $stt->execute();

//sql文
$sql="
INSERT INTO
formdata1
(
name,
zipcode1,
zipcode2,
adress1,
adress2,
adress3,
email,
faq_categoly,
faq_naiyou
)
VALUES
(?,?,?,?,?,?,?,?,?)
";

try{
  $pdo->beginTransaction();
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(1, $_REQUEST['name']);
  $stmt->bindValue(2, $_REQUEST['zipcode1']);
  $stmt->bindValue(3, $_REQUEST['zipcode2']);
  $stmt->bindValue(4, $_REQUEST['adress1']);
  $stmt->bindValue(5, $_REQUEST['adress2']);
  $stmt->bindValue(6, $_REQUEST['adress3']);
  $stmt->bindValue(7, $_REQUEST['email']);
  $stmt->bindValue(8, (int)$_REQUEST['faq_categoly']);
  $stmt->bindValue(9, $_REQUEST['faq_naiyou']);

  $stmt->execute(); //実行
  $count = $stmt->rowCount();
  echo "検索結果は" . $count . "件です。<br>";
  
}catch(PDOException $Exception){
  echo "エラー：" . $Exception->getMessage();
}




// //statementオブジェクト準備とbind_paramと実行
// $stt=$db->prepare($sql);
// //$stt->bind_param("sssssssssi",$name,$zipcode1,$zipcode2,$adress1,$adress2,$adress3,$email,$faq_categoly,$faq_naiyou,strtotime("now"));
// $stt->execute();//実行
// $db->close();//切断


//------------------------------------------------------------
//メール送信
//------------------------------------------------------------
// $mail_title = "質問が投稿されました (".$date2.")";
// $mail_rcvadress = "tetsuo@ame-nochi-hare.com";
// $mail_sendadress = "puludog@nifty.com";
// $header="Reply-To: ".$mail_rcvadress."\nContent-Type: text/plain;charset=ISO-2022-JP\nX-Mailer: PHP/".phpversion();
// $body="質問詳細は以下\n\n";
// $body.="■名前■\n".$name."\n\n";
// $body.="■住所■\n".$zipcode1."-".$zipcode2."\n".$adress1.$adress2.$adress3."\n\n";
// $body.="■メールアドレス■\n".$email."\n\n";
// $body.="■お問い合わせの種類■\n".$faq_categoly_value."\n\n";
// $body.="■お問い合わせの内容■\n".$faq_naiyou."\n\n";
// $body.="■投稿時間■\n".$date2."\n\n";
// mb_send_mail($mail_sendadress,$mail_title,$body,$header);


// header("Location: "."thanks.html");




//print $sql;//デバッグ用
?>