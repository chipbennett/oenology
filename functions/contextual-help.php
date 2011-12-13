<?php
/**
 * Oenology Theme Contextual Help
 *
 * This file defines the Theme Options contextual help content 
 * for the Oenology Theme.
 * 
 * @package 	Oenology
 * @copyright	Copyright (c) 2011, Chip Bennett
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 *
 * @since 		Oenology 1.0
 */
 

/**
 * Settings Page Contextual Help
 * 
 * Contextual help, WordPress 3.3-compatible
 * 
 * @since	Oenology 2.5
 */
function oenology_settings_page_contextual_help() {
	// Globalize settings page
	global $oenology_settings_page;
	// Test for current page
	$screen = get_current_screen();
	if ( $screen->id != $oenology_settings_page ) {
		return;
	}
	// Add Settings - Varietals help screen tab
	$screen->add_help_tab( array(
		'id'      => 'oenology-settings-varietal',
		'title'   => __( 'Settings - Varietals', 'oenology' ),
		'content' => oenology_get_contextual_help_tab_content_settings_varietal(),
	) );
	// Add Settings - Layout help screen tab
	$screen->add_help_tab( array(
		'id'      => 'oenology-settings-layout',
		'title'   => __( 'Settings - Layout', 'oenology' ),
		'content' => oenology_get_contextual_help_tab_content_settings_layout(),
	) );
	// Add Settings - General help screen tab
	$screen->add_help_tab( array(
		'id'      => 'oenology-settings-general',
		'title'   => __( 'Settings - General', 'oenology' ),
		'content' => oenology_get_contextual_help_tab_content_settings_general(),
	) );
	// Add Theme Features help screen tab
	$screen->add_help_tab( array(
		'id'      => 'oenology-reference-features',
		'title'   => __( 'Theme Features', 'oenology' ),
		'content' => oenology_get_contextual_help_tab_content_general(),
	) );
	// Add FAQ Reference help screen tab
	$screen->add_help_tab( array(
		'id'      => 'oenology-reference-varietal',
		'title'   => __( 'FAQ', 'oenology' ),
		'content' => oenology_get_contextual_help_tab_content_faq(),
	) );
	// Add Code Ref Reference help screen tab
	$screen->add_help_tab( array(
		'id'      => 'oenology-reference-layout',
		'title'   => __( 'Code Reference', 'oenology' ),
		'content' => oenology_get_contextual_help_tab_content_coderef(),
	) );
	// Add Change Log Reference help screen tab
	$screen->add_help_tab( array(
		'id'      => 'oenology-reference-changelog',
		'title'   => __( 'Change Log', 'oenology' ),
		'content' => oenology_get_contextual_help_tab_content_changelog(),
	) );
	// Add License Reference help screen tab
	$screen->add_help_tab( array(
		'id'      => 'oenology-reference-license',
		'title'   => __( 'License', 'oenology' ),
		'content' => oenology_get_contextual_help_tab_content_license(),
	) );
	// Add Support Reference help screen tab
	$screen->add_help_tab( array(
		'id'      => 'oenology-reference-support',
		'title'   => __( 'Theme Support', 'oenology' ),
		'content' => oenology_get_contextual_help_tab_content_support(),
	) );
}
 

/**
 * Reference Page Contextual Help
 * 
 * Contextual help, WordPress 3.3-compatible
 * 
 * @since	Oenology 2.5
 */
function oenology_reference_page_contextual_help() {
	// Globalize settings page
	global $oenology_reference_page;
	// Test for current page
	$screen = get_current_screen();
	if ( $screen->id != $oenology_reference_page ) {
		return;
	}
	// Add Code Ref Reference help screen tab
	$screen->add_help_tab( array(
		'id'      => 'oenology-reference-coderef',
		'title'   => __( 'Code Reference', 'oenology' ),
		'content' => ooenology_get_contextual_help_tab_content_coderef(),
	) );
}


/**
 * General Settings Help Tab Content
 */
