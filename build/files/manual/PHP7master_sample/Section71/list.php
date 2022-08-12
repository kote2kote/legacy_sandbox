<!DOCTYPE html>
<html lang="ja">
<head>
<title>PHPのテスト</title>
</head>
<body>
<?php
require_once("MYDB.php");
$pdo = db_connect();

if(isset($_GET['action']) && $_GET['action'] == 'delete' && $_GET['id'] > 0 ){
    try {
      $pdo->beginTransaction();
      $id = $_GET['id'];
      $sql = "DELETE FROM member WHERE id = :id";
      $stmh = $pdo->prepare($sql);
      $stmh->bindValue(':id',         $id,                  PDO::PARAM_INT );
      $stmh->execute();
      $pdo->commit();
      print "データを" . $stmh->rowCount() . "件、削除しました。<br>";

    } catch (PDOException $Exception) {
      $pdo->rollBack();
      print "エラー：" . $Exception->getMessage();
    }
}


try {
  $sql= "SELECT * FROM member ";
  $stmh = $pdo->query($sql);
  $count = $stmh->rowCount();
  print "検索結果は" . $count . "件です。<br>";
  
} catch (PDOException $Exception) {
  print "エラー：" . $Exception->getMessage();
}

if($count < 1){
	print "検索結果がありません。<br>";
}else{
?>

<table border="1">
<tbody>
<tr><th>番号</th><th>氏</th><th>名</th><th>年齢</th></tr>
<?php
  while ($row = $stmh->fetch(PDO::FETCH_ASSOC)) {
?>
<tr>
<td><?=htmlspecialchars($row['id'], ENT_QUOTES)?></td>
<td><?=htmlspecialchars($row['last_name'], ENT_QUOTES)?></td>
<td><?=htmlspecialchars($row['first_name'], ENT_QUOTES)?></td>
<td><?=htmlspecialchars($row['age'], ENT_QUOTES)?></td>
</tr>
<?php
}    
?>
</tbody></table>

<?php
}
?>

</body>
</html>
