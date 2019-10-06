// Please see documentation at https://docs.microsoft.com/aspnet/core/client-side/bundling-and-minification
// for details on configuring this project to bundle and minify static web assets.

// Write your JavaScript code.
let x = getCookie('kloudtransact_gdpr');
if (x) {
    $('#cookieConsent').hide();
}

      $('.summernote').summernote({
        height: 200,
      });

$('.shop-categories-linkk').click(function(e){
	e.preventDefault();
	let c = $(this).attr('data-cat');
	console.log("Category: " + c);
});

$("#pay-cod").click(function(e){
	e.preventDefault();
	setPaymentAction("cod");
});

$(".cli").click(function(e){
	e.preventDefault();
	uu = $(this).attr("data-cli");
	console.log(uu);
	window.location = uu; 
	
});

$("#pay-card").click(function(e){
	e.preventDefault();
	 mc['comment'] = $('#comment').val();
	if($('#customCheck3').is(':checked')) mc['ssa'] = "on";
	$('#nd').val(JSON.stringify(mc));
	
	setPaymentAction("card");
});

$("#deposit-card").click(function(e){
	e.preventDefault();
	
	 $('#meta-amount').val($('#amount').val() * 100);
	$('#nd').val(JSON.stringify(mc));
	setPaymentAction("card");
});


/** Add Auction **/
        $('#i-d').change(function(event) {
            event.preventDefault();
            let d = $(this).val();            
            if(d == ""){d = 0; $(this).val("0"); }
            updateAuctionTime($('#a-d'),d);
          });
        
        
         $('#i-h').change(function(event) {
            event.preventDefault();
            let h = $(this).val();            
            if(h == ""){h = 0; $(this).val("0"); }
            updateAuctionTime($('#a-h'),h);
          
        });
        
         $('#i-m').change(function(event) {
            event.preventDefault();
            let m = $(this).val();            
            if(m == ""){m = 0; $(this).val("0"); }
            updateAuctionTime($('#a-m'),m);
          
        });
