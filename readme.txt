=== Oenology ===
Contributors: Chip Bennett
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=QP3N9HUSYJPK6
Tags: cbnet, theme, fixed-width, three-column, white, minimalist
Requires at least: 3.0
Tested up to: 3.0
Stable tag: 0.9

Oenology is designed to be a simple, minimalist, yet feature-complete and fully documented Theme intended to serve as a base for child Themes and as an educational reference for Theme development using WordPress functions, action/filter hooks, and template tags. The Theme includes built-in breadcrumb navigation, and supports Navigation Menus, Post Thumbnails, Custom Backgrounds, Custom Image Headers, and Custom Editor Style. The Theme includes plug-and-play support for the WP-Paginate and Yoast Breadcrumbs plugins.

== Description ==

Oenology is the study of all aspects of wine-making. Much like wine-making, WordPress Theme development is both a science and an art. 
Much like wine-making, WordPress Theme development is the result of a fermentation process that transforms something simple into something beautiful and complex.
Much like wine-making, WordPress Theme development involves an understanding of both the "indoor" (the back-end data management) and the "outdoor" (website design) elements of the process.
Much like a fine wine, a great WordPress Theme is often the result of years of study by a passionate developer.

Oenology doesn't purport to be a fine wine or even a great WordPress Theme. Rather, Oenology is designed to help others learn the art and science of WordPress Theme development.  
Consider Oenology as the fertile soil from which your own enjoyment and passion for WordPress Theme development can grow.

You, too, can become an Oenologist!

== Installation ==

Manual installation:

1. Upload the `oenology` folder to the `/wp-content/themes/` directory

Installation using "Add New Theme"

1. From your Admin UI (Dashboard), use the menu to select Themes -> Add New
2. Search for 'oenology'
3. Click the 'Install' button to open the theme's repository listing
4. Click the 'Install' button

Activiation and Use

1. Activate the Theme through the 'Themes' menu in WordPress
2. The Theme requires no configuration.

== Theme Notes ==

=== Menu Functionality ===

The Theme fully supports WordPress core Navigation Menu functionality. The main site navigation menu is called "Header Navigation", and the left sidebar page navigation is called "Sidebar Navigation".

The Theme defaults to using wp_list_pages() for these menus, which means that you do not have to create your own menus. With the Theme-default functionality, any time you add pages, they will automatically appear in the menus.

The Header Navigation menu shows only top-level Pages. The Sidebar Navigation shows up to four levels of Child Pages, and shows the current Page and its Child Pages. Second-level Child Pages show from the first level, third-level Child Pages show from the second level, and fourth-level Child Pages show from the third level.

Menus are displayed as lists, with each list item being a link displaying a Page Title. The list items are styled so that overly long Page Titles will not break the layout. Long Page Titles will be cut off, and the full Page Title will appear in the tooltip when hovering over the link.

=== Post Thumbnail Functionality ===

The Theme fully supports WordPress core Post Thumbnail functionality. By default, Post Thumbnails will appear in the Post Title for Archive, Taxonomy (Category/Tag), and Search pages.

=== Custom Header Image Functionality ===

The Theme fully supports WordPress core Custom Header Image functionality. The Theme is configured to make the TwentyTen header images available. Custom images will be cropped to 1000x198px when uploaded.

=== Custom Background Functionality ===

The Theme fully supports WordPress core Custom Background functionality. Background image or color is applied to the BODY tag, and will appear outside the Theme content.

=== Widgets ===

The Theme includes some custom Widgets, that can take the place of their built-in counterparts. In fact, the custom Widgets are essentially identical to the core Widgets, except that the custom Widgets are collapsible. The following Widgets are available:
  * Archives
  * Categories
  * Linkroll by Cat
  * Recent Posts
  * Tags

== Frequently Asked Questions ==

= So, how do I learn from Oenology? =

Each Theme template file includes a considerable amount of inline documentation, explaining the code use. 
Also, each template file includes a function reference, that lists each function, hook, and tag used in the file, along with a WordPress Codex reference, an explanation of the function, and example usage.

= What is oenology-reference.txt? =

oenology-reference.txt is the master cross-reference file, that contains all of the functions, template tags, and hooks used in the Theme.

= Why so many template files? =

Oenology is likely broken down into more template parts than the average Theme. This deconstruction is by design, in order to facilitate easier Child-Theming.

= What's in store for the future? =

First and foremost, since Oenology is intended to be a learning tool, the inline and reference documentation will be a continual work-in-progress, based upon user feedback. This documentation is complete, except for functions.php, which will be included in the next version release.

Other features that may be added in the future:
 - Internationalization
 - Theme Options
 - others, as determined by user feedback and demand

 = What About SEO? =
 
I am a firm believer that the single, most important criterion for SEO is good content. That said, the Theme does take apply some SEO considerations:

1. The Theme assumes that the H1 heading tag will only be applied to the Post Title, and not to any post-entry content. Accordingly, if you use an H1 heading in the post-entry content, you'll find that it is styled rather similarly to the H2 heading tag.
2. The Theme template files ensure that the most important content - the post-entry content - is rendered as early as possible. The loop.php template file is called first, and the sidebar-left.php and sidebar-right.php files are called second. 
3. The Theme supplies a default breadcrumb navigation function.
4. The Theme includes plug-and-play support for the following plugins: WP-Paginate, Yoast Breadcrumbs

Most of the rest is really up to the user. The Theme is intended to be SEO-neutral: neither hurting your SEO, nor going out of its way (and adding considerable bloat that is better added via the many good plugins available) to improve it.

== Screenshots ==

1. Standard Theme Screenshot

== Changelog ==

= 1.0 =
* Initial Release

== Upgrade Notice ==

= 1.0 =
Initial Release.