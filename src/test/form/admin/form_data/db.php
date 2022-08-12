<?php
$sql_table_name = "formdata1";//テーブル名
$sql_search_field = "name,zipcode1,zipcode2,adress1,adress2,adress3,email,faq_naiyou";//検索フィールド
$sql_result_field = "id,name,zipcode1,zipcode2,adress1,adress2,adress3,faq_category,email,faq_naiyou,created";//結果フィールド名
$category_table="shurui1";//内部結合で参照するテーブル
$category_field="shurui";//内部結合でひっぱってきたいフィールド
$category_num="faq_categoly";//内部結合で比較するカテゴリーnum
?>