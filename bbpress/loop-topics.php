<?php
/**
 * Topics Loop
 *
 * @package Oenology
 * @subpackage Theme
 */

?>

<?php do_action( 'bbp_template_before_topics_loop' ); ?>

<ul id="bbp-forum-<?php bbp_forum_id(); ?>" class="bbp-topics">

	<li class="bbp-header">

		<ul class="forum-titles">
			<li class="bbp-topic-title">
				<?php _e( 'Topic', 'oenology' ); ?>
				<?php bbp_get_template_part( 'pagination', 'topics'    ); ?>
			</li>
			<li class="bbp-topic-voice-count"><?php _e( 'Voices', 'oenology' ); ?></li>
			<li class="bbp-topic-reply-count"><?php bbp_show_lead_topic() ? _e( 'Replies', 'oenology' ) : _e( 'Posts', 'oenology' ); ?></li>
			<li class="bbp-topic-freshness"><?php _e( 'Freshness', 'oenology' ); ?></li>
		</ul>

	</li>

	<li class="bbp-body">

		<?php while ( bbp_topics() ) : bbp_the_topic(); ?>

			<?php bbp_get_template_part( 'loop', 'single-topic' ); ?>

		<?php endwhile; ?>

	</li>

	<li class="bbp-footer">

		<div class="tr">
			<p>
				<span class="td colspan<?php echo ( bbp_is_user_home() && ( bbp_is_favorites() || bbp_is_subscriptions() ) ) ? '5' : '4'; ?>">&nbsp;</span>
			</p>
		</div><!-- .tr -->

		<?php bbp_get_template_part( 'pagination', 'topics'    ); ?>

	</li>

</ul><!-- #bbp-forum-<?php bbp_forum_id(); ?> -->

<?php do_action( 'bbp_template_after_topics_loop' ); ?>
