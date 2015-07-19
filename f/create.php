<?php 
	function clean($string) {
		$string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
	
		return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
	}
		
	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		
		$username = clean($_POST['username']);
		$password = clean($_POST['password']);
		$email = $_POST['email'];
		
		if(strpos($username, '\'') === false && strpos($password, '\'') === false && strpos($email, '\'') === false) {
			if(strlen($username) < 6)	
				$error = 1;
			if(strlen($password) < 6)
				$error = 2;		
			if(strlen($email) < 6 || strpos($email, "@") === false || strpos($email, ".") === false)	
				$error = 3;
				
			if(isset($error)) {
				header( "Location: create?status={$error}" );//if all inputs were valid then
			} else {
				include('inc/connectDB.php');
				$sql = sprintf("INSERT INTO account ( access, username, password, email) 
				VALUES (0, '%s', '%s', '%s');",
					$conn->real_escape_string($username),
					$conn->real_escape_string($password),
					$conn->real_escape_string($email));	//sql goes here we are inserting data

				if($conn->query($sql) === true) {
					session_start();
					$_SESSION['login'] = $username;
					header( 'Location: forum' );
				} else if(strncmp($conn->error, 'Duplicate entry', 16)) {
					header( 'Location: create?status=4' );
				} else {
					echo 'Error: ' . $sql . "<br>" . $conn->error;
				}
				
				mysqli_close($conn);
			}
		} else {
			header('Location: create?status=5');		
		}
		exit;
	}
	include('inc/navBar.php'); 	
?>
	<div class = "enterAcc">
    	<h2>Sign up</h2>
        
		<?php if(isset($_GET['status'])) { ?>
        	<p id = "error">
            <?php
            	switch($_GET['status']) {
					case 1:
						echo "Usernames must be longer than 6 characters";
						break;
					case 2:
						echo "Password is too short";
						break;
					case 3:
						echo "Invalid email";
						break;
					case 4:
						echo "Username has been taken";
						break;
					case 5:
						echo "No symbols!";

				}
			?>
            </p>
        <?php } ?>
        
        <form method = "post" action="create">
        	<table>
            	<tr>
                	<th><label for="username">Username</label></th>
                    <td><input type="text" name="username" id="username"></td>
            	</tr>
                <tr>
                	<th><label for="password">Password</label></th>
                    <td><input type="password" name="password" id="password"></td>
            	</tr>
                <tr>
                	<th><label for="email">Email</label></th>
                    <td><input type="text" name="email" id="email"></td>
            	</tr>
            </table>
            <input type="submit" value="Submit" id="submit">
        </form>
                    
    </div>
</body>
</html>