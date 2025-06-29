<?php
/**
 * User Subscriptions
 *
 * @package Oenology
 * @subpackage Theme
 */

?>

	<?php do_action( 'bbp_template_before_user_subscriptions' ); ?>

	<?php if ( bbp_is_subscriptions_active() ) : ?>

		<?php if ( bbp_is_user_home() || current_user_can( 'edit_users' ) ) : ?>

			<div id="bbp-user-subscriptions" class="bbp-user-subscriptions">
				<h2 class="entry-title"><?php _e( 'Subscribed Forum Topics', 'oenology' ); ?></h2>
				<div class="bbp-user-section">

					<?php if ( bbp_get_user_subscriptions() ) : ?>

						<?php bbp_get_template_part( 'loop',       'topics' ); ?>

					<?php else : ?>

						<p><?php bbp_is_user_home() ? _e( 'You are not currently subscribed to any topics.', 'oenology' ) : _e( 'This user is not currently subscribed to any topics.', 'oenology' ); ?></p>

					<?php endif; ?>

				</div>
			</div><!-- #bbp-user-subscriptions -->

		<?php endif; ?>

	<?php endif; ?>

	<?php do_action( 'bbp_template_after_user_subscriptions' ); ?>
