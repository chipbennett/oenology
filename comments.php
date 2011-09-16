<?php
/**
 * Template part file the contains the Comments functionality
 *
 * This template file includes both the comments list and
 * 
 * @link	http://codex.wordpress.org/Function_Reference/comments_number			Codex reference: comments_number()
 * @link	http://codex.wordpress.org/Function_Reference/the_title					Codex reference: the_title()
 * @link	http://codex.wordpress.org/Function_Reference/get_comments_pages_count	Codex reference: get_comment_pages_count()
 * @link	http://codex.wordpress.org/Function_Reference/get_option				Codex reference: get_option()
 * @link	http://codex.wordpress.org/Function_Reference/paginate_comments_links	Codex reference: paginate_comments_links()
 * @link	http://codex.wordpress.org/Function_Reference/wp_list_comments			Codex reference: wp_list_comments()
 * @link	http://codex.wordpress.org/Function_Reference/comment_form				Codex reference: comment_form()
 * 
 * @uses		oenology_hook_post_comments_after()		Defined in /functions/hooks.php
 * @uses		oenology_hook_post_comments_before()()	Defined in /functions/hooks.php
 * 
 * @package 	Oenology
 * @copyright	Copyright (c) 2010, Chip Bennett
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 *
 * @since 		Oenology 1.0
 */
?>

<!-- Comments Begin (div#comments) -->
<div id="comments">

	<?php oenology_hook_post_comments_before(); ?>

	<?php 
	if ( 
	//
	//
	have_comments() 
	) {
		?>
		<h2 class="commentsheader">Feedback</h2>
		<?php
		// Globalize variable that holds comments by type
		global $comments_by_type;	
		?>
		<h3>Comments <?php if ( ! comments_open() ) { ?> <small>(Comments are closed)</small><?php } ?></h3>

		<?php $i = 0; ?>
		<span id="comments-responses" style="font-weight:bold;"><?php comments_number('No Responses', 'One Response', '% Responses' );?> to &#8220;<?php the_title(); ?>&#8221;</span>

		<?php 
		// If the paged comments setting is enabled, and enough comments exisst to cause comments to be paged
		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { 
			?>
			<div class="nav-comments">
				<?php paginate_comments_links( array( 'prev_text' => '&lt;&lt;', 'next_text' => '&gt;&gt;' ) ); ?>
			</div> <!-- .navigation -->
			<?php 
		} // check for comment navigation 
		
		if ( get_comments_number() > '0' ) { 
			?>
			<ol class="commentlist">
				<?php	wp_list_comments( 'type=comment&avatar_size=40' ); ?>
			</ol>
			<?php 
		}

		// Are there comments to navigate through?
		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) {
			?>
			<div class="nav-comments">
				<?php paginate_comments_links( array( 'prev_text' => '&lt;&lt;', 'next_text' => '&gt;&gt;' ) ); ?>
			</div>
			<?php 
		} // check for comment navigation 		
		
		// if the post has any trackbacks or pingbacks, display them as a list		
		global $comments_by_type;
		$comments_by_type = &separate_comments( $comments );
		if ( ! empty( $comments_by_type['pings'] ) ) {  
			?>
			<h3 class='trackbackheader'>Trackbacks</h3>
			<ol class="trackbacklist">
				<?php wp_list_comments( array( 'type' => 'pings', 'callback' => 'oenology_comment_list_pings' ) ); ?>
			</ol>
			<?php 
		}
	} else { 
		// or, if we don't have comments:
	} 
	// end have_comments() 

	comment_form();
	
	oenology_hook_post_comments_after(); 
	
	?>

</div>
<!-- Comments End  (div#comments) -->