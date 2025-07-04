<?php
/**
 * User Favorites
 *
 * @package Oenology
 * @subpackage Theme
 */

?>

	<?php do_action( 'bbp_template_before_user_favorites' ); ?>

	<div id="bbp-user-favorites" class="bbp-user-favorites">
		<h2 class="entry-title"><?php _e( 'Favorite Forum Topics', 'oenology' ); ?></h2>
		<div class="bbp-user-section">

			<?php if ( bbp_get_user_favorites() ) : ?>

				<?php bbp_get_template_part( 'loop',       'topics' ); ?>

			<?php else : ?>

				<p><?php bbp_is_user_home() ? _e( 'You currently have no favorite topics.', 'oenology' ) : _e( 'This user has no favorite topics.', 'oenology' ); ?></p>

			<?php endif; ?>

		</div>
	</div><!-- #bbp-user-favorites -->

	<?php do_action( 'bbp_template_after_user_favorites' ); ?>