function oenology_get_contextual_help_tab_content_settings_general() {
	$tabtext = '';
	$tabtext .= '<h2>' . __( 'Header Options', 'oenology' ) . '</h2>';
	$tabtext .= '<h3>' . __( 'Header Nav Menu Position', 'oenology' ) . '</h3>';
	$tabtext .= '<p>';
	$tabtext .= __( 'The default location of the header navigation menu is above the site title/description.', 'oenology' ) . ' ';
	$tabtext .= __( 'Use this setting to display the header navigation menu below the site title/description.', 'oenology' );
	$tabtext .= '</p>';
	$tabtext .= '<h3>' . __( 'Header Nav Menu Depth', 'oenology' ) . '</h3>';
	$tabtext .= '<p>';
	$tabtext .= __( 'By default, the Header Nav Menu only displays top-level Pages.', 'oenology' ) . ' ';
	$tabtext .= __( 'Child Pages are displayed in the Sidebar Nav Menu when the Top-Level Page is displayed.', 'oenology' ) . ' ';
	$tabtext .= __( 'To change this setting:', 'oenology' );
	$tabtext .= '</p>';
	$tabtext .= '<ol>';
	$tabtext .= '<li><strong>' . __( 'One', 'oenology' ) . '</strong> ' . __( '(default) displays only the top-level Pages in the Header Nav Menu', 'oenology' ) . '</li>';
	$tabtext .= '<li><strong>' . __( 'Two', 'oenology' ) . '</strong> ' . __( 'displays the top-level Pages in the Header Nav Menu, and displays second-level Pages in a dropdown menu when the top-level Page is hovered.', 'oenology' ) . '</li>';
	$tabtext .= '<li><strong>' . __( 'Three', 'oenology' ) . '</strong> ' . __( 'displays the top-level Pages in the Header Nav Menu, displays second-level Pages in a dropdown menu when the top-level Page is hovered, and displays third-level Pages in a dropdown menu when the second-level Page is hovered.', 'oenology' ) . '</li>';
	$tabtext .= '</ol>';
	$tabtext .= '<h2>' . __( 'Footer Options', 'oenology' ) . '</h2>';
	$tabtext .= '<h3>' . __( 'Footer Credit', 'oenology' ) . '</h3>';
	$tabtext .= '<p>';
	$tabtext .= __( 'This setting controls the display of a footer credit link.', 'oenology' ) . ' ';
	$tabtext .= __( 'By default, no footer credit link is displayed.', 'oenology' ) . ' ';
	$tabtext .= __( 'You are under no obligation to display a credit link in the footer or anywhere else.', 'oenology' );
	$tabtext .= '</p>';
	return $tabtext;
}

/**
 * Varietal Settings Help Tab Content
 */
function oenology_get_contextual_help_tab_content_settings_varietal() {
	$tabtext = '';
	$tabtext .= '<h2>' . __( 'Varietals', 'oenology' ) . '</h2>';
	$tabtext .= '<p>' . __( 'Varietals are the skins, or styles, applied to Oenology.', 'oenology' ) . '</p>';
	
	$option_parameters = oenology_get_option_parameters();
	$oenology_varietals = $option_parameters['varietal']['valid_options'];
	foreach ( $oenology_varietals as $varietal ) {
		$tabtext .= '<dl>';
		$tabtext .= '<dt><strong>' . $varietal['title'] . '</strong></dt>';
		$tabtext .= '<dd>' . $varietal['description'] . '</dd>';
		$tabtext .= '</dl>';
	}
	return $tabtext;
}


/**
 * Layout Settings Help Tab Content
 */
function oenology_get_contextual_help_tab_content_settings_layout() {
	$tabtext = '';
	$tabtext .= '<h2>' . __( 'Layouts', 'oenology' ) . '</h2>';
	$tabtext .= '<p>' . __( 'Set default layouts for static pages, single blog posts, and blog post indexes.', 'oenology' ) . '</h2>';
	$tabtext .= '<p>The Theme provides global and per-post layout options for static pages, single blog posts, and blog post index pages. Generally, the layout options include one-, two-, and three-column layouts.</p>';
	$tabtext .= '<p>Static page layouts include a one-column layout with no sidebars, a two-column layout with a half-width sidebar on the left, and a three-column layout with half-width sidebars on the left and right.</p>';
	$tabtext .= '<p>Single blog post and blog post index page layouts include a one-column layout with no sidebars, a two-column layout with a full-width sidebar on either the left or the right, and a three-column layout with half-width sidebars on the left and right.</p>';
	$tabtext .= '<p>To configure global Layout settings, see Dashboard -> Appearance -> Oenology Settings -> Layout</p>';
	$tabtext .= '<p>To configure per-post settings for static pages and blog posts, use the meta box provided on the Edit Post screen.</p>';
	$tabtext .= '<p>Note: blog post index pages, including all archive index pages, use the global setting.</p>';
	return $tabtext;
}


/**
 * Theme Features Help Tab Content
 */
