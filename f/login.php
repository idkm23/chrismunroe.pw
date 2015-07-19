<?php 
	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		if(strpos($username, '\'') === false && strpos($password, '\'') === false) {
			include('inc/connectDB.php');
			
			$sql = sprintf("SELECT username FROM account WHERE username='%s' AND password='%s'", //sql goes here we are searching data
				$conn->real_escape_string($_POST['username']),
				$conn->real_escape_string($_POST['password']));	
			
					
			$success = $conn->query($sql)->fetch_assoc();
	
			if(isset($success)) {
				session_start();
				$_SESSION['login'] = $_POST['username'];
				header( 'Location: forum' );
			} else {
				header('Location: login?status=1');
				echo 'Error: ' . $sql . "<br>" . mysqli_error($conn);
			}
			
			
			mysqli_close($conn);
		} else {
			header('Location: login.php?status=2');
		}
		exit;
	}
	include('inc/navBar.php'); 
?>
	<div class = "enterAcc">
    	<h2>Sign in</h2>
        
        <?php if(isset($_GET['status'])) { ?>
        	<p id = "error">
            <?php
            	switch($_GET['status']) {
					case 1:
						echo "Username and/or password was incorrect";
						break;
					case 2:
						echo "No symbols!";
				}
			?>
            </p>
        <?php } ?>
        
        <form method = "post" action="login">
        	<table>
            	<tr>
                	<th><label for="username">Username</label></th>
                    <td><input type="text" name="username" id="username"></td>
            	</tr>
                <tr>
                	<th><label for="password">Password</label></th>
                    <td><input type="password" name="password" id="password"></td>
            	</tr>               
            </table>
            <input type="submit" value="Submit" id="submit">
        </form>
   		<a href="create.php"><p>Don't have an account?</p></a>
    </div>
</body>
</html>