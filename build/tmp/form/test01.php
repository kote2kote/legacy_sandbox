<?php
require_once("CheckUtil.php");
require_once("DB.php");

$kakunin = 0;//確認フラグ。初回アクセス時・エラー確認時は0。エラーがなかった場合は1になり、commit.phpへ送信。

if(isset($_REQUEST['btn_confirm'])){
  $kakunin  = 1;
}

/***フォームの値を取得***/
// if ($_SERVER["REQUEST_METHOD"]  == "POST") {
// 	$kakunin = 1;
//     foreach($_POST as $k => $v){
//         // 「magic_quotes_gpc = On」のときはエスケープ解除
//         if (get_magic_quotes_gpc()) {
//             $v = stripslashes($v);
//         }
//         $v = htmlspecialchars($v);
//         $$k = $v;
//     }
// }
// else {
//    // exit();
// }

/***都道府県選択肢***/
$chiiki1="北海道・東北地方";
$chiiki2="関東地方";
$chiiki3="中部地方";
$chiiki4="近畿地方";
$chiiki5="中国地方";
$chiiki6="四国地方";
$chiiki7="九州地方";
$chiiki8="日本国外";

$adress1_data = array(
	'北海道'=>$chiiki1,
	'青森県'=>$chiiki1,
	'岩手県'=>$chiiki1,
	'宮城県'=>$chiiki1,
	'秋田県'=>$chiiki1,
	'山形県'=>$chiiki1,
	'福島県'=>$chiiki1,
	
	'茨城県'=>$chiiki2,
	'栃木県'=>$chiiki2,
	'群馬県'=>$chiiki2,
	'埼玉県'=>$chiiki2,
	'千葉県'=>$chiiki2,
	'東京都'=>$chiiki2,
	'神奈川県'=>$chiiki2,
	
	'新潟県'=>$chiiki3,
	'富山県'=>$chiiki3,
	'石川県'=>$chiiki3,
	'福井県'=>$chiiki3,
	'山梨県'=>$chiiki3,
	'長野県'=>$chiiki3,
	'岐阜県'=>$chiiki3,
	'静岡県'=>$chiiki3,
	'愛知県'=>$chiiki3,
	
	'三重県'=>$chiiki4,
	'滋賀県'=>$chiiki4,
	'京都府'=>$chiiki4,
	'大阪府'=>$chiiki4,
	'兵庫県'=>$chiiki4,
	'奈良県'=>$chiiki4,
	
	'鳥取県'=>$chiiki5,
	'島根県'=>$chiiki5,
	'岡山県'=>$chiiki5,
	'広島県'=>$chiiki5,
	'山口県'=>$chiiki5,
	
	'徳島県'=>$chiiki6,
	'香川県'=>$chiiki6,
	'愛媛県'=>$chiiki6,
	'高知県'=>$chiiki6,
	
	'福岡県'=>$chiiki7,
	'佐賀県'=>$chiiki7,
	'長崎県'=>$chiiki7,
	'熊本県'=>$chiiki7,
	'大分県'=>$chiiki7,
	'宮崎県'=>$chiiki7,
	'鹿児島県'=>$chiiki7,
	'沖縄県'=>$chiiki7,
	
	'日本国外'=>$chiiki8
	);

$sql = 'SELECT * FROM shurui1';
$stmt = $pdo->prepare($sql);//プリペアードステートメント
$stmt->execute(); //実行
$stmt = $stmt->fetchall();

// echo '<pre>';
// var_dump($res);
// echo '</pre>';
$faq_categoly = array();
foreach($stmt as $value){
  echo "name = ".$value['shurui'].'<br />';
  $faq_categoly[] = $value['shurui'];
}

$faq_categoly_data = array(
	$faq_categoly[0]=>0,
	$faq_categoly[1]=>1,
	$faq_categoly[2]=>2
	);

/***値チェック***/
$name_message = 0;
$email_message = 0;
$faq_categoly_message = 0;
$faq_naiyou_message = 0;
$zipcode1_message = 0;
$zipcode2_message = 0;

if ($kakunin == 1){
	$name_message = requiredCheck($_REQUEST['name'],"お名前");
	$email_message = requiredCheck($_REQUEST['email'],"E-mailアドレス");
	$faq_categoly_message = requiredCheck($_REQUEST['faq_categoly'],"お問い合わせの種類");
	$faq_naiyou_message = requiredCheck($_REQUEST['faq_naiyou'],"お問い合わせ内容");
	$zipcode1_message = numberTypeCheck($_REQUEST['zipcode1'],"3ケタの郵便番号");
	$zipcode2_message = numberTypeCheck($_REQUEST['zipcode2'],"4ケタの郵便番号");
}