function oenology_get_contextual_help_tab_content_general() {
	$tabtext = '';
	$tabtext .= '<h2>' . __( 'Theme Features', 'oenology' ) . '</h2>';
	$tabtext .= '<h3>Custom Theme Hooks</h3>';
	$tabtext .= '<p>Custom Theme hooks provide an alternate means to modify the Oenology Theme content, without needing to modify template files. Nearly all Theme-defined content can be filtered, and most Theme template locations have associated before and after action hooks, to facilitate injection of content.</p>';
	$tabtext .= '<p>In the future, Oenology may include more UI around the custom Theme hooks (particularly, the Post-specific hooks); but for now, you can use the <a href="http://wordpress.org/extend/plugins/oenology-hooks/">Oenology Hooks Plugin</a> for rudimentary UI access to many of the available hooks.</p>';
	$tabtext .= '<h3>Menu Functionality</h3>';
	$tabtext .= '<p><strong>New in Version 2.3!</strong> The Theme now includes a footer menu, called "Footer Navigation".</p>';
	$tabtext .= '<p><strong>New in Version 2.1!</strong> The Header Navigation menu list items can now be optionally set to "fixed" or "fluid". The "fixed" option behaves as before. The "fluid" option allows for long Page Titles not to be cut off; the width of each menu list item will be determined by the length of the Page Title.</p>';
	$tabtext .= '<p>The Theme fully supports WordPress core Navigation Menu functionality. The main site navigation menu is called "Header Navigation", and the left sidebar page navigation is called "Sidebar Navigation".</p>';
	$tabtext .= '<p>The Header Navigation menu can optionally be set to display either above or below the Site Title and Description. By default, the Header Navigation menu displays above the Site Title/Description. To change this setting, see Appearance -> Oenology Options.</p>';
	$tabtext .= '<h4>Header/Sidebar Navigation Menus</h4>';
	$tabtext .= '<p>The Theme defaults to using wp_list_pages() for these menus, which means that you do not have to create your own menus. With the Theme-default functionality, any time you add pages, they will automatically appear in the menus.</p>';
	$tabtext .= '<p>The Header Navigation menu shows only top-level Pages. The Sidebar Navigation shows up to four levels of Child Pages, and shows the current Page and its Child Pages. Second-level Child Pages show from the first level, third-level Child Pages show from the second level, and fourth-level Child Pages show from the third level.</p>';
	$tabtext .= '<p>Menus are displayed as lists, with each list item being a link displaying a Page Title. The list items are styled so that overly long Page Titles will not break the layout. Long Page Titles will be cut off, and the full Page Title will appear in the tooltip when hovering over the link.</p>';
	$tabtext .= '<h4>Footer Navigation Menu</h4>';
	$tabtext .= '<p>The Footer Navigation menu defaults to display nothing if no menu is applied to this location. When the Footer Navigation menu is displayed, it displays on the right side of the footer, and the other footer content displays on the left side of the footer. If no Footer Navigation menu is displayed, the footer content displays in the center of the footer, as before.</p>';
	$tabtext .= '<p>The Footer Navigation menu displays only one level of Page hierarchy.</p>';
	$tabtext .= '<p>The number of items that can be displayed in the Footer Navigation menu is limited by the available space. If too many menu items are included, the other footer content may be pushed beneath the footer. If this happens, simply reduce the number of items included in the menu.</p>';
	$tabtext .= '<h3>Post Thumbnail Functionality</h3>';
	$tabtext .= '<p>The Theme fully supports WordPress core Post Thumbnail functionality. By default, Post Thumbnails will appear in the Post Title for Archive, Taxonomy (Category/Tag), and Search pages.</p>';
	$tabtext .= '<h3>Custom Header Image Functionality</h3>';
	$tabtext .= '<p>The Theme fully supports WordPress core Custom Header Image functionality. The Theme is configured to make the TwentyTen header images available if TwentyTen is installed. Custom images will be cropped to 1000x198px when uploaded.</p>';
	$tabtext .= '<p>The Theme will automatically apply a foreground color to the Site Header Text. If you use a custom image header, you may need to modify this text color, via Dashboard -> Appearance -> Header -> "Text Color"</p>';
	$tabtext .= '<h3>Custom Background Functionality</h3>';
	$tabtext .= '<p>The Theme fully supports WordPress core Custom Background functionality. Background image or color is applied to the BODY tag, and will appear outside the Theme content.</p>';
	$tabtext .= '<h3>Post Formats Functionality</h3>';
	$tabtext .= '<p>The Theme fully supports WordPress core Post Formats functionality. Custom layout and style are applied for each of the core Post Format types: Aside, Audio, Chat, Gallery, Image, Link, Status, and Video. Post Format archive pages are linked in the post footer of each post that uses a Post Format other than "standard". Also, the Theme includes a custom Widget to display a list of Post Format types, similar to the Category list or Tag list.</p>';
	$tabtext .= '<p><strong>Note:</strong> to display captions for Gallery Post Format types, and for Image Post Format types with linked (external) images, add the caption to the <em>Excerpt</em> field on the Edit Post screen.</p>';
	$tabtext .= '<h3>Widgets</h3>';
	$tabtext .= '<p>The Theme includes some custom Widgets, that can take the place of their built-in counterparts. In fact, the custom Widgets are essentially identical to the core Widgets, except that the custom Widgets are collapsible. The following Widgets are available:</p>';
	$tabtext .= '<ol><li>Archives</li><li>Categories</li><li>Linkroll by Cat</li><li>Post Formats</li><li>Recent Posts</li><li>Tags</li></ol>';
	return $tabtext;
}


/**
 * FAQ Reference Help Tab Content
 */
