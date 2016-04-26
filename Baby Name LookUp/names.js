/*
Stuti Sulgaonkar, Section: AK, Date: 12/3/2014
Hw 7: Baby Names
This is the Javascript connected with the names.html which loads information about
baby names dynamically when the user selects a name. 
*/

(function () { 
	"use strict"; 

	var GOOD_STATUS = 200; 

	window.onload = function() { 
		displayInformation("https://webster.cs.washington.edu/cse154/babynames.php?type=list", 
							displayoptions); 
		document.getElementById("search").onclick = getResults; 
	};

	//getResults is a function that sets up the information other functions will need to 
	//display information on the html and calls those functions. 
	function getResults() { 
		var results = document.getElementById("resultsarea"); 	
		var options = document.getElementById("allnames"); 
		var name = options.value; 
		var radio = document.getElementsByName("gender");
		var gender = ""; 
		for(var i = 0; i < radio.length; i++) { 
			if(radio[i].checked) { 
				gender = radio[i].value; 
			}
		} 
		
		//Functions to display information are only called if a name is actually selected and not
		// "(choose a name)"
		if(name.length > 0) { 			
			results.style.display = "block";

			resetDisplay("loadingmeaning", "meaning"); 		
			displayInformation("https://webster.cs.washington.edu/cse154/babynames.php?type=meaning&name=" +
								name, displayMeaning); 			

			resetDisplay("loadinggraph", "graph"); 		 
			document.getElementById("norankdata").style.display = "none"; 
			displayInformation("https://webster.cs.washington.edu/cse154/babynames.php?type=rank&name=" + 
								name + "&gender=" + gender, displayGraph);			
			
			resetDisplay("loadingcelebs", "celebs"); 		
			displayInformation("https://webster.cs.washington.edu/cse154/babynames.php?type=celebs&name=" + 
								name + "&gender=" + gender, displayCele); 
		}
	}

	//This function resets the display to appear and have cleared content 
	function resetDisplay(displaySection, innerContent) { 
		document.getElementById(displaySection).style.display = "block";
			document.getElementById(innerContent).innerHTML = ""; 
	}

	//This function is response for displaying the list of celebrities with the same first name as the baby name
	function displayCele() { 
		if(this.status == GOOD_STATUS) { 
			var data = JSON.parse(this.responseText).actors; 
			var ul = document.getElementById("celebs"); 
			
			for (var i = 0; i < data.length; i++) {
				var li = document.createElement("li"); 
				li.innerHTML = data[i].firstName + " " + data[i].lastName + " " + "(" + data[i].filmCount +
								" films" +")"; 
				ul.appendChild(li); 
			}				
		} else { 
			ajaxFailed(this.status, this.statusText, this.responseText); 
		}	
		document.getElementById("loadingcelebs").style.display = "none";
	}

	//This function is response for gathering the information for the graph that presents 
	//the popularity of the baby name. 
	function displayGraph() { 
		var table = document.getElementById("graph"); 
		
		if(this.status == GOOD_STATUS) { 
			var rank = this.responseXML.getElementsByTagName("rank");
			var tr1 = document.createElement("tr");
			var tr2 = document.createElement("tr"); 

			for (var i = 0; i < rank.length; i++) {
				var th = document.createElement("th"); 
				th.innerHTML = rank[i].getAttribute("year"); 
				tr1.appendChild(th); 
				var td = document.createElement("td"); 
				var div = document.createElement("div");
				var rate = rank[i].firstChild.nodeValue;
				div.innerHTML = rate; 
				style(div, rate); 
				td.appendChild(div); 
				tr2.appendChild(td); 				
			}

			table.appendChild(tr1); 
			table.appendChild(tr2); 

		} else { 
			if(this.status == 410) { 
				document.getElementById("norankdata").style.display = "block"; 
			} else { 
				ajaxFailed(this.status, this.statusText, this.responseText);
			}			
		}
		document.getElementById("loadinggraph").style.display = "none";
	}

	// This function styles the graph correctly. The heights of the bars in the graph
	// are set here. 
	function style(bar, rate) { 
		if(rate != 0) { 
			bar.style.height = parseInt((1000 - rate)/4) + "px"; 
		} else { 
			bar.style.height = 0;
		}

		if(rate >= 1 && rate <= 10) { 
			bar.style.color = "red";
		}
	}

	//This function displays the meaning of the baby name. 
	function displayMeaning() {		
		if(this.status == GOOD_STATUS) { 
			var definition = this.responseText; 
			var meaning = document.getElementById("meaning"); 
			meaning.innerHTML = definition; 		
		} else { 
			ajaxFailed(this.status, this.statusText, this.responseText); 
		}
		document.getElementById("loadingmeaning").style.display = "none";
	}

	//This function displays the options of names the users can select in the drop
	//down menu. 
	function displayoptions() { 
		if(this.status == GOOD_STATUS) { 
			var names = this.responseText.split("\n");
			var select = document.getElementById("allnames");
			select.disabled = false; 
			for(var i = 0; i < names.length; i++) { 
				var option = document.createElement("option");
				option.innerHTML = names[i]; 
				select.appendChild(option); 
			}
		} else {
			ajaxFailed(this.status, this.statusText, this.responseText); 
		}
		document.getElementById("loadingnames").innerHTML = ""; 
	}

	//This function sets up the Ajax call and it reads the file sent by the URL
	// and sends the ajax response text to the approriate function fn.   
	function displayInformation(url, fn) { 
		var ajax = new XMLHttpRequest(); 
		ajax.onload = fn; 
		ajax.open("GET",url, true); 
		ajax.send(null);	
	}

	//This function is called when an error occurs when the status of the ajax is 
	//something other than a 200 or a 410 error. Using the ajax's status, statusText,
	//and responseText this function displays that infomration in the errors section. 
	function ajaxFailed(status, statusText, responseText) {
		var msg = "Error making Ajax request: \n \n"; 
		msg += "Server status:\n" + status + " " + statusText +
				"\n\nServer response text:\n" + responseText; 
		document.getElementById("errors").innerHTML = msg; 		
	}
} ());