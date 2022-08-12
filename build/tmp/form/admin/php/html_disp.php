<?php
//--------------------------------------------------
//共通ヘッダ(googleanalyticsとか)
//--------------------------------------------------
function common_header(){
?>
<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />
<script type="text/javascript" src="/js/common/rollover_popup.js"></script>
<?
}
function common_meta($a,$b,$c){
?>
<meta name="author" content="<?php echo $a;?>"/>
<meta name="description" content="<?php echo $b;?>"/>
<meta name="keywords" content="<?php echo $c;?>"/>
<!--[if IE]>
<style type="text/css">
.fsize_s{
font-size:70% !important;
}
</style>
<![endif]-->
<?php
}
//--------------------------------------------------
//ヘッダー
//--------------------------------------------------
function header_html(){
?>
<div id="header"></div>
<?php
}
//--------------------------------------------------
//ヘッダーロールオーバーメニュー
//--------------------------------------------------
function top_navi($num){
$page01 = "トップページ";
$page02 = "お知らせ";
$page03 = "初めての方";
$page04 = "各種検索";
$page05 = "マイページ";

$url1 = "<a href=\"/\">$page01</a>";
$url2 = "<a href=\"#\">$page02</a>";
$url3 = "<a href=\"#\">$page03</a>";
$url4 = "<a href=\"#\">$page04</a>";
$url5 = "<a href=\"#\">$page05</a>";
if($num == ""){
	$num = "0";
}
switch($num){
	case "1":
		$url1="$page01";
		break;
	case "2":
		$url2="$page02";
		break;
	case "3":
		$url3="$page03";
		break;
	case "4":
		$url4="$page04";
		break;
	case "5":
		$url5="$page05";
		break;
	default:
		break;
}
?>
<div id="header">
<h1><a href="/"><img src="/common_img/logo.gif" alt="タイトル" width="159" height="42" border="0" /></a></h1>
		<div id="top_navi">
			<ul>
				<li id="top_navi01"><?php echo $url1; ?></li>
				<li id="top_navi02"><?php echo $url2; ?></li>
				<li id="top_navi03"><?php echo $url3; ?></li>
				<li id="top_navi04"><?php echo $url4; ?></li>
				<li id="top_navi05"><?php echo $url5; ?></li>
			</ul>
		</div>
		</div>
<?
}
//--------------------------------------------------
//フッター
//--------------------------------------------------
function footer_html(){
?>
<div id="footer"></div>
<?
}
//--------------------------------------------------
//ページ内埋め込み型javascript
//--------------------------------------------------
function inner_js(){
?>
<script type="text/javascript" src="/js/common/search.js"></script>
<?php
}

/***表示データ番号の表示***/
function disp_data_num($p_from,$p_to,$p_count){
	//件数表示のスタート
    $disp_num_from = 1 + $p_from;//必ず1足す
	
	//件数表示のエンド
    if($p_count >= $p_to){
        $disp_num_to = $p_to;
    }else{
        $disp_num_to = $p_count;
    }
	
	//表示
    if($disp_num_to == 0){//0なら未投稿
        $disp_num = "データがありません。";
    }else{
        $disp_num = $disp_num_from."件目～".$disp_num_to."件目を表示";
    }
    print($disp_num);
}

/***「次のページ」「前のページ」***/
function next_pre_link($p_from,$p_to,$p_max,$p_count,$p_link,$p_search = ""){
	//書込表示が0番目（一番最初）じゃない場合
    if($p_from != 0){
        $before_num = $p_from - $p_max;//20件目→20-10=10 「10(=before_num)～20件目を表示」と出す
		//0以下になってしまった場合は0にする
        if($before_num < 0){
            $before_num = 0;
        }
		//リンクhtml生成
        $move_link  = "<a href=\"".$p_link."?from=".$before_num
          ."&key_word=".$p_search."\">前の".$p_max."件</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    }
	//書込件数がまだある場合
    if($p_to < $p_count){
        $after_num = $p_from + $p_max;
        $move_link  = $move_link."<a href=\"".$p_link."?from="
          .$after_num."&key_word=".$p_search."\">次の".$p_max."件</a>";
    }
    print($move_link);
}


?>