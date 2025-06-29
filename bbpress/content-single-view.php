<?php
/**
 * Single View Content Part
 *
 * @package Oenology
 * @subpackage Theme
 */

?>

<div id="bbpress-forums">

	<?php bbp_set_query_name( 'bbp_view' ); ?>

	<?php if ( bbp_view_query() ) : ?>

		<?php bbp_get_template_part( 'loop',       'topics'    ); ?>

	<?php else : ?>

		<?php bbp_get_template_part( 'feedback',   'no-topics' ); ?>

	<?php endif; ?>

	<?php bbp_reset_query_name(); ?>

</div>
