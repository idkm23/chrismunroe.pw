<?php 
	session_start();
	if(isset($_SESSION['login'])) {
		include('inc/connectDB.php');
		if(isset($_POST['title']) && strlen($_POST['title']) > 0 && strlen($_POST['content']) > 0 && !isset($_GET['p'])) {
			$sql = "SELECT `AUTO_INCREMENT` FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'chrismun_forum' AND TABLE_NAME = '{$_GET['t']}'";
            $result = $conn->query($sql)->fetch_array(MYSQLI_NUM);
			
			$sql = sprintf("INSERT INTO {$_GET['t']} (author, title, detail, parent_id) VALUES('{$_SESSION['login']}', '%s', '%s', {$result[0]})",
				$conn->real_escape_string($_POST['title']),
				$conn->real_escape_string($_POST['content']));
			$conn->query($sql);
			header('Location: forum?t='.$_GET['t']."&p=".$result[0]);
			exit;
		} else if(isset($_POST['content'])&&isset($_GET['p']) && strlen($_POST['content']) > 0 ) {
			$sql = sprintf("INSERT INTO {$_GET['t']} (author, detail, parent_id) VALUES('{$_SESSION['login']}', '%s', {$_GET['p']})",
				$conn->real_escape_string($_POST['content']));
			$conn->query($sql);
			header('Location: forum?t='.$_GET['t']."&p=".$_GET['p'].'#threadPoster');
			exit;
		}
	}
	$goBack = (isset($_GET['t'])) ? "?t=".$_GET['t'] : NULL;
	$goBack = ($goBack === NULL) ? 
		( (isset($_GET['p'])) ? "?p=".$_GET['p'] : NULL ) 
		: 
		$goBack.( (isset($_GET['p'])) ? "&p=".$_GET['p'] : "" ) ;
		
	header('Location: forum'.(($goBack === NULL) ? "" : $goBack ));
?>