<?php
//--------------------------------------------------
//pupup
//--------------------------------------------------
function popup($width,$height,$url,$str){
	print "<a href=\"javascript:void(0)\" onclick=MM_openBrWindow('$url','newwin','width=$width,height=$height')>$str</a>";
}

function showstr($str,$check){
	if($check=="sjis_euc"){
		$str = mb_convert_encoding($str, "EUC-JP", "SJIS");
	}else if($check=="euc_sjis"){
		$str = mb_convert_encoding($str, "SJIS", "EUC-JP");
	}else if($check==null){
		$str = mb_convert_encoding($str, mb_internal_encoding(), "auto");
	}
	return $str;
}

function utf8_out($str){
	$str = mb_convert_encoding($str, "UTF8", "EUC-JP");
	return $str;
}
function euc_out($str){
	$str = mb_convert_encoding($str, "EUC-JP", "UTF8");
	return $str;
}
?>