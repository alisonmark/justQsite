<?php if (get_next_posts_link() || get_previous_posts_link()) : ?>

				<div class="pagination archive-pagination-prevnext-ajax">
					<ul>
						<li class="prev"><?php if (get_next_posts_link()) { next_posts_link( '<i class="fa fa-angle-left"></i> ' . esc_html__('Older Posts', 'loc-canon-belle') ); } else { printf("<span class='eol'>%s</span>", esc_html__("No More Posts", "loc-canon-belle")); } ?> &nbsp;</li>
						<li class="next">&nbsp; <?php if (get_previous_posts_link()) { previous_posts_link( esc_html__('Newer Posts', 'loc-canon-belle') . ' <i class="fa fa-angle-right"></i>' ); } else { printf("<span class='eol'>%s</span>", esc_html__("No More Posts", "loc-canon-belle")); } ?></li>
					</ul>	
				</div>

<?php endif; ?>
