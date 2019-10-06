/********** Helper functions **********/

function setCookie(name,value,days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days*24*60*60*1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "")  + expires + "; path=/";
}
function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}
function eraseCookie(name) {   
    document.cookie = name+'=; Max-Age=-99999999;';  
}
function updateAuctionTime(el,v){
    	el.html(v);
    }
function getcd(wxy,did){
let x = setInterval(function() { 
let now = new Date().getTime(); 
let t = wxy - now; 
let days = Math.floor(t / (1000 * 60 * 60 * 24)); 
let hours = Math.floor((t%(1000 * 60 * 60 * 24))/(1000 * 60 * 60)); 
let minutes = Math.floor((t % (1000 * 60 * 60)) / (1000 * 60)); 
let seconds = Math.floor((t % (1000 * 60)) / 1000); 
document.getElementById(did).innerHTML = days + "d "  
+ hours + "h " + minutes + "m " + seconds + "s "; 
    if (t < 0) { 
        clearInterval(x); 
        document.getElementById(did).innerHTML = "ENDED"; 
		if(typeof(ertyw) === 'undefined' || ertyw === null){}
		else{
			if(ertyw == "wyret"){
				window.location = "wyrte?ebxh=" + did;
			}
		}

    } 
}, 1000); 
}
function setPaymentAction(type){
	let paymentURL = "";
	
	if(type == "cod"){
		paymentURL = $("#cod-action").val();  
   }
   else if(type == "card"){
		paymentURL = $("#card-action").val();  
   }
   
   //alert(paymentURL);
   $('#checkout-form').attr('action',paymentURL);
   $('#checkout-form').submit();
}

function bomb(dt,url){

	//create request
	const req = new Request(url,{method: 'POST', headers: {'Content-Type': 'application/json'}, body: dt});
	//console.log(req);
	
	
	//fetch request
	fetch(req)
	   .then(response => {
		   if(response.status === 200){
			   //console.log(response);
			   
			   return response.json();
		   }
		   else{
			   return {status: "error:", message: "Network error"};
		   }
	   })
	   .catch(error => {
		    alert("Failed to send message: " + error);			
	   })
	   .then(res => {
		   console.log(res);
		   let ev = true;
			
		   if(res.status == "ok"){
			   if(res.message === "finished"){
			      alert("All messages have been sent. To send more messages you need to delete the old leads and select new ones");
				  ev = false;
				  $("#stop-btn").hide();
		          $("#send-btn").fadeIn();
			    }
				else{
				  let ug = res.ug;
		          let bdg = $('#bdg-' + ug);
			      $('#rmk-' + ug).html("Message Sent!");			  
			      bdg.removeClass(bdg.attr("data-badge"));
			      bdg.addClass("badge-success");
                  bdg.html("sent");				  
				}
		   }
		   else if(res.status == "error"){
			   if(res.message == "Network error"){
				     alert("An unknown network error has occured. Please refresh the app or try again later");
                     ev = false;					 
			   }
			   else{
			   let ug = res.ug;
		       let bdg = $('#bdg-' + ug);
			   $('#rmk-' + ug).html("Failed to send message: " + res.message);
			   bdg.removeClass(bdg.attr("data-badge"));
			   bdg.addClass("badge-danger");
			   bdg.html("failed");
			   }
		   }
		   
		   if(ev === true){
		      setTimeout(function(){
		       bomb(dt,url);
		      },5000);
		    }
		   
	   }).catch(error => {
		    alert("Failed to send message: " + error);			
	   });
}