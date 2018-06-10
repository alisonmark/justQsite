<!-- TEMPLATE: template_footer_pre_custom_center -->

<?php
    
    // GET OPTIONS
    $canon_options = get_option('canon_options');
    $canon_options_frame = get_option('canon_options_frame');

    // DEV MODE OPTIONS
    if ($canon_options['dev_mode'] == "checked") {
        if (isset($_GET['footer_pre_custom_center'])) { $canon_options_frame['footer_pre_custom_center'] = wp_filter_nohtml_kses($_GET['footer_pre_custom_center']); }
    }

?>

    <!-- PRE-FOOTER-CONTAINER -->
    <div class="outter-wrapper pre-footer-container">
	
        <!-- SCROLL TO TOP BUTTON -->
        <?php if ($canon_options['back_to_top_button'] == "prefooter") { printf('<a class="scroll-up to-top" title="%s"><em class="fa fa-angle-up"></em></a>', esc_html__('Back To Top', 'loc-canon-belle')); } ?>
		
        <div class="wrapper">

            <div class="clearfix pre-footer centered">

                <?php get_template_part('inc/templates/elements/template_element_' . $canon_options_frame['footer_pre_custom_center']); ?>

            </div>

        </div>

    </div>
    <!-- END PRE-FOOTER-CONTAINER -->