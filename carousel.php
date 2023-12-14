<?php
/*
Plugin Name: Carousel
Description: A plugin that makes images slide using Bootstrap
Author: Chelsea Johnson
Version: 1.7.2
Author URI: www.chelseamjohnson.com
*/



// Function to create the shortcode
function custom_shortcode_function() {
    
	
	$slideOneHTML = ''; 
	$slideTwoHTML = ' '; 

	// Get the 'Profiles' post type
	$args = array(
    'post_type' => 'homepage_carousel', 
	'posts_per_page' => -1,
);
	$loop = new WP_Query($args);

if ($loop-> have_posts() ) { 


	$allValues = [];  
	$postCount = 1;

	while ($loop-> have_posts() ){
		
			$loop->the_post();  

				$postID = get_the_ID();   
				$key_1_values = get_post_meta($postID, 'large_fancy_header', true ); 
				$key_2_values = get_post_meta($postID, 'small_fancy_header', true );  
				$key_3_values = get_post_meta($postID, 'banner_button', true );
				$key_4_values = get_post_meta($postID, 'banner_button_text', true );
				$featured_img_url = get_the_post_thumbnail_url($postID,'full'); 


				if($postCount == 1){ 

				$slideOneHTML = '<div class="carousel-item active">
				  						<div class="d-block w-100 div-height" style="background: url('. $featured_img_url . ')"></div> 
										  <div class="carousel-caption d-none d-md-block">
										  <h2>' . $key_1_values . '</h2>
										  <p>' . $key_2_values . '</p>  
										  <button><a href="' . $key_3_values . '">' . $key_4_values . '</a></button>
										</div>
									</div>'; 

									array_push($allValues,$slideOneHTML);

				}else{ 

					$slideTwoHTML = '<div class="carousel-item">
										<div class="d-block w-100 div-height" style="background: url('. $featured_img_url . ')"></div>  
										<div class="carousel-caption d-none d-md-block">
										<h2>' . $key_1_values . '</h2>
										<p>' . $key_2_values . '</p>  
										<button><a href="' . $key_3_values . '">' . $key_4_values . '</a></button>
									  </div></div>'; 

								array_push($allValues,$slideTwoHTML);

				} 

		
				$postCount++;

				} 		 
				
				$string = implode(', ', $allValues);

				$bttnHTML = '<button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
								<span class="carousel-control-prev-icon" aria-hidden="true"></span>
								<span class="visually-hidden">Previous</span>
			 				 </button>
			 				 <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
								<span class="carousel-control-next-icon" aria-hidden="true"></span>
								<span class="visually-hidden">Next</span>
			  				</button>';
	} // end while


	return '<div id="carouselExample" class="carousel slide"><div class="carousel-inner">'. $string . $bttnHTML . '</div></div>'; 

}add_shortcode('carousel', 'custom_shortcode_function');