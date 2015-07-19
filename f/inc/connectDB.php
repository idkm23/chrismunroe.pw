<?php
	$conn = new mysqli('localhost', 'chrismun_main', 'DqyS+n]VKr~G', 'chrismun_forum'); //opens our connection with the server, username, password, and Database
		
	if($conn->connect_error) {
		die('Connection Failed: ' . $conn->connect_error); //if theres an error then connection failed
	}
?>
