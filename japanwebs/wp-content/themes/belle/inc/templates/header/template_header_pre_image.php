<!-- TEMPLATE HEADER: pre_image -->

<?php
    
    // GET OPTIONS
    $canon_options = get_option('canon_options');
    $canon_options_frame = get_option('canon_options_frame');

    extract($canon_options_frame);

    // DEV MODE OPTIONS
    if ($canon_options['dev_mode'] == "checked") {
        if (isset($_GET['use_sticky_preheader'])) { $canon_options_frame['use_sticky_preheader'] = wp_filter_nohtml_kses($_GET['use_sticky_preheader']); }
    }

?>



<?php 

    if ( ( $canon_options_frame['header_img_homepage_only'] == 'checked' && is_front_page() ) || ( $canon_options_frame['header_img_homepage_only'] != 'checked') ) {
    ?>


        <!-- Start Outter Wrapper -->
        <div class="outter-wrapper pre-header-container image-header-container <?php if ($canon_options_frame['use_sticky_preheader'] == 'checked') { echo "canon_sticky"; } ?>" data-stellar-background-ratio="<?php echo canon_fw_convert_percentage_to_inverse_ratio($canon_options_frame['header_img_parallax_amount']); ?>">
            
            <style type="text/css" scoped>
                .outter-wrapper.image-header-container {
                    <?php if (!empty($header_img_url)) { printf("background-image: url('%s');", esc_url($header_img_url)); } ?>
                    <?php if (!empty($header_img_bg_color)) { printf("background-color: %s;", esc_attr($header_img_bg_color)); } ?>
                    <?php if (!empty($header_img_height)) { printf("height: %spx;", esc_attr($header_img_height)); } ?>
                }

                .outter-wrapper.image-header-container .header_img_text {
                    <?php if (!empty($header_img_text_margin_top)) { printf("margin-top: %spx;", esc_attr($header_img_text_margin_top)); } ?>
                }

            </style>

            <!-- Start Main Navigation -->
            <div class="wrapper">
                <header class="clearfix <?php echo esc_attr($canon_options_frame['header_img_text_alignment']); ?>">

                    <div class="header_img_text">
                        <?php echo do_shortcode($canon_options_frame['header_img_text']); ?>
                    </div>

                </header>
            </div>
            <!-- End Main Navigation -->
        </div>
        <!-- End Outter Wrapper -->    
            
    <?php    
    }

?>

