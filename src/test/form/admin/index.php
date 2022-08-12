<?php
$page_title = "ログイン";
$page_author = "著作者名前";
$page_description = "このページの説明";
$page_keyword = "キーワード1,キーワード2,キーワード3,キーワード4";

//--------------------------------------------------
//include
//--------------------------------------------------
require("php/common.php");
require("php/html_disp.php");
require("php/DB.php");
include("db.php");


$user_id = "pulu";
$password = "09pulu07";

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
	
	if($id == $user_id && $pass == $password){
		session_start();
		$_SESSION["uid"] = md5(uniqid(rand(), true));
		header("Location: form_data");
	}
}
?>
<?php include("php/common-head.php");?>
<?php common_meta($page_author,$page_description,$page_keyword);?>
<script type="text/javascript">
<!--

// -->
</script>

<style type="text/css">
<!--

-->
</style>

<title><?php echo $page_title;?></title>
</head>
<body>
	
	<form action="<?php $_SERVER['PHP_SELF'];?>" method="post">
		<div align="center">
		<h3>管理画面</h3>
			<table>
				<tr>
					<td>ID</td>
					<td><input name="id" type="text" size="20" maxlength="20"></td>
				</tr>
				<tr>
					<td>pass</td>
					<td><input name="pass" type="password" size="20" maxlength="20"></td>
				</tr>
				<tr>
					<td colspan="2"><div align="center">
					  <input type="submit" name="Submit" value="送信">
				    </div></td>
				</tr>
			</table>
		</div>
	</form>
</body>
</html>
