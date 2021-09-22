//This is the main javascript file which contains all the functions which each and every page on the website uses in order to have functionality

//opens the sidemenu for the user when clicked and allows the user a selection of links to go to different pages when called
function openNav() {
	//if the page is the login or registration page, open the sidemenu and make it cover the screen with no transition and make the background colour a gradient between one colour to the next
    if(window.location == 'http://127.0.0.1/' || window.location == 'http://127.0.0.1/Register.html' || window.location == 'http://127.0.0.1/register.php' || window.location == "http://127.0.0.1/login.php" || window.location == 'http://127.0.0.1/index.html'){
        document.getElementById("mySidenav").style.width = "100%";
        document.getElementById("mySidenav").style.transition = "none";
        document.getElementById("mySidenav").style.backgroundImage = "linear-gradient(#6002ee,#ee6002)";
    }
	//else make the sidemenu come out 350 pixels from the right side of the screen
    else{
        document.getElementById("mySidenav").style.width = "350px";
    }
}	

//closes the sidemenu when called
function closeNav() {
	//make the sidemeny dissapear by changing its width to 0
    document.getElementById("mySidenav").style.width = "0";
}

//changes the page to Register.html when called
function register(){
    window.location ='/Register.html';
}

//displays the dropdown menu when called by changing a property to show
function dropdown() {
    document.getElementById("dropcontent").classList.toggle("show");
}

//when called make the template for divs equal to that displayed below so each div with name x goes into location y
function profile(){
    document.getElementById("grid-container").style.gridTemplateAreas = "'header header header header header header header header''profile profile profile profile profile profile profile profile''posts posts posts posts posts posts posts util'";
}

//when called split the cookies array on ; and for each cookie in array, set the variable cookie to the current position in the cookies array and set the equal position to the index of the = in cookie.
//then set the name variable to the substring between the first character of the cookie string to the equal position if the equal position is greater than -1 and else set name to cookie
//after that set the found cookie to expire therefore deleting the cookie
function logout(){
    var cookies = document.cookie.split(";");

    for (var i = 0; i < cookies.length; i++) {
        var cookie = cookies[i];
        var eqPos = cookie.indexOf("=");
        var name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
        document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT";
    }
}

