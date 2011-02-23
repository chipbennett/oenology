<?php 

/* Load Settings Page Tab Content
*******************************************************************************************/

global $pagenow;
if ( 'themes.php' == $pagenow && isset( $_GET['page'] ) && 'oenology-reference' == $_GET['page'] ) :
    if ( isset ( $_GET['tab'] ) ) :
        $tab = $_GET['tab'];
    else:
        $tab = 'general';
    endif;
    switch ( $tab ) :
        case 'general' :
            oenology_reference_page_general();
            break;
        case 'faq' :
            oenology_reference_page_faq();
            break;
        case 'coderef' :
            oenology_reference_page_coderef();
            break;
        case 'changelog' :
            oenology_reference_page_changelog();
            break;
    endswitch;
endif;


/* Reference Page Tab Content
*******************************************************************************************/

// Changelog Tab
function oenology_reference_page_changelog() { ?>
	
	<h3 id="">1.1 [2011.02.DD]</h3>
	<p>Update Release</p>
	<ol>
	<li>New Features:
		<ol>
		<li>Added support for Post Formats (introduced in WordPress 3.1)</li>
		<li>Added basic Theme options:
			<ol>
			<li>Header Navigation Menu Position</li>
			<li>Header Navigation Menu Depth (up to three levels)</li>
			<li>Footer Credit Link (disabled-by-default)</li>
			</ol>
		</li>
		<li>Added Theme color schemes ("Varietals"): Syrah, Seyval Blanc</li>
		</ol>
	</li>
	<li>Maintenance/Bugfixes:
		<ol>
		<li>Added check to ensure TwentyTen header images are registered only if TwentyTen is installed</li>
		<li>Minor tweak/bugfix to ensure floats are cleared properly on paginated posts</li>
		<li>Minor tweaks to comments.php</li>
		</ol>
	</li>
	</ol>

	<h3 id="">1.0 [2010.12.08]</h3>
	<p>Maintenance Release</p>
	<ol>
	<li>Moved all CSS declarations into style.css, and eliminated @import calls</li>
	<li>Cleaned up un-needed CSS files in css\ and css\fonts\ directories; removed css\fonts\ directory.</li>
	<li>Fixed a few minor bugs</li>
	<li>Added Prev/Next page navigation in Loop Footer, to match Infobar navigation</li>
	<li>Added default Widgets to appear in each sidebar if no widgets are defined by the user</li>
	<li>Finished adding inline documentation for all functions used in the Theme, including functions.php</li>
	<li>Added default "(Untitled)" text to appear in place of Title for Posts without a defined Post Title</li>
	<li>Removed translation strings. Internationalization will be added in a later revision.</li>
	</ol>

	<h3 id="">0.9.2 [2010.11.04]</h3>
	<p>Minor BugFix release</p>
	<ol>
	<li>Fixed divide-by-zero PHP notice generated on the attachment page when the image metadata indicates 
	a shutter speed of zero.</li>
	<li>Fixed minor CSS image dimension bug</li>
	<li>Updated Theme tags</li>
	</ol>

	<h3 id="">0.9.1 [2010.09.24]</h3>
	<p>Initial Release.</p>
	
<?php }

// Changelog Tab
function oenology_reference_page_general() { ?>
	
	<h3 id="">Menu Functionality</h3>

	<p>The Theme fully supports WordPress core Navigation Menu functionality. The main site navigation menu 
	is called "Header Navigation", and the left sidebar page navigation is called "Sidebar Navigation".</p>

	<p>The Header Navigation menu can optionally be set to display either above or below the Site Title and 
	Description. By default, the Header Navigation menu displays above the Site Title/Description. To change 
	this setting, see Appearance -> Oenology Options.</p>

	<p>The Theme defaults to using wp_list_pages() for these menus, which means that you do not have to create 
	your own menus. With the Theme-default functionality, any time you add pages, they will automatically appear 
	in the menus.</p>

	<p>The Header Navigation menu shows only top-level Pages. The Sidebar Navigation shows up to four levels of 
	Child Pages, and shows the current Page and its Child Pages. Second-level Child Pages show from the first level, 
	third-level Child Pages show from the second level, and fourth-level Child Pages show from the third level.</p>

	<p>Menus are displayed as lists, with each list item being a link displaying a Page Title. The list items are 
	styled so that overly long Page Titles will not break the layout. Long Page Titles will be cut off, and the full 
	Page Title will appear in the tooltip when hovering over the link.</p>

	<h3 id="">Post Thumbnail Functionality</h3>

	<p>The Theme fully supports WordPress core Post Thumbnail functionality. By default, Post Thumbnails will appear 
	in the Post Title for Archive, Taxonomy (Category/Tag), and Search pages.</p>

	<h3 id="">Custom Header Image Functionality</h3>

	<p>The Theme fully supports WordPress core Custom Header Image functionality. The Theme is configured to make the 
	TwentyTen header images available if TwentyTen is installed. Custom images will be cropped to 1000x198px when uploaded.</p>

	<h3 id="">Custom Background Functionality</h3>

	<p>The Theme fully supports WordPress core Custom Background functionality. Background image or color is applied to 
	the BODY tag, and will appear outside the Theme content.</p>

	<h3 id="">Post Formats Functionality</h3>

	<p>The Theme fully supports WordPress core Post Formats functionality. Custom layout and style are applied for each of 
	the core Post Format types: Aside, Audio, Chat, Gallery, Image, Link, Status, and Video. Post Format archive pages are 
	linked in the post footer of each post that uses a Post Format other than "standard". Also, the Theme includes a custom 
	Widget to display a list of Post Format types, similar to the Category list or Tag list.</p>
	
	<p><strong>Note:</strong> to display captions for Gallery Post Format types, and for Image Post Format types with linked 
	(external) images, add the caption to the <em>Excerpt</em> field on the Edit Post screen.</p>

	<h3 id="">Widgets</h3>

	<p>The Theme includes some custom Widgets, that can take the place of their built-in counterparts. In fact, the custom 
	Widgets are essentially identical to the core Widgets, except that the custom Widgets are collapsible. The following 
	Widgets are available:</p>
	<ol>
		<li>Archives</li>
		<li>Categories</li>
		<li>Linkroll by Cat</li>
		<li>Post Formats</li>
		<li>Recent Posts</li>
		<li>Tags</li>
	</ol>
	
<?php }

// FAQ Tab
function oenology_reference_page_faq() { ?>
	
	<h3 id="">So, how do I learn from Oenology?</h3>

	<p>Each Theme template file includes a considerable amount of inline documentation, explaining the code 
	use. Also, each template file includes a function reference, that lists each function, hook, and tag 
	used in the file, along with a WordPress Codex reference, an explanation of the function, and example usage.</p>

	<h3 id="">What is oenology-reference.txt?</h3>

	<p>oenology-reference.txt is the master cross-reference file, that contains all of the functions, template tags, 
	and hooks used in the Theme.</p>

	<h3 id="">Why so many template files?</h3>

	<p>Oenology is likely broken down into more template parts than the average Theme. This deconstruction is by 
	design, in order to facilitate easier Child-Theming.</p>

	<h3 id="">What's in store for the future?</h3>

	<p>First and foremost, since Oenology is intended to be a learning tool, the inline and reference documentation 
	will be a continual work-in-progress, based upon user feedback. This documentation is complete as of Oenology 
	Version 1.0, but will continue to be updated and improved.</p>

	<p>Other features that may be added in the future:</p>
	<ol>
	<li>Internationalization</li>
	<li>Theme Options</li>
	<li>others, as determined by user feedback and demand</li>
	</ol>

	<h3 id="">What About SEO?</h3>
 
	<p>I am a firm believer that the single, most important criterion for SEO is good content. That said, the Theme 
	does take apply some SEO considerations:</p>
	<ol>
	<li>The Theme assumes that the H1 heading tag will only be applied to the Post Title, and not to any post-entry 
	content. Accordingly, if you use an H1 heading in the post-entry content, you'll find that it is styled rather 
	similarly to the H2 heading tag.</li>
	<li>The Theme template files ensure that the most important content - the post-entry content - is rendered 
	as early as possible. The loop.php template file is called first, and the sidebar-left.php and sidebar-right.php 
	files are called second.</li>
	<li>The Theme supplies a default breadcrumb navigation function.</li>
	<li>The Theme includes plug-and-play support for the following plugins: WP-Paginate, Yoast Breadcrumbs</li>
	</ol>

	<p>Most of the rest is really up to the user. The Theme is intended to be SEO-neutral: neither hurting your SEO, 
	nor going out of its way (and adding considerable bloat that is better added via the many good plugins available) 
	to improve it.</p>
	
<?php }

