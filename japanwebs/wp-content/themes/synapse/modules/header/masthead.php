<header id="masthead" class="site-header" role="banner">
    <div class="container masthead-container">
        <div class="site-branding">
            <?php if ( function_exists( 'the_custom_logo' ) ) : ?>
                <div class="site-logo">
                    <?php the_custom_logo();?>
                </div>
            <?php endif; ?>
            <div id="text-title-desc">
                <h1 class="site-title title-font"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                <h3 class="site-description"><?php bloginfo( 'description' ); ?></h3>
            </div>
        </div>

    </div>

    <div id="bar" class="container-fluid">

        <div id="slickmenu"></div>
        <?php get_template_part('modules/navigation/menu','primary'); ?>

        <div id="searchicon">
            <i class="fa fa-search"></i>
        </div>

        <div class="social-icons">
            <?php get_template_part('modules/social/social', 'fa'); ?>
        </div>

    </div><!--#bar-->

</header><!-- #masthead -->