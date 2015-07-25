var BASE_SPEED = 6, MAX_SPEED = 40, RADIUS = 30;
var bckDiv = document.getElementById("main");
var ball_count = 0, BALL_COUNT_MAX = 20;
var balls = [];

function Ball() {
	if(ball_count > BALL_COUNT_MAX)
		return;
	
	this.id = ball_count;
	this.x = Math.random() * (bckDiv.offsetWidth - RADIUS*2);
	this.y = Math.random() * (bckDiv.offsetHeight - RADIUS*2);
	this.speed = BASE_SPEED;
	this.theta = Math.random() * Math.PI * 2;
	this.div = document.createElement("div" + ball_count++);
	this.styleDiv();
}

Ball.prototype.styleDiv = function() {
  	this.div.style.display = "none";
	this.div.style.height = RADIUS*2 + "px";
  	this.div.style.width = RADIUS*2 + "px";
  	this.div.style.background = "#77BA9B";
  	this.div.style.borderRadius = "50%";
  	this.div.style.position = "absolute";
  	this.div.style.top = this.x + "px";
  	this.div.style.left = this.y + "px";
  	this.div.style.cursor = "pointer";
  	this.div.style.zIndex = "-1";
	this.div.style.display = "block";
    this.div.style.opacity = ".7";
	document.body.appendChild(this.div);
}

function isObstructed(a, b) {
  	return (a < 0 || a + RADIUS*2 > bckDiv.offsetWidth || b < 0 || b + RADIUS*2 > bckDiv.offsetHeight);
}

function isTouching(ballA, ballB) {
    if(ballA == ballB)
        return false;
  
    var a_x = ballA.x + RADIUS;
    var b_x = ballB.x + RADIUS;
    var a_y = ballA.y + RADIUS;
    var b_y = ballB.y + RADIUS;
    
    return (Math.sqrt( Math.pow(a_x - b_x, 2) + Math.pow(a_y - b_y, 2) ) < RADIUS*2);
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
	  			this.x = 2*(bckDiv.offsetWidth - RADIUS*2) - xAndStep; 
		
    	}
		if(isObstructed(this.x, yAndStep)) {
		    		
			this.theta = 2*Math.PI - this.theta;
			
			//have extra count towards new theta
			if(yAndStep < 0)
				this.y = -yAndStep;
			else
				this.y = 2*(bckDiv.offsetHeight - RADIUS*2) - yAndStep;
			
		}
	}
    
    for(i = 0; i < ball_count; i++) {
        if(isTouching(this, balls[i]))
        {
            var delta_x = this.x - balls[i].x;
			var delta_y = this.y - balls[i].y;
			var pure_angle = Math.atan(delta_y / delta_x);
        
            this.theta = pure_angle;  
            balls[i].theta = Math.PI + pure_angle;
			    
			if((this.y < balls[i].y && delta_y / delta_x >= 0) 
                || (this.y >= balls[i].y && delta_y / delta_x < 0))
            {
                var hold = this.theta;  
                this.theta = balls[i].theta;
                balls[i].theta = hold;
            }
		}
    }
  
	this.div.style.left = this.x + "px";
	this.div.style.top = this.y + "px";
	if(this.speed > BASE_SPEED) {
		this.speed -= .2;
	}
	
}

//sets up the balls
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