<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<meta charset="utf-8">
		<title>Chris Munroe</title>
		<link rel = "stylesheet" href = "css/normalize.css">
        <link rel= "icon" href= "res/slime.ico">
		<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
		<link rel = "stylesheet" href = "css/main.css">
        <link rel = "stylesheet" href = "css/responsive.css">
		<script src="http://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.6/prefixfree.min.js"></script>
		<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
	</head>
    
	<body>
		
        <div id = "background"></div>
        
    	<div id="navBar">
        	<ul id = "mainButton" class = "menu">
            	<a href = "index" title = "Home"><li>HOME</li></a>
                <a href = "about" title = "About"><li>ABOUT</li></a>
            </ul>
            
            <ul id = "smallButton" class = "menu">
                <li><a href = "resume.pdf" title = "Resume">
                	<span class="fa-stack fa-lg" >
                    	<i class="fa fa-circle fa-stack-2x" class="navIcon"></i>
                    	<i class="fa fa-file-pdf-o fa-stack-1x fa-inverse"></i>
                    </span>
                </a></li>
            	<li><a href = "http://www.github.com/idkm23" title = "Github">
                	<span class="fa-stack fa-lg" >
                    	<i class="fa fa-circle fa-stack-2x" class="navIcon"></i>
                    	<i class="fa fa-git fa-stack-1x fa-inverse"></i>
                    </span>
                </a></li>
                <li><a id = "email_me_button" title = "Email">
                	<span class="fa-stack fa-lg" >
                    	<i class="fa fa-circle fa-stack-2x" class="navIcon"></i>
                    	<i class="fa fa-envelope-o fa-stack-1x fa-inverse"></i>
                    </span>
                </a></li>
            </ul>
        </div>         
        
        <div id = "blackOverlay"></div>
        <div id = "emailBoxWrap" class = "hideEmail">
        	<div id = "emailBox">
                Email me at: idkm23@gmail.com
            </div>
        </div>
        
        <script src = "background.js"></script>
        
        <!-- Email-me script -->
		<script>
			$(document).ready(function() {
				var emailBoxWrap = $('#emailBoxWrap');
				
				//open uploadbox
				document.getElementById('email_me_button').onclick = function() {
					document.getElementById('blackOverlay').style.display = 'block';
					emailBoxWrap.toggleClass('showEmail');
					
				}
				//close box
				document.getElementById('blackOverlay').onclick = function() {
					emailBoxWrap.toggleClass('showEmail');
					document.getElementById('blackOverlay').style.display = 'none';
				}
			});
        </script>