//when called request creates the feed for the homepage and the feed for a users specific profile page
function request(url){
	//making a new http request
	var httpRequest = new XMLHttpRequest();

	//processing server response after data is sent and returned from the php file
	httpRequest.onreadystatechange = function(){
		try{

			//what to do with response
			if (httpRequest.readyState === XMLHttpRequest.DONE) {
				//if the request passes then 
				if (httpRequest.status === 200) {
					//processing outputted query
					//get the query 					
					var query = httpRequest.responseText;
					//split the query on each new line
					var array = query.split("<br>");
					//create an array called out
					var out = []
					// for length of array -1 append the current element as an array of elements split on the space, creating a 2d array for each field
					for (i = 0; i < array.length-1; i++){
						out.push(array[i].split(" "));
					}
					for (i = 0; i < array.length-1; i++){
						out[i][1] = out[i][1].replace(/_955f_/g," ");
						out[i][3] = out[i][3].replace(/_955f_/g," "); //perform a global replace of spaces in the title, post and datecreated, not in order of the replaces on the left
						out[i][4] = out[i][4].replace(/_955f_/g," ");
					}

					//declaring variables for the feed
					var counter = 0;
					var divs = [];

					document.getElementById("posts").innerHTML="";

					//creating the feed
					for (index = 0; index < array.length-1; index++){
						
						//setting the posts div to be the parent div
						var parent = document.getElementById("posts");

							//post div
							var post = document.createElement("div"); //create a post div
							post.setAttribute("id","post");	//give it an id and a class for js and css to use
							post.setAttribute("class","post");
							parent.appendChild(post); //append it to the posts div
							
								//vote div
								
								var vote = document.createElement("div");	//create a vote div
								vote.setAttribute("id","vote"); //give it an id and a class for js and css to use
								vote.setAttribute("class","vote");
								post.appendChild(vote); // append it to the post div
								
						
									//divs in vote div
									
									//create 3 divs to be appended to vote
									for (j = 0; j < 3; j++){
										//set divs[counter] to a newly created div and give it the attribute id set to a string called div with the current counter appended on the end
										divs[counter] =  document.createElement("div");
										divs[counter].setAttribute("id","div" + counter);
										
										//if current index is 0
										if(j == 0){
											//append a div
											vote.appendChild(divs[counter]);
										}
										
										//if current index is 1
										else if (j == 1){
											
											votesi = document.createTextNode(out[index][0]); //create a text node containing the post number and append it to the vote divs.
											divs[counter].appendChild(votesi);
											vote.appendChild(divs[counter]);
											
										}
										
										//if current index is 2
										else if (j == 2){
											//append a div
											vote.appendChild(divs[counter]);
										}
										counter +=1; // add one to the counter
									}
								
								//title div
								var title = document.createElement("div"); //create a div and set the variable title to it
								title.setAttribute("id","title"); //give it attributes to be used by js and css
								title.setAttribute("class","title");
									var titlei = document.createTextNode(out[index][3]); //create a text node containing the title of the current post
									title.appendChild(titlei); //append the text node to the title div
								post.appendChild(title); //append the title div to the post div
								
								//content div
								var content = document.createElement("div"); //create a div and set the variable content to it
								content.setAttribute("id","content"); //give it attributes to be used by js and css
								content.setAttribute("class","content");
									var contenti = document.createTextNode(out[index][4]); //create a text node containing the contents of the current post
									content.appendChild(contenti);//append the text node to the content div
								post.appendChild(content); //append the content div to the post div
								
								//subbar div
								var subbar = document.createElement("div"); //create a div and set the variable subbar to it
								subbar.setAttribute("id","subbar"); //give it attributes to be used by js and css
								subbar.setAttribute("class","subbar");
									var createdby = document.createTextNode("Created by "); //create a text node called created by and append it to the subbar
									subbar.appendChild(createdby);
									var username = document.createElement("a");//create a link and set it to the profile page of the user who created the post
									username.setAttribute("href", "profile.php");
									username.setAttribute("onclick","probeprofile('" + out[index][5] + "')");  //make it so that when clicked it calls the function probeprofile and passes the creator of the post to the function
									var usernamehtml = document.createTextNode(out[index][5]); //create a text node containing the name of the user who created the post
									username.appendChild(usernamehtml); //append to the end of the link the name of the user who created the post
									subbar.appendChild(username); //append the link to the subbar
									var datecreated = document.createTextNode(" at " + out[index][1]);// create a text node containing the date when the post was created
									subbar.appendChild(datecreated); //append the date the post was created to the subbar
								post.appendChild(subbar); //append the subbar to the post
					}
					
					//getting pageno cookie contents
					var pageno = document.cookie.replace(/(?:(?:^|.*;\s*)pageno\s*\=\s*([^;]*).*$)|^.*$/, "$1");
					//if page is home make button to go forward a page
					//if the number of posts on the page is 50 and the pageno is 0 do
					if (out.length == 50 && pageno == 0){
						//make a div called feednav to put the button in and give it the attributes id set to feednav
						var feednav = document.createElement("div");
						feednav.setAttribute("id","feednav");
						
						posts.appendChild(feednav); // append to the posts div feednav
						
						//make button to go forward a page
						 var forward = document.createElement("button"); //create a button called forward and give it attributes to be used by js and css
						 forward.setAttribute("onclick","forward()"); // when button is clicked call the forward function
						 forward.setAttribute("id","forward");
						 var ftext = document.createTextNode("next >");//create a text node called ftext and have it contain "next >"
						 forward.appendChild(ftext); //append ftext to the forward button
						 feednav.appendChild(forward); // append to feednav the forward button
					}
					
					//else if the number of posts on the page is 50 do
					else if (out.length == 50){
						//make a div called feednav to put the button in and give it the attributes id set to feednav
						var feednav = document.createElement("div");
						feednav.setAttribute("id","feednav");
						
						posts.appendChild(feednav);
						
						 //make button to go back a page
						 var back = document.createElement("button");//create a button called back and give it attributes to be used by js and css
						 back.setAttribute("onclick","back()"); // when button is clicked call the back function
						 back.setAttribute("id","back");
						 back.setAttribute("class","back"); 
						 var btext = document.createTextNode("< prev");//create a text node called btext and have it contain "< prev"
						 back.appendChild(btext); //append btext to the forward button
						 feednav.appendChild(back); // append to feednav the back button

						 //make button to go forward a page
						 var forward = document.createElement("button");//create a button called forward and give it attributes to be used by js and css
						 forward.setAttribute("onclick","forward()"); // when button is clicked call the forward function
						 forward.setAttribute("id","forward");
						 forward.setAttribute("class","forward");
						 var ftext = document.createTextNode("next >");//create a text node called ftext and have it contain "next >"
						 forward.appendChild(ftext);//append ftext to the forward button
						 feednav.appendChild(forward);// append to feednav the forward button
					}
					
					//else if the number of posts is less than 50 and we are not on the first page
					else if (out.length < 50 && pageno != 0){
						//make a div called feednav to put the button in and give it the attributes id set to feednav
						var feednav = document.createElement("div");
						feednav.setAttribute("id","feednav");
						
						posts.appendChild(feednav);

						//make button to go back a page
						var back = document.createElement("button");//create a button called back and give it attributes to be used by js and css
						back.setAttribute("onclick","back()"); // when button is clicked call the back function
						back.setAttribute("id","back");
						back.setAttribute("class","back"); 
						var btext = document.createTextNode("< prev");//create a text node called btext and have it contain "< prev"
						back.appendChild(btext);//append btext to the forward button
						feednav.appendChild(back);// append to feednav the back button
										
					}

					document.getElementById("posts").innerHTML += "<br>";//append a newline to the end of the posts div

					
				} 
				//else if the request did not pass
				else {
					alert('There was a problem with the request.'); //alert that there was an error with the request
				}
			}
		}
		//catch the error and send to console the error
		catch(error){
			console.log('Caught Exception: ' +error.description);
		}
	};
	
	//making request to the server

	httpRequest.open('POST', url, true);// open a request to the php file
	//getting cookies
	var pageno = document.cookie.replace(/(?:(?:^|.*;\s*)pageno\s*\=\s*([^;]*).*$)|^.*$/, "$1");
	var sortmethod = document.cookie.replace(/(?:(?:^|.*;\s*)sortmethod\s*\=\s*([^;]*).*$)|^.*$/, "$1");
	var page = document.cookie.replace(/(?:(?:^|.*;\s*)page\s*\=\s*([^;]*).*$)|^.*$/, "$1");
	var package = [pageno,sortmethod,page]; //putting cookies into an array called pacakage to be sent to the php file as you can't send more than one variable in js for some reason
	httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');//saying what type of file is going to be sent to the php file
	httpRequest.send('package=' + encodeURIComponent(package));	//sending the request to the php file
}

