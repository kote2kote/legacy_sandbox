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
<?php include("../php/common-head.php");?>
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
<div id="wrapper">
	<?php header_html(); ?>
	<div id="container">
		<div class="lr_box">
			<!--left_menu START-->
			<div id="box_left">
				<div id="subbox_left">
					<?php include("../php/common-sidebar1.php");?>
				</div>
			</div>
			<!--left_menu END-->
			<div id="box_right">
				<!--right_menu START-->
				<div id="subbox_right">
				  <div id="admin_contents">
				  <h2><?php echo $page_title;?></h2>
				  <p><span class="rime_green">■</span>は必須</p>
					<form action="<?php $_SERVER['PHP_SELF'];?>" method="post">
					<table width="100%" cellpadding="0" cellspacing="0" class="admin_table">
					<tr>
						<th class="check">サイト名&amp;URL</th>
						<td><ul>
							<li><input type="text" name="name" value="<?php echo $row["name"]; ?>" class="textbox3"></li>
						</ul></td>
					</tr>
					<tr>
						<th class="check">ID&amp;PASS&amp;MAIL</th>
						<td><ul>
						  <li>〒<input type="text" name="zipcode1" value="<?php echo( $row["zipcode1"]); ?>" class="textbox1">-<input type="text" name="zipcode2" value="<?php echo( $row["zipcode2"]); ?>" class="textbox1"></li>
						  <li><input type="text" name="adress1" value="<?php echo( $row["adress1"]); ?>" class="textbox1"><input type="text" name="adress2" value="<?php echo( $row["adress2"]); ?>" class="textbox1"><input type="text" name="adress3" value="<?php echo( $row["adress3"]); ?>" class="textbox1"></li>
						  <li><input type="text" name="email" value="<?php echo( $row["email"]); ?>" class="textbox1"></li>
						</ul></td>
					</tr>
<?php if($mode=="update"){?>
					<tr>
					  <th class="check">用途</th>
					  <td><select name="category" id="category" class="textbox1">
										<?php for($i=1; $i<=count($categoly_id);$i++){?>
										<option value="<?php echo $categoly_id[$i]; ?>"<?php if($row2["shurui"] == $categoly_name[$i]){echo " selected=\"selected\"";} ?>><?php echo $categoly_name[$i]; ?></option>
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
						<th>内容</th>
						<td><textarea name="faq_naiyou" cols="60" rows="10" class="textbox3"><?php echo $row["faq_naiyou"]; ?></textarea></td>
					</tr>
					<tr>
						<th>備考</th>
						<td><textarea name="notes" cols="60" rows="10" class="textbox3"><?php echo $row["notes"]; ?></textarea></td>
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
<?php include("../php/common-footer.php");?>
<?php
	//メモリ開放
	mysql_free_result($res);
?>