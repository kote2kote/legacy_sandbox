<?php
if($dirhandle = opendir('.')) {
	while (false !== ($filename = readdir($dirhandle)))
	{
		print $filename . "<br>";
	}
	closedir($dirhandle);
}
?>
