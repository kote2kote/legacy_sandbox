<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>PHPのテスト</title>
</head>
<body>
メール受信：
<?php
$username = "xxxxxxxx";
$password = "xxxxxxxx";
$mailserver = "xxxxxxxx";

// POP3サーバ
$mailbox = @imap_open("{" . $mailserver . ":110/pop3}INBOX", $username, $password);

// IMAPサーバ
// $mailbox = @imap_open("{" . $mailserver . ":143/imap/novalidate-cert}INBOX", $username, $password);

// Gmailサーバ
// $mailbox = imap_open("{" . $mailserver . ":993/imap/novalidate-cert/ssl}INBOX", $username, $password);


if ($mailbox) {
    $mails = imap_check($mailbox);
    $count = $mails->Nmsgs;
    if ($count >= 1){
?>
メールは<?=$count?>件あります。<br>
<table border=1>
<tr><td>No</td><td>件名</td><td>日付</td><td>差出人</td><td>サイズ</td></tr>
<?php
        for ($num = 1; $num <= $count; $num++){
            $head = imap_header($mailbox, $num);
            $body = imap_body($mailbox, $num, FT_INTERNAL);
?>         <tr>
	       <td><?=$num?></td>
               <td nowrap><?=htmlspecialchars(mb_decode_mimeheader($head->subject), ENT_QUOTES)?></td>
               <td nowrap><?=$head->date?></td>
               <td nowrap><?=htmlspecialchars(mb_decode_mimeheader($head->fromaddress), ENT_QUOTES)?></td>
               <td nowrap><?=$head->Size?></td>
           </tr>
<?php
        }
?>
</table>
<?php
    }else{
?>
        新着メールはありません。<br>
<?php
    }
    imap_close($mailbox);
} else {
?>
ユーザー名またはパスワードが間違っています。
<?php
}
?>
</body>
</html>

