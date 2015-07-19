<?php 
	session_start(); 
	$_SESSION['login'] = NULL;
	header('Location: forum');
?>