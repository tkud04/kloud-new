		<!-- Banner section -->
			
			<?php
			 #'subtitle', 'title', 'cta', 'tag', 'copy', 'img', 'type'
			  $img = "img/banner-bg.jpg";
			  $tag = "NEW";
			  $subtitle = "New Arrivals";
			  $title = "STRIPED SHIRTS";
			  $copy = "";
			  $cta = explode(',', "#,SHOP NOW");
			  
		       if(isset($data['img'])) $img = $data['img'];
		       if(isset($data['tag'])) $tag = $data['tag'];
		       if(isset($data['subtitle'])) $subtitle = $data['subtitle'];
		       if(isset($data['title'])) $title = $data['title'];
		       if(isset($data['cta'])) $cta = $data['cta'];
		       
            ?>
	<section class="banner-section">
		<div class="container">
			<div class="banner set-bg" data-setbg="{{$img}}">
				<div class="tag-new">{{$tag}}</div>
				<span>{{$subtitle}}</span>
				<h2>{{$title}}</h2>
				<a href="{{$cta[0]}}" class="site-btn">{{$cta[1]}}</a>
			</div>
		</div>
	</section>
	<!-- Banner section end  -->
	