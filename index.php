<!DOCTYPE html>

<?php include('inc/navBar.php'); ?>

	<div id = "welcome">
    	<h1>Welcome</h1>
        <p>This is Kreestof's online playground. Enjoy your stay.</p>
    </div>
    
    <script>
		var welcome = document.getElementById('welcome');
		welcome.style.cursor = 'pointer';
		welcome.onclick = function() {
			welcome.style.cursor = 'initial';
			welcome.onclick = "";
			this.style.top = '38%';
			setTimeout(function() {
				var welcome = document.getElementById('welcome');
				welcome.style.transition = 'top 2s';
				welcome.style.top = '100%';
				setTimeout(function() {document.getElementById('welcome').style.display = 'none'}, 2000);
			}, 700);
		}
	</script>