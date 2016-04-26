/*
	Stuti Sulgaonkar, Section: AK, Date: 11/26/2014
	Hw 8: Fifteen Puzzle
	This is the Javascript connected with the fifteen.html that uploads the peices of the puzzle 
	and also is able to suffle the puzzle with the botton is pressed. This file is also responsible 
	for making the tiles move. 
*/

(function () { 
	"use strict"; 
	
	window.onload = function() { 	 
		createpuzzle(); 	
		document.getElementById("shufflebutton").onclick = shuffle;	
	};

	var TILE_HEIGHT = 100; 
	var PUZZLE_AREA = 400;
	var MAX_TILENUM = 15;  

	//This function is responsible for creating the puzzle board. 
	function createpuzzle() { 
		var puzzlearea = document.getElementById("puzzlearea");	
		var topsize = 0;
		var leftsize = 0; 
		var count = 1; 	
		
		while(topsize < PUZZLE_AREA ) {
			while(leftsize < PUZZLE_AREA && count <= MAX_TILENUM) { 
				//Creates the tile div and positions it correctly
				var tile = document.createElement("div"); 			
				tile.className = "tile";		
				tile.style.top = topsize + "px"; 
				tile.style.left = leftsize + "px";
				tile.id = topsize + "_" + leftsize; 
				//Sets up the appearance of this particular tile  
				tile.innerHTML = count;	
				var backgroundstring = "-" + leftsize + "px " + "-" + topsize + "px"; 
				tile.style.backgroundPosition = backgroundstring;
				//Sets up the handlers for the different events that can be taken on the tile
				tile.onclick = movetile;
				tile.onmouseover = highlight;
				tile.onmouseout = unhighlight;   		
				
				puzzlearea.appendChild(tile); 
				leftsize += TILE_HEIGHT; 
				count++; 
			}
			//This creates the a blank div to keep track of the empty space 
			if (count > MAX_TILENUM) { 
				var blank = document.createElement("div");
				blank.id = "blank"; 		 
				blank.style.top = topsize + "px"; 
				blank.style.left = leftsize + "px";
				puzzlearea.appendChild(blank);
			}				
			topsize += TILE_HEIGHT;
			leftsize = 0; 
		}			
	}
	
	//This function is used to shuffle the puzzle board
	function shuffle() {	 
		var y = 0; 
		var x = 1; 

		for(var j = 0; j < 1000; j++) { 
			var neighbors = []; 
			var blankinfo = getblank();
			//All the different options the blank tile can move to
			var options = [blankinfo.blank_y + "," + (blankinfo.blank_x - TILE_HEIGHT), 
							blankinfo.blank_y + "," +(blankinfo.blank_x + TILE_HEIGHT), 
							(blankinfo.blank_y - TILE_HEIGHT) + "," + blankinfo.blank_x, 
							(blankinfo.blank_y + TILE_HEIGHT)+ "," + blankinfo.blank_x]; 
		

			for (var i = 0; i < options.length; i++) {
				var cordinates = options[i].split(","); 
				if( !isNaN(parseInt(cordinates[y])) && !isNaN(parseInt(cordinates[x])) && 
					cordinates[y] != PUZZLE_AREA && cordinates[x] != PUZZLE_AREA &&
					cordinates[y] >= 0 && cordinates[x] >= 0) { 
					neighbors.push(options[i]);
				}		
			}

			var rand = parseInt(Math.random() * neighbors.length);
			var cordinates = neighbors[rand].split(","); 
			var cortop = cordinates[x];			
			var corleft = cordinates[y]; 
			switchTile(cortop, corleft); 		

		}
		
	}
	
	//This function is responsible for grabbing the right tile given the x and y coordinates.
	//And is also responsible for switiching the tile with the blank 
	function switchTile(top_x, left_y) { 
		var tile = document.getElementById(top_x + "_" + left_y); 
		var blank = document.getElementById("blank"); 
		var blankinfo = getblank(); 
		
		blank.style.top = top_x + "px"; 
		blank.style.left = left_y + "px"; 
		tile.style.top = blankinfo.blank_x + "px"; 
		tile.style.left = blankinfo.blank_y + "px";
		tile.id = blankinfo.blank_x + "_" + blankinfo.blank_y; 	
	}

	//Responsible for highlighting the tiles and switching cursors 
	function highlight() { 	
		var tiletop = parseInt(this.style.top); 
		var tileleft = parseInt(this.style.left);
		var isvalid = vaildmove(tileleft, tiletop); 

		if(isvalid) { 
			this.style.border = "5px solid red"; 
			this.style.color = "red";
			this.style.cursor = "pointer"; 
		} 
	}

	//This function is resposible for unhighlighting after hover is done 
	function unhighlight() { 
		this.style.border = "5px solid black"; 
		this.style.color = "black";
		this.style.cursor = "default"; 
	}

	//This function is called when a tile is asked to be moved by the user
	function movetile() { 		 
		var tiletop = parseInt(this.style.top); 
		var tileleft = parseInt(this.style.left); 	
		var isvalid = vaildmove(tileleft, tiletop); 
		
		if(isvalid) { 
			switchTile(tiletop, tileleft);										
		}		
	}

	//This function checks if the move is vaild (if there is actually a blank space next to the tile)
	function vaildmove(tileleft, tiletop) { 
		var blankinfo = getblank(); 	
		
		if(blankinfo.blank_y == tileleft) { 
			if (blankinfo.blank_x - TILE_HEIGHT == tiletop || blankinfo.blank_x + TILE_HEIGHT == tiletop) { 
				return true; 
			}
		} else if(blankinfo.blank_x == tiletop) {
			if(blankinfo.blank_y - TILE_HEIGHT == tileleft || blankinfo.blank_y + TILE_HEIGHT == tileleft) {
				return true; 
			}
		}
		return false; 
	}

	//This just gets infromation about the blank tile
	function getblank() { 
		var blank = document.getElementById("blank"); 	
		var toppos = parseInt(blank.style.top); 
		var leftpos = parseInt(blank.style.left);
		var array = {blank_x : toppos, blank_y : leftpos}; 

		return array;
	}
} ()); 
