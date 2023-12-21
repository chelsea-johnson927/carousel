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
				$key_3_values = get_post_meta($postID, 'banner_button', false);   
                		$innerArray = $key_3_values[0];
				$featured_img_url = get_the_post_thumbnail_url($postID,'full'); 


				if($postCount == 1){ 

				$slideOneHTML = '<div class="carousel-item active">
				  						<div class="d-block w-100 div-height" style="background: url('. $featured_img_url . ')"></div> 
										  <div class="carousel-caption d-none d-md-block">
										  <h2>' . $key_1_values . '</h2>
										  <p>' . $key_2_values . '</p> 
                                          <button><a href="'. esc_url($innerArray['url']) . '">' . esc_html($innerArray['title']) . '</a></button>
										</div></div>';  

                                        
									array_push($allValues,$slideOneHTML); 
                                    

				}else{ 

					$slideTwoHTML = '<div class="carousel-item">
										<div class="d-block w-100 div-height" style="background: url('. $featured_img_url . ')"></div>  
										<div class="carousel-caption d-none d-md-block">
										<h2>' . $key_1_values . '</h2>
										<p>' . $key_2_values . '</p> 
                                        <button><a href="'. esc_url($innerArray['url']) . '">' . esc_html($innerArray['title']) . '</a></button>
                                        
				                        </div></div>'; 

								        array_push($allValues,$slideTwoHTML); 
                                        

				} 

		
				$postCount++;

				} 		 
				
				$string = implode(', ', $allValues);

				
	} // end while


	return '<div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel"><div class="carousel-inner"> '. $string . '</div></div>'; 

}add_shortcode('carousel', 'custom_shortcode_function');