/***どれか一つでもエラーが出たらフラグを0に***/
if ($name_message || $email_message || $faq_categoly_message || $faq_naiyou_message || $zipcode1_message || $zipcode2_message) {
	$kakunin = 0;
}

function h($str)
{
	return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

// $pdo->beginTransaction();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">

<head>
  <meta http-equiv="content-type" content="text/html;charset=utf-8" />
  <meta http-equiv="content-Style-Type" content="text/css" />
  <title>フォーカス時のスタイルを指定する</title>

  <script language="JavaScript" src="js/CheckUtil.js"></script>
  <script type="text/javascript">
  function focusColor(i) {
    i.style.borderColor = '#7F9DB9';
    i.style.backgroundColor = '#FFFFFF';
  }

  function blurColor(i) {
    i.style.borderColor = '#CCCCCC';
    i.style.backgroundColor = '#F3F3F3';
  }

  function chk() {
    strErr = "";
    strErr += requiredCheck(document.fm.name.value, "お名前");
    strErr += requiredCheck(document.fm.email.value, "E-Mailアドレス");
    strErr += requiredCheck(document.fm.faq_naiyou.value, "お問い合わせ内容");
    strErr += regExCheck(document.fm.zipcode1.value, "^[0-9]{3}", "郵便番号上3ケタ");
    strErr += regExCheck(document.fm.zipcode2.value, "[0-9]{4}$", "郵便番号下4ケタ");
    strErr += regExCheck(document.fm.email.value, "^[a-zA-Z0-9_\.\-]+?@[A-Za-z0-9_\.\-]+$", "E-Mailアドレス");
    strErr += lengthCheck(document.fm.name.value, 30, "お名前");
    strErr += lengthCheck(document.fm.adress2.value, 50, "市区町村・番地");
    strErr += lengthCheck(document.fm.adress3.value, 50, "アパート・マンション名");
    strErr += lengthCheck(document.fm.faq_naiyou.value, 255, "お問い合わせ内容");
    if (strErr == "") {
      return true;
    } else {
      window.alert(strErr);
      return false;
    }
  }
  </script>

  <style type="text/css">
  body {
    font-size: 75%;
    font-family: "ヒラギノ角ゴ Pro W3", "Hiragino Kaku Gothic Pro", "ＭＳ Ｐゴシック", sans-serif;
    line-height: 1.5;
    color: #333333;
    background-color: #FFFFFF;
  }

  #inquiry {
    width: 600px;
    /* ボックスの幅を指定 */
  }

  #inquiry table {
    border-top: 1px solid #CCCCCC;
    border-bottom: none;
    border-left: none;
    border-right: none;
    font-size: 100%;
    width: 100%;
  }

  #inquiry td {
    border-top: none;
    border-bottom: 1px solid #CCCCCC;
    border-left: none;
    border-right: none;
    padding: 10px;
  }

  #inquiry th {
    border-top: none;
    border-bottom: 1px solid #CCCCCC;
    border-left: 6px solid #CCCCCC;
    border-right: none;
    background-color: #F3F3F3;
    font-weight: normal;
    padding: 10px;
    width: 200px;
  }

  #inquiry th.must {
    border-left-color: #D90000;
  }

  #inquiry th em {
    font-style: normal;
    color: #FF0000;
    padding-left: 5px;
  }

  .text1,
  .text2,
  .text3,
  .text4 {
    border: 1px solid #CCCCCC;
    background-color: #F3F3F3;
    padding: 2px;
  }

  .text1 {
    width: 100px;
  }

  .text2 {
    width: 4em;
  }

  .text3 {
    width: 98%;
  }

  .text4 {
    width: 98%;
  }

  .err {
    background-color: #FFDDDD;
  }

  .err_message {
    color: #FF0000;
  }

  #inquiry select {
    border: 1px solid #CCCCCC;
    background-color: #F3F3F3;
  }

  #inquiry .submit {
    text-align: center;
    margin-top: 30px;
  }

  .text1:focus,
  .text2:focus,
  .text3:focus,
  .text4:focus {
    border-color: #7F9DB9;
    /* フォーカス時のボーダーの色を指定 */
    background-color: #FFFFFF;
    /* フォーカス時の背景色を指定 */
  }
  </style>
</head>

