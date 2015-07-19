<?php 
	function accTitle($access) {
		switch($access) {
			case 0: 
				return 'Lame-o';
			case 1:
				return 'Premium User';
			case 2:
				return 'Admin';
			case 3:
				return 'K I N G';
			default:
				return 'Unknown';
		}
	}


	include('inc/navBar.php');

?>

<div id = "profile" > 
    
<?php

	if(strpos($_GET['n'], '\'') === false) {
		include('inc/connectDB.php');
		
		$sql = "SELECT access, username, password, email, about FROM account WHERE username='{$_GET['n']}'";
		
		$person = $conn->query($sql)->fetch_assoc();
		
		if(isset($person['username'])) {
?>	
        
            <div id = "picWrap">
            	<img id = "proPic" src = <?php 
					if(glob("res/profile/{$_GET['n']}.{jpg,jpeg,png,gif}", GLOB_BRACE)) {
						$hold = glob("res/profile/{$_GET['n']}.{jpg,jpeg,png,gif}", GLOB_BRACE);
						echo $hold[0];
					} else {
						echo "res/profile/default.png";
					}
				
				?>>
            	<?php if(isset($_SESSION['login']) && $_GET['n'] === $_SESSION['login']) { ?> 
                	<p><a id = "clickPic">Update profile picture</a></p>
                <?php } ?>
            </div>
            
            <div id = "text-wrap">
                <h1><?php echo $person['username'];?></h1>
                <p>Status: <?php echo accTitle($person['access']); ?></p>
                <p>Email: <?php echo $person['email']; ?></p>
                <h3>About me<?php if(isset($_SESSION['login']) && $_GET['n'] === $_SESSION['login']) { ?>
						<div id="pencil"></div>
					<?php } ?></h3>
                
                <p id = "aboutDesc" style = 'display: block;'><?php echo ((isset($person['about']))? $person['about']:"This about me has not been created yet.");?></p>
                <form action="upload" method="post" id="aboutIn" style = 'display: none;'>
                	<textarea name="aboutIn" maxlength = "600" cols = '50' rows = '3'></textarea>
                    <input type="submit" value="send" name="submit">
                </form>
            </div>
        </div>
		
        <div id = "uploadOverlay">      	
        </div>
        
        <div id = "uploadBox">
            <h1>Upload an image<a><div id = "x"></div></a></h1>
            <form action="upload" method="post" enctype = "multipart/form-data">          	
                <input type="file" name="fileToUpload" id="fileToUpload">
                <input type="submit" value="Upload Image" name="submit">
            </form>
        </div>
 
        
		<script>
			//open uploadbox
			document.getElementById('clickPic').onclick = function() {
				document.getElementById('uploadOverlay').style.display = 'block';
				var box = document.getElementById('uploadBox');
				box.style.opacity = '1';
				box.style.top = '40%';
			}
			//close box
			document.getElementById('uploadOverlay').onclick = document.getElementById('x').onclick = function() {
				document.getElementById('uploadBox').style.opacity = '0';
				document.getElementById('uploadBox').style.top = '0';
				document.getElementById('uploadOverlay').style.display = 'none';
			}
			//open about
			document.getElementById('pencil').onclick = function() {
				var descrip = document.getElementById('aboutDesc');
				var input = document.getElementById('aboutIn');
				if(descrip.style.display === 'block' && input.style.display === 'none') {
					descrip.style.display = 'none';
					input.style.display = 'block';
				} else if(descrip.style.display === 'none' && input.style.display === 'block') {
					descrip.style.display = 'block';
					input.style.display = 'none';
				}
			}
        </script>
        
	<?php } else { ?>
        	<p class = "notFound" >Profile not found.</p>
    <?php } 
	} else { ?>
		<p class = "notFound" >Profile not found.</p>	
	<?php } ?>
	
   	