// Code Ref Tab
function oenology_reference_page_coderef() { ?>

<div class="updated"><p><strong>Please note: this page is a work-in-progress! For the time being, refer to the <em>oenology-reference.txt</em>
file in the Theme root directory for a better-formatted version of this information.</strong></p></div>

<p>The following functions, tags, and hooks are used (or referenced) in Oenology:</p>

<ul class="codereflinklist">
<li>
<h4>WordPress Functions</h4>
<ul>
<li><a href="#add_action">add_action()</a></li>
<li><a href="#add_custom_background">add_custom_background()</a></li>
<li><a href="#add_custom_image_header">add_custom_image_header()</a></li>
<li><a href="#add_editor_style">add_editor_style()</a></li>
<li><a href="#add_filter">add_filter()</a></li>
<li><a href="#add_image_size">add_image_size()</a></li>
<li><a href="#add_theme_support">add_theme_support()</a></li>
<li><a href="#apply_filters">apply_filters()</a></li>
<li><a href="#dynamic_sidebar">dynamic_sidebar()</a></li>
<li><a href="#get_bloginfo">get_bloginfo()</a> /<br /><a href="#bloginfo">bloginfo()</a></li>
<li><a href="#get_footer">get_footer()</a></li>
<li><a href="#get_header">get_header()</a></li>
<li><a href="#get_option">get_option()</a></li>
<li><a href="#get_queried_object">get_queried_object()</a></li>
<li><a href="#get_query_var">get_query_var()</a></li>
<li><a href="#get_search_form">get_search_form()</a></li>
<li><a href="#get_sidebar">get_sidebar()</a></li>
<li><a href="#get_stylesheet_uri">get_stylesheet_uri()</a></li>
<li><a href="#get_theme_root">get_theme_root()</a></li>
<li><a href="#get_userdata">get_userdata()</a></li>
<li><a href="#header_image">header_image()</a></li>
<li><a href="#home_url">home_url()</a></li>
<li><a href="#register_default_headers">register_default_headers()</a></li>
<li><a href="#register_nav_menus">register_nav_menus()</a></li>
<li><a href="#register_sidebar">register_sidebar()</a></li>
<li><a href="#register_widget">register_widget()</a></li>
<li><a href="#set_post_thumbnail_size">set_post_thumbnail_size()</a></li>
<li><a href="#size_format">size_format()</a></li>
<li><a href="#wp_upload_dir">wp_upload_dir()</a></li>
</ul>
</li>
<li>
<h4>WordPress Template Tags</h4>
<ul>
<li><a href="#body_class">body_class()</a></li>
<li><a href="#category_description">category_description()</a></li>
<li><a href="#comment_form">comment_form()</a></li>
<li><a href="#comments_link">comments_link()</a></li>
<li><a href="#comments_number">comments_number()</a></li>
<li><a href="#edit_post_link">edit_post_link()</a></li>
<li><a href="#get_avatar">get_avatar()</a></li>
<li><a href="#get_category">get_category()</a> /<br /><a href="#the_category">the_category()</a></li>
<li><a href="#get_category_parents">get_category_parents()</a></li>
<li><a href="#get_children">get_children()</a></li>
<li><a href="#get_comment_link">get_comment_link()</a></li>
<li><a href="#get_comments_number">get_comments_number()</a></li>
<li><a href="#get_comment_pages_count">get_comment_pages_count()</a></li>
<li><a href="#get_comment_type">get_comment_type()</a></li>
<li><a href="#get_month_link">get_month_link()</a></li>
<li><a href="#get_permalink">get_permalink()</a> /<br /><a href="#get_permalink">the_permalink()</a></li>
<li><a href="#get_post">get_post()</a> /<br /><a href="#get_post">the_post()</a> /<br /></li>
<li><a href="#get_post_format">get_post_format()</a></li>
<li><a href="#get_posts">get_posts()</a></li>
<li><a href="#get_search_query">get_search_query()</a> /<br /><a href="#get_search_query">the_search_query()</a></li>
<li><a href="#get_tag_feed_link">get_tag_feed_link()</a></li>
<li><a href="#get_template_part">get_template_part()</a></li>
<li><a href="#get_the_author">get_the_author()</a> /<br /><a href="#get_the_author">the_author()</a></li>
<li><a href="#get_the_author_meta">get_the_author_meta()</a> /<br /><a href="#get_the_author_meta">the_author_meta()</a></li>
<li><a href="#get_the_category">get_the_category()</a> /<br /><a href="#get_the_category">the_category()</a></li>
<li><a href="#get_the_content">get_the_content()</a> /<br /><a href="#get_the_content">the_content()</a></li>
<li><a href="#get_the_date">get_the_date()</a> /<br /><a href="#get_the_date">the_date()</a></li>
<li><a href="#get_the_excerpt">get_the_excerpt()</a> /<br /><a href="#get_the_excerpt">the_excerpt()</a></li>
<li><a href="#get_the_ID">get_the_ID()</a> /<br /><a href="#get_the_ID">the_ID()</a></li>
<li><a href="#get_the_post_thumbnail">get_the_post_thumbnail()</a> /<br /><a href="#get_the_post_thumbnail">the_post_thumbnail()</a></li>
<li><a href="#get_the_time">get_the_time()</a> /<br /><a href="#get_the_time">the_time()</a></li>
<li><a href="#get_the_title">get_the_title()</a> /<br /><a href="#get_the_title">the_title()</a></li>
<li><a href="#get_trackback_url">get_trackback_url()</a> /<br /><a href="#get_trackback_url">trackback_url()</a></li>
<li><a href="#get_year_link">get_year_link()</a></li>
<li><a href="#language_attributes">language_attributes()</a></li>
<li><a href="#next_comments_link">next_comments_link()</a> /<br /><a href="#next_comments_link">previous_comments_link()</a></li>
<li><a href="#next_post_link">next_post_link()</a> /<br /><a href="#next_post_link">previous_post_link()</a></li>
<li><a href="#post_class">post_class()</a></li>
<li><a href="#posts_nav_link">posts_nav_link()</a></li>
<li><a href="#single_cat_title">single_cat_title()</a></li>
<li><a href="#single_tag_title">single_tag_title()</a></li>
<li><a href="#wp_get_shortlink">wp_get_shortlink()</a> /<br /><a href="#wp_get_shortlink">the_shortlink()</a></li>
<li><a href="#the_tags">the_tags()</a></li>
<li><a href="#the_widget">the_widget()</a></li>
<li><a href="#wp_get_attachment_image">wp_get_attachment_image()</a></li>
<li><a href="#wp_get_attachment_link">wp_get_attachment_link()</a></li>
<li><a href="#wp_get_current_user">wp_get_current_user()</a></li>
<li><a href="#wp_get_post_categories">wp_get_post_categories()</a></li>
<li><a href="#wp_link_pages">wp_link_pages()</a></li>
<li><a href="#wp_list_comments">wp_list_comments()</a></li>
<li><a href="#wp_list_pages">wp_list_pages()</a></li>
<li><a href="#wp_loginout">wp_loginout()</a></li>
<li><a href="#wp_nav_menu">wp_nav_menu()</a></li>
<li><a href="#wp_register">wp_register()</a></li>
<li><a href="#wp_title">wp_title()</a></li>
</ul>
</li>
<li>
<h4>WordPress Conditional Tags</h4>
<ul>
<li><a href="#comments_open">comments_open()</a></li>
<li><a href="#has_nav_menu">has_nav_menu()</a></li>
<li><a href="#have_comments">have_comments()</a></li>
<li><a href="#have_posts">have_posts()</a></li>
<li><a href="#is_404">is_404()</a></li>
<li><a href="#is_archive">is_archive()</a></li>
<li><a href="#is_author">is_author()</a></li>
<li><a href="#is_category">is_category()</a></li>
<li><a href="#is_day">is_day()</a></li>
<li><a href="#is_feed">is_feed()</a></li>
<li><a href="#is_home">is_home()</a></li>
<li><a href="#is_month">is_month()</a></li>
<li><a href="#is_page">is_page()</a></li>
<li><a href="#is_search">is_search()</a></li>
<li><a href="#is_single">is_single()</a></li>
<li><a href="#is_singular">is_singular()</a></li>
<li><a href="#is_tag">is_tag()</a></li>
<li><a href="#is_user_logged_in">is_user_logged_in()</a></li>
<li><a href="#is_year">is_year()</a></li>
<li><a href="#post_password_required">post_password_required()</a></li>
<li><a href="#wp_attachment_is_image">wp_attachment_is_image()</a></li>
</ul>
<h4>WordPress Hooks</h4>
<ul>
<li><a href="#hook_after_setup_theme">after_setup_theme</a></li>
<li><a href="#hook_get_comments_number">get_comments_number</a></li>
<li><a href="#hook_widgets_init">widgets_init</a></li>
<li><a href="#hook_wp_enqueue_script">wp_enqueue_script</a></li>
<li><a href="#hook_wp_footer">wp_footer</a></li>
<li><a href="#hook_wp_footer">wp_footer</a></li>
<li><a href="#hook_wp_head">wp_head</a></li>
<li><a href="#hook_wp_title">wp_title</a></li>
</ul>
<h4>WordPress Variables</h4>
<ul>
<li><a href="#var_page">$page</a></li>
<li><a href="#var_paged">$paged</a></li>
<li><a href="#var_post">$post</a></li>
<li><a href="#var_wpdb">$wpdb</a></li>
</ul>
<h4>WordPress Constants</h4>
<ul>
<li><a href="#"></a></li>
</ul>
</li>
<li>
<h4>PHP Functions</h4>
<ul>
<li><a href="#_server">$_SERVER[]</a></li>
<li><a href="#array_map">array_map()</a></li>
<li><a href="#array_reverse">array_reverse()</a></li>
<li><a href="#array_values">array_values()</a></li>
<li><a href="#basename">basename()</a></li>
<li><a href="#count">count()</a></li>
<li><a href="#create_function">create_function()</a></li>
<li><a href="#date">date()</a></li>
<li><a href="#define">define()</a></li>
<li><a href="#max">max()</a></li>
<li><a href="#number_format">number_format()</a></li>
<li><a href="#preg_replace">preg_replace()</a></li>
<li><a href="#require">require()</a> /<br /><a href="#require">require_once()</a></li>
<li><a href="#sprintf">sprintf()</a></li>
<li><a href="#str_replace">str_replace()</a></li>
<li><a href="#trim">trim()</a></li>
<li><a href="#urldecode">urldecode()</a></li>
</ul>
<h4>PHP Conditionals</h4>
<ul>
<li><a href="#file_exists">file_exists()</a></li>
<li><a href="#filesize">filesize()</a></li>
<li><a href="#function_exists">function_exists()</a></li>
<li><a href="#is_array">is_array()</a></li>
<li><a href="#isset">isset()</a></li>
</ul>
<h4>Oenology Custom Functions</h4>
<ul>
<li><a href="#oenology_404_handler">oenology_404_handler()</a></li>
<li><a href="#oenology_admin_header_style">oenology_admin_header_style()</a></li>
<li><a href="#oenology_breadcrumb">oenology_breadcrumb()</a></li>
<li><a href="#oenology_comment_count">oenology_comment_count()</a></li>
<li><a href="#oenology_copyright">oenology_copyright()</a></li>
<li><a href="#oenology_filter_wp_title">oenology_filter_wp_title()</a></li>
<li><a href="#oenology_gallery_image_meta">oenology_gallery_image_meta()</a></li>
<li><a href="#oenology_gallery_links">oenology_gallery_links()</a></li>
<li><a href="#oenology_header_style">oenology_header_style()</a></li>
<li><a href="#oenology_load_widgets">oenology_load_widgets()</a></li>
<li><a href="#oenology_setup">oenology_setup()</a></li>
<li><a href="#oenology_setup_widgets">oenology_setup_widgets()</a></li>
<li><a href="#oenology_show_current_cat_on_single">oenology_show_current_cat<br />_on_single()</a></li>
<li><a href="#oenology_widget_archives">oenology_widget_archives()</a></li>
<li><a href="#oenology_widget_categories">oenology_widget_categories()</a></li>
<li><a href="#oenology_widget_linkrollbycat">oenology_widget_linkrollbycat()</a></li>
<li><a href="#oenology_widget_recentposts">oenology_widget_recentposts()</a></li>
<li><a href="#oenology_widget_tags">oenology_widget_tags()</a></li>
</ul>
<h4>Other Custom Functions</h4>
<ul>
<li><a href="#wp_paginate">wp_paginate()</a></li>
</ul>
</li>
</ul>

<hr style="clear:both;" />

<h2>Functions</h2>

<h3 id="_server">$_SERVER[]</h3>
<div style="padding-left:30px;">
<p><code>$_SERVER[]</code> is a PHP function that returns various server variables.</p>
<ul style="list-style-type:disc;margin-left:25px;">
<li>PHP reference: <a href="http://php.net/manual/en/reserved.variables.server.php">$_SERVER</a></li>
</ul>

<p>Example:</p>
<ul style="list-style-type:disc;margin-left:25px;">
<li><code>$_SERVER['PHP_SELF']</code><br />Returns the name of the current file</li>
</ul>

<p>Used in the following template files:</p>
<ul style="list-style-type:disc;margin-left:25px;">
<li>(tbd)</li>
</ul>
</div>

<h3 id="add_action">add_action()</h3>
<div style="padding-left:30px;">
<p><code>add_action()</code> is a WordPress function.</p>
<ul style="list-style-type:disc;margin-left:25px;">
<li>Codex reference: <a href="http://codex.wordpress.org/Function_Reference/add_action">add_action()</a></li>
</ul>

<p><code>add_action()</code> is used to hook a function into a WordPress action</p>

<p><code>add_action( $tag, $function_to_add, $priority, $accepted_args )</code> accepts four arguments:</p>
<ul style="list-style-type:disc;margin-left:25px;">
<li><code>$tag:</code> WordPress action into which to hook the function.<br />Default: <code>null</code></li>
<li><code>$function_to_add:</code> function to hook into the WordPress action.<br />Default: <code>null</code></li>
<li><code>$priority:</code> relative priority (order of execution, lower numbers execute sooner) of function.<br />Default: <code>10</code></li>
<li><code>$accepted_args:</code> number of arguments accepted by function being hooked.<br />Default: <code>1</code></li>
</ul>

<p>Example:</p>
<ul style="list-style-type:disc;margin-left:25px;">
<li><code>add_action( 'after_setup_theme', 'oenology_setup', 10 );</code><br />
Hooks custom function oenology_setup() into the "after_setup_theme" action, with the default priority</li>
</ul>

<p>Used in the following template files:</p>
<ul style="list-style-type:disc;margin-left:25px;">
<li>functions.php</li>
</ul>
</div>

<h3 id="add_custom_background">add_custom_background()</h3>
<div style="padding-left:30px;">
<p><code>add_custom_background()</code> is a WordPress function.</p>
Codex reference: <a href="http://codex.wordpress.org/Function_Reference/add_custom_background">add_custom_background()</a>

<p><code>add_custom_background()</code> is used to add Theme support for WordPress custom background functionality</p>

<p><code>add_custom_background( $header_callback, $admin_header_callback, $admin_image_div_callback )</code> accepts three arguments:</p>
 - $header_callback: Callback to add to "wp_head". Default: none.
 - $admin_header_callack: Callback to add to Custom Background admin screen. Default: none.
 - $admin_image_div_callback: Output a custom background image div on Custom Background admin screen. Default: none

<p>Example:</p>
add_custom_background();
Adds custom background support to Theme, with no default background image defined.

<p>Used in the following template files:</p>
functions.php
</div>

<h3 id="add_custom_image_header">add_custom_image_header()</h3>
<div style="padding-left:30px;">
<p><code>add_custom_image_header()</code> is a WordPress template tag.</p>
Codex reference: <a href="http://codex.wordpress.org/Function_Reference/add_custom_image_header">add_custom_image_header()</a>

<p><code>add_custom_image_header()</code> is used to add Theme support for WordPress custom background functionality</p>

<p><code>add_custom_image_header( $header_callback, $admin_header_callback )</code> accepts two arguments:</p>
 - $header_callback: Callback to add to "wp_head". Default: none.
 - $admin_header_callback: Callback to add to Custom Image Header admin screen. Default: none.

<p>Example:</p>
add_custom_image_header( 'oenology_header_style', 'oenology_admin_header_style' );
Adds custom image header support to Theme, using header style defined in custom function
oenology_header_style(), and Custom Image Header admin screen style defined in custom function
oenology_admin_header_style().

<p>Used in the following template files:</p>
functions.php
</div>

<h3 id="add_editor_style">add_editor_style()</h3>
<div style="padding-left:30px;">
<p><code>add_editor_style()</code> is a WordPress template tag.</p>
Codex reference: <a href="http://codex.wordpress.org/Function_Reference/add_editor_style">add_editor_style()</a>

<p><code>add_editor_style()</code> is used to add Theme support for WordPress custom visual editor style functionality</p>

<p><code>add_editor_style( $stylesheet )</code> accepts one argument:</p>
 - $stylesheet: name (without file extension) of the CSS file that contains the custom editor style
 definitions. Default: editor-style.css ('editor-style')

<p>Example:</p>
add_editor_style();
Adds custom visual editor style support to Theme, with styles defined in CSS file editor-style.css.

<p>Used in the following template files:</p>
functions.php
</div>

<h3 id="add_filter">add_filter()</h3>
<div style="padding-left:30px;">
<p><code>add_filter()</code> is a WordPress function.</p>
Codex reference: <a href="http://codex.wordpress.org/Function_Reference/add_filter">add_filter()</a>

<p><code>add_filter()</code> is used to hook a function into a WordPress action</p>

<p><code>add_filter( $tag, $function_to_add, $priority, $accepted_args )</code> accepts four arguments:</p>
 - $tag: WordPress filter into which to hook the function. Default: none
 - $function_to_add: function to hook into the WordPress filter. Default: none
 - $priority: relative priority (order of execution, lower numbers execute sooner) of function. Default: 10
 - $accepted_args: number of arguments accepted by function being hooked. Default: 1

<p>Example:</p>
add_filter('get_comments_number', 'oenology_comment_count', 0);
Hooks custom function oenology_comment_count() into the "get_comment_count" filter, with the highest priority (0)

<p>Used in the following template files:</p>
functions.php
</div>

<h3 id="add_image_size">add_image_size()</h3>
<div style="padding-left:30px;">
<p><code>add_image_size()</code> is a WordPress function.</p>
Codex reference: <a href="http://codex.wordpress.org/Function_Reference/add_image_size">add_image_size()</a>

<p><code>add_image_size()</code> is used to define a custom thumbnail image size, which will be generated
along with the default sizes of "Original", "Large", "Medium", "Small", and "Thumbnail".</p>

<p><code>add_image_size( $name, $width, $height, $crop )</code> accepts four arguments:</p>
 - $name: Name of the custom Image Size to be added. Default: none.
 - $width: Width (in pixels) of the custom image. Default: '0'.
 - $height: Height (in pixels) of the custom image. Default: '0'.
 - $crop: boolean (TRUE or FALSE) argument to indicate crop method:
  - TRUE: hard crop mode
  - FALSE: soft (proportional) crop mode

<p>Example:</p>
add_image_size( 'attachment-nav-thumbnail', 45, 45, true );
Adds a custom image size "attachment-nav-thumbnail", 45px wide, 45px in height, hard-cropped.

<p>Used in the following template files:</p>
functions.php
</div>

<h3 id="add_theme_support">add_theme_support()</h3>
<div style="padding-left:30px;">
<p><code>add_theme_support()</code> is a WordPress function.</p>
Codex reference: <a href="http://codex.wordpress.org/Function_Reference/add_theme_support">add_theme_support()</a>

<p><code>add_theme_support()</code> is used to add Theme support for the specified functionality</p>

<p><code>add_theme_support( $feature )</code> accepts one argument:</p>
 - $feature: feature for which to add Theme support. 
  - Currently, either 'automatic-feed-links' or 'post-thumbnails'
  - Default: none

<p>Example:</p>
add_theme_support( 'post-thumbnails' );
Adds Theme support for core WordPress Post Thumbnails feature

<p>Used in the following template files:</p>
functions.php
</div>

<h3 id="apply_filters">apply_filters()</h3>
<div style="padding-left:30px;">
<p><code>apply_filters()</code> is a WordPress function.</p>
Codex reference: <a href="http://codex.wordpress.org/Function_Reference/apply_filters">apply_filters()</a>

<p><code>apply_filters()</code> is used to call the functions added to a filter hook, and apply them to a specified value.</p>

<p><code>apply_filters( $tag, $value )</code> accepts two arguments:</p>
 - $tag: the name of the filter hook. Default: none.
 - $value: the value to be modified by the specified filter hook.

<p>Examples:</p>
apply_filters( 'oenology_header_image_width', 1000 ) );
 - Applies the value of 1000 (px) to the "oenology_header_image_width" filter hook.
$title = apply_filters( 'widget_title', empty($instance['title']) ? 'oenology Recent Posts' : $instance['title'] );
 - Applies a string (based on a shorthand conditional) to the "widget_title" filter hook, and sets that value to the variable "$title".

<p>Used in the following template files:</p>
functions.php
</div>

<h3 id="array_map">array_map()</h3>
<div style="padding-left:30px;">
<p><code>array_map()</code> is a PHP function.</p>
PHP reference: <a href="http://php.net/manual/en/function.array-map.php">array_map()</a>

<p><code>array_map()</code> is used to apply a callback to the elements of the given array(s)</p>

<p><code>array_map()</code> returns an array containing all the elements of arr1 after applying the callback function to each one. 
The number of parameters that the callback function accepts should match the number of arrays passed to the array_map()</p>

<p><code>array_map( $callback, $array )</code> accepts two arguments:</p>
 - $callback: the function to apply to the array
 - $array: the array to which to apply the function

<p>Used in the following template files:</p>
functions.php
</div>

<h3 id="array_reverse">array_reverse()</h3>
<div style="padding-left:30px;">
<p><code>array_reverse()</code> is a PHP function.</p>
PHP reference: <a href="http://php.net/manual/en/function.array-reverse.php">array_reverse()</a>

<p><code>array_reverse()</code> is used to reverse the order of elements in an array</p>

<p><code>array_reverse()</code> will take an array containing elements array[0] = A, array[1] = B, array[2] = C,
and reverse the array, such that array[0] = C, array[1] = B, array[2] = A.</p>

