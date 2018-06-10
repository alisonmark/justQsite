<?php
	
    // GET OPTIONS
    $canon_options_post = get_option('canon_options_post'); 

?>

				
						<div class="inner-wrapper ad-inner-wrapper">	

							<div class="post-component-container post-component-ad">

								<?php echo wp_kses_post($canon_options_post['post_component_ad_code']); ?>

							</div>

						</div>					
