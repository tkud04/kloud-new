(function() {
	function pickElement(filter) {
		return document.querySelector(filter);
	}
	
	function pickElements(filter) {
		return document.querySelectorAll(filter);
	}

	// Mayan Calendar: 1356088271111

	
	function update() {
		var units = countdown.DAYS | countdown.HOURS | countdown.MINUTES | countdown.SECONDS,
			
			empty = "now!",
			max = 11,
			digits = 20;

		var yyyy = 2019,
			MM = 7,
			dd = 12,
			HH = 12,
			mm = 0,
			ss = 0;

		var start = new Date(yyyy, MM, dd, HH, mm, ss),
			ts = countdown(null, start, units, max, digits);
           //console.log(ts);
		var deals = pickElements('span.deadline'),
			//msg = ts.toHTML('strong', empty);
			msg = ts.days + ":" + ts.hours + ":" + ts.minutes + ":" + Math.floor(ts.seconds);

		deals.forEach(function(el) {
         el.innerHTML = msg;
       });
       
       var auctionSection = pickElement('#auction-section');

		requestAnimationFrame(update, auctionSection);
	}
	update();
})();