<p><code>array_reverse( $array, $preserve_keys )</code> accepts two arguments:</p>
 - $array: the array to reverse
 - $preserve_keys: (boolean) set to TRUE to preserve keys

<p>Example:</p>
$breadcrumbs = array_reverse($breadcrumbs);
Reverses the order of elements in the $breadcrumb array (containing a list of Parent Categories)

<p>Used in the following template files:</p>
functions.php
</div>

<h3 id="array_values">array_values()</h3>
<div style="padding-left:30px;">
<p><code>array_values()</code> is a PHP function.</p>
PHP reference: <a href="http://php.net/manual/en/function.array-values.php">array_values()</a>

<p><code>array_values()</code> is used to return an array of indexed values</p>

<p><code>array_values()</code> will take an array containing elements "size" => "XL", "color" => "black", "sleeve" => "long",
and return an array containing elements array[0] = "XL", array[1] = "black", array[3] = "long"</p>

<p><code>array_values( $array )</code> accepts one argument:</p>
 - $array: array for which to return values

<p>Used in the following template files:</p>
functions.php
</div>

<h3 id="basename">basename()</h3>
<div style="padding-left:30px;">
<p><code>basename()</code> is a PHP function.</p>
PHP reference: <a href="http://php.net/manual/en/function.basename.php">basename()</a>

<p><code>basename()</code> is used to return the filename component of a "\path\to\filename.ext" string</p>

<p><code>basename( $path, $ext )</code> accepts two arguments:</p>
 - $path: string containing a filepath
 - $ext: file extension, e.g. ".php". If included, the indicated extension will omitted from the returned value

<p>Used in the following template files:</p>
functions.php
</div>

<h3 id="bloginfo">bloginfo()</h3>
<div style="padding-left:30px;">
<p><code>bloginfo()</code> is a WordPress template tag.  </p>
Codex reference: <a href="http://codex.wordpress.org/Function_Reference/bloginfo">bloginfo()</a>

<p><code>bloginfo()</code> can be used to print several useful WordPress-related parameters. For <p>Example:</p>

	charset = (character set defined for the blog (see wp-config.php); usually UTF-8)
	description =  (blog description, as defined on the General Settings page in the administration panel)
	html_type =  (HTML type, as defined on the General Settings page in the administration panel. Usually "text/html")
	name =  (blog name, as defined on the General Settings page in the administration panel)
	template_directory = (url of the directory that contains the currently active theme)
	version = (version of WordPress installed)
	
<p>For the full list of parameters returned by bloginfo(), see the Codex.</p>

<p><code>bloginfo()</code> prints (displays/outputs) the data requested. To get, but not display/output the data, use get_bloginfo() instead.</p>

<p>Used in the following template files:</p>
footer.php, functions.php, header.php, loop-header.php, site-header.php
</div>

<h3 id="body_class">body_class()</h3>
<div style="padding-left:30px;">
<p><code>body_class()</code> is a WordPress template tag.</p>
Codex reference: <a href="http://codex.wordpress.org/Template_Tags/body_class">body_class()</a>

<p><code>body_class()</code> is added inside the HTML &lt;body&gt; tag, and outputs various CSS class
declarations, depending on which page is currently being displayed.</p>

<p>For the full list of CSS classes returned by body_class(), see the Codex.</p>

<p>Used in the following template files:</p>
404.php, index.php, page.php
</div>

<h3 id="category_description">category_description()</h3>
<div style="padding-left:30px;">
<p><code>category_description()</code> is a WordPress template tag.</p>
Codex reference: <a href="http://codex.wordpress.org/Function_Reference/category_description">category_description()</a>

<p><code>category_description()</code> is used to display the description for the current category.</p>

<p><code>category_description( $cat )</code> accepts one argument:</p>
 - $cat: category (ID) for which to display the description. Defaults to current category.

<p><code>category_description()</code> must be used within the Loop, unless given a category ID 
 using the $cat argument.</p>
 
 <p>Used in the following template files:</p>
 loop-header.php
</div>

<h3 id="comment_form">comment_form()</h3>
<div style="padding-left:30px;">
<p><code>comment_form()</code> is a WordPress template tag.</p>
Codex reference: <a href="http://codex.wordpress.org/Template_Tags/comment_form">comment_form()</a>

<p><code>comment_form()</code> is used to output the comment reply form in the comments section
of a Post or Page.</p>

<p><code>comment_form()</code> accepts two arguments:</p>
 - $args: ampersand (&) joined list of arguments. See the Codex reference for full list. 
 - $postid: PostID of the post to which the comment form should post comments. 
    Defaults to the current post.

<p>Example:</p>
comment_form();

<p><code>comment_form()</code> must be used from within the Loop, unless the $postid parameter is used.</p>

<p>Used in the following template files:</p>
comments.php
</div>

<h3 id="comments_link">comments_link()</h3>
<div style="padding-left:30px;">
<p><code>comments_link()</code> is a WordPress template tag.</p>
Codex reference: <a href="http://codex.wordpress.org/Template_Tags/comments_link">comments_link()</a>

<p><code>comments_link()</code> is used to display the URL to the current post's comments. This tag
returns the URL only, rather than the full HTML anchor-tag link.</p>

<p><code>comments_link()</code> accepts no arguments.</p>

<p>Example:</p>
&lt;a href="comments_link();"&gt;Comments&lt;/a&gt;

<p><code>comments_link()</code> must be used within the Loop.</p>

<p>Used in the following template files:</p>
post-header.php
</div>

<h3 id="comments_number">comments_number()</h3>
<div style="padding-left:30px;">
<p><code>comments_number()</code> is a WordPress template tag.</p>
Codex reference: <a href="http://codex.wordpress.org/Function_Reference/comments_number">comments_number()</a>

<p><code>comments_number()</code> is used to display the number of comments (including 
comments, trackbacks, and pingbacks) on the current post.</p>

<p><code>comments_number( $a, $b, $c )</code> accepts three arguments:</p>
 - $a: what to display for 0 comments
 - $b: what to display for 1 comment
 - $c: what to display for multiple comments
 
<p>Example:</p>
comments_number('0','1','%'); displays:
  - '0' if 0 comments
  - '1' if 1 comment
  - '#' (actual number of comments) if multiple comments

<p><code>comments_number()</code> must be used within the Loop.</p>

<p>Used in the following template files:</p>
comments.php, post-header.php
</div>

<h3 id="comments_open">comments_open()</h3>
<div style="padding-left:30px;">
<p><code>comments_open()</code> is a WordPress template conditional tag.</p>
Codex reference: <a href="http://codex.wordpress.org/Function_Reference/comments_open">comments_open</a>

<p><code>comments_open()</code> is a boolean (returns TRUE or FALSE) conditional tag that returns true if 
comments are open for the current post.</p>

<p><code>comments_open( $postid )</code> accepts one argument:</p>
 - $postid: PostID of the post being checked. Defaults to the current post.

<p><code>comments_open()</code> must be used from within the Loop, unless the $postid parameter is used.</p>

<p>Used in the following template files:</p>
comments.php, loop.php
</div>

<h3 id="count">count()</h3>
<div style="padding-left:30px;">
<p><code>count()</code> is a PHP function.</p>
PHP reference: <a href="http://php.net/manual/en/function.count.php">count()</a>

<p><code>count()</code> is used to count the number of elements in an array.</p>

<p><code>count()</code> will take an array containing elements array[0] = "red", array[1] = "green", array[2] = "blue",
and return the value "3".</p>

<p><code>count( $array, $mode )</code> accepts two arguments:</p>
 - $array: the array for which to count the elements.
 - $mode: count normally, or count recursively. Default: count_normal.

<p>Example:</p>
count($comments_by_type['comment']);
Returns the number of comments of type 'comment' (rather than 'trackback' or 'pingback') for the current Post->$ID.

<p>Used in the following template files:</p>
functions.php
</div>

<h3 id="create_function">create_function()</h3>
<div style="padding-left:30px;">
<p><code>create_function()</code> is a WordPress function.</p>
PHP reference: <a href="http://php.net/manual/en/function.create-function.php">create_function()</a>

<p><code>create_function()</code> is used to create an anonymous function from the parameters passed, 
and return a unique name for it. </p>

<p><code>create_function( $args, $code )</code> accepts two arguments:</p>
 - $args: the arguments to pass to the function
 - $code: the function code

<p>Used in the following template files:</p>
functions.php
</div>

<h3 id="date">date()</h3>
<div style="padding-left:30px;">
<p><code>date()</code> is a PHP function that returns the current date.</p>
PHP reference: <a href="http://php.net/manual/en/function.date.php">date()</a>

<p><code>date()</code> accepts one argument: a string indicating the date format.</p>

<p>Used in the following template files:</p>
footer.php
</div>

<h3 id="define">define()</h3>
<div style="padding-left:30px;">
<p><code>define()</code> is a PHP function.</p>
PHP reference: <a href="http://php.net/manual/en/function.define.php">define()</a>

<p><code>define()</code> is used to define a named constant.</p>

<p><code>define( $name, $value, $case_insensitive )</code> accepts arguments:</p>
 - $name: name of the constant. Default: none.
 - $value: value of the constant. Default: none.
 - $case_insensitive: (boolean) determines if constant name is case-sensitive or not.
  - TRUE: name is case-sensitive ("CONSTANT" and "constant" are two different constants)
  - FALSE: name is case-insensitive ("CONSTANT" and "constant" are the same constant)
  - Default: FALSE

<p>Example:</p>
define( 'HEADER_TEXTCOLOR', '000000' );
Defines the "HEADER_TEXTCOLOR" constant, with a value of "000000" (the HEX value for black)

<p>Used in the following template files:</p>
functions.php
</div>

<h3 id="dynamic_sidebar">dynamic_sidebar()</h3>
<div style="padding-left:30px;">
<p><code>dynamic_sidebar()</code> is a WordPress function.</p>
Codex reference: <a href="http://codex.wordpress.org/Function_Reference/dynamic_sidebar">dynamic_sidebar()</a>

<p><code>dynamic_sidebar()</code> is used to insert widgetized areas ("sidebars") into a Theme.</p>

<p>Example:</p>
dynamic_sidebar( 'foo' ) will insert a dynamic sidebar named "foo".

<p>Dynamic sidebars must be defined and registered. Refer to functions.php for more information.</p>

<p>Used in the following template files:</p>
sidebar-left.php, sidebar-right.php
</div>

<h3 id="edit_post_link">edit_post_link()</h3>
<div style="padding-left:30px;">
<p><code>edit_post_link()</code> is a WordPress template tag.</p>
Codex reference: <a href="http://codex.wordpress.org/Function_Reference/edit_post_link">edit_post_link()</a>

<p><code>edit_post_link()</code> is used to display a link to edit the current post. This link only
displays if the current user is logged in and has the edit_post capability
(typically, Admins, Editors, and Authors). </p>

<p><code>edit_post_link()</code> returns the full HTML anchor tag, rather than just the URL of the edit-post
link. To retrieve just the URL, use get_edit_post_link().</p>

<p><code>edit_post_link( $link, $before, $after, $id )</code> accepts four arguments:</p>
- $link: link text to display. Defaults to "Edit This"
- $before: text to display before link. Defaults to no text.
- $after: text to display after link. Defaults to no text.
- $id: ID of post to be edited. Defaults to ID of current post.

<p>Example:</p>
edit_post_link( 'Edit' ); displays: "&lt;a href='[link to post edit screen]'&gt;Edit&lt;/a&gt;"

<p><code>edit_post_link()</code> must be used within the Loop, unless the $id argument is specified.</p>

<p>Used in the following template files:</p>
post-header.php
</div>

<h3 id="file_exists">file_exists()</h3>
<div style="padding-left:30px;">
<p><code>file_exists()</code> is a PHP function.</p>
PHP reference: <a href="http://php.net/manual/en/function.file-exists.php">file_exists()</a>

<p><code>file_exists()</code> is a boolean (returns TRUE or FALSE) conditional function that returns true if 
the specified file exists.</p>

<p><code>file_exists( $filepath )</code> accepts one argument:</p>
 - $filepath: (string) the filepath and filename, e.g. /path/to/my/file.ext

<p>Example:</p>
file_exists( get_theme_root() . '/twentyten/style.css' )
 - returns TRUE if the file is found

<p>Used in the following template files:</p>
functions.php
</div>

<h3 id="filesize">filesize()</h3>
<div style="padding-left:30px;">
<p><code>filesize()</code> is a PHP function.</p>
PHP reference: <a href="http://php.net/manual/en/function.filesize.php">filesize()</a>

<p><code>filesize()</code> is used to return the size, in bytes, of the specified file </p>

<p><code>filesize( $file )</code> accepts one argument:</p>
 - $file: string containing full path to file for which to return the size.

<p>Used in the following template files:</p>
functions.php
</div>

<h3 id="function_exists">function_exists()</h3>
<div style="padding-left:30px;">
<p><code>function_exists()</code> is a boolean (returns TRUE or FALSE) conditional PHP function.</p>
PHP reference: <a href="http://php.net/manual/en/function.function-exists.php">function_exists()</a>

<p><code>function_exists( 'foo' )</code> returns TRUE if a function named foo() is found; otherwise, it returns FALSE.</p>

<p>Used in the following template files:</p>
404.php, functions.php, loop-footer.php, post-entry.php
</div>

<h3 id="get_avatar">get_avatar()</h3>
<div style="padding-left:30px;">
<p><code>get_avatar()</code> is a WordPress template tag.</p>
Codex reference: <a href="http://codex.wordpress.org/Function_Reference/get_avatar">get_avatar()</a>

<p><code>get_avatar()</code> is used to display the Post ID for the current post.

<p><code>get_avatar( $id_or_email, $size, $default, $alt )</code>  accepts four arguments:</p>
 - $id_or_email: UserID or email address;
 - $size: width/height (in pixels) of the displayed avatar. Defaults to '96'.
 - $default: URL for default image to display if the user has no defined avatar. Defaults to "Mystery Man"
 - $alt: alt text to display for avatar image. Defaults to no alt text.

<p>Example:</p>
echo get_avatar( get_the_author_meta('email'), $size = '20'); displays a 20x20px avatar for the post author.

<p>To get the Avatar without displaying it, omit "echo" in the function call for get_avatar().</p>

<p>Used in the following template files:</p>
post-footer.php
</div>


<h3 id="get_bloginfo">get_bloginfo()</h3>
<div style="padding-left:30px;">
See: bloginfo()

<p>Used in the following template files:</p>
functions.php
</div>

<h3 id="get_category">get_category()</h3>
<div style="padding-left:30px;">
See: the_category()

<p>Used in the following template files:</p>
functions.php
</div>

<h3 id="get_category_parents">get_category_parents()</h3>
<div style="padding-left:30px;">
<p><code>get_category_parents()</code> is a WordPress function.</p>
Codex reference: <a href="http://codex.wordpress.org/Function_Reference/get_category_parents">get_category_parents()</a>

<p><code>get_category_parents()</code> is used to return a list of the parents of a category, 
including the category, sorted by ID.</p>

<p><code>get_category_parents( $category, $displaylink, $separator, $nicename )</code> accepts four arguments:</p>
 - $category: category ID for which to return the list. Default: current category, or none
 - $displaylink: boolean (TRUE/FALSE) argument to display the list as links to the categories
  - TRUE: display list as links to categories
  - FALSE: display list as text-only
  - Default: TRUE
 - $separator: text string to be used as separator between categories in the list
 - $nicename: boolean (TRUE/FALSE) argument to display the category nicename (slug)
  - TRUE: Display the category nicename (e.g. "my-category")
  - FALSE: Display the category display name (e.g. "My Category")
  - Default: FALSE

