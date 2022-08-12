<?php
/************************************************************
フォーム入力チェックロジック
作成:2006/7/29
************************************************************/


/***必須入力チェック***/
function requiredCheck($strVal,$strErr) {
	if(is_null($strVal) || trim($strVal)==''){
		$message=$strErr."は必須入力です";
	}
	return $message;
}

/***最大文字数チェック***/
function lengthCheck($strVal,$intMax,$strErr){
	if(is_null($strVal)===FALSE && trim($strVal)!=''){
		if(mb_strlen($strVal)>$intMax){
			$message=$strErr."は".$intMax."桁以下で入力してください";
		}
	}
	return $message;
}

/***全角入力チェック***/
function ZenCheck($strVal,$strErr){
	if(is_null($strVal)===FALSE && trim($strVal)!=''){
		if(mb_strlen($strVal)*2!=strlen($strVal)){
			$message=$strErr."は全角（2バイト文字）で入力してください";
		}
	}
	return $message;
}

/***半角入力チェック***/
function HanCheck($strVal,$strErr){
	if(is_null($strVal)===FALSE && trim($strVal)!=''){
		if(mb_strlen($strVal)!=strlen($strVal)){
			$message=$strErr."は半角（1バイト文字）で入力してください";
		}
	}
	return $message;
}

/***数値入力チェック***/
function numberTypeCheck($strVal,$strErr){
	if(is_null($strVal)===FALSE && trim($strVal)!=''){
		if(is_numeric($strVal)===FALSE){
			$message=$strErr."は数値で入力してください";
		}
	}
	return $message;
}

/***日付入力チェック(Y/M/D)***/
function dateTypeCheck($strVal,$strErr){
	if(is_null($strVal)===FALSE && trim($strVal)!=''){
		if(!ereg("^[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}$",$strVal)){
			$message=$strErr."は日付形式で入力してください";
		} else{
			$aryStr=split("/",$strVal);
			if($strVal!=
				date("Y/m/d",mktime(0,0,0,$aryStr[1],$aryStr[2],$aryStr[0]))){
				$message=$strErr."は正しい日付で入力してください";
			}
		}
	}
	return $message;
}

/***日付入力チェック(Y,M,D)***/
function dateNumberTypeCheck($strYear,$strMonth,$strDay,$strErr){
	if(is_numeric($strYear)===FALSE ||
		is_numeric($strMonth)===FALSE || is_numeric($strDay)===FALSE){
		$message=$strErr."は数値で入力してください";
	}
	$intTmp=mktime(0,0,0,$strMonth,$strDay,$strYear);
	if(date("Y",$intTmp)!=$strYear ||
		date("m",$intTmp)!=$strMonth || date("d",$intTmp)!=$strDay){
		$message=$strErr."は正しい日付形式で入力してください";
	}
	return $message;
}

/***以上以下チェック***/
function rangeCheck($strVal,$intMax,$intMin,$strErr){
	if(is_null($strVal)===FALSE && trim($strVal)!=''){
		if(is_numeric($strVal)===FALSE){
			$message=$strErr."は数値で入力してください";
		}
		if($strVal<$intMin || $strVal>$intMax){
			$message=$strErr."は".$intMin."以上、かつ"
				.$intMax."以下で入力してください";
		}
	}
	return $message;
}

/***正規表現チェック***/
function regExCheck($strVal,$strPtn,$strErr){
	if(is_null($strVal)===FALSE && trim($strVal)!=''){
		if(!ereg($strPtn,$strVal)){
				$message=$strErr."を正しい形式で入力してください";
		}
	}
	return $message;
}

/***最小値チェック***/
function compareCheck($strVal1,$strVal2,$strErr1,$strErr2){
	if(is_null($strVal1)===FALSE && trim($strVal1)!=''
		&& is_null($strVal2)===FALSE && trim($strVal2)!=''){
		if($strVal1>=$strVal2){
			$message=$strErr1."は".$strErr2."より小さい値を指定してください";
		}
	}
	return $message;
}

/***重複データチェック(SQL)***/
function duplicateCheck($sql,$strErr) {
	$db=new mysqli("localhost","php","php","sample");
	$rs=$db->query($sql);
	if(!is_null($rs->fetch_array(MYSQLI_ASSOC))){
		$message=$strErr."が重複しています";
	}
	return $message;
}

//以下、いろいろパクったり作ったり

/***特殊文字の変換***/
function html_convert($p_string){
    $p_string = str_replace("&","&amp;",$p_string);
    $p_string = str_replace("\"","&quot;",$p_string);
    $p_string = str_replace("<","&lt;",$p_string);
    $p_string = str_replace(">","&gt;",$p_string);
    $p_string = str_replace(",","&#44;",$p_string);
    $p_string = str_replace("'","&#39;",$p_string);
    $p_string = str_replace("\r\n","\n",$p_string);
    $p_string = str_replace("\r","\n",$p_string);
    $p_string = str_replace(" ","&nbsp;",$p_string);
    $p_string = str_replace("\n","<br />",$p_string);
    return $p_string;
}

?>