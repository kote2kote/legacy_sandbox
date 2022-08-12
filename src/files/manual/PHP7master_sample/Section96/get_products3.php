<?php
/**
 * Created by PhpStorm.
 * User: nagatayorinobu
 * Date: 2017/11/24
 * Time: 12:18
 */

// 取得したアクセスキーを設定してください。このままでは動作しません。
// アクセスキーID
define('ACCESSKEY_ID', 'あなたのアクセスキーID');
// シークレットアクセスキー
define('SECRETACCESSKEY', 'あなたのシークレットアクセスキー');
// アソシエートタグ
define('ASSOCIATE_TAG', 'あなたのアソシエートタグ');
// エンドポイント 検索対象サイト
define('ENDPOINT',  'webservices.amazon.co.jp');
//
define('URI' , '/onca/xml');

$params = array(
	"Service" => "AWSECommerceService",
	"Operation" => "ItemSearch",
	"AWSAccessKeyId" => ACCESSKEY_ID,
	"AssociateTag" => ASSOCIATE_TAG,
	"SearchIndex" => "Books",
	"Keywords" => "マイナビ PHP MySQL",
	"ResponseGroup" => "Images,ItemAttributes,Offers"
);

// Set current timestamp if not set
if (!isset($params["Timestamp"])) {
	$params["Timestamp"] = gmdate('Y-m-d\TH:i:s\Z');
}

// Sort the parameters by key
ksort($params);

$pairs = [];

foreach ($params as $key => $value) {
	array_push($pairs, rawurlencode($key)."=".rawurlencode($value));
}

// Generate the canonical query
$canonical_query_string = join("&", $pairs);

// Generate the string to be signed
$string_to_sign = "GET\n". ENDPOINT . "\n" . URI . "\n" . $canonical_query_string;

// Generate the signature required by the Product Advertising API
$signature = base64_encode(hash_hmac("sha256", $string_to_sign, SECRETACCESSKEY, true));

// Generate the signed URL
$request_url = 'http://'. ENDPOINT .URI.'?'.$canonical_query_string.'&Signature='.rawurlencode($signature);

// XML形式のデータをURLから取得する
$lines = file_get_contents($request_url);

// オブジェクト形式に変換
$xml = simplexml_load_string($lines);

// 配列に変換できますが、うまくいかないときもあります。
//$json = json_encode($xml);
//$array = json_decode($json,TRUE);

//print "<pre>";
//var_dump($array["Items"]["Item"][0]["Offers"]);
//print "</pre>";

// 検索件数を取得
$totalresults =  $xml->Items->TotalResults;
$totalpages =  $xml->Items->TotalPages;
print "検索結果 :" . $totalresults . "件<br>";
print "ページ数 :" . $totalpages . "ページです。<br>";
print "最初のページのみ表示します。<br><br>";


if($totalresults > 10) {$totalresults = 10;}
for($i = 0; $i < $totalresults; ++$i) {
	$title  = htmlspecialchars($xml->Items->Item[$i]->ItemAttributes->Title);
	$author = $xml->Items->Item[$i]->ItemAttributes->Author;
	$binding= $xml->Items->Item[$i]->ItemAttributes->Binding;
	$url    = $xml->Items->Item[$i]->DetailPageURL;
	$image  = $xml->Items->Item[$i]->MediumImage->URL;
	if(isset($xml->Items->Item[$i]->Offers->Offer->OfferListing->Price->FormattedPrice)){
		$price  = $xml->Items->Item[$i]->Offers->Offer->OfferListing->Price->FormattedPrice;
	}else{
		$price = "取得できません";
	}
	$html = <<<HTML
	    <div>
		<a href="{$url}" ><img src="{$image}" border="0" align="left" >{$title}</a><br>
		著者：{$author}<br>
		形式：{$binding}<br>
	    価格：{$price}</div><br clear="all"><br>
HTML;
	print $html;

}