<p>Used in the following template files:</p>
functions.php
</div>

<h3 id="get_children">get_children()</h3>
<div style="padding-left:30px;">
<p><code>get_children()</code> is a WordPress function.</p>
Codex reference: <a href="http://codex.wordpress.org/Function_Reference/get_children">get_children()</a>

<p><code>get_children()</code> is used to retrieve attachments, revisions of a given Post</p>

<p><code>get_children()</code> returns an associative array of posts (of variable type set 
by $output parameter) with post IDs as array keys, or an empty array if no 
posts are found.</p>

<p><code>get_children( $args[string] )</code> accepts multiple arguments. See the Codex for full list.</p>

<p>Used in the following template files:</p>
functions.php
</div>

<h3 id="get_comment_link">get_comment_link()</h3>
<div style="padding-left:30px;">
<p><code>get_comment_link()</code> is a WordPress template tag.</p>
Codex reference: <a href="http://codex.wordpress.org/Function_Reference/get_comment_link">get_comment_link()</a>

<p><code>get_comment_link()</code> is used to get the permalink to a given comment</p>

<p><code>get_comment_link()</code> accepts two arguments:</p>
 - $comment: Id for comment for which to output link. Defaults to current comment.
 - $args: ampersand (&) linked array of options. See Codex for full list.

<p>Example:</p>
&lt;a href="echo get_comment_link();"&gt;Comment&lt;/a&gt;

<p><code>get_comment_link()</code> must be used from within the Loop, unless the $comment parameter is used.</p>

<p>Used in the following template files:</p>
comments.php
</div>

<h3 id="get_comments_number">get_comments_number()</h3>
<div style="padding-left:30px;">
<p><code>get_comments_number()</code> is a WordPress template tag.</p>
Codex reference: <a href="http://codex.wordpress.org/Template_Tags/get_comments_number">get_comments_number()</a>

<p><code>get_comments_number()</code> is used to return the number (as a numeric value) of comments (including 
comments, trackbacks, and pingbacks) on the current post.</p>

<p><code>get_comments_number()</code> accepts no arguments</p>

<p><code>get_comments_number()</code> must be used within the Loop.</p>

<p>Used in the following template files:</p>
comments.php
</div>

<h3 id="get_comment_pages_count">get_comment_pages_count()</h3>
<div style="padding-left:30px;">
<p><code>get_comment_pages_count()</code> is a WordPress function.</p>
Codex reference: N/A

<p><code>get_comment_pages_count()</code> is used to return the number of comment pages for a given post. Generally,
it is used as part a conditional, to display comment-page navigation links only if more than one comment
page exists.</p>

<p><code>get_comment_pages_count()</code> accepts no arguments.</p>

<p>Examples:</p>
 - get_comment_pages_count() returns a number equal to the number of comment pages, e.g. '1', '2', etc.

 - if (get_comment_pages_count() > 1 )  will return true if more than one comment page exists.

<p><code>get_comment_pages_count()</code> must be used from within the Loop.</p>

<p>Used in the following template files:</p>
comments.php
</div>

<h3 id="get_comment_type">get_comment_type()</h3>
<div style="padding-left:30px;">
<p><code>get_comment_type()</code> is a WordPress function.</p>
Codex reference: <a href="http://codex.wordpress.org/Function_Reference/comment_type">comment_type()</a>

<p><code>get_comment_type()</code> is used to return (not output or print) the type of a given comment:
'comment', 'pingback', or 'trackback. To output this value, use comment_type().</p>

<p><code>get_comment_type()</code> accepts no arguments.</p>

<p>Examples:</p>
 - get_comment_type() will return either 'comment', 'pingback', or 'trackback'

 - if ( get_comment_type() != "comment" ) will return true if the current comment type is 
    'pingback' or 'trackback'

<p><code>get_comment_type()</code> must be used from within the Loop.</p>

<p>Used in the following template files:</p>
comments.php
</div>

<h3 id="get_footer">get_footer()</h3>
<div style="padding-left:30px;">
<p><code>get_footer()</code> is a WordPress template tag.</p>
Codex reference: <a href="http://codex.wordpress.org/Function_Reference/get_footer">get_footer()</a>

<p><code>get_footer()</code> is used to include the footer Theme template file (footer.php) within another. This function facilitates
re-use of Theme template files, and also facilitates child Theme template files to take precedence
over parent Theme template files.</p>

<p><code>get_footer( $foo )</code> will attempt to include footer-foo.php. If it doesn't exist, the default footer.php will be used.</p>

<p>Used in the following template files:</p>
404.php, index.php, page.php
</div>

<h3 id="get_header">get_header()</h3>
<div style="padding-left:30px;">
<p><code>get_header()</code> is a WordPress template tag.</p>
Codex reference: <a href="http://codex.wordpress.org/Function_Reference/get_header">get_header()</a>

<p><code>get_template_part()</code> is used to include the header Theme template file (header.php) within another. This function facilitates
re-use of Theme template files, and also facilitates child Theme template files to take precedence
over parent Theme template files.</p>

<p><code>get_header( $foo )</code> will attempt to include header-foo.php. If it doesn't exist, the default header.php will be used.</p>

<p>Used in the following template files:</p>
404.php, index.php, page.php
</div>

<h3 id="get_month_link">get_month_link()</h3>
<div style="padding-left:30px;">
get_month_link() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/get_month_link

get_month_link() is used to return the monthly archive URL to a specific year and month

get_month_link() returns, but does not display (print) the URL. Use echo get_month_link() to display the URL.

get_month_link( $year, $month ) accepts two arguments:
 - $year: the year from which to retrieve the archive URL
 - $month: the month from which to retrive the archive URL
 - Default: current year/month

<p>Used in the following template files:</p>
functions.php
</div>
	
<h3 id="get_option">get_option()</h3>
<div style="padding-left:30px;">
get_option() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/get_option

get_option() is used to return the value of a specified database option.
If the option does not exist or has no value, the function returns FALSE.

get_option() returns, but does not print (output/display) the value requested. To 
print this value, use 'echo get_option()'.

get_option( $show, $default ) accepts two arguments
 - $show: the database option for which to return a value
     - See this Codex reference for full list of options: http://codex.wordpress.org/Option_Reference
 - $default: the value to return if the option does not exist, or has no value. Default is FALSE

<p>Examples:</p>
 - if ( get_option( 'show_on_front' ) == 'posts' ) returns TRUE if the "Show On Front" option is set to display blog posts, and
   returns FALSE if the "Show On Front" option is set to display a static page
   
 - get_option( 'page_comments' ) returns TRUE is the "Paged Comments" option is true; otherwise returns FALSE

<p>Used in the following template files:</p>
comments.php, header.php, site-navigation.php
</div>

<h3 id="get_permalink">get_permalink()</h3>
<div style="padding-left:30px;">
get_permalink() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/get_permalink

get_permalink() is used to return the permalink URL for the current post. This tag
returns only the permalink URL, not a fully formed HTML anchor tag.

get_permalink() returns, but does not display, the requested post permalink.

get_permalink( $id ) accepts one argument:
 - $id: ID of the post for which to return the permalink

<p>Example:</p>
echo get_permalink($post->post_parent);
Displays the URL to the post parent of the current post.

<p>Used in the following template files:</p>
post-entry-image.php
</div>

<h3 id="get_post">get_post()</h3>
<div style="padding-left:30px;">
get_post() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/get_post

get_post() is used to return an object or array containing the data for the specified post.

get_post() returns, but does not display, the requested data.

get_post( $post, $output ) accepts two arguments
 - $post: a variable containing the PostID interger value
 - $output: 'OBJECT', 'ARRAY_A', 'ARRAY_N'

<p>Used in the following template files:</p>
functions.php
</div>

<h3 id="get_post_format">get_post_format()</h3>
<div style="padding-left:30px;">
get_post_format() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/get_post_format

get_post_format() is used to retrieve the Post Format of the current Post

get_post_format() returns the Post Format type, as a string, if the current Post
has a Post Format (other than "standard") selected; otherwise, it returns NULL.

get_post_format( $postid ) accepts one argument:
 - $postid: the ID of the post for which to return the Post Format type. Defaults to
   the current post.

<p>Used in the following template files:</p>
loop.php
</div>

<h3 id="get_posts">get_posts()</h3>
<div style="padding-left:30px;">
get_posts() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/get_posts

get_posts() is used to create/output multiple Post Loops.

get_posts( 'arguments' ) accepts various arguments. See the Codex for the complete list.

<p>Used in the following template files:</p>
functions.php
</div>

<h3 id="get_search_form">get_search_form()</h3>
<div style="padding-left:30px;">
get_search_form() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/get_search_form

get_search_form() is used to display the search form. If the Theme includes a
searchform.php template file, it will be used. Otherwise, the built-in search form
will be used.

get_search_form() accepts no arguments.

<p>Used in the following template files:</p>
infobar.php
</div>

<h3 id="get_sidebar">get_sidebar()</h3>
<div style="padding-left:30px;">
get_sidebar() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/get_sidebar

get_sidebar() is used to include a sidebar template file within another. This function facilitates
re-use of Theme template files, and also facilitates child Theme template files to take precedence
over parent Theme template files.

get_sidebar( $name ) will attempt to include sidebar-name.php. The function will attempt to 
include files in the following order, until it finds one that exists:
 - the Theme's sidebar-name.php
 - the Theme's sidebar.php
 - the parent Theme's sidebar-name.php
 - the parent Theme's sidebar.php

get_sidebar() with no argument passed will attempt to include sidebar.php. The function will
attempt to include files in the following order, until it finds one that exists:
 - the Theme's sidebar.php
 - the parent Theme's sidebar.php

<p>Used in the following template files:</p>
404.php, index.php, page.php
</div>
	
<h3 id="get_stylesheet_uri">get_stylesheet_uri()</h3>
<div style="padding-left:30px;">
get_stylesheet_uri() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/get_stylesheet_uri

get_stylesheet_uri() is used to get the value for the URI of the Theme
style sheet (style.css).

get_stylesheet_uri() accepts no arguments.

get_option() returns, but does not print (output/display) the value requested. To 
print this value, use 'echo get_option()'.

<p>Example:</p>
echo get_stylesheet_uri(); returns e.g. "http://www.mydomain.tld/wp-content/themes/my-theme/style.css"

<p>Used in the following template files:</p>
header.php
</div>

<h3 id="get_tag_feed_link">get_tag_feed_link()</h3>
<div style="padding-left:30px;">
get_tag_feed_link() is a WordPress template tag.
Codex reference: N/A

get_tag_feed_link() returns the link for the RSS feed for the specified tag.

get_tag_feed_link( $tagid, $feed ) accepts two arguments:
 - $tagid: ID of the tag for which to display the RSS feed.
 - $feed: feed format ('rss', 'rss2', 'atom'). Defaults to user-defined default.

<p>Example:</p>
get_tag_feed_link( $wp_query->get( 'tag_id' ) ); returns the default RSS feed for the
current tag (e.g. when on a tag page).

get_tag_feed_link() must be used outside the Loop.

<p>Used in the following template files:</p>
loop-header.php
</div>

<h3 id="get_template_part">get_template_part()</h3>
<div style="padding-left:30px;">
get_template_part() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/get_template_part

get_template_part() is used to include a Theme template file within another. This function facilitates
re-use of Theme template files, and also facilitates child Theme template files to take precedence
over parent Theme template files.

get_template_part( $file ) will attempt to include file.php. The function will attempt to 
include files in the following order, until it finds one that exists:
 - the Theme's file.php
 - the parent theme's file.php

get_template_part( $file , $foo ) will attempt to include file-foo.php. The function will
attempt to include files in the following order, until it finds one that exists:
 - the Theme's file-foo.php
 - the Theme's file.php
 - the parent theme's file-foo.php
 - the parent theme-s file.php

<p>Used in the following template files:</p>
404.php, index.php, loop.php, page.php, post-entry.php, site-header.php
</div>

<h3 id="get_the_author_meta">get_the_author_meta()</h3>
<div style="padding-left:30px;">
get_the_author_meta() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/the_author_meta

get_the_author_meta() is used to display the Post Author for the current post.

get_the_author_meta( $field, $userID )  accepts two arguments:
 - $field: field name for data item to be displayed. See the Codex for full list.
 - $userID: UserID for whom data item is displayed. Defaults to Post Author.

<p>Example:</p>
get_the_author_meta( 'email' ); returns the Post Author's email address.

To display the author meta information, use 'echo" in the function call
for get_the_author_meta(), or use the_author_meta() instead.

get_the_author_meta()  must be used within the Loop, unless the $userID argument is used.

<p>Used in the following template files:</p>
post-footer.php
</div>

<h3 id="get_the_category">get_the_category()</h3>
<div style="padding-left:30px;">
get_the_category() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/get_the_category

get_the_category() returns an array of categories for the current page. The returned 
array includes the following variables:
 - $cat[n]->cat_ID: the ID of category 'n'
 - $cat[n]->cat_name: the name of category 'n'
 - $cat[n]->category_nicename: the nicename (slug) of category 'n'
 - $cat[n]->category_description: the description of category 'n'
 - $cat[n]->category_parent: the name of the parent category of category 'n'
 - $cat[n]->category_count: the count of posts included in category 'n'

get_the_category( $id ) accepts one argument:
 - $id: post ID for which to return the category array. Defaults to current post ID.

<p>Example:</p>
$cat = get_the_category(); $cat = $cat[0]; echo $cat->category_nicename;
displays the nicename (slug) of the first category returned in the category array.

get_the_category() must be used inside the loop, unless a post ID is passed 
using the $id argument.

<p>Used in the following template files:</p>
loop-header.php
</div>

<h3 id="get_the_excerpt">get_the_excerpt()</h3>
<div style="padding-left:30px;">
See: the_excerpt()
</div>

<p>Used in the following template files:</p>
functions.php
</div>

<h3 id="get_the_time">get_the_time()</h3>
<div style="padding-left:30px;">
See: the_time()

<p>Used in the following template files:</p>
functions.php
</div>

<h3 id="get_the_title">get_the_title()</h3>
<div style="padding-left:30px;">
get_the_title() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/get_the_title

get_the_title() is used to display the Post Title of the current post.

get_the_title( $id ) accepts one argument:
 - $id: ID of the post for which to return the Post Title

<p>Example:</p>
echo get_the_title($post->post_parent); 
Displays the Post Title of the current post's parent post. 

<p>Used in the following template files:</p>
functions.php, post-entry-image.php
</div>

<h3 id="get_theme_root">get_theme_root()</h3>
<div style="padding-left:30px;">
get_theme_root() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/get_theme_root

get_theme_root() is used to retrieve the file path to the directory in which 
Themes are installed (e.g. 'home/username/html/wp-content/themes').

Note that the returned string has no trailing slash.

get_theme_root() accepts no arguments.

<p>Used in the following template files:</p>
functions.php
</div>

<h3 id="get_trackback_url">get_trackback_url()</h3>
<div style="padding-left:30px;">
get_trackback_url() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/trackback_url

get_trackback_url() is used to display the URL to the current post's trackback URL. This tag
returns the URL only, rather than a full HTML anchor-tag link.

get_trackback_url() accepts no arguments.

<p>Example:</p>
&lt;a href="get_trackback_url();"&gt;Trackback&lt;/a&gt;

get_trackback_url() must be used within the Loop.

<p>Used in the following template files:</p>
post-header.php
</div>

