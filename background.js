var BASE_SPEED = 6, MAX_SPEED = 40;
var bckDiv = document.getElementById("ballWalls");
var ball_count = 0;

function Ball() {
	if(ball_count > 20)
		return;
	
	this.id = ball_count;
	this.x = Math.random() * (bckDiv.offsetWidth - 100);
	this.y = Math.random() * (bckDiv.offsetHeight - 100);
	this.speed = BASE_SPEED;
	this.theta = Math.random() * Math.PI * 2;
	this.div = document.createElement("div" + ball_count++);
	styleDiv();
}

Ball.prototype.styleDiv = function() {
  	this.div.style.display = "none";
	this.div.style.height = "100px";
  	this.div.style.width = "100px";
  	this.div.style.background = "#9c9";
  	this.div.style.borderRadius = "50%";
  	this.div.style.position = "absolute";
  	this.div.style.top = this.x + "px";
  	this.div.style.left = this.y + "px";
  	this.div.style.cursor = "pointer";
  	this.div.style.zIndex = "-1";
	this.div.style.display = "block";
}

function isObstructed(a, b) {
  	return (a < 0 || a + 100 > bckDiv.offsetWidth || b < 0 || b + 100 > bckDiv.offsetHeight);
}

var step_x, step_y;
Ball.prototype.move = function() {
  	step_x = this.speed * Math.cos(this.theta);
  	step_y = this.speed * Math.sin(this.theta);

	if (!isObstructed(this.x + step_x, y + step_y)) {
		this.x += step_x;
		this.y += step_y;
	} else {
		if(isObstructed(this.x + step_x, this.y)) {
      
      		if((this.theta = Math.PI - this.theta) < 0)
          		this.theta += 2*Math.PI;
				
	  		//add the extra to move towards new theta
	  		if(this.x + step_x < 0)
	  			this.x = 0;
	  		else
	  			this.x = bckDiv.offsetWidth - 100; 
		
    	} else {
			
        	this.theta = 2*Math.PI - this.theta;
			
			//have extra count towards new theta
			if(this.y + step_y < 0)
				this.y = 0;
			else
				this.y = bckDiv.offsetHeight - 100;
			
		}
	}

	this.ball.style.left = x + "px";
	this.ball.style.top = y + "px";
	if(this.speed > BASE_SPEED) {
		this.speed -= .2;
	}
	
	//call next ball's move?
}

move();

/*
function speedUp() {
  if(speed < MAX_SPEED)
    speed = speed * 2;
}
*/