<div id="top-bar">
    <div class="container-fluid">

        <div id="top-menu">
            <?php $twalker = new Synapse_Menu_With_Hover;
            if (has_nav_menu('top'))
                wp_nav_menu( array( 'theme_location' => 'top', 'walker' => $twalker ) ); ?>
        </div>

        <div id="woocommerce-zone">
            <?php if (class_exists('woocommerce')) : ?>
                <div id="top-cart">
                    <div class="top-cart-icon">


						<span class="cart-contents" href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php esc_html_e('View your shopping cart', 'synapse'); ?>">
							<div class="count"><?php echo sprintf(_n('%d item', '%d items', WC()->cart->cart_contents_count, 'synapse'), WC()->cart->cart_contents_count);?></div>
							<div class="total"> <?php echo WC()->cart->get_cart_total(); ?> </div>

							<a class="links" href="<?php echo WC()->cart->get_cart_url(); ?>"><?php esc_html_e('Go to Cart','synapse'); ?></a>
							<a class="links" href="<?php echo WC()->cart->get_checkout_url(); ?>"><?php esc_html_e('Checkout','synapse'); ?></a>
						</span>



                        <i class="fa fa-shopping-bag"></i>
                    </div>
                </div>

                <div id="userlinks">
                    <?php if ( is_user_logged_in() ) { ?>
                        <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php esc_html_e('My Account','synapse'); ?>"><?php esc_html_e('My Account','synapse'); ?></a>
                    <?php }
                    else { ?>
                        <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php esc_html_e('Login / Register','synapse'); ?>"><?php esc_html_e('Login / Register','synapse'); ?></a>
                    <?php } ?>
                </div>

            <?php endif; ?>


        </div>

    </div>

</div>