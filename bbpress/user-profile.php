<?php
/**
 * User Profile
 *
 * @package Oenology
 * @subpackage Theme
 */

?>

	<?php do_action( 'bbp_template_before_user_profile' ); ?>

	<div id="bbp-user-profile" class="bbp-user-profile">
	
		<h2 class="entry-title"><?php _e( 'About', 'oenology' ); ?></h2>
		
		<div id="bbp-user-avatar">

			<span class='vcard'>
				<a class="url fn n" href="<?php bbp_user_profile_url(); ?>" title="<?php bbp_displayed_user_field( 'display_name' ); ?>" rel="me">
					<?php echo get_avatar( bbp_get_displayed_user_field( 'user_email' ), apply_filters( 'bbp_single_user_details_avatar_size', 150 ) ); ?>
				</a>
			</span>

		</div><!-- #author-avatar -->
		
		<div class="bbp-user-section">

			<?php if ( bbp_get_displayed_user_field( 'description' ) ) : ?>

				<p class="bbp-user-description"><?php bbp_displayed_user_field( 'description' ); ?></p>

			<?php endif; ?>

			<p class="bbp-user-forum-role"><?php  printf( __( 'Forum Role: %s',      'oenology' ), bbp_get_user_display_role()    ); ?></p>
			<p class="bbp-user-topic-count"><?php printf( __( 'Topics Started: %s',  'oenology' ), bbp_get_user_topic_count_raw() ); ?></p>
			<p class="bbp-user-reply-count"><?php printf( __( 'Replies Created: %s', 'oenology' ), bbp_get_user_reply_count_raw() ); ?></p>
			
		</div>
		
	</div><!-- #bbp-author-topics-started -->

	<?php do_action( 'bbp_template_after_user_profile' ); ?>
