<?php

$pathname = pathinfo(__FILE__);
print $pathname['dirname']    . "<br>";
print $pathname['basename']   . "<br>";
print $pathname['extension']  . "<br>";


?>