<h3 id="get_queried_object">get_queried_object()</h3>
<div style="padding-left:30px;">
get_queried_object() is a property of the WordPress WP_Query class.
Codex reference: http://codex.wordpress.org/Function_Reference/WP_Query

get_queried_object() is used to return information about the current 
category, author, permalink, or page

get_queried_object() returns an object that contains the specified information.

get_queried_object() accepts no arguments

<p>Example:</p>
$my_obj = $wp_query->get_queried_object();
returns object $my_obj that contains the specified information from $wp_query.

<p>Used in the following template files:</p>
functions.php
</div>

<h3 id="get_query_var">get_query_var()</h3>
<div style="padding-left:30px;">
get_query_var() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/get_query_var

get_query_var() is used to return the specified variable from the $wp_query object

get_query_var( $var ) accepts one argument:
 - $var: the query variable to return.

<p>Examples:</p>
get_query_var('paged');
 - Returns the current page number of an index page (home, archive, etc.)
get_query_var('page');
 - Returns the current page number of a Post or Page

<p>Used in the following template files:</p>
functions.php
</div>

<h3 id="get_search_query">get_search_query()</h3>
<div style="padding-left:30px;">
get_search_query() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/get_search_query

get_search_query() is used to return the string used in a search query.

get_search_query() returns, but does not print/display, the search query string.
To print/display the search query string, use "echo get_search_query()" or "the_search_query()"

get_search_query( $args ) accepts no arguments

<p>Example:</p>
get_search_query();
If e.g. "lorem ipsum" was entered as the search query, returns the string "lorem ipsum"

<p>Used in the following template files:</p>
functions.php
</div>

<h3 id="get_userdata">get_userdata()</h3>
<div style="padding-left:30px;">
get_userdata() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/get_userdata

get_userdata() is used to return an object containing user data for the specified user.

get_userdata( userid ) accepts one argument:
 - userid: the ID of the user for which to return data

<p>Example:</p>
$user_info = get_userdata($id);
Returns the following object values (not inclusive):
 - $user_info->user_login
 - $user_info->user_pass
 - $user_info->user_nicename
 - $user_info->user_email
 - $user_info->user_url
 - $user_info->user_registered
 - $user_info->display_name
 - $user_info->user_firstname
 - $user_info->user_lastname
 - $user_info->nickname
 - $user_info->user_description

<p>Used in the following template files:</p>
functions.php
</div>

<h3 id="get_year_link">get_year_link()</h3>
<div style="padding-left:30px;">
get_year_link() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/get_year_link

get_year_link() is used to return (not print) the URL for the year-archive for the specified year.

get_year_link( $year ) accepts one argument:
 - $year: year for which to return the year-archive URL. Default: current year

<p>Used in the following template files:</p>
functions.php
</div>

<h3 id="has_nav_menu">has_nav_menu()</h3>
<div style="padding-left:30px;">
has_nav_menu() is a WordPress template conditional tag.
Codex reference: N/A

has_nav_menu( $menu ) is a boolean (returns TRUE or FALSE) conditional tag that returns true if 
a nav_menu named $menu has been configured by the user; otherwise it returns false.

has_nav_menu() is useful for defining a fallback option for a navigation menu, in case the
user does not define a particular nav menu in the Menus administration panel.

<p>Used in the following template files:</p>
sidebar-left.php, site-navigation.php
</div>

<h3 id="have_comments">have_comments()</h3>
<div style="padding-left:30px;">
have_comments() is a WordPress conditional tag.
Codex reference: N/A

have_comments() is a conditional that returns TRUE if the current post has comments
associated with it; otherwise, it returns FALSE. The most typical use of this conditional
is within the comments template, as part of the comments "Loop".

have_comments() accepts no arguments.

<p>Example:</p>
if ( have_comments() ) is used to begin the comments "Loop", which displays only if the current
post has comments.

have_comments() must be used from within the Loop.

<p>Used in the following template files:</p>
comments.php
</div>

<h3 id="have_posts">have_posts()</h3>
<div style="padding-left:30px;">
have_posts() is a WordPress template conditional tag.
Codex reference: http://codex.wordpress.org/User:Samsm/have_posts

have_posts() is a boolean (returns TRUE or FALSE) conditional tag that returns true if 
the current query has posts available. It is primarily used in conjunction with the_post() 
as part of the call to the Loop.

Example (the Loop):
if ( have_posts() ) : while ( have_posts() ) : the_post();

<p>Used in the following template files:</p>
loop.php
</div>

<h3 id="header_image">header_image()</h3>
<div style="padding-left:30px;">
header_image() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/header_image

header_image() is used to display the path to the header image

header_image() accepts no arguments.

<p>Used in the following template files:</p>
functions.php
</div>

<h3 id="home_url">home_url()</h3>
<div style="padding-left:30px;">
home_url() is a WordPress function
Codex reference: http://codex.wordpress.org/Function_Reference/home_url

home_url() is used to return the home URL (the 'home' option), using the appropriate protocol 
(http or https), based on value of is_ssl().

home_url() accepts no arguments.

<p>Example:</p>
home_url(); returns e.g. "http://www.domain.tld"

<p>Used in the following template files:</p>
footer.php, infobar.php, site-navigation.php
</div>

<h3 id="is_404">is_404()</h3>
<div style="padding-left:30px;">
is_404() is a WordPress template conditional tag.
Codex reference: http://codex.wordpress.org/Function_Reference/is_404

is_404() is a boolean (returns TRUE or FALSE) conditional tag that returns true if 
a 404 error page is currently displayed.

A 404 error page corresponds to the 404.php Theme template file in the
Theme hierarchy, and if the body_class() hook is used, the &lt;body&gt; tag of an
page will have class="error404".

<p>Used in the following template files:</p>
functions.php
</div>

<h3 id="is_archive">is_archive()</h3>
is_archive() is a WordPress template conditional tag.
Codex reference: http://codex.wordpress.org/Function_Reference/is_archive

is_archive() is a boolean (returns TRUE or FALSE) conditional tag that returns true if 
an archive page is currently displayed.

An archive page corresponds to the archive.php Theme template file in the
Theme hierarchy, and if the body_class() hook is used, the &lt;body&gt; tag of an
page will have class="archive".

<p>Used in the following template files:</p>
loop-header.php
</div>

<h3 id="is_array">is_array()</h3>
<div style="padding-left:30px;">
is_array() is a PHP function.
Codex reference: N/A
PHP reference: http://php.net/manual/en/function.is-array.php

is_array() is a boolean (returns TRUE or FALSE) conditional function that returns true if
a variable is an array.

is_array() accepts one argument: the variable to be evaluated

<p>Used in the following template files:</p>
functions.php
</div>

<h3 id="is_attachment">is_attachment()</h3>
<div style="padding-left:30px;">
is_attachment() is a WordPress template conditional tag.
Codex reference: http://codex.wordpress.org/Function_Reference/is_attachment

is_attachment() is a boolean (returns TRUE or FALSE) conditional tag that returns true if 
an attachment post ("attachment" post-type) is currently displayed.

An attachment post corresponds to the attachment.php Theme template file in the
Theme hierarchy, and if the body_class() hook is used, the &lt;body&gt; tag of an
attachment post will have class="attachment".

<p>Used in the following template files:</p>
functions.php, post-entry.php
</div>

<h3 id="is_author">is_author()</h3>
<div style="padding-left:30px;">
is_author() is a WordPress template conditional tag.
Codex reference: http://codex.wordpress.org/Function_Reference/is_author

is_author() is a boolean (returns TRUE or FALSE) conditional tag that returns true if 
an author archive page is currently displayed.

An author archive page corresponds to the author.php Theme template file in the
Theme hierarchy, and if the body_class() hook is used, the &lt;body&gt; tag of an
attachment post will have class="author".

<p>Used in the following template files:</p>
functions.php
</div>

<h3 id="is_category">is_category()</h3>
<div style="padding-left:30px;">
is_category() is a WordPress template conditional tag.
Codex reference: http://codex.wordpress.org/Function_Reference/is_category

is_category() is a boolean (returns TRUE or FALSE) conditional tag that returns true if 
a category page is currently displayed.

A category page corresponds to the category.php Theme template file in the
Theme hierarchy, and if the body_class() hook is used, the &lt;body&gt; tag of an
page will have class="category".

is_category( $category ) accepts one optional argument:
 - $category: category ID, slug, or nicename. If used, will return TRUE if the current
  page corresponds to the indicated category.

<p>Used in the following template files:</p>
functions.php, loop-header.php
</div>

<h3 id="is_day">is_day()</h3>
<div style="padding-left:30px;">
is_day() is a WordPress template conditional tag.
Codex reference: http://codex.wordpress.org/Function_Reference/is_day

is_day() is a boolean (returns TRUE or FALSE) conditional tag that returns true if 
a date (day) archive page is currently displayed.

A date (day) archive page corresponds to the archive.php Theme template file in the
Theme hierarchy, and if the body_class() hook is used, the &lt;body&gt; tag of an
page will have class="date".

<p>Used in the following template files:</p>
functions.php
</div>

<h3 id="is_feed">is_feed()</h3>
<div style="padding-left:30px;">
is_feed() is a WordPress template conditional tag.
Codex reference: http://codex.wordpress.org/Function_Reference/is_feed

is_feed() is a boolean (returns TRUE or FALSE) conditional tag that returns true if 
a feed is currently displayed.

A feed does not correspond to any template files in the Theme hierarchy.

<p>Used in the following template files:</p>
functions.php
</div>

<h3 id="is_home">is_home()</h3>
<div style="padding-left:30px;">
is_home() is a WordPress template conditional tag.
Codex reference: http://codex.wordpress.org/Function_Reference/is_home

is_home() is a boolean (returns TRUE or FALSE) conditional tag that returns true if 
the home page is currently displayed.

The home page corresponds to the index.php Theme template file in the
Theme hierarchy, and if the body_class() hook is used, the &lt;body&gt; tag of an
page will have class="blog".

<p>Used in the following template files:</p>
post-entry.php
</div>

<h3 id="is_month">is_month()</h3>
<div style="padding-left:30px;">
is_month() is a WordPress template conditional tag.
Codex reference: http://codex.wordpress.org/Function_Reference/is_month

is_month() is a boolean (returns TRUE or FALSE) conditional tag that returns true if 
a date (month) archive page is currently displayed.

A date (month) archive page corresponds to the archive.php Theme template file in the
Theme hierarchy, and if the body_class() hook is used, the &lt;body&gt; tag of an
page will have class="date".

<p>Used in the following template files:</p>
functions.php
</div>

<h3 id="is_page">is_page()</h3>
<div style="padding-left:30px;">
is_page() is a WordPress template conditional tag.
Codex reference: http://codex.wordpress.org/Function_Reference/is_page

is_page() is a boolean (returns TRUE or FALSE) conditional tag that returns true if 
a page ("page" post-type) is currently displayed.

A page corresponds to the page.php Theme template file in the
Theme hierarchy, and if the body_class() hook is used, the &lt;body&gt; tag of an
page will have class="page".

<p>Used in the following template files:</p>
functions.php, loop.php, post-entry.php, post-footer.php, post-header.php, sidebar-left.php
</div>

<h3 id="is_search">is_search()</h3>
<div style="padding-left:30px;">
is_search() is a WordPress template conditional tag.
Codex reference: http://codex.wordpress.org/Function_Reference/is_search

is_search() is a boolean (returns TRUE or FALSE) conditional tag that returns true if 
a search results page is currently displayed.

A search results page corresponds to the search.php Theme template file in the
Theme hierarchy, and if the body_class() hook is used, the &lt;body&gt; tag of an
page will have class="search".

<p>Used in the following template files:</p>
functions.php, loop-header.php
</div>

<h3 id="is_single">is_single()</h3>
<div style="padding-left:30px;">
is_single() is a WordPress template conditional tag.
Codex reference: http://codex.wordpress.org/Function_Reference/is_single

is_single() is a boolean (returns TRUE or FALSE) conditional tag that returns true if 
a single post ("post" post-type, i.e. a single blog post) is currently displayed.

A single post corresponds to the single.php Theme template file in the
Theme hierarchy, and if the body_class() hook is used, the &lt;body&gt; tag of a 
single post will have class="single".

<p>Used in the following template files:</p>
functions.php, loop.php, post-entry.php, post-footer.php, post-header.php
</div>

<h3 id="is_singular">is_singular()</h3>
<div style="padding-left:30px;">
is_singular() is a WordPress template conditional tag.
Codex reference: http://codex.wordpress.org/Function_Reference/is_singular

is_singular() is a boolean (returns TRUE or FALSE) conditional tag that returns true if any of the following are true:

	is_single() - a single post ("post" post-type, i.e. a single blog post) is displayed
	is_page() - a page ("page" post-type) is displayed
	is_attachment() - an attachment 

<p>Used in the following template files:</p>
functions.php, header.php, loop-footer.php
</div>

<h3 id="is_tag">is_tag()</h3>
<div style="padding-left:30px;">
is_tag() is a WordPress template conditional tag.
Codex reference: http://codex.wordpress.org/Function_Reference/is_tag

is_tag() is a boolean (returns TRUE or FALSE) conditional tag that returns true if 
a tag page is currently displayed.

A tag page corresponds to the tag.php Theme template file in the
Theme hierarchy, and if the body_class() hook is used, the &lt;body&gt; tag of an
page will have class="tag".

is_tag( $tag ) accepts one optional argument:
 - $tag: tag ID, slug, or nicename. If used, will return TRUE if the current
  page corresponds to the indicated tag.

<p>Used in the following template files:</p>
loop-header.php
</div>

<h3 id="is_user_logged_in">is_user_logged_in()</h3>
<div style="padding-left:30px;">
is_user_logged_in() is a WordPress conditional tag.
Codex reference: http://codex.wordpress.org/Function_Reference/is_user_logged_in

is_user_logged_in() is a boolean (returns TRUE or FALSE) conditional tag that returns
true if the current user is logged in; otherwise it returns false.

is_user_logged_in() accepts no arguments.

<p>Used in the following template files:</p>
infobar.php
</div>

<h3 id="is_year">is_year()</h3>
<div style="padding-left:30px;">
is_year() is a WordPress template conditional tag.
Codex reference: http://codex.wordpress.org/Function_Reference/is_year

is_year() is a boolean (returns TRUE or FALSE) conditional tag that returns true if 
a date (year) archive page is currently displayed.

A date (year) archive page corresponds to the archive.php Theme template file in the
Theme hierarchy, and if the body_class() hook is used, the &lt;body&gt; tag of an
page will have class="date".

<p>Used in the following template files:</p>
functions.php
</div>

<h3 id="isset">isset()</h3>
<div style="padding-left:30px;">
isset() is a PHP function.
Codex reference: N/A
PHP reference: http://php.net/manual/en/function.isset.php

isset() is used to determine if a specified variable is set, and is not NULL

isset() returns TRUE if the specified veriable is set, and is not NULL. Otherwise, it
returns false. Note: a zero-value ("0") is *not* equivalent to a NULL value.

isset( $arg ) accepts arguments:
 - $arg: variable to evaluate
 - isset() can take multiple variables. In this case, variables ae evaluated as defined 
 from left to right, and the function returns true only if ALL variables return true. Upon
 the first occurrence of a NULL-value variable, the function stops evaluating, and returns false.

<p>Example:</p>
if ( ! isset( $content_width ) ) {
  $content_width = 640;
}
This conditional will determine if the $content_width variable is set. If $content_width is not already
set, then it is set to a value of "640".

<p>Used in the following template files:</p>
functions.php
</div>

<h3 id="language_attributes">language_attributes()</h3>
<div style="padding-left:30px;">
language_attributes() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/language_attributes

