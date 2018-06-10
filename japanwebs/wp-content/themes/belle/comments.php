 <?php 

/**************************************
COMMENTS CALLBACK
***************************************/

	function canon_belle_comments_callback ($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment;
		
		?>

		<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>

			<div class="clearfix">

				<!-- AVATAR -->
				<?php 

					if (get_option('show_avatars') === '1' && get_avatar($comment, $args['avatar_size'], '', 'comment-avatar')) {
						echo get_avatar($comment,$args['avatar_size'],'', 'comment-avatar');	
					}

				?>
				

				<!-- META -->
				<h6 class="meta">
					<?php comment_author_link(); ?>
					<span><?php echo canon_fw_localize_datetime(get_comment_date(get_option('date_format') . ' (' . get_option('time_format') .')')); ?></span>
				</h6> 

				<!-- REPLY AND EDIT LINKS -->
				<div class="more right">
					<?php comment_reply_link(array_merge( $args, array('reply_text' => esc_html__('Reply', 'loc-canon-belle'), 'depth' => $depth, 'max_depth' => $args['max_depth'])), $comment->comment_ID); ?>
					<?php edit_comment_link(esc_html__('Edit', 'loc-canon-belle')); ?>
				</div>

				<!-- THE COMMENT -->
				<?php if ($comment->comment_approved == '0') { printf('<span class="approval_pending_notice">%s</span>', esc_html__('Comment awaiting approval', 'loc-canon-belle')); } ?>

				<?php comment_text(); ?>


			</div>

	<?php 
	}

?>
        	                       		

					<!-- ANCHOR TAG -->
					<a name="comments"></a>

						
					<!-- DISPLAY COMMENTS -->
					<?php 

						// CUSTOM INNER-WRAPPER
						echo '<div class="inner-wrapper inner">';

						// TITLE
						echo "<h3 class='feat-title'>";
						if (comments_open()) { comments_number(esc_html__('No Comments','loc-canon-belle'), esc_html__('1 Comment','loc-canon-belle'), '% ' . esc_html__('Comments','loc-canon-belle') ); } else { esc_html_e('Comments Disabled','loc-canon-belle'); }
						echo "</h3>";

						// THE COMMENTS
						echo "<ul class='comments'>";
						
							wp_list_comments(array(
								'avatar_size'	=> 65,
								'max_depth'		=> 5,
								'style'			=> 'ul',
								'callback'		=> 'canon_belle_comments_callback',
								'type'			=> 'all'
							));

					 	echo "</ul>";

						// PAGINATION
						echo "<div id='comments-pagination'>";
						paginate_comments_links(array('prev_text' => '&laquo;', 'next_text' => '&raquo;'));
						echo "</div>";


						// COMMENTS FORM
						$custom_comment_field = '<textarea class="full" placeholder="'.esc_html__('Leave a comment', 'loc-canon-belle').'" id="comment" name="comment" cols="20" rows="5" aria-required="true"></textarea>';  //label removed for cleaner layout

						//vars for fields
						$commenter = wp_get_current_commenter();
						$req = get_option( 'require_name_email' );
						$aria_req = ( $req ? " aria-required='true'" : '' );


						comment_form(array(
							'fields' => apply_filters( 'comment_form_default_fields', array(
										'author' 	=> sprintf('<input placeholder="%s" id="author" name="author" type="text" value="%s" %s/>'
														, esc_html__('Name', 'loc-canon-belle')
														, esc_attr($commenter['comment_author'])
														, esc_attr($aria_req)
													),
										'email' 	=> sprintf('<input placeholder="%s" id="email" name="email" type="text" value="%s" %s/>'
														, esc_html__('Email', 'loc-canon-belle')
														, esc_attr($commenter['comment_author_email'])
														, esc_attr($aria_req)
													),
										'url' 		=> sprintf('<input placeholder="%s" id="url" name="url" type="text" value="%s"/>'
														, esc_html__('Website', 'loc-canon-belle')
														, esc_attr($commenter['comment_author_url'])
													), 
									)),
							'comment_field'			=> $custom_comment_field,
							'comment_notes_before' 	=> '',
							'comment_notes_after'	=> '',
							'logged_in_as' 			=> '',
							'title_reply'			=> '',
							'cancel_reply_link'		=> esc_html__('Cancel reply', 'loc-canon-belle'),
							'label_submit'			=> esc_html__('Submit Comment', 'loc-canon-belle')
						));


 						// END CUSTOM INNER-WRAPPER
 						echo '</div>';

					 ?>

