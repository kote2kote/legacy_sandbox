<?php
$filelist = `ls -laF`; // Mac、Linux

// $filelist = `dir`;  // Windows
//$filelist = mb_convert_encoding($filelist, "UTF-8","SJIS");

print "<pre>";
print $filelist;
print "</pre>";

?>
