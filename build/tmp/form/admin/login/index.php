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


//--------------------------------------------------
//次の～件、前の～件
//--------------------------------------------------
$VIEW_NUM = 30;//表示件数
$from = $_GET["from"];
if(!$from = intval($from)){
    $from = 0;
}
$to   = $from + $VIEW_NUM;

//--------------------------------------------------
//検索用語があれば変数に代入
//--------------------------------------------------
if(isset($_POST["key_word"])){
    $key_word = $_POST["key_word"];
}else{
    $key_word = $_GET["key_word"];
}

//--------------------------------------------------
//SQL(カウントと検索)
//--------------------------------------------------
//カウント
$sql_search_field_list = split(",", $sql_search_field);
$a = sizeof($sql_search_field_list);

$sql = "SELECT id FROM $sql_table_name";
$res = mysql_query($sql, $conn);
$result_count = mysql_num_rows($res);

//検索
$sql_result_field_list = split(",", $sql_result_field);
$b = sizeof($sql_result_field_list);

$sql_item = " WHERE $sql_search_field_list[0] LIKE \"%".$key_word."%\"";
if($a >=2){
	for($i=1; $i<=$a-1;$i++){
		$sql_item .= " OR $sql_search_field_list[$i] LIKE \"%".$key_word."%\"";
	}
}

$sql = "SELECT * FROM $sql_table_name".$sql_item." ORDER BY id DESC"
		." LIMIT ".$from.", "."$VIEW_NUM";
$res = mysql_query($sql, $conn);

$num=0;
while($row = mysql_fetch_array($res)) {
	for($i=0; $i<=$b;$i++){
		$sql_result_item[$num][$i]= $row[$sql_result_field_list[$i]];
	}	
	$num++;
}
$c = sizeof($sql_result_item);
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
						<div align="center">
							<form method="post" action="<?php $_SERVER['PHP_SELF'];?>" class="search_form">
								<input type="text" name="key_word" value="<?php echo $key_word; ?>" maxlength="30" class="textbox1" /> <input type="submit" value="検索" name="submit" />
							</form>
							<p><?php echo $result_count."件該当&nbsp;&nbsp;";?></p>
							<p><?php disp_data_num($from,$to,$result_count);?></p>
						</div>
					 	<!--<p class="add"><a href="edit.php?mode=add">⇒新規追加</a></p>-->
						<table width="100%" cellpadding="0" cellspacing="0" class="admin_table">
						  <tr>
							<?php for($i=0; $i<=$b-1;$i++){?>
                            <th>
							<?php 
							if($sql_result_field_list[$i]=="modified"){
								echo "修正";
							} else {
								echo $sql_result_field_list[$i];
							}
							?>
                            </th>
                            <?php }?>
							<th>更新</th>
							<th>削除</th>
						  </tr>
<?php
for($i=0; $i<=$c-1;$i++){
?>
<form action="update.php" method="post">
<tr>
<?php
for($num=0; $num<=$b-1;$num++){
?>
<td>
<?php
//--------------------------------------------------
//カスタマイズ項目
//--------------------------------------------------
if($sql_result_field_list[$num]=="id"){
?>
<input type="hidden" name="id" value="<?php echo $sql_result_item[$i][$num];?>">
<?php echo $sql_result_item[$i][$num];?>
<?
} else if($sql_result_field_list[$num]=="modified"){

	$date = gmdate("Y/m/d H:i:s",$sql_result_item[$i][$num]+9*3600);
	echo $date;
	
}else if($sql_result_field_list[$num]=="created"){

	$date = gmdate("Y/m/d H:i:s",$sql_result_item[$i][$num]+9*3600);
	echo $date;
	
}else{
?>
<input name="<?php echo $sql_result_field_list[$num];?>" type="text" class="textbox2" value="<?php echo $sql_result_item[$i][$num];?>" />
<?
}
?>
</td>
<?php
}
?>
<td><a href="edit.php?bid=<?php echo $sql_result_item[$i][0];?>&amp;mode=update">更新</a></td>
<td><a href="flag_update.php?bid=<?php echo $sql_result_item[$i][0];?>&mode=delete">削除</a></td>
</tr>
</form>
<?php
}
?>
					  </table>
						<table width="100%" cellpadding="0" cellspacing="0" class="admin_dbtable">
						  <tr>
							<td>
								<h3>デバッグ用SQL文</h3>
								<ul>
									<li><?php echo $sql;?></li>
									<li><?php echo $sql2;?></li>
								</ul></td>
						  </tr>
					</table>
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