function oenology_get_contextual_help_tab_content_faq() {
	$tabtext = '';
	$tabtext .= '<h2>' . __( 'Answers to questions frequently (or not-so-frequently) asked.', 'oenology' ) . '</h2>';
	$tabtext .= '<h3>So, how do I learn from Oenology?</h3>';
	$tabtext .= '<p>Each Theme template file includes a considerable amount of inline documentation, explaining the code use. Also, each template file includes a function reference, that lists each function, hook, and tag used in the file, along with a WordPress Codex reference, an explanation of the function, and example usage.</p>';
	$tabtext .= '<h3>What is the Code Reference?</h3>';
	$tabtext .= '<p>The Code Reference is the master cross-reference file, that contains all of the functions, template tags, and hooks used in the Theme.</p>';
	$tabtext .= '<h3>Why so many template files?</h3>';
	$tabtext .= '<p>Oenology is likely broken down into more template parts than the average Theme. This deconstruction is by design, in order to facilitate easier Child-Theming.</p>';
	$tabtext .= '<h3>What\'s in store for the future?</h3>';
	$tabtext .= '<p>First and foremost, since Oenology is intended to be a learning tool, the inline and reference documentation will be a continual work-in-progress, based upon user feedback. This documentation is complete as of Oenology Version 1.0, but will continue to be updated and improved.</p>';
	$tabtext .= '<p>Other features that may be added in the future, as determined by user feedback/demand, and changes to WordPress.</p>';
	$tabtext .= '<h3>What About SEO?</h3>';
	$tabtext .= '<p>I am a firm believer that the single, most important criterion for SEO is good content. That said, the Theme does take apply some SEO considerations:</p>';
	$tabtext .= '<ol>';
	$tabtext .= '<li>The Theme assumes that the H1 heading tag will only be applied to the Post Title, and not to any post-entry content. Accordingly, if you use an H1 heading in the post-entry content, you\'ll find that it is styled rather similarly to the H2 heading tag.</li>';
	$tabtext .= '<li>The Theme template files ensure that the most important content - the post-entry content - is rendered as early as possible. The loop.php template file is called first, and the sidebar-left.php and sidebar-right.php files are called second.</li>';
	$tabtext .= '<li>The Theme supplies a default breadcrumb navigation function.</li>';
	$tabtext .= '<li>The Theme includes plug-and-play support for the following plugins: WP-Paginate, Yoast Breadcrumbs</li>';
	$tabtext .= '</ol>';
	$tabtext .= '<p>Most of the rest is really up to the user. The Theme is intended to be SEO-neutral: neither hurting your SEO, nor going out of its way (and adding considerable bloat that is better added via the many good plugins available) to improve it.</p>';
	return $tabtext;
}


/**
 * Code Ref Reference Help Tab Content
 */
function oenology_get_contextual_help_tab_content_coderef() {
	$tabtext = '';
	$tabtext .= '<h2>' . __( 'A cross-reference of every WordPress function, hook, and global variable used in the Theme.', 'oenology' ) . '</h2>';
	$tabtext .= '<p>Coming soon to a contextual help tab near you.</p>';
	return $tabtext;
}


/**
 * Change Log Reference Help Tab Content
 */
