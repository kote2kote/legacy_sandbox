<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title></title>
</head>
<body>
<?php

    $password = 'system';

    print get_hashed_password($password);

    function get_hashed_password($password) {
        // コストパラメーター
        $cost = 10;
        // ランダムな文字列を生成します。
        $salt = strtr(base64_encode(random_bytes(16)), '+', '.');
        // ソルトを生成します。
        $salt = sprintf("$2y$%02d$", $cost) . $salt;
        $hash = crypt($password, $salt);
        return $hash;
    }
?>
</body>
</html>
