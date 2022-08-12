<?php
//グローバルスコープの変数
$data = 5;

function scope_test() {
	global $data;
	//グローバルスコープの変数を参照 
	$data += 1;
	print $data;
	print "<br>";
}

print $data;
print "<br>";

scope_test();

print $data;
print "<br>";

?>