function oenology_get_contextual_help_tab_content_changelog() {
	$tabtext = '';
	$tabtext .= <<<EOT
	<h3>2.4 [2011.10.06]</h3>	
	<p>Maintenance Release</p>
	<ol>
	<li>Bugfixes:
		<ol>
		<li>Fixed Issue <a href="https://github.com/chipbennett/oenology/issues/41">41</a> (bug): use oenology_get_options() globally</li>
		<li>Fixed Issue <a href="https://github.com/chipbennett/oenology/issues/43">43</a> (bug): Header dropdown menu needs persistent contextual style</li>
		<li>Fixed Issue <a href="https://github.com/chipbennett/oenology/issues/45">45</a> (bug): Update CSS Gradients to be Cross-Browser Compatible</li>
		<li>Fixed Issue <a href="https://github.com/chipbennett/oenology/issues/46">46</a> (bug): Footer menu displays incorrectly in IE</li>
		<li>Fixed Issue <a href="https://github.com/chipbennett/oenology/issues/47">47</a> (bug): Error when using 3 columns and put something in sidebar column bottom</li>
		</ol>
	</li>
	<li>Maintenance:
		<ol>
		<li>Issue <a href="https://github.com/chipbennett/oenology/issues/33">33</a> (enhancement): Full-Width Layout for Gallery/Video Formats Single-Post View</li>
		<li>Issue <a href="https://github.com/chipbennett/oenology/issues/35">35</a> (enhancement): Make oenology_setup() function non-pluggable
			<ol>
			<li><strong>Note: this change will cause breakage for Child Themes that call oenology_setup().</strong></li>
			<li>Child Themes that call oenology_setup() should rename this function <em>before updating Oenology</em>.</li>
			</ol>
		</li>
		<li>Issue <a href="https://github.com/chipbennett/oenology/issues/37">37</a> (enhancement): Set IMG max-width dynamically using content_width</li>
		<li>Issue <a href="https://github.com/chipbennett/oenology/issues/42">42</a> (enhancement): Add basic styling to TABLE tag</li>
		<li>Issue <a href="https://github.com/chipbennett/oenology/issues/44">44</a> (enhancement): Remove Menu Background Images</li>
		</ol>
	</li>
	</ol>
	
	<h3>2.3 [2011.08.12]</h3>	
	<p>Maintenance Release</p>
	<ol>
	<li>New Features:
		<ol>
		<li>Footer Navigation menu. (Issue <a href="https://github.com/chipbennett/oenology/issues/24">24</a> (feature request): Add footer navigation menu)</li>
		<li>Layout options. (Issue <a href="https://github.com/chipbennett/oenology/issues/22">22</a> (feature request): Add layout options)
			<ol>
			<li>Default layout options for static pages, single blog posts, and blog post indexes.</li>
			<li>Per-post layout options for static pages and single blog posts.</li>
			</ol>
		</li>
		</ol>
	</li>
	<li>Bugfixes:
		<ol>
		<li>Fixed Issue <a href="https://github.com/chipbennett/oenology/issues/19">19</a> (bug): Post Format Link Displays Excerpt</li>
		<li>Fixed Issue <a href="https://github.com/chipbennett/oenology/issues/20">20</a> (bug): Post Format Gallery Does Not Display Page Links</li>
		<li>Fixed Issue <a href="https://github.com/chipbennett/oenology/issues/29">29</a> (bug): Post Format Chat Displays Excerpt</li>
		<li>Fixed Issue <a href="https://github.com/chipbennett/oenology/issues/31">31</a> (bug): 404 Error Handling Undefined Variable</li>
		<li>Fixed Issue <a href="https://github.com/chipbennett/oenology/issues/32">32</a> (bug): Post Format Quote Displays Excerpt</li>
		</ol>
	</li>
	<li>Maintenance:
		<ol>
		<li>Issue <a href="https://github.com/chipbennett/oenology/issues/21">21</a> (enhancement): Clean up inefficient CSS rules</li>
		<li>Issue <a href="https://github.com/chipbennett/oenology/issues/23">23</a> (enhancement): Attachment Page Does Not Show Full Image Size</li>
		<li>Issue <a href="https://github.com/chipbennett/oenology/issues/25">25</a> (enhancement): General Documentation Cleanup</li>
		<li>Issue <a href="https://github.com/chipbennett/oenology/issues/26">26</a> (enhancement): Replace options initialization with wp_parse_args</li>
		<li>Issue <a href="https://github.com/chipbennett/oenology/issues/27">27</a> (enhancement): Rearrange Contextual Help</li>
		<li>Issue <a href="https://github.com/chipbennett/oenology/issues/28">28</a> (enhancement): Move Dynamic Style/Script Output to Separate File</li>
		<li>Issue <a href="https://github.com/chipbennett/oenology/issues/30">30</a> (enhancement): Improve styling of Chat Post Format</li>
		<li>Issue <a href="https://github.com/chipbennett/oenology/issues/34">34</a> (enhancement): Add Milestone to GitHub API Tables in Support Tab</li>
		</ol>
	</li>
	</ol>
	
	<h3>2.2 [2011.07.25]</h3>	
	<p>Maintenance Release</p>
	<ol>
	<li>New Features:
		<ol>
		<li>Theme has been internationalized; front-end output and Theme Settings Page are entirely translation ready. (<em>Note: contextual help will be internationlaized in a future release; reference content will be internationalized where appropriate.</em>)</li>
		<li>Admin Page "Oenology Reference", "Support" tab now features display of latest support forum replies, as well as open bug reports, bugs closed since last release, and development commits since last release.</li>
		</ol>
	</li>
	<li>Bugfixes:
		<ol>
		<li>Fixed Issue <a href="https://github.com/chipbennett/oenology/issues/7">#7</a> (bug): Images without caption or excerpt return error on attachment page</li>
		<li>Fixed Issue <a href="https://github.com/chipbennett/oenology/issues/8">#87</a> (bug): Missing RSS icon</li>
		<li>Fixed Issue <a href="https://github.com/chipbennett/oenology/issues/9">#9</a> (bug): Sidebar Social Icons DIV does not clear floats</li>
		<li>Fixed Issue <a href="https://github.com/chipbennett/oenology/issues/10">#10</a> (enhancement): Some code improvements in options-register.php. Props Andreas Nurbo @andreasnrb</li>
		<li>Fixed Issue <a href="https://github.com/chipbennett/oenology/issues/12">#12</a> (bug): Emil Uzelac: Post Title Margin-Bottom. Props Emil Uzelac @emiluzelac</li>
		<li>Fixed Issue <a href="https://github.com/chipbennett/oenology/issues/13">#13</a> (bug): Emil Uzelac: Feedback heading location. Props Emil Uzelac @emiluzelac</li>
		<li>Fixed Issue <a href="https://github.com/chipbennett/oenology/issues/14">#14</a> (bug): Emil Uzelac: comment form style. Props Emil Uzelac @emiluzelac</li>
		<li>Fixed Issue <a href="https://github.com/chipbennett/oenology/issues/15">#15</a> (bug): Emil Uzelac: IE7 Rendering. Props Emil Uzelac @emiluzelac</li>
		<li>Fixed Issue <a href="https://github.com/chipbennett/oenology/issues/16">#16</a> (bug): Emil Uzelac: IE8 Rendering. Props Emil Uzelac @emiluzelac</li>
		<li>Fixed Issue <a href="https://github.com/chipbennett/oenology/issues/17">#17</a> (bug): Menus: Child Pages of Current Page don't reset CSS</li>
		<li>Fixed Issue <a href="https://github.com/chipbennett/oenology/issues/18">#18</a> (bug): class .current_page_parent a not highlighting properly</li>
		<li>Fixed some bugs with display of Post Format icons.</li>
		</ol>
	</li>
	<li>Maintenance:
		<ol>
		<li>Implemented core filter to address Settings API manage_theme_options bug that prevented Editors from being able to save options</li>
		<li>Cleaned up display of static Pages in search results</li>
		<li>Converted more hard-coded Theme output into filter hooks</li>
		<li>Updated [gallery] shortcode display/style, and added support for galleries of one to ten columns</li>
		<li>Style tweaks to all varietals</li>
		</ol>
	</li>
	</ol>
	
	<h3>2.1 [2011.06.21]</h3>	
	<p>Maintenance Release</p>
	<ol>
	<li>New Features:
		<ol>
		<li>New Varietal: Chardonnay (light color scheme - new default)</li>
		<li>New Theme Option: Header Nav Menu Item Width: fluid or fixed</li>
		</ol>
	</li>
	<li>Maintenance:
		<ol>
		<li>Converted icon images to image sprites for post format icons and social network profile icons</li>
		<li>Tweaks to navigation breadcrumb for better handling of static Page as Front Page, and static Page for Blog Posts Index</li>
		<li>Tweaks site header style for custom header navigation menu</li>
		<li>Tweaks to all varietals</li>
		</ol>
	</li>
	</ol>
	
	<h3>2.0.3 [2011.06.11]</h3>	
	<p>Bugfix Release</p>
	<ol>
	<li>Fixes issue with Post Titles not displaying with Blog Posts Index on front page.</li>
	<li>Fixes issue with Posts pagination not working properly when using default permalink structure.</li>
	<li>Fixes issue with trackback list not being output.</li>
	<li>Fixes issue with custom nav menus not displaying in "nav-sidebar" Theme location.</li>
	<li>Fixes issue with footer credit link option not saving properly.</li>
	</ol>
	
	<h3>2.0.2 [2011.06.10]</h3>	
	<p>Bugfix Release</p>
	<ol>
	<li>Fixes issue with default options not saving properly on init.</li>
	</ol>
	
	<h3>2.0.1 [2011.06.09]</h3>	
	<p>Bugfix Release</p>
	<ol>
	<li>Fixes uploader script issue with <code>body_class()</code> not being on same line as <code>&lt;body&gt;</code> tag.</li>
	</ol>
	
	<h3>2.0 [2011.06.09]</h3>
	<p>Major Update Release</p>
	<ol>
	<li>New Features:
		<ol>
		<li>Extensive custom action/filter hooks. Nearly all Theme-generated content can now be
		modified via filter.</li>
		<li>Added context to all template part function calls, including get_header(), get_footer(),
		get_sidebar(), and get_template_part(), to facilitate Child Theme over-riding of template parts.</li>
		</ol>
	</li>
	<li>Updates:
		<ol>
		<li>Changed handling of sidebar template part files.</li>
		<li>Significant code re-factoring.</li>
		</ol>
	</li>
	<li>Bugfixes:
		<ol>
		<li>Fixes buggy handling of new dynamic sidebars.</li>
		<li>Fixes <a href="https://github.com/chipbennett/oenology/issues/6">Issue #6</a>: Add ID to register_sidebar calls, for use via is_active_sidebar().</li>
		</ol>
	</li>
	<li>Documentation:
		<ol>
		<li>Most inline documentation changed to PHPdoc standard.</li>
		</ol>
	</li>
	</ol>
	
	<h3>1.2.2 [2011.05.16]</h3>
	<p>Bugfix Release</p>
	<ol>
	<li>Fixes <a href="https://github.com/chipbennett/oenology/issues/2">Issue #2</a>: Footer link to home_url() does not echo.</li>
	<li>Fixes <a href="https://github.com/chipbennett/oenology/issues/3">Issue #3</a>: #postnavlogin overflow.</li>
	<li>Fixes <a href="https://github.com/chipbennett/oenology/issues/4">Issue #4</a>: Tables overflowing content area (props FurciferRising).</li>
	<li>Fixes <a href="https://github.com/chipbennett/oenology/issues/5">Issue #5</a>: #postnav floats into nav menu.</li>
	</ol>
	
	<h3>1.2.1 [2011.04.25]</h3>
	<p>Bugfix Release</p>
	<ol>
	<li>Minor bug with 1.2 release.</li>
	</ol>
	
	<h3>1.2 [2011.04.25]</h3>
	<p>Update Release</p>
	<ol>
	<li>New Features:
		<ol>
		<li>Added basic Theme options:
			<ol>
			<li>RSS and Social Network Profile Icons
				<ul>
				<li><em>TODO: Change icons to sprites to elimiate hover "blink"</em></li>
				</ul>
			</li>
			</ol>
		</li>
		<li>Added Widgetized Sidebars:
			<ul>
			<li>Added two full-width sidebars:
				<ol>
				<li>Above existing lef/right column sidebars</li>
				<li>Below existing lef/right column sidebars</li>
				</ol>
			</li>
			<li><em>Note: These sidebars do not apply to Page templates, where left and right column sidebars are separated</em></li>
			<li><em>Note: you may need to adjust Widget placement, via Dashboard -> Appearance -> Widgets, after upgrade</em></li>
			</ul>
		</li>
		<li>Added Theme color schemes ("Varietals"): 
			<ol>
			<li>Muscat (Light Green)</li>
			<li>Malbec (Dark Green)</li>
			</ol>
		</li>
		</ol>
	</li>
	<li>Maintenance/Bugfixes:
		<ol>
		<li>Fixed handling of Custom Image Header:
			<ol>
			<li>Added default header text color based on light/dark color scheme</li>
			<li>Added translucent filter over header image, to improve readability of Site Title/Description</li>
			<li>Fixed handling of user-configured header text color</li>
			</ol>
		</li>
		<li>Stylesheet updates to improve aesthetics</li>
		<li>Added caching for the oenology_copyright() function database query results</li>
		<li>Added caching for the oenology_copyright() function database query results</li>
		<li>Added icons for Post Formats</li>
		<li>Changed RSS icon in Loop Header</li>
		<li>Changed enqueueing of comment-reply script from hard-coded in document head to hooked into wp_enqueue_scripts,
			and added comments_open() to enqueue conditional.</li>
		<li>Changed Track/pingback list in comments.php from custom markup to a wp_list_comments() callback</li>
		<li>Changed handling of no Post Title from an inline conditional to a hook into the_title filter.</li>
		<li>Tweaked CSS for .wp-caption class for handling linked images with captions</li>
		<li>Added "Light" and "Dark" color scheme designations, for automatic styling of Post Format and Social Network icons</li>
		<li>Replaced previous/next index page links in infobar and loop footer with native 
			pagination links, via core function paginate_links()</li>
		<li>Replaced previous/next comments page links above/below comment list with native 
			pagination links, via core function paginate_comments_links()</li>
		<li>Added oenology_paginate_archive_page_links() custom wrapper function for paginate_links, for use by Child Themes</li>
		<li>Added @import font: TexGyre Schola</li>
		</ol>
	</li>
	<li>Documentation:
		<ol>
		<li>Completed update to Oenology Resources Admin Page "Code Ref" Tab</li>
		</ol>
	</li>
	</ol>

	<h3>1.1 [2011.02.23]</h3>
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
		<li>Added Theme color schemes ("Varietals"):
			<ol>
				<li>Syrah (Black)</li>
				<li>Seyval Blanc (Tan)</li>
			</ol>
		</li>
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
EOT;
	return $tabtext;
}


