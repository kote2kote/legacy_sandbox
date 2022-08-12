<?php
//--------------------------------------------------
//include
//--------------------------------------------------
require("../php/session.php");
require("../php/common.php");
require("../php/html_disp.php");
require("../php/DB.php");
include("db.php");

//--------------------------------------------------
//pageinfo
//--------------------------------------------------
$page_title = "種類";
$page_author = "著作者名前";
$page_description = "このページの説明";
$page_keyword = "キーワード1,キーワード2,キーワード3,キーワード4";

$mode = $_GET['mode'];

if($mode=="add"){
require("add.php");
$page_name="新規追加";
}
if($mode=="update"){
require("update.php");
$page_name="データ編集";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<meta name="author" content="著作者名前"/>
<meta name="description" content="このサイトの説明"/>
<meta name="keywords" content="キーワード1,キーワード2,キーワード3,キーワード4"/>
<link rel="stylesheet" type="text/css" title="スタイル" media="screen,print" href="../css/common.css" />
<link rel="stylesheet" type="text/css" title="スタイル" media="screen,print" href="../css/layout.css" />
<link rel="stylesheet" type="text/css" title="スタイル" media="screen,print" href="../css/contents.css" />
<?php common_header();?>
<script type="text/javascript">
<!--

// -->
</script>

<style type="text/css">
<!--

-->
</style>

<title>ページタイトル</title>
</head>

<body>
<div id="wrapper">
	<?php header_html(); ?>
	<div id="container">
		<div class="lr_box">
			<!--left_menu START-->
			<div id="box_left">
				<div id="subbox_left">
					<?php left_menu(); ?>
				</div>
			</div>
			<!--left_menu END-->
			<div id="box_right">
				<!--right_menu START-->
				<div id="subbox_right">
				  <div id="admin_contents">
				  <h2>ID・PASS管理 - <?php echo $page_name;?></h2>
				  <p><span class="rime_green">■</span>は必須</p>
					<form action="<?php $_SERVER['PHP_SELF'];?>" method="post">
					<table width="100%" cellpadding="0" cellspacing="0" class="admin_table">
					<tr>
						<th class="check">サイト名&amp;URL</th>
						<td><ul>
							<li><input type="text" name="name" value="<?php echo $row["name"]; ?>" class="textbox3"></li>
							<li><input type="text" name="url" value="<?php echo $row["url"]; ?>" class="textbox3"></li>
						</ul></td>
					</tr>
					<tr>
						<th class="check">ID&amp;PASS&amp;MAIL</th>
						<td><ul>
						  <li><input type="text" name="uid" value="<?php echo( $row["uid"]); ?>" class="textbox1"></li>
						  <li><input type="text" name="pass" value="<?php echo( $row["pass"]); ?>" class="textbox1"></li>
						  <li><input type="text" name="email" value="<?php echo( $row["email"]); ?>" class="textbox1"></li>
						</ul></td>
					</tr>
<?php if($mode=="update"){?>
					<tr>
					  <th class="check">用途</th>
					  <td><select name="category" id="category" class="textbox1">
										<?php for($i=1; $i<=count($categoly_id);$i++){?>
										<option value="<?php echo $categoly_id[$i]; ?>"<?php if($row2["idpass_category"] == $categoly_name[$i]){echo " selected=\"selected\"";} ?>><?php echo $categoly_name[$i]; ?></option>
										<?php }?>
					  </select></td>
					</tr>
<?php }?>
<?php if($mode=="add"){?>
					<tr>
					  <th class="check">用途</th>
					  <td><select name="category" id="category" class="textbox1">
										<?php for($i=1; $i<=count($categoly_id);$i++){?>
										<option value="<?php echo $categoly_id[$i]; ?>"<?php if($categoly_id[$i] == 1){echo " selected=\"selected\"";} ?>><?php echo $categoly_name[$i]; ?></option>
										<?php }?>
					  </select></td>
					</tr>
<?php }?>
					<tr>
						<th>備考</th>
						<td><textarea name="bikou" cols="60" rows="10" class="textbox3"><?php echo $row["bikou"]; ?></textarea></td>
					</tr>
					<tr>
					<td colspan="2" align="center">
					<input type="submit" name="submit" value="追加"><br><a href="javascript:history.back();">戻る</a></td>
					</tr>
					</table>
					<table width="100%" cellpadding="0" cellspacing="0" class="admin_dbtable">
					  <tr>
							<td>
								<h3>デバッグ用SQL文</h3>
								<ul>
									<li><?php echo($sql);?></li>
									<li><?php echo($sql2);?></li>
								</ul></td>
					  </tr>
					</table>
					</form>
				  </div>
			  	</div>
				<!--right_menu END-->
			</div>
		</div>
	</div>
	<?php footer_html();?>
	<?php inner_js();?>
</div>
</body>
</html>
<?php
	//メモリ開放
	mysql_free_result($res);
?>