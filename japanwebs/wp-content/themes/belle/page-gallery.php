<?php /* Template Name: Gallery */ ?>

<?php get_header(); ?>

<?php 

    // SETTTINGS
    $cmb_gallery_style = get_post_meta($post->ID, 'cmb_gallery_style', true);

    // DEFAULTS
    if (empty($cmb_gallery_style)) { $cmb_gallery_style = "masonry"; }

    get_template_part('inc/templates/gallery/template_gallery_' . $cmb_gallery_style);

?>
		
<?php get_footer(); ?>