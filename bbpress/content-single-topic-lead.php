<?php

/**
 * Single Topic Part
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<?php do_action( 'bbp_template_before_lead_topic' ); ?>

<ul id="bbp-topic-<?php bbp_topic_id(); ?>-lead" class="bbp-lead-topic">

	<li class="bbp-body">

		<div class="bbp-topic-header">

			<div class="bbp-meta">

				<span class="bbp-topic-author"><?php bbp_topic_author_link( array( 'type' => 'name' ) ); ?></span>

				<a href="<?php bbp_topic_permalink(); ?>" title="<?php bbp_topic_title(); ?>" class="bbp-topic-permalink">#<?php bbp_topic_id(); ?></a>

			</div><!-- .bbp-meta -->

		</div><!-- .bbp-topic-header -->

		<div id="post-<?php bbp_topic_id(); ?>" <?php bbp_topic_class(); ?>>

			<div class="bbp-topic-author">

				<?php do_action( 'bbp_theme_before_topic_author_details' ); ?>

				<?php bbp_topic_author_link( array( 'type' => 'avatar', 'sep' => '<br />', 'show_role' => true ) ); ?>

				<?php if ( is_super_admin() ) : ?>

					<?php do_action( 'bbp_theme_before_topic_author_admin_details' ); ?>

					<div class="bbp-topic-ip"><?php bbp_author_ip( bbp_get_topic_id() ); ?></div>

					<?php do_action( 'bbp_theme_after_topic_author_admin_details' ); ?>

				<?php endif; ?>

				<?php do_action( 'bbp_theme_after_topic_author_details' ); ?>

			</div><!-- .bbp-topic-author -->

			<div class="bbp-topic-content">
		
				<div class="bbp-topic-post-date">
				
					<?php bbp_topic_post_date(); ?>
				
				</div>
		
				<div class="bbp-topic-post-content">

					<?php do_action( 'bbp_theme_before_reply_content' ); ?>

					<?php bbp_reply_content(); ?>

					<?php do_action( 'bbp_theme_after_reply_content' ); ?>
				
				</div>

			</div><!-- .bbp-topic-content -->
		
			<div class="bbp-topic-footer">

				<?php do_action( 'bbp_theme_before_reply_admin_links' ); ?>

				<?php bbp_topic_admin_links(); ?>

				<?php do_action( 'bbp_theme_after_reply_admin_links' ); ?>
			
			</div>

		</div><!-- #post-<?php bbp_topic_id(); ?> -->

	</li><!-- .bbp-body -->

</ul><!-- #topic-<?php bbp_topic_id(); ?>-replies -->

<?php do_action( 'bbp_template_after_lead_topic' ); ?>
