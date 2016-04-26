/*
Stuti Sulgaonkar, Section: AK, Date: 11/19/2014
Hw 7: Ascii Animation Viewer
This is the Javascript connected with the ascii.html which reacts to the options
user choose such as the start and stop buttons, animation and size drop downs, 
and the speed radio buttons. 
*/

"use strict";

var count = 0;
var shots = null;
var timer = null; 
var time = 0; 

window.onload = function() { 
	document.getElementById("start").onclick = animate;
	document.getElementById("anima").onchange = displayArt; 
	document.getElementById("font").onchange = changeFont; 
	document.getElementById("stop").onclick = stopAnimation; 
	document.getElementById("turbo").onchange = speed; 
	document.getElementById("normal").onchange = speed; 
	document.getElementById("slo-mo").onchange = speed;
	time = document.getElementById("normal").value;  
	
};

//This function produces the next shots of the animation each time it is called
function startAnimation() { 	
	if(shots == null) { 
		var stringShots = document.getElementById("textarea").value;
		shots = stringShots.split("=====\n");
	}
 	
	document.getElementById("textarea").value = shots[count]; 
	
	if(shots.length-1 == count) {
		count = 0; 		 
	} else { 
		count++;		
	}	
} 

// This function stops the animation and returns the textarea back to it's origial state
// with all of the particular animations shots showing. 
function stopAnimation() { 
	clearInterval(timer); 
	document.getElementById("textarea").value = shots.join("=====\n");
	document.getElementById("start").disabled = false; 
	document.getElementById("anima").disabled = false; 
	shots = null; 
	count = 0; 
}

//This function is called first when the start button is clicked and sets the 
//interval for when to call the startAnimation funtion. 
function animate() { 
	timer = setInterval(startAnimation, time);	
	document.getElementById("start").disabled = true; 
	document.getElementById("anima").disabled = true;  		
}
//This function is called when the the user choses a certian animation and displays 
//all the shots of this animation in the textarea
function displayArt() { 
	var thisOne = document.getElementById("anima").value; 
	document.getElementById("textarea").value = ANIMATIONS[thisOne];	
}

//This function is called when the user decideds to change the font size of the ASCII
//font. Users are also able to custom their font size. All changes are effective 
//immediately as the textareas css is changed.  
function changeFont() { 
	var size = document.getElementById("font").value; 
	if(size == "custom") { 
		size = prompt("Font size to use? (e.g. 12pt)"); 
	}
	document.querySelector("textarea").style.fontSize = size; 
}

//This function is called when the users change the radio button of speed. This function
//resets the setInterval funtion to the timer the users want to use. 
function speed() { 	
	time = this.value; 
	clearInterval(timer);
	if(timer != null) { 
		timer = setInterval(startAnimation, time);
	}
	
}