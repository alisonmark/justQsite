<?php 

	//VARS
	$canon_options_post = get_option('canon_options_post'); 

    $sidebar = $canon_options_post['404_sidebar'];

    // FAILSAFE DEFAULT
    if (empty($sidebar)) { $sidebar = "canon_page_sidebar_widget_area"; }

?>


                            <aside class="sidebar">

								<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($sidebar)) : ?>  
                                    
                                    <h4><?php esc_html_e("No Widgets added.", "loc-canon-belle"); ?></h4>
                                    <p><i><?php esc_html_e("Please login and add some widgets to this widget area.", "loc-canon-belle"); ?></i></p> 

                                <?php endif; ?>  
                                    
                            </aside> 