<body>
  <?php if($kakunin ==1){?>
  <p>この内容でよろしければ送信ボタンを押してください</p>
  <p><?php var_dump($_REQUEST); ?></p>

  <?php } ?>
  <form action="<?php if($kakunin ==0){$_SERVER['PHP_SELF'];}else{ print "commit.php";} ?>" method="post" id="inquiry" name="fm" onSubmit="return chk()">
    <table border="border" summary="お問い合わせに関する入力項目名とその入力欄" cellspacing="0">
      <!--名前-->
      <tr>

        <th scope="row" class="must"><label for="name">お名前<em>（必須）</em></label></th>
        <td class="<?php if($name_message){print "err"; }else{ print "noerr";} ?>">
          <?php
	if($kakunin ==0){
		if($name_message){ print "<span class=\"err_message\">".$name_message."</span><br />";} ?>
          <input type="text" name="name" size="30" id="name" class="text1" onfocus="focusColor(this)" onblur="blurColor(this)" value="<?php if(isset($_REQUEST['name'])){ echo h($_REQUEST['name']);} ?>" />
          <?php } else { ?>
          <input type="hidden" name="name" value="<?php if(isset($_REQUEST['name'])){ echo h($_REQUEST['name']);} ?>" />
          <?php if(isset($_REQUEST['name'])){ echo h($_REQUEST['name']);} ?>
          <?php } ?>
        </td>
      </tr>
      <!--郵便番号-->
      <tr>
        <th scope="row"><label for="zipcode1">郵便番号</label></th>
        <td class="<?php if($zipcode1_message || $zipcode2_message){print "err"; }else{ print "noerr";} ?>"><?php
	if($kakunin ==0){
		if($zipcode1_message){ print "<span class=\"err_message\">".$zipcode1_message."</span><br />";} 
		if($zipcode2_message){ print "<span class=\"err_message\">".$zipcode2_message."</span><br />";} 
		?>
          <input type="text" name="zipcode1" size="3" maxlength="3" id="zipcode1" class="text2" onfocus="focusColor(this)" onblur="blurColor(this)" value="<?php echo h($_REQUEST['zipcode1']); ?>" />
          -
          <input type="text" name="zipcode2" size="4" maxlength="4" id="zipcode2" class="text2" onfocus="focusColor(this)" onblur="blurColor(this)" value="<?php echo h($_REQUEST['zipcode2']); ?>" />
          <?php } else { ?>
          <input type="hidden" name="zipcode1" value="<?php echo h($_REQUEST['zipcode1']); ?>" />
          <input type="hidden" name="zipcode2" value="<?php echo h($_REQUEST['zipcode2']); ?>" />
          <?php echo h($_REQUEST['zipcode1']); ?>-<?php echo h($_REQUEST['zipcode2']); ?>
          <?php } ?>
        </td>
      </tr>
      <!--都道府県-->
      <tr>
        <th scope="row"><label for="adress1">都道府県</label></th>
        <td><?php
	if($kakunin ==0){?>
          <select name="adress1" id="adress1">
            <option value="">選択してください</option>
            <optgroup label="<?php print $chiiki1; ?>">
              <?php
		foreach($adress1_data as $key=>$value){
			if($key == "茨城県"){print "</optgroup>\n<optgroup label=\"".$chiiki2."\">\n";}
			if($key == "新潟県"){print "</optgroup>\n<optgroup label=\"".$chiiki3."\">\n";}
			if($key == "三重県"){print "</optgroup>\n<optgroup label=\"".$chiiki4."\">\n";}
			if($key == "鳥取県"){print "</optgroup>\n<optgroup label=\"".$chiiki5."\">\n";}
			if($key == "徳島県"){print "</optgroup>\n<optgroup label=\"".$chiiki6."\">\n";}
			if($key == "福岡県"){print "</optgroup>\n<optgroup label=\"".$chiiki7."\">\n";}
			if($key == "日本国外"){print "</optgroup>\n";}
		?>
              <option value="<?php print $key; ?>" <?php if(h($_REQUEST['adress1']) == $key){print " selected=\"selected\"";} ?>><?php print $key; ?></option>
              <?php
		 }
		 ?>
          </select>
          <?php } else { ?>
          <input type="hidden" name="adress1" value="<?php echo h($_REQUEST['adress1']); ?>" />
          <?php echo h($_REQUEST['adress1']); ?>
          <?php } ?>
        </td>
      </tr>
      <!--市区町村・番地-->
      <tr>
        <th scope="row"><label for="adress2">市区町村・番地</label></th>
        <td><?php
	if($kakunin ==0){?><input type="text" name="adress2" size="30" id="adress2" class="text3" onfocus="focusColor(this)" onblur="blurColor(this)" value="<?php echo h($_REQUEST['adress2']); ?>" />
          <?php } else { ?>
          <input type="hidden" name="adress2" value="<?php echo h($_REQUEST['adress2']); ?>" />
          <?php echo h($_REQUEST['adress2']); ?>
          <?php } ?>
        </td>
      </tr>
      <tr>
        <th scope="row"><label for="adress3">アパート・マンション名</label></th>
        <td><?php
	if($kakunin ==0){?><input type="text" name="adress3" size="30" id="adress3" class="text3" onfocus="focusColor(this)" onblur="blurColor(this)" value="<?php echo h($_REQUEST['adress3']); ?>" />
          <?php } else { ?>
          <input type="hidden" name="adress3" value="<?php echo h($_REQUEST['adress3']); ?>" />
          <?php echo h($_REQUEST['adress3']); ?>
          <?php } ?>
        </td>

      </tr>
      <!--E-Mailアドレス-->
      <tr>
        <th scope="row" class="must"><label for="email">E-Mailアドレス<em>（必須）</em></label></th>
        <td class="<?php if($email_message){print "err"; }else{ print "noerr";} ?>">
          <?php
	if($kakunin ==0){
		if($email_message){ print "<span class=\"err_message\">".$email_message."</span><br />";} ?>
          <input type="text" name="email" size="30" id="email" class="text3" onfocus="focusColor(this)" onblur="blurColor(this)" value="<?php echo h($_REQUEST['email']); ?>" />
          <?php } else { ?>
          <input type="hidden" name="email" value="<?php echo h($_REQUEST['email']); ?>" />
          <?php echo h($_REQUEST['email']); ?>
          <?php } ?>
        </td>
      </tr>
      <!--お問い合わせの種類-->
      <tr>
        <th scope="row" class="must">お問い合わせの種類<em>（必須）</em></th>
        <td class="<?php if($faq_categoly_message){print "err"; }else{ print "noerr";} ?>">
          <?php
	if($kakunin ==0){
		if($faq_categoly_message){ print "<span class=\"err_message\">".$faq_categoly_message."</span><br />";} ?>
          <?php
		$i = 1;
		foreach($faq_categoly_data as $key=>$value){
		?>
          <input name="faq_categoly" type="radio" value="<?php print $value; ?>" id="faq_categoly<?php print $i; ?>" <?php if($faq_categoly == $key){print " checked=\"checked\"";} ?> />
          <label for="faq_categoly<?php print $i; ?>">key:<?php print $key; ?> value:<?php print $value; ?></label><br />
          <?php
		$i++;
		}
		?>
          <?php } else { ?>
          <input type="hidden" name="faq_categoly" value="<?php if(isset($_REQUEST['faq_categoly'])){echo $_REQUEST['faq_categoly'];} ?>" />
          <?php // if(isset($_REQUEST['faq_categoly'])){echo $_REQUEST['faq_categoly'];} ?>
          <?php if(isset($_REQUEST['faq_categoly'])){echo(array_search($_REQUEST['faq_categoly'],$faq_categoly_data));}
          // array_search() ... valueからkeyを取得
          // https://www.flatflag.nir87.com/in_array-431
          ?>
          <!--
        // js
          function getKeyByValue(object, value) {
            return Object.keys(object).find((key) => object[key] === value);
          } -->
          <?php } ?>
        </td>
      </tr>
      <!--お問い合わせ内容-->
      <tr>

        <th scope="row" class="must"><label for="faq_naiyou">お問い合わせ内容<em>（必須）</em></label></th>
        <td class="<?php if($faq_naiyou_message){print "err"; }else{ print "noerr";} ?>">
          <?php
	if($kakunin ==0){
		if($faq_naiyou_message){ print "<span class=\"err_message\">".$faq_naiyou_message."</span><br />";} ?>
          <textarea name="faq_naiyou" cols="30" rows="15" id="faq_naiyou" class="text4" onfocus="focusColor(this)" onblur="blurColor(this)"><?php echo h($_REQUEST('faq_naiyou')); ?></textarea>
          <?php } else { ?>
          <input type="hidden" name="faq_naiyou" value="<?php echo h($_REQUEST['faq_naiyou']); ?>" />
          <?php echo h($_REQUEST['faq_naiyou']); ?>
          <?php } ?>
        </td>
      </tr>
    </table>
    <div class="submit"><?php
	if($kakunin ==0){?><input type="submit" value="確認画面へ" name="btn_confirm" />
      <?php } else { ?>
      <input type="submit" value="送信" />
      <?php } ?>
    </div>
  </form>
</body>

</html>