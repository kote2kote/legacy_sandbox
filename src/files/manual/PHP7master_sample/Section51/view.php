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
$newuser = new User();
$newuser->print_hello();

class User {
    public $name       = '永田';
    public function print_hello() {
        print $this->name;
        print "さん、こんにちは！<br>";
    }
}
?>
</body>
</html>