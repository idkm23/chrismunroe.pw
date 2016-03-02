var BASE_SPEED = 4, MAX_SPEED = 40, BASE_RADIUS = 10;
var bckDiv = document.getElementById("background");
var ball_count = 0, BALL_COUNT_MAX = 20;
var balls = [];

function Ball() {
	if(ball_count > BALL_COUNT_MAX)
		return;
	
	this.id = ball_count;
	this.vx = BASE_SPEED * (Math.random() - 0.5) * 2;
  this.vy = BASE_SPEED * (Math.random() - 0.5) * 2;
	this.radius = Math.random() * 25 + BASE_RADIUS;
  do {
	  this.x = Math.random() * (bckDiv.offsetWidth - this.radius*2);
	  this.y = Math.random() * (bckDiv.offsetHeight - this.radius*2);
  } while(isTouchingAny(this));
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

function distance(x1, y1, x2, y2) {
  return Math.sqrt(Math.pow(x1 - x2, 2) + Math.pow(y1 - y2, 2));
}

function isObstructed(a, b, radius) {
  	return (a < 0 || a + radius*2 > bckDiv.offsetWidth || b < 0 || b + radius*2 > bckDiv.offsetHeight);
}

function isTouchingAny(ball) {
  for(i = 0; i < ball_count; i++) {
          
        if(ball != balls[i] && isTouching(ball, balls[i]))
        {
          return true;
        }
  }
  
  return false;
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
  	
    newX = this.x + this.vx;
    newY = this.y + this.vy;
   
  //fixes newX and newY to bounce back from borders
		if(isObstructed(newX, this.y, this.radius)) {
      
        this.vx *= -1;
				
	  		//add the extra to move towards new theta
	  		if(newX < 0)
          newX *= -1;
	  		else
	  			newX = 2*(bckDiv.offsetWidth - this.radius*2) - newX; 
		
    	}
		if(isObstructed(this.x, newY, this.radius)) {
		    		
			this.vy *= -1;
			
			//have extra count towards new theta
			if(newY < 0)
				newY *= -1;
			else
				newY = 2*(bckDiv.offsetHeight - this.radius*2) - newY;
			
		}

    var oldX = this.x;
    var oldY = this.y;
    this.x = newX;
    this.y = newY;
  
	  var touched = false;
    //now that we are in a final position we compare it to other balls
    for(i = 0; i < ball_count; i++) {
          
        if(isTouching(this, balls[i]))
        {
            touched = true;
            var v1 = Math.sqrt(Math.pow(this.vx, 2) + Math.pow(this.vy, 2));
            var theta1 = Math.atan(this.vy/this.vx);
           
            var v2 = Math.sqrt(Math.pow(balls[i].vx, 2) + Math.pow(balls[i].vy, 2));
            var theta2 = Math.atan(balls[i].vy/balls[i].vx);
           
            
            var old_vx = this.vx;
            this.vx = (this.vx*(this.radius - balls[i].radius) + 2 * balls[i].radius
                      * balls[i].vx) / (this.radius + balls[i].radius);
            
            balls[i].vx = (balls[i].vx * (balls[i].radius - this.radius) 
                           + 2*this.radius*old_vx) / (this.radius + balls[i].radius);
          
            var old_vy = this.vy;
            this.vy = (this.vy*(this.radius - balls[i].radius) + 2 * balls[i].radius
                      * balls[i].vy) / (this.radius + balls[i].radius);
            
            balls[i].vy = (balls[i].vy * (balls[i].radius - this.radius) 
                           + 2*this.radius*old_vy) / (this.radius + balls[i].radius);
          
        } 
    }
    
  if(touched) {
    this.x = oldX;
    this.y = oldY;
  }
  
	this.div.style.left = this.x + "px";
	this.div.style.top = this.y + "px";
	
}

//sets up the balls
while(ball_count < BALL_COUNT_MAX) {
	balls[ball_count] = new Ball();
}

function moveBalls() {
	for(j = 0; j < ball_count; j++) {
		balls[j].move();
	}
  
	setTimeout(moveBalls, 10);
}

moveBalls();