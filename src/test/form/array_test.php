<?php
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
$faq_categoly1="このサイトについてのお問い合わせ";
$faq_categoly2="弊社の業務内容についてのお問い合わせ";
$faq_categoly3="その他のお問い合わせ";

$faq_categoly_data = array(
	$faq_categoly1=>1,
	$faq_categoly2=>2,
	$faq_categoly3=>3
	);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<meta http-equiv="content-Style-Type" content="text/css" />
<title>フォーカス時のスタイルを指定する</title>
</head>

<body>
<form action="index.php" method="post" id="inquiry" name="fm">
		<select name="adress1" id="adress1">
		<option value="" selected="selected">選択してください</option>
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
		<option value="<?php print $key; ?>"<?php if($adress1 == $key){print " selected=\"selected\"";} ?>><?php print $key; ?></option>
		<?php
		 }
		 ?>
		</select><br />
		<?php
		$i = 0;
		foreach($faq_categoly_data as $key=>$value){
		?>
		<input name="faq_categoly" type="radio" value="<?php print $key; ?>" id="category<?php print $i; ?>"<?php if($faq_categoly == $key){print " checked=\"checked\"";} ?> />
		<label for="category<?php print $i; ?>"><?php print $key; ?></label><br />
		<?php
		$i++;
		}
		?>
</form>
</body>
</html>

