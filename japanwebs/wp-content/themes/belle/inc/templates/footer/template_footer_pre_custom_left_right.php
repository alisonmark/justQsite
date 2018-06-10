<!-- TEMPLATE: template_footer_pre_custom_left_right -->

<?php
    
    // GET OPTIONS
    $canon_options = get_option('canon_options');
    $canon_options_frame = get_option('canon_options_frame');

    // DEV MODE OPTIONS
    if ($canon_options['dev_mode'] == "checked") {
        if (isset($_GET['footer_pre_custom_left'])) { $canon_options_frame['footer_pre_custom_left'] = wp_filter_nohtml_kses($_GET['footer_pre_custom_left']); }
        if (isset($_GET['footer_pre_custom_right'])) { $canon_options_frame['footer_pre_custom_right'] = wp_filter_nohtml_kses($_GET['footer_pre_custom_right']); }
    }

?>

                    <!-- PRE-FOOTER-CONTAINER -->
                    <div class="outter-wrapper pre-footer-container">
						
						<!-- SCROLL TO TOP BUTTON -->
                        <?php if ($canon_options['back_to_top_button'] == "prefooter") { printf('<a class="scroll-up to-top" title="%s"><em class="fa fa-angle-up"></em></a>', esc_html__('Back To Top', 'loc-canon-belle')); } ?>
						
                        <div class="wrapper">

                            <div class="clearfix">

                                <!-- POST FOOTER LEFT SLOT -->
                                <div class="pre-footer left">

                                    <?php get_template_part('inc/templates/elements/template_element_' . $canon_options_frame['footer_pre_custom_left']); ?>

                                </div>


                                <!-- POST FOOTER RIGHT SLOT -->
                                <div class="pre-footer right">

                                    <?php get_template_part('inc/templates/elements/template_element_' . $canon_options_frame['footer_pre_custom_right']); ?>

                                </div>


                            </div>  

                        </div>

                    </div>
                    <!-- END PRE-FOOTER-CONTAINER --> 
