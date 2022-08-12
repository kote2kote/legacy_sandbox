<?php
//--------------------------------------------------
//DB接続
//--------------------------------------------------
// $host = "localhost";
// $usr = "kote2";
// $password = "09pulu07";
// $select_db = "form_test2";
const DB_HOST = 'mysql:dbname=form_test2;host=127.0.0.1;charset=utf8';
const DB_USER = 'kote2';
const DB_PASSWORD = '09pulu07';


// if (!$conn = mysqli_connect($host, $usr, $password)){
//     die("データベース接続エラー.<br />");
// }

// mysqli_select_db($select_db, $conn);
// mysqli_query("set names utf8", $conn);

try{
    $pdo = new PDO(DB_HOST, DB_USER, DB_PASSWORD, [
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //連想配列
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, //例外
      PDO::ATTR_EMULATE_PREPARES => false, //SQLインジェクション対策
    ]);
    // echo '接続成功';
  
  } catch(PDOException $Exception){
    // echo '接続失敗' . $e->getMessage() . "\n";
    exit();
  }