/**
 * License Reference Help Tab Content
 */
function oenology_get_contextual_help_tab_content_license() {
	$tabtext = '';
	$tabtext .= <<<EOT
	<h2>Oenology WordPress Theme License Information</h2>

	<p>Oenology WordPress Theme, Copyright (C) 2010 Chip Bennett</p>
	<ol>
		<li>License: GNU General Public License, v2 (or newer)</li>
		<li>License URI: <a href="http://www.gnu.org/licenses/old-licenses/gpl-2.0.html">http://www.gnu.org/licenses/old-licenses/gpl-2.0.html</a></li>
	</ol>
	
	<p>This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation; either version 2 of the License, or
	(at your option) any later version.</p>
	
	<p>This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.</p>
	
	<h3>Bundled Fonts</h3>

	<p>TexGyre Schola Font, Copyright 2005, 2006 C. R. Holder</p>
	<ol>
		<li>Source: <a href="http://www.fontsquirrel.com/fonts/TeX-Gyre-Schola">TeXGyre Schola Font</a></li>
		<li>License: GUST Font License (GFL) (GPL-compatible)</li>
		<li>License URI: <a href="<?php echo get_template_directory_uri(); ?>/fonts/GUST-FONT-LICENSE.txt">/fonts/GUST-FONT-LICENSE.txt</a></li>
	</ol>
	
	<h3>Bundled Icons</h3>

	<p>IconSweets2 Icons, Copyright 2010 YummyGum</p>
	<ol>
		<li>Source: <a href="http://www.iconsweets2.com">IconSweets2</a></li>
		<li>License: "You may use these icons for both commercial and for 
		personal use and customize them any way you like."</li>
		<li>License URI: <a href="<?php echo get_template_directory_uri(); ?>/images/iconsweets2/License.rtf">/images/iconsweets2/License.rtf</a></li>
	</ol>

	<p>InFocus Social Media Icons, Copyright 2010 WebTreats</p>
	<ol>
		<li>Source: <a href="http://webtreats.mysitemyway.com/1540-infocus-social-media-icon-mega-set/">InFocus Social Media Icons</a></li>
		<li>License: "This resource is free for personal and commercial use ~ no attribution necessary."</li>
		<li>License URI: <a href="<?php echo get_template_directory_uri(); ?>/images/infocus/readme.txt">/images/infocus/readme.txt</a></li>
	</ol>	
EOT;
	return $tabtext;
}


