<?php 

    $canon_options_post = get_option('canon_options_post'); 

?>

                            <aside class="sidebar">

								<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($canon_options_post['woocommerce_sidebar'])) : ?>  
                                    
                                    <h4><?php esc_html_e("No Widgets added.", "loc-canon-belle"); ?></h4>
                                    <p><i><?php esc_html_e("Please login and add some widgets to this widget area.", "loc-canon-belle"); ?></i></p> 

                                <?php endif; ?>  
                                    
                            </aside> 