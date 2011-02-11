=== Oenology ===
Contributors: Chip Bennett
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=QP3N9HUSYJPK6
Tags: fixed-width, white, black, tan, three-columns, custom-header, custom-background, custom-menu, editor-style, theme-options, threaded-comments, sticky-post, left-sidebar, right-sidebar
Requires at least: 3.1
Tested up to: 3.1
Stable tag: 1.1

Description: Oenology is designed to be a simple, minimalist, yet feature-complete and fully documented Theme intended to serve as a base for child Themes and as an educational reference for Theme development using WordPress functions, action/filter hooks, and template tags. The Theme includes built-in breadcrumb navigation, and supports Post Formats, Navigation Menus, Post Thumbnails, Custom Backgrounds, Custom Image Headers, and Custom Editor Style. The Theme includes plug-and-play support for the WP-Paginate and Yoast Breadcrumbs plugins. <strong>Requires WordPress 3.1, and is compatible up to WordPress 3.1.</strong>

== Description ==

Oenology is the study of all aspects of wine-making. Much like wine-making, WordPress Theme development is both a science and an art. 

Much like wine-making, WordPress Theme development is the result of a fermentation process that transforms something simple into something beautiful and complex. Much like wine-making, WordPress Theme development involves an understanding of both the "indoor" (the back-end data management) and the "outdoor" (website design) elements of the process. Much like a fine wine, a great WordPress Theme is often the result of years of study by a passionate developer.

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
2. See Appearance -> Oenology Options for Theme Options

== Theme Notes ==

=== Menu Functionality ===

The Theme fully supports WordPress core Navigation Menu functionality. The main site navigation menu is called "Header Navigation", and the left sidebar page navigation is called "Sidebar Navigation".

The Header Navigation menu can optionally be set to display either above or below the Site Title and Description. By default, the Header Navigation menu displays above the Site Title/Description. To change this setting, see Appearance -> Oenology Options.

The Theme defaults to using wp_list_pages() for these menus, which means that you do not have to create your own menus. With the Theme-default functionality, any time you add pages, they will automatically appear in the menus.

The Header Navigation menu shows only top-level Pages. The Sidebar Navigation shows up to four levels of Child Pages, and shows the current Page and its Child Pages. Second-level Child Pages show from the first level, third-level Child Pages show from the second level, and fourth-level Child Pages show from the third level.

Menus are displayed as lists, with each list item being a link displaying a Page Title. The list items are styled so that overly long Page Titles will not break the layout. Long Page Titles will be cut off, and the full Page Title will appear in the tooltip when hovering over the link.

=== Post Thumbnail Functionality ===

The Theme fully supports WordPress core Post Thumbnail functionality. By default, Post Thumbnails will appear in the Post Title for Archive, Taxonomy (Category/Tag), and Search pages.

=== Custom Header Image Functionality ===

The Theme fully supports WordPress core Custom Header Image functionality. The Theme is configured to make the TwentyTen header images available. Custom images will be cropped to 1000x198px when uploaded.

=== Custom Background Functionality ===

The Theme fully supports WordPress core Custom Background functionality. Background image or color is applied to the BODY tag, and will appear outside the Theme content.

=== Post Formats Functionality ===

The Theme fully supports WordPress core Post Formats functionality. Custom layout and style are applied for each of the core Post Format types: Aside, Audio, Chat, Gallery, Image, Link, Status, and Video. Post Format archive pages are linked in the post footer of each post that uses a Post Format other than "standard". Also, the Theme includes a custom Widget to display a list of Post Format types, similar to the Category list or Tag list.

=== Widgets ===

The Theme includes some custom Widgets, that can take the place of their built-in counterparts. In fact, the custom Widgets are essentially identical to the core Widgets, except that the custom Widgets are collapsible. The following Widgets are available:
  * Archives
  * Categories
  * Linkroll by Cat
  * Post Formats
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

First and foremost, since Oenology is intended to be a learning tool, the inline and reference documentation will be a continual work-in-progress, based upon user feedback. This documentation is complete as of Oenology Version 1.0, but will continue to be updated and improved.

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

= 1.1 [2011.02.DD] =
* Update Release
* New Features
  * Added support for Post Formats (introduced in WordPress 3.1)
  * Added basic Theme options: 
    * Header Navigation Menu Position
    * Header Navigation Menu Depth (up to three levels)
    * Footer Credit Link (disabled by default)
  * Added Theme color schemes ("Varietals"): Syrah, Seyval Blanc
* Maintenance/Bugfixes
  * Added check to ensure TwentyTen header images are registered only if TwentyTen is installed
  * Minor tweak/bugfix to ensure floats are cleared properly on paginated posts
  * Minor tweaks to comments.php

= 1.0 [2010.12.08] =
* Maintenance Release
* Moved all CSS declarations into style.css, and eliminated @import calls
* Cleaned up un-needed CSS files in css\ and css\fonts\ directories; removed css\fonts\ directory.
* Fixed a few minor bugs
* Added Prev/Next page navigation in Loop Footer, to match Infobar navigation
* Added default Widgets to appear in each sidebar if no widgets are defined by the user
* Finished adding inline documentation for all functions used in the Theme, including functions.php
* Added default "(Untitled)" text to appear in place of Title for Posts without a defined Post Title
* Removed translation strings. Internationalization will be added in a later revision.

= 0.9.2 [2010.11.04] =
* Minor BugFix release
* Fixed divide-by-zero PHP notice generated on the attachment page when the image metadata indicates a shutter speed of zero.
* Fixed minor CSS image dimension bug
* Updated Theme tags

= 0.9.1 [2010.09.24] =
Initial Release.

== Upgrade Notice ==

= 1.1 =
Maintenance release. Post Formats support; Theme options; bugfixes

= 1.0 =
Maintenance release. Completed inline documentation, added default Widgets, minor bugfixes, CSS clean-up, minor updates

= 0.9.2 =
Minor BugFix release

= 0.9.1 =
Initial Release.