language_attributes() is added inside the HTML &lt;html&gt; tag, and outputs various HTML
language attributes, such as language and text-direction.

<p>Used in the following template files:</p>
header.php
</div>

<h3 id="max">max()</h3>
<div style="padding-left:30px;">
max() is a PHP function.
Codex reference: N/A
PHP reference: http://php.net/manual/en/function.max.php

max() is used to determine the highest numerical value of a given group of inputs

max() returns the highest numerical value of the given inputs. String values can be passed to the function,
but are evaluated as a numerical value of zero.

max( $arg1, $arg2, etc ) accepts multiple arguments:
 - $arg1, $arg2, etc: a list of values

max( $array ) accepts one argument:
 - $array: an array, for which each array value will be evaluated.
 - If used, an array MUST be the FIRST and ONLY value passed to the function, in order for the function
 to evaluate each array value

<p>Example:</p>
max( $paged, $page ) );
Will return the higher value between $paged (index page number) and $page (single-post page number)

<p>Used in the following template files:</p>
functions.php
</div>

<h3 id="next_comments_link">next_comments_link()</h3>
<div style="padding-left:30px;">
next_comments_link() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Template_Tags/next_comments_link
Codex reference: http://codex.wordpress.org/Function_Reference/next_comments_link

next_comments_link() is used to display the next page of comments (older comments)

next_comments_link( $label, $max_page ) accepts two arguments:
 - $label: text label for the link text. Defaults to '' (no label).
 - $max_page: maximum number of comment pages on which to place the link. Defaults to '0' (no limit)

<p>Example:</p>
previous_comments_link( '&lt;span class="meta-nav"&gt;&larr;&lt;/span&gt; Older Comments' );
returns "&larr; Older Comments" (with an ASCII left-arrow symbol)

next_comments_link() must be used from within the Loop.

<p>Used in the following template files:</p>
comments.php
</div>

<h3 id="next_post_link">next_post_link()</h3>
<div style="padding-left:30px;">
next_post_link() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/next_post_link

next_post_link() is used to display the next post (older post) 

next_post_link() displays a fully-formed HTML link.

next_post_link( $format, $link, $in_same_cat, $exclude_categories ) accepts four arguments:
 - $format: string format of the link, using the %link% placeholder for the HTML link. Default: "%link% &raquo;"
 - $link: text (string) to display within the HTML link. Default: "%title%" (Post Title)
 - $in_same_cat: boolean (TRUE/FALSE) value to specify if linked post must be in the same category as the
 current post. Default: FALSE
 - $exclude_categories: list of categories by ID, separated by 'and', to exclude. Default: none.

<p>Example:</p>
next_post_link( '%link', '&lArr; ' );
Displays the link to the next post, with a left arrow as the link text.

next_post_link() must be used from within the Loop.

<p>Used in the following template files:</p>
functions.php, infobar.php
</div>

<h3 id="number_format">number_format()</h3>
<div style="padding-left:30px;">
number_format() is a PHP function.
Codex reference: N/A
PHP reference: http://us.php.net/manual/en/function.number-format.php

number_format() is used to format a number with grouped thousands 

number_format( $number, $decimals, $dec_point, $thousands_sep ) accepts one, two, our four arguments:
 - $number: the number to be formatted
 - $decimals: (optional) the number of decimal places. Default: 0
 - $dec_point / $thousands_sep: (optional, but must be in tandem if used) string value to use for 
 decimal place and thousands separator. Defaults: dot (".") for decimal place, and comma (",") for 
 thousands separator.

<p>Used in the following template files:</p>
functions.php
</div>

<h3 id="oenology_404_handler">oenology_404_handler()</h3>
<div style="padding-left:30px;">
oenology_404_handler() is a custom Theme function.
Codex reference: N/A
Defined in: functions.php

oenology_404_handler() is used to generate suggested site content when a user is sent to
the 404 page due to a server 404 "file not found" error.

oenology_404_handler() is defined in functions.php.

<p>Used in the following template files:</p>
404.php
</div>

<h3 id="oenology_admin_header_style">oenology_admin_header_style()</h3>
<div style="padding-left:30px;">
oenology_admin_header_style() is a custom Theme function.
Codex reference: N/A
Defined in: functions.php

oenology_admin_header_style() is used to define the CSS to apply to the header image displayed
on the Custom Header admin option page, as part of the Custom Image Header feature

<p>Used in the following template files:</p>
functions/functions-theme-setup.php
</div>

<h3 id="oenology_breadcrumb">oenology_breadcrumb()</h3>
<div style="padding-left:30px;">
oenology_breadcrumb() is a custom Theme function.
Codex reference: N/A
Defined in: functions.php

oenology_breadcrumb() is used to output breadcrumb links.

oenology_breadcrumb() outputs a home link, followed by appropriate breadcrumb links,
including categories (hierarchical), tags, search query, etc.

oenology_breadcrumb() accepts no arguments.

<p>Used in the following template files:</p>
infobar.php
</div>

<h3 id="oenology_comment_count">oenology_comment_count()</h3>
<div style="padding-left:30px;">
oenology_comment_count() is a custom Theme function.
Codex reference: N/A
Defined in: functions.php

oenology_comment_count() is used to return only the number of comment-type 
comments (excluding trackbacks/pingbacks)

oenology_comment_count() hooks into the get_comments_number() filter hook

<p>Used in the following template files:</p>
functions/functions-custom.php
</div>

<h3 id="oenology_copyright">oenology_copyright()</h3>
<div style="padding-left:30px;">
oenology_copyright() is a custom Theme function.
Codex reference: N/A
Defined in: functions.php

oenology_copyright() is used to output the copyright date range, in the format 'XXXX - YYYY',
where 'XXXX' is the year the oldest post was published, and'YYYY' is the current year.

oenology_copyright() is defined in functions.php.

<p>Used in the following template files:</p>
footer.php
</div>

<h3 id="oenology_filter_wp_title">oenology_filter_wp_title()</h3>
<div style="padding-left:30px;">
oenology_filter_wp_title() is a custom Theme function.
Codex reference: N/A
Defined in: functions.php

oenology_filter_wp_title() is used to display more accurate information in wp_title,
according to current location (search query, single post, etc.)

oenology_filter_wp_title() hooks into the wp_title filter hook

<p>Used in the following template files:</p>
functions/functions-custom.php
</div>

<h3 id="oenology_gallery_image_meta">oenology_gallery_image_meta()</h3>
<div style="padding-left:30px;">
oenology_gallery_image_meta() is a custom Theme function.
Codex reference: N/A
Defined in: functions.php

oenology_gallery_image_meta() is used to output various metadata related to
gallery images. The function outputs an array containing the
following values:
 - $image_meta['image']: image output, using wp_get_attachment_image()
 - $image_meta['url']: image attachment url, using wp_get_attachment_url()
 - $image_meta['width']: image width, in px
 - $image_meta['height']: image height, in px
 - $image_meta['dimensions']: image width/height dimensions, in px, displayed as "# x # px"
 - $image_meta['filesize']: image filesize, converted to human-readable size format, displayed as e.g. "### kb"
 - $image_meta['created_timestamp']: image metadata - date/time image taken, displayed as "D MMM YYYY"
 - $image_meta['copyright']: image metadata - copyright statement
 - $image_meta['credit']: image metadata - photographer
 - $image_meta['aperture']: image metadata - camera aperture setting
 - $image_meta['focal_length']: image metadata - camera focal length setting, displayed as "f/###"
 - $image_meta['iso']: image metadata - camera ISO setting
 - $image_meta['shutter_speed']: image metadata - camera shutter speed setting, displayed as e.g. "1/### sec"
 - $image_meta['camera']: image metadata - camera type
 - $image_meta['caption']: the image caption, as defined in image settings

oenology_gallery_image_meta() is defined in functions.php.

<p>Used in the following template files:</p>
post-entry-image.php
</div>

<h3 id="oenology_gallery_links">oenology_gallery_links()</h3>
<div style="padding-left:30px;">
oenology_gallery_links() is a custom Theme function.
Codex reference: N/A
Defined in: functions.php

oenology_gallery_links() is used to output "previous" and "next" links with both text and
thumbnail images, for use with gallery images. The function outputs an array containing the
following values:
 - $links['prevlink']: text link to previous gallery image
 - $links['prevthumb']: thumbnail of previous gallery image
 - $links['nextlink']: text link to next gallery image
 - $links['nextthumb']: thumbnail of next gallery image

oenology_gallery_links() is defined in functions.php.

<p>Used in the following template files:</p>
post-entry-image.php
</div>

<h3 id="oenology_header_style">oenology_header_style()</h3>
<div style="padding-left:30px;">
oenology_header_style() is a custom Theme function.
Codex reference: N/A
Defined in: functions.php

oenology_header_style() is used to define the CSS to apply to the header image, as part
of the Custom Image Header feature

<p>Used in the following template files:</p>
functions/functions-theme-setup.php
</div>

<h3 id="oenology_load_widgets">oenology_load_widgets()</h3>
<div style="padding-left:30px;">
oenology_load_widgets() is a custom Theme function.
Codex reference: N/A
Defined in: functions.php

oenology_load_widgets() is used to register the custom Theme Widgets.

oenology_load_widgets() hooks into the widgets_init action hook

<p>Used in the following template files:</p>
functions/functions-widgets.php
</div>

<h3 id="oenology_setup">oenology_setup()</h3>
<div style="padding-left:30px;">
oenology_setup() is a custom Theme function.
Codex reference: N/A
Defined in: functions.php

oenology_setup() is used to define and setup all of the custom Theme features, including
Theme support for optional WordPress features. This function is designed to be over-ridden
by a Child Theme, if necessary.

oenology_setup() hooks into the after_setup_theme action hook

<p>Used in the following template files:</p>
functions/functions-theme-setup.php
</div>

<h3 id="oenology_setup_widgets">oenology_setup_widgets()</h3>
<div style="padding-left:30px;">
oenology_setup_widgets() is a custom Theme function.
Codex reference: N/A
Defined in: functions.php

oenology_setup_widgets() is used to define all of the custom Theme Widgets. This function is
designed to be over-ridden by a Child Theme, if necessary.

oenology_setup_widgets() hooks into the after_theme_setup action hook

<p>Used in the following template files:</p>
functions/functions-widgets.php
</div>

<h3 id="oenology_show_current_cat_on_single">oenology_show_current_cat_on_single()</h3>
<div style="padding-left:30px;">
oenology_show_current_cat_on_single() is a custom Theme function.
Codex reference: N/A
Defined in: functions.php

oenology_show_current_cat_on_single() is used to add a "current-cat" CSS class, analogous to the
"current-page" CSS class, for use in styling the output of wp_list_categories()

oenology_show_current_cat_on_single() hooks into the wp_list_categories filter hook

<p>Used in the following template files:</p>
functions/functions-custom.php
</div>

<h3 id="oenology_widget_archives">oenology_widget_archives()</h3>
<div style="padding-left:30px;">
oenology_widget_archives() is a custom Theme Widget.
Codex reference: N/A
Defined in: functions.php

oenology_widget_archives() outputs the default "Archives" Widget, but adds a "show/hide" 
toggle to the Widget output.

<p>Used in the following template files:</p>
functions/functions-widgets.php
</div>

<h3 id="oenology_widget_categories">oenology_widget_categories()</h3>
<div style="padding-left:30px;">
oenology_widget_categories() is a custom Theme Widget.
Codex reference: N/A
Defined in: functions.php

oenology_widget_categories() outputs the default "Categories" Widget, but adds a "show/hide" 
toggle to the Widget output. 

<p>Used in the following template files:</p>
functions/functions-widgets.php
</div>

<h3 id="oenology_widget_linkrollbycat">oenology_widget_linkrollbycat()</h3>
<div style="padding-left:30px;">
oenology_widget_linkrollbycat() is a custom Theme Widget.
Codex reference: N/A
Defined in: functions.php

oenology_widget_linkrollbycat() outputs the default "Linkroll" Widget, but adds a "show/hide" 
toggle to the Widget output. 

<p>Used in the following template files:</p>
functions/functions-widgets.php
</div>

<h3 id="oenology_widget_recentposts">oenology_widget_recentposts()</h3>
<div style="padding-left:30px;">
oenology_widget_recentposts() is a custom Theme Widget.
Codex reference: N/A
Defined in: functions.php

oenology_widget_recentposts() outputs the default "Recent Posts" Widget, but adds a "show/hide" 
toggle to the Widget output. 

<p>Used in the following template files:</p>
functions/functions-widgets.php
</div>

<h3 id="oenology_widget_tags">oenology_widget_tags()</h3>
<div style="padding-left:30px;">
oenology_widget_tags() is a custom Theme Widget.
Codex reference: N/A
Defined in: functions.php

oenology_widget_tags() outputs the default "Tags" Widget, but adds a "show/hide" 
toggle to the Widget output. 

<p>Used in the following template files:</p>
functions/functions-widgets.php
</div>

<h3 id="post_class">post_class()</h3>
<div style="padding-left:30px;">
post_class() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Template_Tags/post_class

post_class() is added inside the HTML &lt;div&gt; or &lt;span&gt; tag that contains the post, 
and outputs various CSS class declarations, depending on which post is currently 
being displayed.

For the full list of CSS classes returned by post_class(), see the Codex.

<p>Used in the following template files:</p>
404.php, loop.php
</div>

<h3 id="post_password_required">post_password_required()</h3>
<div style="padding-left:30px;">
post_password_required() is a WordPress conditional tag.
Codex reference: N/A

post_password_required() is a conditional that returns TRUE if the current post is password-protected; 
otherwise, it returns FALSE. The most typical use of this conditional is within the comments template, as 
part of the comments "Loop".

post_password_required() accepts no arguments.

<p>Example:</p>
if ( post_password_required() ) is used to display a "password required" message, and prevents post
comments from displaying, if the post is password-protected.

post_password_required() must be used from within the Loop.

<p>Used in the following template files:</p>
comments.php
</div>

<h3 id="posts_nav_link">posts_nav_link()</h3>
<div style="padding-left:30px;">
posts_nav_link() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/posts_nav_link

posts_nav_link() is used to display Previous/Next links for paginated lists of posts
(e.g. index.php, archive.php, category.php, tag.php).

Note: the "Previous" link indicates *newer* posts; the "Next" link indicates *older* posts.
Thus, "Previous" and "Next" indicate the reverse-chronological nature of blog posts;
i.e. Previous in time (more recent) and Next in time (older).

posts_nav_link( $sep, $prelabel, $nxtlabel ) accepts 3 arguments:
 - $sep: text displayed between "Previous" and "Next" links. Defaults to ' :: '.
 - $prelabel: Link text displayed for "Previous" link. Defaults to '&lt;&lt; Previous Page'.
 - $nxtlabel:  Link text displayed for "Next" link. Defaults to 'Next Page >>'.

<p>Example:</p>
posts_nav_link('&nbsp;&diams;&nbsp;','&laquo;&laquo; Newer Posts','Older Posts &raquo;&raquo;');
Displays '&laquo;&laquo; Newer Posts' and 'Older Posts &raquo;&raquo;', with diamonds as a separator.

posts_nav_link() must be used within the Loop.

<p>Used in the following template files:</p>
functions.php, loop-footer.php
</div>

<h3 id="preg_replace">preg_replace()</h3>
<div style="padding-left:30px;">
preg_replace() is a PHP function.
Codex reference: N/A
PHP reference: http://us.php.net/manual/en/function.preg-replace.php

preg_replace() is used to perform a regular-expression search-and-replace

