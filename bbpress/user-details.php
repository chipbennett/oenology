<?php

/**
 * User Details
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

	<?php do_action( 'bbp_template_before_user_details' ); ?>

	<div id="bbp-single-user-details">

		<div id="bbp-user-navigation">
			<ul>
				<li class="<?php if ( bbp_is_single_user_profile() ) :?>current<?php endif; ?>">
					<span class="vcard bbp-user-profile-link">
						<a class="url fn n" href="<?php bbp_user_profile_url(); ?>" title="<?php printf( __( "%s's Profile", 'bbpress' ), esc_attr( bbp_get_displayed_user_field( 'display_name' ) ) ); ?>" rel="me"><?php _e( 'Profile', 'bbpress' ); ?></a>
					</span>
				</li>

				<li class="<?php if ( bbp_is_single_user_topics() ) :?>current<?php endif; ?>">
					<span class='bbp-user-topics-created-link'>
						<a href="<?php bbp_user_topics_created_url(); ?>" title="<?php printf( __( "%s's Topics Started", 'bbpress' ), esc_attr( bbp_get_displayed_user_field( 'display_name' ) ) ); ?>"><?php _e( 'Topics Started', 'bbpress' ); ?></a>
					</span>
				</li>

				<li class="<?php if ( bbp_is_single_user_replies() ) :?>current<?php endif; ?>">
					<span class='bbp-user-replies-created-link'>
						<a href="<?php bbp_user_replies_created_url(); ?>" title="<?php printf( __( "%s's Replies Created", 'bbpress' ), esc_attr( bbp_get_displayed_user_field( 'display_name' ) ) ); ?>"><?php _e( 'Replies Created', 'bbpress' ); ?></a>
					</span>
				</li>

				<?php if ( bbp_is_favorites_active() ) : ?>
					<li class="<?php if ( bbp_is_favorites() ) :?>current<?php endif; ?>">
						<span class="bbp-user-favorites-link">
							<a href="<?php bbp_favorites_permalink(); ?>" title="<?php printf( __( "%s's Favorites", 'bbpress' ), esc_attr( bbp_get_displayed_user_field( 'display_name' ) ) ); ?>"><?php _e( 'Favorites', 'bbpress' ); ?></a>							
						</span>
					</li>
				<?php endif; ?>

				<?php if ( bbp_is_user_home() || current_user_can( 'edit_users' ) ) : ?>

					<?php if ( bbp_is_subscriptions_active() ) : ?>
						<li class="<?php if ( bbp_is_subscriptions() ) :?>current<?php endif; ?>">
							<span class="bbp-user-subscriptions-link">
								<a href="<?php bbp_subscriptions_permalink(); ?>" title="<?php printf( __( "%s's Subscriptions", 'bbpress' ), esc_attr( bbp_get_displayed_user_field( 'display_name' ) ) ); ?>"><?php _e( 'Subscriptions', 'bbpress' ); ?></a>							
							</span>
						</li>
					<?php endif; ?>

					<li class="<?php if ( bbp_is_single_user_edit() ) :?>current<?php endif; ?>">
						<span class="bbp-user-edit-link">
							<a href="<?php bbp_user_profile_edit_url(); ?>" title="<?php printf( __( 'Edit Profile of User %s', 'bbpress' ), esc_attr( bbp_get_displayed_user_field( 'display_name' ) ) ); ?>"><?php _e( 'Edit', 'bbpress' ); ?></a>
						</span>
					</li>

				<?php endif; ?>

			</ul>
		</div><!-- #bbp-user-navigation -->
	</div><!-- #bbp-single-user-details -->

	<?php do_action( 'bbp_template_after_user_details' ); ?>
