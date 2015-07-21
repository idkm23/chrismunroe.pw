var BASE_SPEED = 6, MAX_SPEED = 40;
var bckDiv = document.getElementById("main");
var ball_count = 0, BALL_COUNT_MAX = 30;

function Ball() {
	if(ball_count > BALL_COUNT_MAX)
		return;
	
	this.id = ball_count;
	this.x = Math.random() * (bckDiv.offsetWidth - 100);
	this.y = Math.random() * (bckDiv.offsetHeight - 100);
	this.speed = BASE_SPEED;
	this.theta = Math.random() * Math.PI * 2;
	this.div = document.createElement("div" + ball_count++);
	this.styleDiv();
}

Ball.prototype.styleDiv = function() {
  	this.div.style.display = "none";
	this.div.style.height = "100px";
  	this.div.style.width = "100px";
  	this.div.style.background = "#aaf";
  	this.div.style.borderRadius = "50%";
  	this.div.style.position = "absolute";
  	this.div.style.top = this.x + "px";
  	this.div.style.left = this.y + "px";
  	this.div.style.cursor = "pointer";
  	this.div.style.zIndex = "-1";
	this.div.style.display = "block";
    this.div.style.opacity = ".4";
	document.body.appendChild(this.div);
}

function isObstructed(a, b) {
  	return (a < 0 || a + 100 > bckDiv.offsetWidth || b < 0 || b + 100 > bckDiv.offsetHeight);
}

var step_x, step_y, xAndStep, yAndStep;
Ball.prototype.move = function() {
  	step_x = this.speed * Math.cos(this.theta);
  	step_y = this.speed * Math.sin(this.theta);
    xAndStep = this.x + step_x;
    yAndStep = this.y + step_y;
   
	if (!isObstructed(xAndStep, yAndStep)) {
		this.x += step_x;
		this.y += step_y;
	} else {
		if(isObstructed(xAndStep, this.y)) {
      
      		if((this.theta = Math.PI - this.theta) < 0)
          		this.theta += 2*Math.PI;
				
	  		//add the extra to move towards new theta
	  		if(xAndStep < 0)
	  			this.x = -xAndStep;
	  		else
	  			this.x = 2*(bckDiv.offsetWidth - 100) - xAndStep; 
		
    	}
		if(isObstructed(this.x, yAndStep)) {
				
			this.theta = 2*Math.PI - this.theta;
			
			//have extra count towards new theta
			if(yAndStep < 0)
				this.y = -yAndStep;
			else
				this.y = 2*(bckDiv.offsetHeight - 100) - yAndStep;
			
		}
	}

	this.div.style.left = this.x + "px";
	this.div.style.top = this.y + "px";
	if(this.speed > BASE_SPEED) {
		this.speed -= .2;
	}
	
}

//sets up the balls
var balls = [];
while(ball_count < BALL_COUNT_MAX) {
	balls[ball_count] = new Ball();
}

function moveBalls() {
	for(j = 0; j < ball_count; j++) {
		balls[j].move();
	}
	setTimeout(moveBalls, 50);
}

moveBalls();
