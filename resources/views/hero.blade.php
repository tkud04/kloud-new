<!-- Hero section -->
	<section class="hero-section">
		<div class="hero-slider owl-carousel">
			<?php
			foreach($sliders as $s){	
               $img = "https://res.cloudinary.com/kloudtransact/image/upload/v1563645033/".$s['img'];
               if($s['img'] == "none") $img = "img/no-image.png";
			   
			   $cta_1 = explode(',',$s['cta_1']);
			   $cta_2 = explode(',',$s['cta_2']);
			?>
			<div class="hs-item set-bg" data-setbg="<?=$img?>">
				<div class="container">
					<div class="row">
						<div class="col-xl-6 col-lg-7 text-white">
							<span><?=$s['subtitle']?></span>
							<h2><?=$s['title']?></h2>
							<p><?=$s['copy']?></p>
							<a href="{{$cta_1[1]}}" target="_blank" class="site-btn sb-line">{{$cta_1[0]}}</a>
							@if($cta_2[0] != "None" && $cta_2[1] != "#")
							<a href="{{$cta_2[1]}}" target="_blank"  class="site-btn sb-white">{{$cta_2[0]}}</a>
						    @endif
						</div>
					</div>
					@if($s['tag'] != null && $s['tag'] != "")
					<div class="offer-card text-white">
				        <span></span>
						<h2 style="font-size: 57px;">{!! $s['tag'] !!}</h2>
						<p></p>
					</div>
					@endif
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
