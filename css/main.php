<?php header("Content-type: text/css; charset: UTF-8"); ?>


body {
	font-family: 'Montserrat', sans-serif;
}

/*######################
INC/NAVBAR
#######################*/

#ball {
  display: none;
  height: 100px;
  width: 100px;
  background-color: #9c9;
  border-radius: 50%;
  position: absolute;
  top: 0px;
  left: 0px;
  cursor: pointer;
  z-index: -1;
}

#ballWalls {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: -2;
  background-color: #eee;
}

#myCanvas { 
	background: #224;
    //background: #532c58;
	position: fixed;
    z-index: -300;	
    top: 0;
    left: 0; 
	width: 100%;
    height: 100%;    
}

#navBar {
	margin: 50px 0 0 0;
	background: #222;
    text-align: center;
    height: 75px;
    line-height: 75px;
}

.menu {
	text-align: center;
    margin: 0;
    padding: 0;
    height: 100%;
    display: inline-block;   
}

.menu li {
	display: inline-block;	
    list-style-type: none;
    color: #eee;    
    font-size: 1.3em;
}

.menu a, .menu a:visited {
	color: #eee;
	text-decoration: none;
}

#mainButton li:hover {
	background-color: #333;
}

#mainButton li {	
	text-shadow: 2px 2px #111;
	padding: 0 30px;  
}

#smallButton li {
	padding: 0 10px;
}

.navIcon {
	font-family: 'Lobster', cursive;
    background-color: #000;
    border-radius: 50%;
    height: 45px;
    width: 45px;
    line-height: 45px;
}

.navIcon:hover {
	background-color: #eee;
    color: #000;
}

/*####################
HOME
#######################*/

#welcome {
	position: fixed;
    text-align: center;
    left: 50%;
    top: 40%;
    width: 100%;
    left: 50%;
    margin: 0 0 0 -50%;
    -webkit-transition: top .7s;
}

#welcome p, #welcome h1 {

    text-shadow: 1px 1px #aaa;
    color: #222;
    
}

/*##############################
ABOUT
################################*/

body {
	text-align: center;
}

#abWrap {
    overflow: hidden;
	display: inline-block;
    width: 60%;
    margin: 3% 0 0 0;
    background-color: rgba(10, 10, 10, 0.5);
    border: 15px inset rgba(50, 50, 50, 0.5);
    color: #eee;
    
    -webkit-animation-name: aPhase;
    -webkit-animation-iteration-count: once;
    -webkit-animation-timing-function: ease-out;
    -webkit-animation-duration: 1.2s;
}

@-webkit-keyframes aPhase {
	0% {
    	max-height: 0px;
    }
    100% {
    	max-height: 500px;
    }

}

#abInWrap {
	display: block;
    margin: 0 3%;
	text-align: left;
}

#abInWrap p {
	margin: 5%;
}

#abInWrap a, #abInWrap:visited{
	color: #eee;
}

#abInWrap a:hover {
	color: #ccf;	
}









