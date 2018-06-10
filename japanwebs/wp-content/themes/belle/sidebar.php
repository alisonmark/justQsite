<?php 

     //SETTTINGS
    $cmb_sidebar_id = get_post_meta($post->ID, 'cmb_sidebar_id', true);

    // FAILSAFE DEFAULT
    if (empty($cmb_sidebar_id)) { $cmb_sidebar_id = "canon_archive_sidebar_widget_area"; }

?>

                            <aside class="sidebar">

                                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($cmb_sidebar_id)) : ?>  
                                    
                                    <h4><?php esc_html_e("Blog / Category Sidebar Widget Area", "loc-canon-belle"); ?></h4>
                                    <p><i><?php esc_html_e("Please login and add some widgets to this widget area.", "loc-canon-belle"); ?></i></p> 

                                <?php endif; ?>  
                                    
                            </aside> 
