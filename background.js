var BASE_SPEED = 6, MAX_SPEED = 40, BASE_RADIUS = 10;
var bckDiv = document.getElementById("background");
var ball_count = 0, BALL_COUNT_MAX = 20;
var balls = [];

function Ball() {
	if(ball_count > BALL_COUNT_MAX)
		return;
	
	this.id = ball_count;
	this.x = Math.random() * (bckDiv.offsetWidth - BASE_RADIUS*2);
	this.y = Math.random() * (bckDiv.offsetHeight - BASE_RADIUS*2);
	this.speed = BASE_SPEED;
	this.theta = Math.random() * Math.PI * 2;
	this.radius = Math.random() * 25 + BASE_RADIUS;
	this.div = document.createElement("ball_" + ball_count++);
	this.styleDiv();
}

Ball.prototype.styleDiv = function() {
	this.div.className = "ball";
	this.div.style.height = this.radius*2 + "px";
  	this.div.style.width = this.radius*2 + "px";
  	this.div.style.top = this.x + "px";
  	this.div.style.left = this.y + "px";
	document.body.appendChild(this.div);
}

function isObstructed(a, b, radius) {
  	return (a < 0 || a + radius*2 > bckDiv.offsetWidth || b < 0 || b + radius*2 > bckDiv.offsetHeight);
}

function isTouching(ballA, ballB) {
    if(ballA == ballB)
        return false;
  
    var a_x = ballA.x + ballA.radius;
    var b_x = ballB.x + ballB.radius;
    var a_y = ballA.y + ballA.radius;
    var b_y = ballB.y + ballB.radius;
    
    return (Math.sqrt( Math.pow(a_x - b_x, 2) + Math.pow(a_y - b_y, 2) ) < ballA.radius + ballB.radius);
}

var step_x, step_y, xAndStep, yAndStep;
Ball.prototype.move = function() {
  	step_x = this.speed * Math.cos(this.theta);
  	step_y = this.speed * Math.sin(this.theta);
    xAndStep = this.x + step_x;
    yAndStep = this.y + step_y;
   
	if (!isObstructed(xAndStep, yAndStep, this.radius)) {
		this.x += step_x;
		this.y += step_y;
	} else {
		if(isObstructed(xAndStep, this.y, this.radius)) {
      
      		if((this.theta = Math.PI - this.theta) < 0)
          		this.theta += 2*Math.PI;
				
	  		//add the extra to move towards new theta
	  		if(xAndStep < 0)
	  			this.x = -xAndStep;
	  		else
	  			this.x = 2*(bckDiv.offsetWidth - this.radius*2) - xAndStep; 
		
    	}
		if(isObstructed(this.x, yAndStep, this.radius)) {
		    		
			this.theta = 2*Math.PI - this.theta;
			
			//have extra count towards new theta
			if(yAndStep < 0)
				this.y = -yAndStep;
			else
				this.y = 2*(bckDiv.offsetHeight - this.radius*2) - yAndStep;
			
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