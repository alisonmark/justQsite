<?php
/**
 * synapse functions and definitions
 *
 * @package synapse
 */



if ( ! function_exists( 'synapse_setup' ) ) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function synapse_setup() {

        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on synapse, use a find and replace
         * to change 'synapse' to the name of your theme in all the template files
         */
        load_theme_textdomain( 'synapse', get_template_directory() . '/languages' );

        /**
         * Set the content width based on the theme's design and stylesheet.
         */
        global $content_width;
        if ( ! isset( $content_width ) ) {
            $content_width = 640; /* pixels */
        }

        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         *
         */
        add_theme_support( 'title-tag' );

        add_theme_support( 'custom-logo' );

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
         */
        add_theme_support( 'post-thumbnails' );

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus( array(
            'primary' => __( 'Primary Menu', 'synapse' ),
            'top' => __( 'Top Menu', 'synapse' ),
        ) );

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support( 'html5', array(
            'search-form', 'comment-form', 'gallery', 'caption',
        ) );

        /*
         * Enable support for Post Formats.
         * See http://codex.wordpress.org/Post_Formats
         */
        add_theme_support( 'post-formats', array(
            'aside', 'image', 'video', 'quote', 'link',
        ) );

        // Set up the WordPress core custom background feature.
        add_theme_support( 'custom-background', apply_filters( 'synapse_custom_background_args', array(
            'default-color' => '33363b',
            'default-image' => '',
        ) ) );

        add_image_size('synapse-sq-thumb', 600,600, true );
        add_image_size('synapse-overlap-thumb', 670,400, true );
        add_image_size('synapse-thumb', 540,450, true );
        add_image_size('synapse-pop-thumb',542, 340, true );

        //Declare woocommerce support
        add_theme_support('woocommerce');
        add_theme_support( 'wc-product-gallery-lightbox' );

        //Slider Support
        add_theme_support('rt-slider');

        //Custom Logo
        add_theme_support('custom-logo');

    }
endif; // synapse_setup
add_action( 'after_setup_theme', 'synapse_setup' );