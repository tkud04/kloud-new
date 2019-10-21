<!-- Hero section -->
	<section class="hero-section">
		<div class="hero-slider owl-carousel">
			<?php
			foreach($sliders as $s){
			?>
			<div class="hs-item set-bg" data-setbg="<?=$s['img']?>">
				<div class="container">
					<div class="row">
						<div class="col-xl-6 col-lg-7 text-white">
							<span><?=$s['title']?></span>
							<h2><?=$s['category']?></h2>
							<p><?=$s['content']?></p>
							<a href="#" class="site-btn sb-line">DISCOVER</a>
							<a href="#" class="site-btn sb-white">ADD TO CART</a>
						</div>
					</div>
					<div class="offer-card text-white">
						<span>from</span>
						<h2 style="font-size: 37px;">&#8358;<?=$s['price']?></h2>
						<p>SHOP NOW</p>
					</div>
				</div>
			</div>
			<?php
			}
			?>
			
		</div>
		<div class="container">
			<div class="slide-num-holder" id="snh-1"></div>
		</div>
	</section>
	<!-- Hero section end -->
