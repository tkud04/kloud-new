		<!-- Banner section -->
			
			<?php
			 #'subtitle', 'title', 'cta', 'tag', 'copy', 'img', 'type'
			  $img = "img/banner-bg.jpg";
			  $tag = "NEW";
			  $subtitle = "New Arrivals";
			  $title = "STRIPED SHIRTS";
			  $copy = "";
			  $ctaa = "#,SHOP NOW";
			  
		       if(isset($data['img']))
			   {
				   $ird = $data['img'];
                   if($ird == null || $ird == "none") { $imgg = "img/no-image.png"; }
                                      else{                                      	
                                      	   $imgg = "https://res.cloudinary.com/kloudtransact/image/upload/v1563645033/".$ird;                                        
										}
			   }
		       if(isset($data['tag'])) $tag = $data['tag'];
		       if(isset($data['subtitle'])) $subtitle = $data['subtitle'];
		       if(isset($data['title'])) $title = $data['title'];
		       if(isset($data['cta'])) $ctaa = $data['cta'];
			   
			   $cta = explode(',',$ctaa);
		       
            ?>
	<section class="banner-section">
		<div class="container">
			<div class="banner set-bg" data-setbg="{{$img}}">
				<div class="tag-new">{{$tag}}</div>
				<span>{{$subtitle}}</span>
				<h2>{{$title}}</h2>
				<a href="{{$cta[1]}}" target="_blank" class="site-btn">{{$cta[0]}}</a>
			</div>
		</div>
	</section>
	<!-- Banner section end  -->
	