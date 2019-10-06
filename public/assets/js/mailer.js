
    $("#send-btn").on('click', function (e) {
		
        e.preventDefault();
		let sn = $('#sn').val();
		let sa = $('#sa').val();
		let subject = $('#subject').val();
		let message = $('#message').val();
		
		//validation
		if(sn === "" || sa === "" || subject === "" || message === ""){
			if(sn === "") alert("Please type your sender name");
			if(sa === "") alert("Please type your sender email address");
			if(subject === "") alert("Please type your subject");
			if(message === "") alert("Please type your message");
		}
		else{
			let regex = /&nbsp;/gi;
		  let om = message.replace(regex, '%20');
		  $("#send-btn").hide();
		  $("#stop-btn").fadeIn();
		  
		  //get form data
		  let arr = {
			sn: sn,
			sa: sa,
			subject: subject,
			message: message,
            _token: $('#ggg').val()			
		  }	
		  let arrh = JSON.stringify(arr);
          let uu = $('#gg').val();
		  bomb(arrh,uu);
		}
		
    });