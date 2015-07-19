<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<!--NAVBAR FOR FORUM-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel= "icon" href= "../res/slime.ico">
    <link rel = "stylesheet" href = "../css/normalize.css">
    <link rel = "stylesheet" href = "css/main.css">
    <link rel = "stylesheet" href = "css/responsive.css">
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <title>Forums</title>
</head>

<body>

<div id = "nav">
	<ul>
   		<a id = "chris" href = "../index"><li>chrismunroe.pw</li></a>
        <a href = "forum" id = "forumLink" ><li>Forum Home</li></a>
        <?php if(isset($_SESSION['login'])) { ?>
                	
            <a id = "dropDown"><li ><?php echo $_SESSION['login'];?><div id = "caret"></div></li></a>
            
            <ul id="smallMenu">
                <a href="profile?n=<?php echo $_SESSION['login']?>"><li>Profile</li></a>
                <a href="logout"><li>Logout</li></a>
            </ul>
                    
        <?php } else { ?>
        	<a href = "login"><li>Login</li></a> 
        <?php } ?>
    </ul>
</div>

<?php 