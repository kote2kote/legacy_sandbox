<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>クラスのテスト</title>
</head>
<body>
<div style="font-size:14px">クラスのテスト</div>
<br><br>
<?php
class User {
    private $name       = NULL;
    public function print_hello() {
        print $this->name;
        print "さん、こんにちは！<br>";
    }
}

class Guest extends User {
    private $name       = "ゲスト";
    public function print_hello() {
        print $this->name;
        print "さん、はじめまして！<br>";
    }
}

$newuser = new Guest();
$newuser->print_hello();
?>
</body>
</html>
