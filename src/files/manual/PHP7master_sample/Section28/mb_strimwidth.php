<?php

$str    = "あいうえおかきくけこさしすせそたちつてと";
$result = mb_strimwidth($str, 0, 10, "...");
print $result;

?>
