function openNav() {
    if(window.location == 'http://127.0.0.1/' || window.location == 'http://127.0.0.1/Register.html' || window.location == 'http://127.0.0.1/register.php' || window.location == "http://127.0.0.1/login.php" || window.location == 'http://127.0.0.1/index.html'){
        document.getElementById("mySidenav").style.width = "100%";
        document.getElementById("mySidenav").style.transition = "none";
        document.getElementById("mySidenav").style.backgroundImage = "linear-gradient(#6002ee,#ee6002)";
    }
    else{
        document.getElementById("mySidenav").style.width = "350px";
    }
}	

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}


function register(){
    window.location ='/Register.html';
}

function dropdown() {
    document.getElementById("dropcontent").classList.toggle("show");
}

function profile(){
    document.getElementById("grid-container").style.gridTemplateAreas = "'header header header header header header header header''profile profile profile profile profile profile profile profile''posts posts posts posts posts posts posts util'";
}

function logout(){
    document.cookie = "user=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
}

function request(url){
	//making a new http request
	var httpRequest = new XMLHttpRequest();

	//processing server response
	httpRequest.onreadystatechange = function(){
		try{

			//what to do with response
			if (httpRequest.readyState === XMLHttpRequest.DONE) {
				if (httpRequest.status === 200) {

					//processing outputted query
					var query = httpRequest.responseText;
					alert(query);
					var array = query.split("<br>");
					var out = []
					for (i = 0; i < array.length-1; i++){
						out.push(array[i].split(" "));
					}
					for (i = 0; i < array.length-1; i++){
						out[i][1] = out[i][1].replace(/_955f_/g," ");
						out[i][3] = out[i][3].replace(/_955f_/g," "); //perform a global replace
						out[i][4] = out[i][4].replace(/_955f_/g," ");
					}

					//setting cookies to the current pages newest and oldest posts
					var newPost= encodeURIComponent(out[0][1]);
					var oldPost = encodeURIComponent(out[out.length-1][1]);

					document.cookie = 'newPost = ' + newPost;
					document.cookie = 'oldPost = ' + oldPost;
																													
					//declaring variables for the feed
					var counter = 0;
					var divs = [];

					//creating the feed
					for (index = 0; index < array.length-1; index++){
						
						//setting the posts div to be the parent div
						var parent = document.getElementById("posts");

							//post div
							var post = document.createElement("div");
							post.setAttribute("id","post");
							post.setAttribute("class","post");
							parent.appendChild(post);
							
								//vote div
								
								var vote = document.createElement("div");
								vote.setAttribute("id","vote");
								vote.setAttribute("class","vote");
								post.appendChild(vote);
								
						
									//divs in vote div
									
									for (j = 0; j < 3; j++){
										divs[counter] =  document.createElement("div");
										divs[counter].setAttribute("id","div" + counter);
										
											
										if(j == 0){
											//append upvote button
											vote.appendChild(divs[counter]);
										}
										
										else if (j == 1){
											
											votesi = document.createTextNode(out[index][2]);
											divs[counter].appendChild(votesi);
											vote.appendChild(divs[counter]);
											
										}
										
										else if (j == 2){
											//append downvote button
											vote.appendChild(divs[counter]);
										}
										counter +=1;
									}
								
								//title div
								var title = document.createElement("div");
								title.setAttribute("id","title");
								title.setAttribute("class","title");
									var titlei = document.createTextNode(out[index][3]);
									title.appendChild(titlei);
								post.appendChild(title);
								
								//content div
								var content = document.createElement("div");
								content.setAttribute("id","content");
								content.setAttribute("class","content");
									var contenti = document.createTextNode(out[index][4]);
									content.appendChild(contenti);
								post.appendChild(content);
								
								//subbar div
								var subbar = document.createElement("div");
								subbar.setAttribute("id","subbar");
								subbar.setAttribute("class","subbar");
									var testsubbar = document.createTextNode("testestest");
									subbar.appendChild(testsubbar);
								post.appendChild(subbar);
					}
					
					
					//if page is home make button to go forward a page
					if (window.location.pathname == '/profile.php' || window.location.pathname == '/home.php'){
						//make a div to put the button in
						var feednav = document.createElement("div");
						feednav.setAttribute("id","feednav");
						feednav.setAttribute("class","feednav"); //make this class and make it inline
						posts.appendChild(feednav);
						
						//make button to go forward a page
						 var forward = document.createElement("button");
						 forward.setAttribute("onclick","forward()"); // make this function
						 forward.setAttribute("id","forward");
						 forward.setAttribute("class","forward"); //do this css
						 var ftext = document.createTextNode("next >");
						 forward.appendChild(ftext);
						 feednav.appendChild(forward);
					}

					else if (array.length == 50){
						//make a div to put the button in
						var feednav = document.createElement("div");
						feednav.setAttribute("id","feednav");
						feednav.setAttribute("class","feednav"); //make this class and make it inline
						posts.appendChild(feednav);
						
						//make button to go forward a page
						var forward = document.createElement("button");
						forward.setAttribute("onclick","forward()"); // make this function
						forward.setAttribute("id","forward");
						forward.setAttribute("class","forward"); //do this css
						var ftext = document.createTextNode("next >");
						forward.appendChild(ftext);
						feednav.appendChild(forward);

						 //make button to go back a page
						 var back = document.createElement("button");
						 back.setAttribute("onclick","back()"); // make this function
						 back.setAttribute("id","back");
						 back.setAttribute("class","back"); //do this css
						 var btext = document.createTextNode("< prev");
						 back.appendChild(btext);
						 feednav.appendChild(back);
					}
					else if (array.length < 50){
						//make a div to put the button in
						var feednav = document.createElement("div");
						feednav.setAttribute("id","feednav");
						feednav.setAttribute("class","feednav"); //make this class and make it inline
						posts.appendChild(feednav);

						//make button to go back a page
						var back = document.createElement("button");
						back.setAttribute("onclick","back()"); // make this function
						back.setAttribute("id","back");
						back.setAttribute("class","back"); //do this css
						var btext = document.createTextNode("< prev");
						back.appendChild(btext);
						feednav.appendChild(back);
					}
				} 
				else {
					alert('There was a problem with the request.');
				}
			}
		}
		catch(error){
			console.log('Caught Exception: ' +error.description);
		}
	};
	
	//making request to the server

	httpRequest.open('GET', url, true);
	httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	httpRequest.send();	
	return httpRequest.responseText;
}

function forward(){
	document.cookie = "direction = forward";
	document.getElementById(posts).innerHTML = "";
	request('feed.php');

}

function back(){
	document.cookie = "direction = back";
	document.getElementById(posts).innerHTML = "";
	request('feed.php');

}

function feed(){
	if (window.location.pathname == '/profile.php'){
		document.cookie = "page=profile; path=/; domain=127.0.0.1";
	}
	else if (window.location.pathname == '/home.php'){
		document.cookie = "page=home; path=/; domain=127.0.0.1";
	}

	request('feed.php');
			
}

//Loops through and shutsdown dropdown elements
window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}