preg_replace() returns an array if the subject parameter is an array, or a string otherwise. If matches are 
found, the new subject will be returned, otherwise subject will be returned unchanged or NULL if an error occurred.

preg_replace( $pattern, $replacement, $subject ) accepts arguments:
 - $pattern: the pattern for which to search
 - $replacement: the string with which to replace found instances of $pattern
 - $subject: the string on which to perform the search (for $pattern)-and-replace (with $replacement)

<p>Used in the following template files:</p>
functions.php
</div>

<h3 id="previous_comments_link">previous_comments_link()</h3>
<div style="padding-left:30px;">
previous_comments_link() is a WordPress template tag.

Codex reference: http://codex.wordpress.org/Template_Tags/previous_comments_link
Codex reference: http://codex.wordpress.org/Function_Reference/previous_comments_link

previous_comments_link() is used to display the previous page of comments (newer comments)

previous_comments_link( $label, $max_page ) accepts two arguments:
 - $label: text label for the link text. Defaults to '' (no label).
 - $max_page: maximum number of comment pages on which to place the link. Defaults to '0' (no limit)

<p>Example:</p>
next_comments_link( 'Newer Comments &lt;span class="meta-nav"&gt;&rarr;&lt;/span&gt;' );
returns "Newer Comments ->" (with an ASCII right-arrow symbol)

previous_comments_link() must be used from within the Loop.

<p>Used in the following template files:</p>
comments.php
</div>

<h3 id="previous_post_link">previous_post_link()</h3>
<div style="padding-left:30px;">
previous_post_link() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/previous_post_link

previous_post_link() is used to display the previous post (newer post) 

previous_post_link() displays a fully-formed HTML link.

previous_post_link( $format, $link, $in_same_cat, $exclude_categories ) accepts four arguments:
 - $format: string format of the link, using the %link% placeholder for the HTML link. Default: "%link% &raquo;"
 - $link: text (string) to display within the HTML link. Default: "%title%" (Post Title)
 - $in_same_cat: boolean (TRUE/FALSE) value to specify if linked post must be in the same category as the
 current post. Default: FALSE
 - $exclude_categories: list of categories by ID, separated by 'and', to exclude. Default: none.

<p>Example:</p>
previous_post_link( '%link', '&rArr; ' );
Displays the link to the next post, with a right arrow as the link text.

previous_post_link() must be used from within the Loop.

<p>Used in the following template files:</p>
functions.php, infobar.php
</div>

<h3 id="register_default_headers">register_default_headers()</h3>
<div style="padding-left:30px;">
register_default_headers() is a WordPress function.
Codex reference: 

register_default_headers() is used to register default header images available through the
Custom Header admin option page, as part of the Custom Image Header feature. 

register_default_headers( $array ) accepts one argument, as an array-of-arrays:
 - $array: array of arrays containing the following key pairs:
   - 'url' => 'url/path/to/header/image'
   - 'thumbnail_url' => 'url/path/to/header/image/thumbnail'
   - 'description' => 'Description of the header image'

<p>Used in the following template files:</p>
functions.php
</div>

<h3 id="register_nav_menus">register_nav_menus()</h3>
<div style="padding-left:30px;">
register_nav_menus() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/register_nav_menus

register_nav_menus() is used to register Navigation Menu locations, as part of the 
Navigation Menus feature 

register_nav_menus( $array ) accept one argument, as an array:
 - $array: an array of key pairs, as $location => $description
   - $location: the menu location, used to add the Menu to a Theme template file
   - $description: description of the menu location, used on the Menus admin option page

<p>Used in the following template files:</p>
functions.php
</div>

<h3 id="register_sidebar">register_sidebar()</h3>
<div style="padding-left:30px;">
register_sidebar() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/register_sidebar

register_sidebar() is used to 

register_sidebar() 

register_sidebar( $array ) accepts one argument, as an array:
 - $array: array containing the following key pairs:
   - 'name' => 'sidebar_name'
   - 'description' => 'Description of the sidebar'
   - 'before_widget' => 'HTML to output before the widget'
   - 'after_widget' => 'HTML to output after the widget'
   - 'before_title' => 'HTML to output before the widget title'
   - 'after_title' => 'HTML to output after the widget title'

<p>Used in the following template files:</p>
functions.php
</div>

<h3 id="register_widget">register_widget()</h3>
<div style="padding-left:30px;">
register_widget() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/register_widget

register_widget() is used to register a custom Theme Widget

register_widget( $widget ) accepts one argument:
 - $widget: function that defines the Widget being registered

<p>Used in the following template files:</p>
functions.php
</div>

<h3 id="require_once">require_once()</h3>
<div style="padding-left:30px;">
require_once() is a PHP function.
Codex reference: N/A
PHP reference: http://php.net/manual/en/function.require-once.php

require_once( $file ) will include the file specified by the $file argument

require_once() will return a fatal error if the specified file cannot be included. Also, if theme
specified file has already been included, require_once() will not attempt to include it again.

require_once( $file ) accepts one argument:
 - $file (string): file to be included.

require_once( 'foo.php' )
 - will include the file "foo.php".
 
<p>Used in the following template files:</p>
functions.php, functions/functions-options.php, functions/functions-options-init.php
</div>

<h3 id="set_post_thumbnail_size">set_post_thumbnail_size()</h3>
<div style="padding-left:30px;">
set_post_thumbnail_size() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/the_post_thumbnail

set_post_thumbnail_size() is used to define the default size for an image thumbnail,
for use with the_post_thumbnail()

set_post_thumbnail_size( $width, $height, $crop ) accepts arguments:
 - $width: image thumbnail width, in pixels
 - $height: image thumbnail height, in pixels
 - $crop: boolean (TRUE/FALSE) to determine whether thumbnail should be cropped
   - TRUE: hard-crop: image is resized and cropped to match the specified dimensions exactly
   - FALSE: box-resize: image is resized proportionally

<p>Used in the following template files:</p>
functions.php
</div>

<h3 id="single_cat_title">single_cat_title()</h3>
<div style="padding-left:30px;">
single_cat_title() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/single_cat_title

single_cat_title() is used to display the title for the current category when displaying
the category page.

single_cat_title( $prefix, $display ) accepts one argument:
 - $prefix: string to display before the category title. Defaults to 'null'
 - $display: boolean (TRUE or FALSE) display value. Defaults to 'true' (display)

single_cat_title() must be used outside the Loop.

<p>Used in the following template files:</p>
functions.php, loop-header.php
</div>

<h3 id="single_tag_title">single_tag_title()</h3>
<div style="padding-left:30px;">
single_tag_title() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/single_tag_title

single_tag_title() is used to display the title for the current tag when displaying
the tag page.

single_tag_title( $prefix, $display ) accepts one argument:
 - $prefix: string to display before the category title. Defaults to 'null'
 - $display: boolean (TRUE or FALSE) display value. Defaults to 'true' (display)

single_tag_title() must be used outside the Loop.

<p>Used in the following template files:</p>
functions.php, loop-header.php
</div>

<h3 id="size_format">size_format()</h3>
<div style="padding-left:30px;">
size_format() is a WordPress function.
Codex reference: N/A

size_format() is used to format filesizes into human-readable
formats, from bytes into KB, MB, etc.

size_format() takes a value in bytes, and returns the same value 
in KiB, MiB (where 1 MiB = 1024 B), with units "MB", "KB", etc.

size_format( $bytes, $decimals ) accepts arguments:
 - $bytes: filesize value (up to 32bits)
 - $decimals: decimal places to return. Default: '0'.

<p>Example:</p>
size_format( '1048576' );
 - returns "1 MB"

<p>Used in the following template files:</p>
functions.php
</div>

<h3 id="sprintf">sprintf()</h3>
<div style="padding-left:30px;">
sprintf() is a PHP function.
Codex reference: N/A
PHP reference: http://us.php.net/manual/en/function.sprintf.php

sprintf() is used to return a string formatted according to the
defined formatting string format. See the PHP reference for more information.

<p>Used in the following template files:</p>
functions.php
</div>

<h3 id="str_replace">str_replace()</h3>
<div style="padding-left:30px;">
str_replace() is a PHP function.
Codex reference: N/A
PHP reference: http://php.net/manual/en/function.str-replace.php

str_replace() is used to replace all occurrences of the search string with
the replacement string 

str_replace() returns a string or array (depending on what arguments are passed)
that contains the replaced strings.

str_replace( $search, $replace, $subject, $count ) accepts arguments:
 - $search: string to be replaced. Can be a string, or an array of strings
 - $replace: string with which to replace. Can be a string, or an array of strings.
 - $subject: string from within to search/replace. Can be a string, or an arrya of strings.
 - $count: integer. If passed, holds the number of replacements performed.

<p>Used in the following template files:</p>
functions.php
</div>

<h3 id="the_author">the_author()</h3>
<div style="padding-left:30px;">
the_author() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/the_author

the_author() is used to display the Post Author for the current post.

the_author()  accepts no arguments.

<p>Example:</p>
the_author();

To get the Post Author without displaying it, use get_the_author().

the_author()  must be used within the Loop.

<p>Used in the following template files:</p>
post-footer.php
</div>

<h3 id="the_category">the_category()</h3>
<div style="padding-left:30px;">
the_category() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/the_category

the_category() is used to display a list of links to categories to which the post belongs.

the_category( $separator, $parents, $postid ) accepts three arguments:
 - $separator: separator list between categories. Defaults to placing categories in an unordered list (<ul>)
 - $parents: accepts 'multiple' or 'single':
      - 'multiple': Display separate links to parent/child categories, exhibiting parent/child relationship
	  - 'single': Display link to child categories only (default)
 - $postid: ID of post for which categories to list. Defaults to ID of current post.

<p>Example:</p>
the_category( ', '); displays: "Category1, Category2, Category3"

the_category() prints (displays/outputs) the data requested. To get, but not display/output the data, use get_category() instead.

the_category() must be used within the Loop, unless the $postid argument is specified.

<p>Used in the following template files:</p>
functions.php, post-header.php
</div>

<h3 id="the_content">the_content()</h3>
<div style="padding-left:30px;">
the_content() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/the_content

the_content() is used to display the Post Content for the current post.

the_content( $more_link_text, $strip_teaser )  accepts two arguments:
 - $more_link_text: string to display for the "read more" link, if <!--more--> is used in the post. Defaults to '(more...)'.
 - $strip_teaser: boolean (true/false); 'false' displays the content before <!--more-->; 'false' hides this content on single.php. Defaults to 'false'

<p>Example:</p>
the_content();

To get the Post Content without displaying it, use get_the_content().

the_content()  must be used within the Loop.

<p>Used in the following template files:</p>
post-entry.php
</div>

<h3 id="the_date">the_date()</h3>
<div style="padding-left:30px;">
the_date() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/the_date

the_date() is used to display the Post Date.

the_date( $d ) accepts one argument:
 -$d: date format (per PHP date() function). Defaults to time format configured in General Settings

<p>Example:</p>
the_date( 'Y' ); displays the year the post was published, e.g. '2010'.

the_date() must be used within the Loop.

<p>Used in the following template files:</p>
post-footer.php
</div>

<h3 id="the_excerpt">the_excerpt()</h3>
<div style="padding-left:30px;">
the_excerpt() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/the_excerpt

the_excerpt() is used to display the Post Excerpt for the current post.

the_excerpt()  accepts no arguments.

<p>Example:</p>
the_excerpt();

To get the Post Excerpt without displaying it, use get_the_excerpt().

the_excerpt()  must be used within the Loop.

<p>Used in the following template files:</p>
post-entry.php, post-entry-image
</div>

<h3 id="the_ID">the_ID()</h3>
<div style="padding-left:30px;">
the_ID() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/the_ID

the_ID() is used to display the Post ID for the current post.

the_ID()  accepts no arguments.

<p>Example:</p>
the_ID();

To get the Post ID without displaying it, use get_the_ID().

the_ID()  must be used within the Loop.

<p>Used in the following template files:</p>
post-header.php
</div>

<h3 id="the_permalink">the_permalink()</h3>
<div style="padding-left:30px;">
the_permalink() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/the_permalink

the_permalink() is used to display the permalink URL for the current post. This tag
returns only the permalink URL, not a fully formed HTML anchor tag.

the_permalink() accepts no arguments.

<p>Example:</p>
&lt;a href="the_permalink();"&gt;Permalink&lt;/a&gt;

the_permalink() must be used within the Loop.

<p>Used in the following template files:</p>
post-header.php
</div>

<h3 id="the_post">the_post()</h3>
<div style="padding-left:30px;">
the_post() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/User:Jefte/the_post

the_post() is used to output the content of each post. It is primarily used in conjunction
with have_posts() as part of the call to the Loop.

Example (the Loop):
if ( have_posts() ) : while ( have_posts() ) : the_post();

<p>Used in the following template files:</p>
loop.php
</div>

<h3 id="the_post_thumbnail">the_post_thumbnail()</h3>
<div style="padding-left:30px;">
the_post_thumbnail() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/the_post_thumbnail

the_post_thumbnail() is used to display the post thumbnail for the current post.

the_post_thumbnail( $size, $attr ) accepts two arguments:
 - $size: size of the thumbnail image:
     - 'thumbnail' (default)
	 - 'medium'
	 - 'large'
	 - 'full'
	 - array( 'W', 'H' , $crop )
	      - 'W': width, in pixels
		  - 'H': height, in pixels
		  - $crop: boolean (true/false) forced-cropping of image to specified dimensions. Defaults to 'false'
 - $attr: used to override default attributes, such as src, alt, title, or class

<p>Example:</p>
the_post_thumbnail();

the_post_thumbnail() must be used within the Loop.

Post Thumbnails support must be defined and configured. Refer to functions.php for more information.

<p>Used in the following template files:</p>
post-entry.php, post-header.php
</div>

<h3 id="the_search_query">the_search_query()</h3>
<div style="padding-left:30px;">
the_search_query() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/the_search_query

the_search_query() displays the current search query entered via the search form.

the_search_query() accepts no arguments.

<p>Example:</p>
'Search results for "the_search_query();" search' will display (assuming
the user entered 'lorem ipsum' as the search query): 'Search results for "lorem ipsum" search'

<p>Used in the following template files:</p>
loop-header.php
</div>

<h3 id="the_shortlink">the_shortlink()</h3>
<div style="padding-left:30px;">
the_shortlink() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/the_shortlink

the_shortlink() is used to display the Shortlink for the current post.

This tag returns the full HTML anchor tag, rather than just the URL of the Shortlink. To retrieve just 
the URL, use wp_get_shortlink().

the_shortlink( $text, $title, $before, $after ) accepts four arguments:
 - $text: Link text to display. Defaults to 'This is the shortlink'.
 - $title: HTML anchor tag title attribute text (displays in tooltip on hover). Defaults to Post Title.
 - $before: string to display before the Shortlink. Defaults to no text.
 - $after: string to display after the Shortlink. Defaults to no text.

<p>Example:</p>
the_shortlink( 'Shortlink' ); displays: &lt;a href="[shortlink URL]" title="[Post Title]"&gt;Shortlink&lt;/a&gt;.

the_shortlink() must be used within the Loop.

<p>Used in the following template files:</p>
post-header.php
</div>

<h3 id="the_tags">the_tags()</h3>
<div style="padding-left:30px;">
the_tags() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/the_tags

the_tags() is used to display a list of links to tags to which the post belongs.

the_tags( $before, $separator, $after ) accepts three arguments:
 - $before: string to display before the tag list. Defaults to "Tags: ".
 - $separator: string/character to display between tags. Defaults to ", ".
 - $after: string to display after the tag list. Defaults to no text.

