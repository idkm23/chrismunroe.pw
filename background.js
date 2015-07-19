var ball = document.getElementById("ball"),
  bckDiv = document.getElementById("ballWalls"),
  x = Math.random() * (bckDiv.offsetWidth - 100),
  y = Math.random() * (bckDiv.offsetHeight - 100),
  BASE_SPEED = 6, speed = BASE_SPEED, MAX_SPEED = 40,
  theta = Math.random() * Math.PI * 2,
  step_x, step_y;

function isObstructed(a, b) {
  return (a < 0 || a + 100 > bckDiv.offsetWidth || b < 0 || b + 100 > bckDiv.offsetHeight);
}

function move() {
  step_x = speed * Math.cos(theta);
  step_y = speed * Math.sin(theta);
  console.log(theta + " ");

  if (!isObstructed(x + step_x, y + step_y)) {
    x += step_x;
    y += step_y;
  } else {
    if(isObstructed(x + step_x, y)) {
      
	  if(x+step_x < 0)
	  	x = 0;
	  else
	  	x = bckDiv.offsetWidth - 100;
		
      if((theta = Math.PI - theta) < 0)
          theta += 2*Math.PI;
      
    } else {
        
		if(y+step_y < 0)
			y = 0;
		else
			y = bckDiv.offsetHeight - 100;
			
        theta = 2*Math.PI - theta;
      
    }
  }

  ball.style.left = x + "px";
  ball.style.top = y + "px";
  if(speed > BASE_SPEED) {
    speed -= .2;
  }
  setTimeout(move, 50);
}

function speedUp() {
  if(speed < MAX_SPEED)
    speed = speed * 2;
}

ball.style.left = x + "px";
ball.style.top = y + "px";
ball.style.display = "block";
move();

