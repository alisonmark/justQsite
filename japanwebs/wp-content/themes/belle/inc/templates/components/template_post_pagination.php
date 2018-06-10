<?php 

     $canon_options_post = get_option('canon_options_post');

     $prev_post = get_previous_post();
     $next_post = get_next_post();

     if (get_post_type() == "post") {
          if ($canon_options_post['post_nav_same_cat'] == "checked") {
               $prev_post = get_previous_post(true);
               $next_post = get_next_post(true);
          }
               
     }

?>


                                   <div class="post-component-container post-component-pagination paging clearfix">

                                        <?php if (!empty( $prev_post )): ?>

                                             <div class="prev">
                            					<a class="meta" href="<?php echo esc_url(get_permalink( $prev_post->ID )); ?>"><?php echo strip_tags($prev_post->post_title); ?></a>
                                             </div>


                                        <?php else : ?>

                                             <div class="prev eol">
                                                  <div class="meta"><?php esc_html_e("No more posts", "loc-canon-belle"); ?></div>
                                             </div>

                                        <?php endif; ?>


                                        <?php if (!empty( $next_post )): ?>

                                             <div class="next last">
                                                  <a class="meta" href="<?php echo esc_url(get_permalink( $next_post->ID )); ?>"><?php echo strip_tags($next_post->post_title); ?></a>
                                             </div>


                                        <?php else : ?>

                                             <div class="next last eol">
                                                  <div class="meta"><?php esc_html_e("No more posts", "loc-canon-belle"); ?></div>
                                             </div>

                                        <?php endif; ?>

                                   </div>