function sortnew(){
	document.cookie = "sortmethod = New";//setting the sortmethod cookie to New
	document.getElementById("posts").innerHTML = ""; //emptying the posts div
	request('feed.php');//calling the feed function to populate the div
}

function sortold(){
	document.cookie = "sortmethod = Old";//setting the sortmethod cookie to Old
	document.getElementById("posts").innerHTML = "";//emptying the posts div
	request('feed.php');//calling the feed function to populate the div
}

function forward(){
	var pageno = document.cookie.replace(/(?:(?:^|.*;\s*)pageno\s*\=\s*([^;]*).*$)|^.*$/, "$1");//getting the contents of the pageno cookie
	pageno = Number(pageno) + 50;//adding 50 to the pageno contents
	document.cookie = "pageno = " + pageno;//setting the pageno cookies to the new pageno contents
	document.getElementById("posts").innerHTML = "";//emptying the posts div
	request('feed.php');//calling the feed function to populate the div

}

function back(){
	var pageno = document.cookie.replace(/(?:(?:^|.*;\s*)pageno\s*\=\s*([^;]*).*$)|^.*$/, "$1");//getting the contents of the pageno cookie
	pageno = Number(pageno) - 50;//subtracting 50 from the pageno contents
	document.cookie = "pageno = " + pageno;//setting the pageno cookies to the new pageno contents
	document.getElementById("posts").innerHTML = "";//emptying the posts div
	request('feed.php');//calling the feed function to populate the div

}

function feed(){
	//if the pathname is profile then set the page cookie to profile
	if (window.location.pathname == '/profile.php'){
		document.cookie = "page=profile; path=/; domain=127.0.0.1";
	}
	//if the pathname is home then set the home cookie to home
	else if (window.location.pathname == '/home.php'){
		document.cookie = "page=home; path=/; domain=127.0.0.1";
	}

	request('feed.php');//calling the feed function to populate the div
				
}

//reset function when called resets the pageno, sortmethod and probepage cookies to their defaults
function reset(){
	document.cookie = "pageno = 0";
	document.cookie = "sortmethod = New";
	document.cookie = "probepage = " + document.cookie.replace(/(?:(?:^|.*;\s*)user\s*\=\s*([^;]*).*$)|^.*$/, "$1");
}

