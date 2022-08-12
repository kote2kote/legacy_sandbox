<?php
session_start();
if($_SESSION["uid"]!=""){
	//何もしない
} else {
	header("Location: ../");
	exit();
}
?>