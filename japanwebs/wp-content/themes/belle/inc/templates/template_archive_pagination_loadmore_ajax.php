<?php if (get_next_posts_link() || get_previous_posts_link()) : ?>

				<div class="pagination archive-pagination-loadmore-ajax is-loadmore">
					<ul>
						<li class="load-more"><?php if (get_next_posts_link()) { next_posts_link( esc_html__('Load More', 'loc-canon-belle') . ' <i class="fa fa-angle-down"></i>' ); } else { printf("<span class='eol'>%s</span>", esc_html__("No More Posts", "loc-canon-belle")); } ?></li>
					</ul>	
				</div>

<?php endif; ?>
