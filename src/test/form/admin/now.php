<?php
mb_language("uni");
mb_internal_encoding("utf-8");
mb_http_input("auto");
mb_http_output("utf-8");
ob_start('mb_output_handler');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<script type="text/javascript">
<!--
var date = new Date(document.lastModified);
  var year = date.getFullYear();
  var month = date.getMonth()+1;
  var day = date.getDate();
  var hour = date.getHours();
  var minute = date.getMinutes();
// -->
</script>
<style type="text/css">
<!--
* {
	margin: 0;
	padding: 0;
}
/*------------------------------------------------------------
ページbody共通
------------------------------------------------------------*/
body {
padding-left:10px;
padding-top:10px;
	color: #666666;
	font-size: 75%;
	font-family: "ヒラギノ角ゴ Pro W3", "Hiragino Kaku Gothic Pro", "ＭＳ Ｐゴシック", sans-serif;
	line-height: 1.2;
	/*\*/
	/*letter-spacing: 0.2em; /* バックスラッシュハックMACIE5用-文字間をフォントサイズの0.1em分に指定 */
	/**/
	/*text-align: center;*//* テキストを中央揃えに指定 -------------------------------------中央配置時必須*/
}
/*------------------------------------------------------------
見出しデフォルト
------------------------------------------------------------*/
h1 {
	font-size: 100%;
}
h2 {
	font-size: 100%;
}
h3 {
	font-size: 100%;
}
h4 {
	font-size: 100%;
}
h5 {
	font-size: 100%;
}
h6 {
	font-size: 100%;
}


/*------------------------------------------------------------
リンク共通
------------------------------------------------------------*/
a:link { 
	/*font-weight: bold; */
	text-decoration: none; 
	color: #0490CB;
	}
a:visited { 
	/*font-weight: bold; */
	text-decoration: none; 
	color: #0490CB;
	}
a:hover, a:active { 
	text-decoration: underline; 
	color: #FF6600;
}

#table01{
border-bottom:#999999 1px solid;
border-right:#999999 1px solid;
}
#table01 th{
border-left:#999999 1px solid;
border-top:#999999 1px solid;
padding:3px;
}
#table01 td{
border-left:#999999 1px solid;
border-top:#999999 1px solid;
padding:3px;
}
.style1 {
	color: #FFFFFF;
	font-weight: bold;
}
-->
</style>
<title>ベビペディアデザイン＆コーディング状況</title>
</head>

<body>
デザイン＆コーディング状況(
  <script type="text/javascript">
<!--
  document.write(month,"/",day," ",hour,":",minute);
// -->
</script>
現在)</h1>
<table width="800" border="0" cellspacing="0" cellpadding="0" id="table01">
  <tr>
    <th width="50%">page</th>
    <th width="40%">url</th>
    <th width="5%">design</th>
    <th width="5%">cording</th>
  </tr>
  <tr>
    <td colspan="4" bgcolor="#CC6699"><span class="style1">メインサイト<a href="/index.php"></a></span></td>
  </tr>
  <tr>
    <td>トップページ</td>
    <td><a href="index.html">index.html</a></td>
    <td><div align="center">○</div></td>
    <td><div align="center">○</div></td>
  </tr>
  <tr>
    <td>トップページ(php)</td>
    <td><a href="idpass/index.php">idpass/index.php</a></td>
    <td><div align="center">○</div></td>
    <td><div align="center">○</div></td>
  </tr>
  <tr>
    <td>ページタイトル</td>
    <td>&nbsp;</td>
    <td><div align="center">&nbsp;</div></td>
    <td><div align="center">&nbsp;</div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="center">&nbsp;</div></td>
    <td><div align="center">&nbsp;</div></td>
  </tr>
  <tr>
    <td colspan="4" bgcolor="#CC6699"><span class="style1">サイト2<a href="/index.php"></a></span></td>
  </tr>
  <tr>
    <td>ページタイトル</td>
    <td>&nbsp;</td>
    <td><div align="center">&nbsp;</div></td>
    <td><div align="center">&nbsp;</div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="center">&nbsp;</div></td>
    <td><div align="center">&nbsp;</div></td>
  </tr>
  <tr>
    <td colspan="4" bgcolor="#CC6699"><span class="style1">サイト3<a href="/index.php"></a></span></td>
  </tr>
  <tr>
    <td>ページタイトル</td>
    <td>&nbsp;</td>
    <td><div align="center">&nbsp;</div></td>
    <td><div align="center">&nbsp;</div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="center">&nbsp;</div></td>
    <td><div align="center">&nbsp;</div></td>
  </tr>
  <tr>
    <td colspan="4">メモ：<br /></td>
  </tr>
</table>
</body>
</html>