//outputs a msg into the posts div by first emptying it and then displaying the set msg
function follows(){
	document.getElementById("posts").innerHTML="";
	document.getElementById("posts").innerHTML="The follows page is a work in progress";
}

//outputs a msg into the posts div by first emptying it and then displaying the set msg
function followers(){
	document.getElementById("posts").innerHTML="";
	document.getElementById("posts").innerHTML="The followers page is a work in progress";
}

function search(){
	//processing outputted query
	//get the query from the econtents of the post div
	var query = document.getElementById("posts").innerHTML;
	var error = document.cookie.replace(/(?:(?:^|.*;\s*)error\s*\=\s*([^;]*).*$)|^.*$/, "$1");//get the contents of the error cookie
	if (error == "none"){//if the contents of the error cookie is none
		var array = query.split("<br>");//split the output of the query on newline and append it to a variable called array, as an array is created from this splitting process
		var out = [];//create an array called out
		for (i = 0; i < array.length-1; i++){// for length of array -1 append the current element as an array of elements split on the space, creating a 2d array for each field
			out.push(array[i].split(" "));
		}
		document.getElementById("posts").innerHTML = "";//empty the feed after getting its contents
		//creating the feed
		for (index = 0; index < array.length-1; index++){
			
			//setting the posts div to be the parent div
			var parent = document.getElementById("posts");

				//search div
				var post = document.createElement("div");//create a post div
				post.setAttribute("id","post");//give it an id and a class for js and css to use
				post.setAttribute("class","post");								
				
				
					//data div								
					var vote = document.createElement("div");//create a vote div
					vote.setAttribute("id","vote");//give it an id and a class for js and css to use
					vote.setAttribute("class","vote");
					
						
					//username div
					var user = document.createElement("div");//create a div and set the variable user to it
					user.setAttribute("id","title");//give it attributes to be used by js and css
					user.setAttribute("class","title");
						var useri = document.createElement("a");//create a link element
						useri.setAttribute("href", "profile.php");//give it attributes like a link and what to do when clicked
						useri.setAttribute("onclick","probeprofile('" + out[index][1] + "')");//when clicked execute probeprofile, passing the name of the user to probe profile
						var userj = document.createTextNode(out[index][1]);//create a textnode containing the searched users username
						useri.appendChild(userj);//append the text node to the link
						user.appendChild(useri);//append the link to the user div(title div)
					
					
					//about friend div
					var content = document.createElement("div");//create a div and set the variable content to it
					content.setAttribute("id","content");//give it attributes to be used by js and css
					content.setAttribute("class","content");
						out[index][2] = out[index][2].replace(/_955f_/g," ");//replace all _955f_ with a space
						var contenti = document.createTextNode(out[index][2]);//create a text node containing the bio of the user
						content.appendChild(contenti);//append the bio to the content div
					
			//appending divs
			parent.appendChild(post);
			post.appendChild(vote);
			post.appendChild(user);
			post.appendChild(content);
		}
	}
}

//when called change probepage cookie to the parameter 'profile' passed to the function
function probeprofile(profile){
	document.cookie = "probepage = " + profile;
}

function about(){
	//making a new http request
	var httpRequest = new XMLHttpRequest();

	//processing server response after data is sent and returned from the php file
	httpRequest.onreadystatechange = function(){
		try{

			//what to do with response
			if (httpRequest.readyState === XMLHttpRequest.DONE) {
				//if the request passes then 
				if (httpRequest.status === 200) {
					//processing outputted query
					//get the query 					
					var query = httpRequest.responseText;
					document.getElementById("posts").innerHTML = "";//empty the feed div
					document.getElementById("posts").innerHTML = query;//make the feed div the query
				} 
				//else if the request did not pass
				else {
					alert('There was a problem with the request.'); //alert that there was an error with the request
				}
			}
		}
		//catch the error and send to console the error
		catch(error){
			console.log('Caught Exception: ' +error.description);
		}
	};
	
	//making request to the server

	httpRequest.open('POST', "about.php", true);// open a request to the php file
	httpRequest.send();	//sending the request to the php file

}

//Loops through and shutsdown dropdown elements
window.onclick = function(event) {
//if an event occurs that is not on the dropbtn class
    if (!event.target.matches('.dropbtn')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");//setting a variable to a class list
        var i;//creating a variable called i
        for (i = 0; i < dropdowns.length; i++) { //for length of dropdown, open dropdown = current dropdown element, remove the show attribute from the class if open dropdown contains show
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}