/**
 * Support Reference Help Tab Content
 */
function oenology_get_contextual_help_tab_content_support() {
	$oenology_github_data_issues_open = oenology_get_github_api_data( 'issues', 'open' );
	$oenology_github_data_roadmap = oenology_get_github_api_data( 'issues', 'open', '*', true );
	$oenology_github_data_issues_closed = oenology_get_github_api_data( 'issues', 'closed' );
	$oenology_github_data_commits = oenology_get_github_api_data( 'commits' );
	$tabtext = '';
	$tabtext .= '<h2>' . __( 'Support options and links for Oenology', 'oenology' ) . '</h2>';
	$tabtext .= <<<EOT
<div id="dashboard-widgets-wrap">
	
	<div id="dashboard-widgets" class="metabox-holder">
	
		<div class="postbox-container" style="width:49%;" >
		
			<div id="normal-sortables" class="meta-box-sortable ui-sortable">
			
				<div class="postbox">
				
					<h3><span>Oenology Support Options</span></h3>
					
					<div class="inside">
					
					<p>For Oenology support, please use one of the below options. I will do my best to fix all bug reports as quickly as possible, and to respond to all support queries.</p>
					
					<h4 style="text-align:center;">Bug Reports and Feature Requests:</h4>
					
					<p style="text-align:center;">
					<a style="padding:5px;border:1px solid #999;background-color:#58a;color:#fff;-webkit-border-radius:10px;-moz-border-radius:10px;border-radius:10px;" target="_blank" href="https://github.com/chipbennett/oenology/issues/new">
						<strong>Submit a bug report or feature request</strong>
					</a>
					<br /><span style="font-size:11px;"><em>Note: requires a (free) GitHub account.</span></em>
					</p>
					<p>Use this option for the following types of issues:</p>
					<ol style="font-size:11px;">
						<li style="line-height:1em;">Theme functionality, style, or design is broken</li>
						<li style="line-height:1em;">Theme functionality, style, or design doesn't work right, or as expected</li>
						<li style="line-height:1em;">Theme functionality, style, or design could be improved</li>
						<li style="line-height:1em;">Theme functionality or feature could be added</li>
					</ol>
					
					<h4 style="text-align:center;padding-top:10px;">General Support Requests:</h4>
					
					<p style="text-align:center;">					
					<a style="padding:5px;border:1px solid #999;background-color:#58a;color:#fff;-webkit-border-radius:10px;-moz-border-radius:10px;border-radius:10px;" target="_blank" href="http://wordpress.org/tags/oenology?forum_id=5#postform">
						<strong>Submit a general support request</strong>
					</a>
					<br /><span style="font-size:11px;"><em>Note: requires a (free) WordPress.org account.</span></em>
					</p>
					<p>Use this option for the following types of issues:</p>
					<ol style="font-size:11px;">
						<li style="line-height:1em;">Help with using the Theme</li>
						<li style="line-height:1em;">Help with Theme options</li>
						<li style="line-height:1em;">Help with modifying the Theme</li>
					</ol>
					
					</div>
				
				</div>
			
				<div class="postbox">
				
					<h3>
						<span>Open Oenology Bug Reports</span> 
						(<a href="https://github.com/chipbennett/oenology/issues/?sort=created&direction=asc&state=open">See All</a>)
					</h3>
					
					<div class="inside">
					
						<div class="text-widget">$oenology_github_data_issues_open</div>
					
					</div>
				
				</div>
			
				<div class="postbox">
				
					<h3>
						<span>Latest Oenology Support Topics</span> 
						(<a href="http://wordpress.org/tags/oenology">See All</a>)
					</h3>
					
					<div class="inside">
					
						<div class="rss-widget">
					
						(Coming back soon)
						
						</div>
					
					</div>
				
				</div>
			
				<div class="postbox">
				
					<h3>
						<span>Oenology Roadmap</span> 
					</h3>
					
					<div class="inside">
					
						<div class="text-widget">$oenology_github_data_roadmap</div>
					
					</div>
				
				</div>
			
			</div>
		
		</div>
	
		<div class="postbox-container" style="width:49%;" >
		
			<div id="side-sortables" class="meta-box-sortable ui-sortable">
			
				<div class="postbox">
				
					<h3>
						<span>Oenology Bug Reports Closed Since Last Release</span> 
						(<a href="https://github.com/chipbennett/oenology/commits/master">See All</a>)
					</h3>
					
					<div class="inside">
					
						<div class="text-widget">$oenology_github_data_issues_closed</div>
					
					</div>
				
				</div>
			
				<div class="postbox">
				
					<h3>
						<span>Oenology Development Commits Since Last Release</span> 
						(<a href="https://github.com/chipbennett/oenology/issues/?sort=created&direction=asc&state=open">See All</a>)
					</h3>
					
					<div class="inside">
					
						<div class="text-widget">$oenology_github_data_commits</div>
					
					</div>
				
				</div>
			
			</div>			
		
		</div>
		
	</div>
	
</div>
EOT;
	return $tabtext;
}
?>