<p>Example:</p>
the_tags();

the_tags() must be used within the Loop.

<p>Used in the following template files:</p>
post-header.php
</div>

<h3 id="the_time">the_time()</h3>
<div style="padding-left:30px;">
the_time() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/the_time

the_time() is used to display the Post Time.

the_time( $d ) accepts one argument:
 -$d: time format (per PHP date() function). Defaults to time format configured in General Settings

<p>Example:</p>
the_time( 'Y' ); displays the year the post was published, e.g. '2010'.

the_time() prints the date. To get (return) the date but not print it, use get_the_time().

the_time() must be used within the Loop.

<p>Used in the following template files:</p>
post-footer.php, post-header.php
</div>

<h3 id="the_title">the_title()</h3>
<div style="padding-left:30px;">
the_title() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/the_title

the_title() is used to display the Post Title of the current post.

the_title( $before, $after, $echo ) accepts three arguments:
 - $before: text string to display before the title. Defaults to no text.
 - $after:text string to display after the title. Defautls to no text.
 - $echo: boolean (true/false). 'True' displays the title; 'false' does not (for use in functions, etc.). Defaults to 'true'.

<p>Example:</p>
the_title();

the_title() must be used within the Loop.

<p>Used in the following template files:</p>
comments.php, post-header.php
</div>

<h3 id="the_widget">the_widget()</h3>
<div style="padding-left:30px;">
the_widget() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/the_widget

the_widget() is used to output a Widget anywhere within a Theme. This tag allows Widgets to be
displayed outside of a Widgetized sidebar. The tag can also be used to output "default" Widgets that will 
display in a defined Widgetized sidebar location if no Widgets are defined (by the user) to appear in
the sidebar.

the_widget( 'WP_Widget_Calendar' ) will display the Calendar Widget.

the_widget( $widget, $instance, $args ) accepts 3 arguments:
 - $widget: name of the Widget to be output (can be a core Widget, such as WP_Widget_Calendar, or a custom, Theme-defined Widget)
 - $instance: Widget instance settings (e.g. Title)
 - $args:  Widget arguments (before_widget, after_widget, before_title,after_title, etc.)

the_widget() can be used anywhere within a template.

<p>Used in the following template files:</p>
sidebar-left.php, sidebar-right.php
</div>

<h3 id="trim">trim()</h3>
<div style="padding-left:30px;">
trim() is a PHP function.
Codex reference: N/A
PHP reference: http://php.net/manual/en/function.trim.php

trim() is used to strip whitespace or characters from the beginning
and end of a string

trim( $string ) accepts arguments:
 - $string: string to be trimmed

<p>Used in the following template files:</p>
functions.php
</div>

<h3 id="urldecode">urldecode()</h3>
<div style="padding-left:30px;">
urldecode() is a PHP function.
Codex reference: N/A
PHP reference: http://php.net/manual/en/function.urlencode.php

urldecode() is used to URL-encode a string

urldecode() returns a string in which all non-alphanumeric characters except -_. 
have been replaced with a percent (%) sign followed by two hex digits and spaces 
encoded as plus (+) signs. It is encoded the same way that the posted data from a 
WWW form is encoded, that is the same way as in application/x-www-form-urlencoded 
media type.

urldecode( $string ) accepts arguments:
 - $string: string to URL-encode

<p>Used in the following template files:</p>
functions.php
</div>

<h3 id="wp_attachment_is_image">wp_attachment_is_image()</h3>
<div style="padding-left:30px;">
wp_attachment_is_image() is a WordPress template conditional tag
Codex reference: http://codex.wordpress.org/Function_Reference/is_attachment

wp_attachment_is_image() is a boolean (returns TRUE or FALSE) conditional tag that returns true if 
the current post's attachment is an image.

<p>Used in the following template files:</p>
post-entry.php
</div>

<h3 id="wp_enqueue_script">wp_enqueue_script()</h3>
<div style="padding-left:30px;">
wp_enqueue_script() is a WordPress filter hook.
Codex reference: http://codex.wordpress.org/Function_Reference/wp_enqueue_script

wp_enqueue_script() is used as a safe way to add JavaScript to displayed pages. WordPress 
maintains a "queue" of javascript files to load when a page is displayed. The wp_enqueue_script()
filter enables a Theme or Plugin to add its own javascript files to this queue. 

Using wp_enqueue_script() facilitates the addition of javascript files only on pages where they
are needed, and will ensure that the same javascript file (e.g. jQuery) is not loaded multiple times.

<p>Used in the following template files:</p>
header.php
</div>

<h3 id="wp_footer">wp_footer()</h3>
<div style="padding-left:30px;">
wp_footer() is a WordPress action hook.
Codex reference: http://codex.wordpress.org/Plugin_API/Action_Reference/wp_footer

wp_footer() is used by themes/plugins, usually to insert content into the WordPress Theme footer.

<p>Used in the following template files:</p>
404.php, index.php, page.php
</div>

<h3 id="wp_get_attachment_image">wp_get_attachment_image()</h3>
<div style="padding-left:30px;">
wp_get_attachment_image() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/wp_get_attachment_image

wp_get_attachment_image() is used to return an HTML image tag for an attachment image

wp_get_attachment_image( $id, $size, $icon ) accepts arguments:
 - $id: the ID of the attachment
 - $size: string ("thumbnail", "large", etc.), or array ( array('width','height') ). Default: "thumbnail"
 - $icon: boolean: return the media icon for the attachment (TRUE).  Default: FALSE 

<p>Used in the following template files:</p>
functions.php
</div>

<h3 id="wp_get_attachment_link">wp_get_attachment_link()</h3>
<div style="padding-left:30px;">
wp_get_attachment_link() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/wp_get_attachment_link

wp_get_attachment_link() is used to return an HTML hyperlink to an attachment
page or file. 

wp_get_attachment_link( $id, $size, $permalink, $icon ) accepts four arguments:
 - $id: the ID of the attachment
 - $size: string ("thumbnail", "large", etc.), or array ( array('width','height') ). Default: "thumbnail"
 - $permalink: boolean: return permalink (TRUE) or the file directly (FALSE). Default: TRUE
 - $icon: boolean: return the media icon for the attachment (TRUE).  Default: FALSE

<p>Used in the following template files:</p>
functions.php
</div>

<h3 id="wp_get_current_user">wp_get_current_user()</h3>
<div style="padding-left:30px;">
wp_get_current_user() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/wp_get_current_user

wp_get_current_user() is used to retrieve the information contained in the 
$current_user global variable.

wp_get_current_user() accepts no arguments.

<p>Example:</p>
wp_get_current_user();
echo $current_user->display_name; will display e.g. "John Smith"

<p>Used in the following template files:</p>
infobar.php
</div>

<h3 id="wp_get_post_categories">wp_get_post_categories()</h3>
<div style="padding-left:30px;">
wp_get_post_categories() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/wp_get_post_categories

wp_get_post_categories() is used to retrieve the list of categories for a post

wp_get_post_categories() returns an array of Category IDs.

wp_get_post_categories( $id, $args ) accepts arguments:
 - $id: PostID for which to retrieve the categories
 - $args: an array of arguments. See Codex.

<p>Used in the following template files:</p>
functions.php
</div>

<h3 id="wp_head">wp_head()</h3>
<div style="padding-left:30px;">
wp_head() is a WordPress action hook.
Codex reference: http://codex.wordpress.org/Hook_Reference/wp_head

wp_head() is used by themes/plugins, usually to insert content into the HTML <head>.

<p>Used in the following template files:</p>
header.php
</div>

<h3 id="wp_link_pages">wp_link_pages()</h3>
<div style="padding-left:30px;">
wp_link_pages() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/wp_link_pages

wp_link_pages() is used to output page links for paginated posts. 

wp_link_pages( '&arg1=value1&arg2=value2' ) accepts several arguments, in array format.
 - 'before': text string to display before the output. Default:'&lt;p&gt;Pages:'
 - 'after':  text string to display after the output. Default: '&lt;/p&gt;'
 - 'link_before': text string to output before each link. Default: NULL 
 - 'link_after': text string to output after each link. Default: NULL
 - 'next_or_number': display either "Previous/Next" links ('next') or page numbers ('number'). Default: 'number'
 - 'nextpagelink': text string to display for "Next" page link (if 'next_or_number' is 'next'. Default: 'Next page'
 - 'previouspagelink':text string to display for "Previous" page link (if 'next_or_number' is 'next'. Default: 'Previous page'
 - 'pagelink': text string to display for page numbers (if 'next_or_number' is 'number'), where % returns the page number. Default: '%'
 - 'more_file': page to which the link points. Default: NULL (i.e. current post) 
 - 'echo': (boolean) output (print/display) or return (for use in PHP) the output. Default: 1 (i.e. TRUE; print/display output)

<p>Example:</p>
wp_link_pages( 'before=&lt;p class="link-pages"&gt;Page: ' ); 
 - outputs e.g.: '&lt;p class="link-pages"&gt;Pages: 1 2 3&lt;/p&gt;'

wp_link_pages() must be used within the Loop.

<p>Used in the following template files:</p>
post-entry.php
</div>

<h3 id="wp_list_comments">wp_list_comments()</h3>
<div style="padding-left:30px;">
wp_list_comments() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/wp_list_comments

wp_list_comments() is used to display the comments associated with a given post.

wp_list_comments( array( 'arg1' => 'value' , 'arg2' => 'value' ) ) accepts several arguments, in the form of an array. Some of the more useful arguments:
 - max_depth: for threaded comments, the maximum thread depth. Defaults to user-configured setting in Settings -> Discussion.
 - style: HTML structure for the comment list. Can be 'ul', 'ol', or 'div'. Defaults to 'ul'.
     - Note: if using 'div' or 'ol', wp_list_comments() must be wrapped in a containing element of the specified type (i.e. <div></div> or <ol></ol>)
 - type: comment type to include. Can be 'all', 'comment', 'trackback', 'pingback', or 'pings' (both trackbacks and pingbacks). Defaults to 'all'
 - avatar_size: size (px) of the user avatar. Can be any interger value between '1' and '512'. Defaults to '32'.
 - per_page: number of comments to display per comments page. Defaults to user-configured setting in Settings -> Discussion.
 - reverse_top_level: if TRUE, will display the newest comments first. Defaults to user-configured setting in Settings -> Discussion.
 
<p>Example:</p>
	wp_list_comments( 'type=comment&avatar_size=40' ); displays comments that are "comment" type (no pingbacks or trackbacks),
with an avatar size of 40px.

wp_list_comments() must be used from within the Loop.

<p>Used in the following template files:</p>
comments.php
</div>

<h3 id="wp_list_pages">wp_list_pages()</h3>
<div style="padding-left:30px;">
wp_list_pages() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/wp_list_pages

wp_list_pages() is used to output a list of pages (as links). This function is
extremely powerful,  with several available arguments, including depth of
hierarchy to display, pages (or hierarchies) to include/exclude, display order
(ascending/descending/menu order).

To see the full list of arguments for wp_list_pages(), see the Codex.

<p>Used in the following template files:</p>
sidebar-left.php, site-navigation.php
</div>

<h3 id="wp_loginout">wp_loginout()</h3>
<div style="padding-left:30px;">
wp_loginout() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/wp_loginout

wp_loginout() displays a login link if user is logged out, or a logout link if user is logged in.

wp_loginout() accepts 1 argument:
 - $redirect: redirect location after login/out. Defaults to no redirect (current location)

<p>Used in the following template files:</p>
infobar.php
</div>

<h3 id="wp_nav_menu">wp_nav_menu()</h3>
<div style="padding-left:30px;">
get_template_part() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/wp_nav_menu

wp_nav_menu( $menu ) is used to output a nav menu named $menu. This menu must be configured
in the Menus administration panel.

wp_nav_menu() (note: no argument for a specific menu) is used to output the default nav menu. This
menu must be configured in the Menus administration panel.

<p>Used in the following template files:</p>
sidebar-left.php, site-navigation.php
</div>

<h3 id="wp_paginate">wp_paginate()</h3>
<div style="padding-left:30px;">
wp_paginate() is a custom function for the WP-Paginate plugin
Codex reference: N/A
Plugin reference: http://wordpress.org/extend/plugins/wp-paginate/

wp_paginate() accepts one argument, that can be used to override default settings.
Refer to the plugin reference for more information.

wp_paginate() is used to output page numbers, in place of Previous/Next Post links.

wp_paginate() must be used within the Loop.

<p>Used in the following template files:</p>
functions.php, loop-footer.php
</div>

<h3 id="wp_register">wp_register()</h3>
<div style="padding-left:30px;">
wp_register() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/wp_register

wp_register() displays a registration link if user is logged out and user registration is 
permitted; otherwise, displays a link to site admin (Dashboard) if user is logged in.

wp_register() accepts 3 arguments:
 - $before: string to display before link. Defaults to '&lt;li&gt;'
 - $after:  string to display after link. Defaults to '&lt;/li&gt;'
 - $echo: return result boolean (true/false). Defaults to 'true'

<p>Example:</p>
wp_register( '' , '' ); returns the Registration or Site Admin link, without wrapping
in &lt;li&gt;&lt;/li&gt; tags.

<p>Used in the following template files:</p>
infobar.php
</div>

<h3 id="wp_title">wp_title</h3>
<div style="padding-left:30px;">
wp_title() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Template_Tags/wp_title
	
wp_title() is a WordPress template tag used to display the title of a page:

	(Post Name for single.php, Date for date-based archive, Category for category archive, etc.)

<p>Used in the following template files:</p>
header.php
</div>

<h3 id="wp_upload_dir">wp_upload_dir()</h3>
<div style="padding-left:30px;">
wp_upload_dir() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/wp_upload_dir

wp_upload_dir() is used to return an array of information regarding the
current upload directory.

wp_upload_dir() returns the following $key => $value pairs:
 - [path] - base directory and sub directory or full path to upload directory
 - [url] - base url and sub directory or absolute URL to upload directory.
 - [subdir] - sub directory if uploads use year/month folders option is on.
 - [basedir] - path without subdir.
 - [baseurl] - URL path without subdir.
 - [error] - set to false.

wp_upload_dir( $time ) accepts arguments:
 - $time: time, as a string, formatted as 'yyyy/mm'. Default: null.

<p>Example:</p>

$upload_dir = wp_upload_dir();
echo $upload_dir['baseurl'];

 - returns "http://www.mydomain.tld/wp-content/uploads/"

<p>Used in the following template files:</p>
functions.php
</div>

<hr />

<h2>Hooks</h2>

<h3 id="hook_after_setup_theme">after_setup_theme</h3>
<div style="padding-left:30px;">
</div>

<h3 id="hook_get_comments_number">get_comments_number</h3>
<div style="padding-left:30px;">
</div>

<h3 id="hook_widgets_init">widgets_init</h3>
<div style="padding-left:30px;">
</div>

<h3 id="hook_wp_list_categories">wp_list_categories</h3>
<div style="padding-left:30px;">
</div>

<h3 id="hook_wp_title">wp_title</h3>
<div style="padding-left:30px;">
</div>

<h2>Global Variables</h2>

<h3 id="var_page">$page</h3>
<div style="padding-left:30px;">
</div>

<h3 id="var_paged">$paged</h3>
<div style="padding-left:30px;">
</div>

<h3 id="var_post">$post</h3>
<div style="padding-left:30px;">
</div>

<h3 id="var_wpdb">$wpdb</h3>
<div style="padding-left:30px;">
</div>


<?php }
?>