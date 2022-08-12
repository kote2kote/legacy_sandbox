<?php
//グローバルスコープの変数
$data = 5;

function scope_test() {
	//グローバルスコープの変数を参照 
	$GLOBALS['data'] += 1;
	print $GLOBALS['data'];
	print "<br>";
}

print $data;
print "<br>";

scope_test();

print $data;
print "<br>";

?>