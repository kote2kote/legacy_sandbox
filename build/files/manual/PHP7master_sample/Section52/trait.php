<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>トレイトのテスト</title>
</head>
<body>
<div style="font-size:14px">トレイトのテスト</div>
<br><br>
<?php
class User {
    private $name       = NULL;
    public function print_hello() {
        print $this->name;
        print "さん、こんにちは！<br>";
    }
}

trait SayMorning {
    public function print_morning() {
        print $this->name;
        print "さん、おはようございます！<br>";
	} 
}

class Guset extends User {
    use SayMorning;
    private $name       = "ゲスト";
    public function print_hello() {
        print $this->name;
        print "さん、はじめまして！<br>";
    }
}

$newuser = new Guset();
$newuser->print_hello();
$newuser->print_morning();
?>

</body>
</html>