/*
function Meteor() {
	do {
		this.xMove = Math.round(Math.random() * 10) - 5;
		this.yMove = Math.round(Math.random() * 10) - 5;
	} while(this.xMove == 0 || this.yMove == 0);
	this.xMove = Math.round(Math.random() * 5);
	this.yMove = Math.round(Math.random() * 5);
	
	this.speed = Math.round(Math.random()*4);
	this.width = Math.abs(this.xMove)*Math.abs(this.yMove)/this.speed * 20;
	this.height = this.width;
	
	var loc = Math.random();
	if(loc < .25) {
		this.x = Math.round(Math.random() * (c.width + 100) - 50);
		this.y = -this.height;
	}
	else if(loc < .5){
		this.y = Math.round(Math.random() * (c.height + 100) - 50);
		this.x = -this.width;
	} else if(loc < .75) {
		this.x = Math.round(Math.random() * (c.width + 100) - 50);
		this.y = c.height + this.height;
	} else {
		this.y = Math.round(Math.random() * (c.width + 100) - 50);
		this.x = c.width + this.width;
	}
	this.frame = 1;	
	this.timer = 0;
	this.next = null;
	if(this.isRot = Math.floor(Math.random()*9) == 1) {
		this.unsXMove = this.xMove;
		this.unsYMove = this.yMove;	
		this.state = 1;				
	}
}

function calcPS(current) { 
	return Math.sqrt(Math.pow(current.xMove, 2) + Math.pow(current.yMove, 2)) / current.speed;
}

function add(head) {	
	var newMeat = new Meteor();
	if(head == null)
		return newMeat;
			
	if(calcPS(head) > calcPS(newMeat)) {	
		newMeat.next = head;
		return newMeat;
	}
	
	var temp = head;	
	while(temp.next != null) {
		if(calcPS(temp.next) > calcPS(newMeat))
			break;
		temp = temp.next;
	}
	
	if(temp.next != null) 
		newMeat.next = temp.next;
		
	temp.next = newMeat;
	return head;
}

function nodeEquals(node1, node2) {
	if(node1 == null || node2 == null)
		return false;
	return (node1.x === node2.x && node1.y === node2.y && node1.frame === node2.frame 
		&& node1.speed === node2.speed && node1.next === node2.next);
}

function del(delObj, head) {
	
	
	if(delObj == null || head == null)
		return head;
	
	if(nodeEquals(delObj, head)){		
		return head.next;
	}
	
	var temp = head;
	while(temp != null && temp.next != null) {
		if(nodeEquals(temp.next, delObj))
			temp.next = temp.next.next;	
		temp = temp.next;
	}
	
	return head;
}

var c=document.getElementById("myCanvas");
var ctx=c.getContext("2d");

function move(current) {		
	
	if(current.isRot == 1) {
		var TURN_RATE = current.width * 20;
		ctx.font = "30px Georgia";
		//ctx.fillText("ya: " + current.yMove, current.x + 60, current.y + 360);
		//ctx.fillText("uns: " + current.unsYMove, current.x + 60, current.y + 400);
		switch(current.state) {
			case 1:
				if(Math.abs(current.xMove -= current.unsXMove/TURN_RATE) < 0.001)
					current.state++;
				break;
			case 2:
				current.xMove -= current.unsXMove/TURN_RATE;
				if(Math.abs(current.yMove -= current.unsYMove/TURN_RATE) < .001)
					current.state++;
				break;
			case 3:
				current.xMove += current.unsXMove/TURN_RATE;
				if((current.yMove -= current.unsYMove/TURN_RATE) + current.unsYMove < .001)
					current.state++;
				break;
			case 4:
				current.xMove += current.unsXMove/TURN_RATE;
				if(Math.abs(current.yMove += current.unsYMove/TURN_RATE) < .001)
					current.state++;
				break;
			case 5:
				if(current.unsYMove - (current.yMove += current.unsYMove/TURN_RATE) < .001)
					current.state = 1;
				break;
		}
	}
	
	if(current !== null) {
		calcRotation(current);
	}
	
	if(current.timer == current.speed) {		
		current.y += current.yMove;
		current.x += current.xMove;			
		current.timer = 0;
		if(current.frame < 6)
			current.frame += .25;
		else
			current.frame = 1;
	} else {
		current.timer++;
	}
}

function findMatch(delObj, head) {
	if(head === null)
		return false;
	while(!nodeEquals(head, delObj) && head != null) {
		head = head.next;
	}
	if(nodeEquals(head.next, head.next))
		return true;
	
}

function calcRotation(current) {
	var image = new Image();
	image.src = "res/test" + Math.floor(current.frame) + ".png";
	var rotation = -Math.atan((-current.yMove)/current.xMove);
	if(current.xMove < 0)
		rotation += Math.PI; 
	
	ctx.save();
	ctx.translate(current.x, current.y); //move to the corner of the image
	ctx.translate(current.width/2, current.height/2);
	ctx.rotate(rotation - Math.PI/4);		
	ctx.drawImage(image, -current.width/2, -current.height/2, current.width, current.height);
	ctx.restore();
}

function outOfBounds(current) {
	if(current == null)
		return false;
		
	if(current.x > c.width+60 || current.x + current.width < -60)
		return true;
	
	if((current.y > c.height + 60) || (current.y + current.height < -60))
		return true;
		
	return false;
}

function findLength(head) {
	var count = 0;
	if(head == null)
		return 0;
	while(head !== null) {
		count++;
		head = head.next;
	}
	return count;
}

function update(head) {	
	ctx.clearRect(0, 0, c.width, c.height)
			
	if(.03 > Math.random())
		head = add(head);
	
	if(head != null)	
		move(head);
	if(outOfBounds(head)) {
		head = del(head, head);
	}
	
	var temp = head;
	while(temp != null && temp.next != null) {
		move(temp.next);
		if(outOfBounds(temp.next)) {
			head = del(temp.next, head);
		}
		temp = temp.next;		
	}
	
	return head;
}
var head = new Meteor(null);		
setInterval(function() { head = update(head) }, 0);
*/

