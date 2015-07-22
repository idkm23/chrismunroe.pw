<?php header("Content-type: text/css; charset: UTF-8"); ?>


body {
	font-family: 'Montserrat', sans-serif;
}

/*######################
INC/NAVBAR
#######################*/

#main {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: -2;
  background-color: #C63D0F;
}

#navBar {
	margin: 0 0 0 0;
	background: #FDF3E7;
    text-align: center;
    height: 75px;
    line-height: 75px;
	border-bottom: 2px solid #3B3738;
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
    color: #3B3738;    
    font-size: 1.3em;
}

.menu a, .menu a:visited {
	color: #7E8F7C;
	text-decoration: none;
}

.menu a:hover {
	color: #8F9F8D;
}

#mainButton li:hover {
	background-color: #ECE2D6;
}

#mainButton li {	
	padding: 0 30px;  
}

#smallButton li {
	padding: 0 10px;
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
    color: #FDF3E7;
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
    background-color: #FDF3E7; //rgba(10, 10, 10, 0.5);
    border: 15px solid rgba(1, 1, 1, 0.1);
    color: #3B3738;
    
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
	color: #6D7E6B;
}

#abInWrap a:hover {
	color: #8F9F8D;	
}









