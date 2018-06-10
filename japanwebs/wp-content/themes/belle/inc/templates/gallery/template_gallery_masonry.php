<?php get_header(); ?>

<?php 

    //SETTTINGS
    $cmb_gallery_style = get_post_meta($post->ID, 'cmb_gallery_style', true);
    $cmb_gallery_num_columns = get_post_meta($post->ID, 'cmb_gallery_num_columns', true);

    // DEFAULTS
    if (empty($cmb_gallery_style)) { $cmb_gallery_style = "masonry"; };
    if (empty($cmb_gallery_num_columns)) { $cmb_gallery_num_columns = 3; };

    // HANDLE WP GALLERY SOURCE
    $consolidated_gallery_array = array();
    $cmb_gallery_source = get_post_meta( $post->ID, 'cmb_gallery_source', true);
    $gallery_array = canon_fw_strip_wp_galleries_to_array($cmb_gallery_source);
    $consolidated_gallery_array = canon_fw_convert_wp_galleries_array_to_consolidated_wp_gallery_array($gallery_array);

    // GET CLASSES
    $size_class = canon_fw_get_col_size_class_from_num($cmb_gallery_num_columns, "col-1-3");

    // SET CONTROLLER CLASSES
    $controller_classes = "not-full is-col-1-1 is-boxed is-dropcap not-sidebar";


?>

    <!-- OUTTER-WRAPPER-PARENT -->
    <div class="outter-wrapper-parent">

        <div class="outter-wrapper clearfix page-content <?php echo esc_attr($controller_classes); ?>">
            
            <div class="main-column">
            
                <div class="wrapper">

                    <div class="inner-wrapper"> 

        
                        <!-- GALLERY HEADER -->
                        <div class="gallery-head clearfix">

                            <h1 class="left"><?php echo wp_kses_post($post->post_title); ?></h1>

                            <ul class="gallery-filter right" data-associated_gallery_selector="#masonry-gallery">
                                <?php canon_fw_list_categories_of_consolidated_wp_gallery($consolidated_gallery_array); ?>
                            </ul>
                            
                        	<div class="clearfix"></div>
                        	<div class="feat-title"></div>
                            
                        </div>

                        <!-- DESCRIPTION -->
                        <?php if (!empty($post->post_content)) { printf('<div class="gallery-description">%s</div>', $post->post_content); } ?>

                        <!-- IMAGES -->
                        <div id="masonry-gallery" class="archive-masonry-container page-masonry-gallery gallery-images" data-num_columns="<?php echo esc_attr($cmb_gallery_num_columns); ?>">

                            <?php

                                        
                                for ($i = 0; $i < count($consolidated_gallery_array); $i++) { 

                                    $cat_class = "";
                                    foreach ($consolidated_gallery_array[$i]['categories'] as $key => $value) { $cat_class .= " " . $key; }
                                    $final_class = $size_class . $cat_class;

                                    $post_thumbnail_src = wp_get_attachment_image_src($consolidated_gallery_array[$i]['id'],'full');
                                    $img_alt = get_post_meta($consolidated_gallery_array[$i]['id'], '_wp_attachment_image_alt', true);
                                    $img_post = get_post($consolidated_gallery_array[$i]['id']);
                                            
                                    printf('<div class="gallery-item %s">', esc_attr($final_class));
                                    printf('<a href="%s" title="%s"><img src="%s" alt="%s" /></a>', esc_url($post_thumbnail_src[0]), esc_attr($img_post->post_excerpt), esc_url($post_thumbnail_src[0]), esc_attr($img_alt));
                                    echo '</div>';

                                }

                            ?>


                        </div>


                    </div>
                    <!-- end inner-wrapper -->

                </div>
                <!-- end wrapper -->

            </div>
            <!-- end main-column -->

        </div>
        <!-- end outter-wrapper -->

    </div>
     <!-- end outter-wrapper-parent -->

        
        


		
<?php get_footer(); ?>