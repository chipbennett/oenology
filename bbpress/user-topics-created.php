<?php
/**
 * User Topics Created
 *
 * @package Oenology
 * @subpackage Theme
 */

?>

	<?php do_action( 'bbp_template_before_user_topics_created' ); ?>

	<div id="bbp-user-topics-started" class="bbp-user-topics-started">
		<h2 class="entry-title"><?php _e( 'Forum Topics Started', 'oenology' ); ?></h2>
		<div class="bbp-user-section">

			<?php if ( bbp_get_user_topics_started() ) : ?>

				<?php bbp_get_template_part( 'loop',       'topics' ); ?>

			<?php else : ?>

				<p><?php bbp_is_user_home() ? _e( 'You have not created any topics.', 'oenology' ) : _e( 'This user has not created any topics.', 'oenology' ); ?></p>

			<?php endif; ?>

		</div>
	</div><!-- #bbp-user-topics-started -->

	<?php do_action( 'bbp_template_after_user_topics_created' ); ?>
