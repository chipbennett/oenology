=== Oenology ===
Contributors: Chip Bennett
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=QP3N9HUSYJPK6
Tags: fixed-width, white, black, blue, red, tan, green, one-column, two-columns, three-columns, custom-header, custom-background, custom-menu, editor-style, featured-images, flexible-width, full-width-template, left-sidebar, post-formats, right-sidebar, sticky-post, theme-options, threaded-comments, translation-ready
Requires at least: 3.5
Tested up to: 6.8
Stable tag: 3.5

Description: Oenology is designed to be a simple, minimalist, yet feature-complete and fully documented Theme intended to serve as a base for child Themes and as an educational reference for Theme development using WordPress functions, action/filter hooks, and template tags. Oenology includes built-in breadcrumb navigation, and supports the Customizer, Custom Logo, Post Formats, Navigation Menus, Post Thumbnails, Custom Backgrounds, Custom Image Headers, and Custom Editor Style. Oenology features a responsive design, and includes plug-and-play support for the WP-Paginate and Yoast Breadcrumbs plugins. <strong>Requires WordPress 3.5, and is compatible up to WordPress 6.8.1.</strong>

== Description ==

Oenology is the study of all aspects of wine-making. Much like wine-making, WordPress Theme development is both a science and an art. 

Much like wine-making, WordPress Theme development is the result of a fermentation process that transforms something simple into something beautiful and complex. Much like wine-making, WordPress Theme development involves an understanding of both the "indoor" (the back-end data management) and the "outdoor" (website design) elements of the process. Much like a fine wine, a great WordPress Theme is often the result of years of study by a passionate developer.

Oenology doesn't purport to be a fine wine or even a great WordPress Theme. Rather, Oenology is designed to help others learn the art and science of WordPress Theme development.  

Consider Oenology as the fertile soil from which your own enjoyment and passion for WordPress Theme development can grow.

You, too, can become an Oenologist!

== Theme Features ==

= Custom Logo =

New in Version 3.4! Oenology now supports the core "Custom Logo" feature added in WordPress 4.5. Configure via Appearance -> Customize -> Site Identity -> Custom Logo. If no custom logo is configured, the Theme displays just as it did before. However, if a custom logo is configured, it is displayed to the left of the site title and description, and the site title and description change from center-aligned to left-aligned.

= Featured Content Template =

New in Version 3.3! Oenology now includes a featured-content template. This template can be used on the site front page, or any other static page. Your featured content is almost infinitely configurable! The featured-content template is entirely Widget-driven, and includes custom widgets for featured-content sliders, featured post-format (image/gallery/quote/status) content, calls to action, and featured pages. Content is defined as "featured" using custom post meta: just click a checkbox in the Featured Content meta box on the post-edit screen.

The following custom Widgets are included:

* Oenology Featured Content Slider: display the featured image, title, and excerpt from featured posts in a configurable slider
* Oenology Post Formats Feature: display a configurable number of random or latest status, quote, or image posts
* Oenology Call To Action: display a call-to-action message and link to a static page
* Oenology Featured Page: display the featured image and excerpt of a static page
* Oenology Featured Text: a text widget

To configure, add Widgets to the "Featured Content" sidebar. Widgets are displayed in a masonry-style layout, with each custom Widget having configurable width (1-3 columns) and height (1-5 rows). You can also use any other Widget, though only the custom Widgets have configurable width and height.

Please note: this feature is still very experimental, and the styling is still fairly raw. It will be a work-in-progress (and if you are a designer and use GitHub, pull requests welcome!), and I'd love to get feedback on it so that I can continue to improve it.

= Responsive Design =

Oenology is a fully responsive Theme, supporting devices with display resolutions as low as 240px wide.
Custom Layouts

Oenology provides Theme options for default layouts for the site front page, blog posts index, single posts, and static pages. Additionally, using custom post meta data, Oenology supports per-post layouts for single posts and static pages. Choose from various one-, two-, and three-column layouts.

= Custom Theme Hooks =

New in version 3.0! Oenology now fully supports the Theme Hooks Alliance (THA) template hooks standard.

Custom Theme hooks provide an alternate means to modify the Oenology Theme content, without needing to modify template files. Nearly all Theme-defined content can be filtered, and most Theme template locations have associated before and after action hooks, to facilitate injection of content.

In the future, Oenology may include more UI around the custom Theme hooks (particularly, the Post-specific hooks); but for now, you can use the Oenology Hooks Plugin for rudimentary UI access to many of the available hooks.

= Theme Customizer =

Oenology Theme options are fully integrated into the core Theme Customizer, so you can preview settings changes in real time.

= Contextual Help =

Oenology includes comprehensive Theme documentation via the Contextual Help tab on the Oenology Settings admin page, including full license information, change log, and even an integrated support tab with links to submit bug reports and to file support topics, and lists of the Oenology roadmap, and code commits and issues closed since the last release.

Note: the settings page was removed in version 3.4, to keep in line with wordpress.org Theme Review requirements - and along with that change, the settings page contextual help was also removed. I am still deciding on the best way to retain/present this information.

= Post Formats =

Oenology fully supports WordPress core Post Formats functionality. Custom layout and style are applied for each of the core Post Format types: Aside, Audio, Chat, Gallery, Image, Link, Status, and Video. Post Format archive pages are linked in the post footer of each post that uses a Post Format other than "standard". Also, Oenology includes a custom Widget to display a list of Post Format types, similar to the Category list or Tag list.

Note: to display captions for Gallery Post Format types, and for Image Post Format types with linked (external) images, add the caption to the Excerpt field on the Edit Post screen.

= Custom Navigation Menus =

New in Version 2.3! Oenology now includes a footer menu, called "Footer Navigation".

New in Version 2.1! The Header Navigation menu list items can now be optionally set to "fixed" or "fluid". The "fixed" option behaves as before. The "fluid" option allows for long Page Titles not to be cut off; the width of each menu list item will be determined by the length of the Page Title.

Oenology fully supports WordPress core Navigation Menu functionality. The main site navigation menu is called "Header Navigation", and the left sidebar page navigation is called "Sidebar Navigation".

The Header Navigation menu can optionally be set to display either above or below the Site Title and Description. By default, the Header Navigation menu displays above the Site Title/Description. To change this setting, see Appearance -> Customize -> Theme General Options -> Header Options.

* Header/Sidebar Navigation Menus

Oenology defaults to using wp_list_pages() for these menus, which means that you do not have to create your own menus. With Oenology-default functionality, any time you add pages, they will automatically appear in the menus.

The Header Navigation menu shows only top-level Pages. The Sidebar Navigation shows up to four levels of Child Pages, and shows the current Page and its Child Pages. Second-level Child Pages show from the first level, third-level Child Pages show from the second level, and fourth-level Child Pages show from the third level.

Menus are displayed as lists, with each list item being a link displaying a Page Title. The list items are styled so that overly long Page Titles will not break the layout. Long Page Titles will be cut off, and the full Page Title will appear in the tooltip when hovering over the link.

* Footer Navigation Menu

The Footer Navigation menu defaults to display nothing if no menu is applied to this location. When the Footer Navigation menu is displayed, it displays on the right side of the footer, and the other footer content displays on the left side of the footer. If no Footer Navigation menu is displayed, the footer content displays in the center of the footer, as before.

The Footer Navigation menu displays only one level of Page hierarchy.

The number of items that can be displayed in the Footer Navigation menu is limited by the available space. If too many menu items are included, the other footer content may be pushed beneath the footer. If this happens, simply reduce the number of items included in the menu.

= Post Thumbnail Functionality =

Oenology fully supports WordPress core Post Thumbnail functionality. By default, Post Thumbnails will appear in the Post Title for Archive, Taxonomy (Category/Tag), and Search pages.

= Custom Header Image Functionality =

Oenology fully supports WordPress core Custom Header Image functionality. Oenology is configured to make the TwentyTen header images available if TwentyTen is installed. Custom images will be cropped to 1000x198px when uploaded.

Oenology will automatically apply a foreground color to the Site Header Text. If you use a custom image header, you may need to modify this text color, via Dashboard -> Appearance -> Header -> "Text Color"

= Custom Background Functionality =

Oenology fully supports WordPress core Custom Background functionality. Background image or color is applied to the BODY tag, and will appear outside Oenology content.

= Widgets =

Oenology includes some custom Widgets, namely for displaying lists of categories, tags, and post formats. For categories and tags, the custom Widgets differ from their core counterparts in that they also display an RSS feed link next to the category archive index link:

* Categories
* Post Formats
* Tags

== Frequently Asked Questions ==

= So, how do I learn from Oenology? =

Each Theme template file includes a considerable amount of inline documentation, explaining the code use. 
Also, the Theme includes a function reference, that lists each function, hook, and tag used in the Theme, along with a WordPress Codex reference, an explanation of the function, and example usage.

= What is the Oenology Reference admin page? =

The Oenology Reference admin page contains the latest updates to general Theme notes, the FAQ, Changelog, License,
 and, perhaps most importantly, the Code Reference.

The Code Reference tab of the Oenology Reference page now replaces the "oenology-reference.txt" file, as
 the master cross-reference file, that contains all of the functions, template tags, and hooks used in the Theme

= What happened to oenology-reference.txt / the contextual help? =

As of version 3.4, the reference page and settings page (including the contextual help) have been removed, in support of wordpress.org Theme Review guidelines. I am still considering options for the best way to retain/present the Theme documentation/reference information.

= Why so many template files? =

Oenology is likely broken down into more template parts than the average Theme. This deconstruction is by design, in order to facilitate easier Child-Theming.

= What's in store for the future? =

First and foremost, since Oenology is intended to be a learning tool, the inline and reference documentation will be a continual work-in-progress, based upon user feedback. This documentation is complete as of Oenology Version 1.0, but will continue to be updated and improved.

Other features that may be added in the future:

 - Others, as determined by user feedback and demand

= What About SEO? =
 
I am a firm believer that the single, most important criterion for SEO is good content. That said, the Theme does take apply some SEO considerations:

1. The Theme assumes that the H1 heading tag will only be applied to the Post Title, and not to any post-entry content. Accordingly, if you use an H1 heading in the post-entry content, you'll find that it is styled rather similarly to the H2 heading tag.
2. The Theme template files ensure that the most important content - the post-entry content - is rendered as early as possible. The loop.php template file is called first, and the sidebar-left.php and sidebar-right.php files are called second. 
3. The Theme supplies a default breadcrumb navigation function.
4. The Theme includes plug-and-play support for the following plugins: WP-Paginate, Yoast Breadcrumbs

Most of the rest is really up to the user. The Theme is intended to be SEO-neutral: neither hurting your SEO, nor going out of its way (and adding considerable bloat that is better added via the many good plugins available) to improve it.

= Where did my social icons go? =

In version 3.3, the social profile link icon handling was changed from using Theme options to using a custom navigation menu for storing social profile links. This 
change will keep your social profile links portable from Theme to Theme, and provides built-in support for other Themes that use this method. To add your social icons:

* Create a new custom navigation menu, and name it, e.g. "Social". (The name isn't important, as long as you remember it!)
* Add <strong>custom links</strong> to your "Social" menu, under the "Links" metabox, one for each social network profile you wish to include.
* Save the menu, and assign it to the "Social Profile Links" Theme Location.
* Now your social profile link icons will appear as they did before.


== Screenshots ==

1. Standard Theme Screenshot

== License ==

= Oenology WordPress Theme, Copyright (C) 2010 Chip Bennett =

License: GNU General Public License, v2 (or newer)
License URI: http://www.gnu.org/licenses/old-licenses/gpl-2.0.html

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

= Bundled Scripts =

**Cycle2, Copyright 2012 M. Alsup**

Source: http://jquery.malsup.com/cycle2/
License: MIT and GPLv2
License URI: /js/cycle2/README.md

**Respond.js, Copyright 2011 Scott Jehl, scottjehl.com**

Source: https://github.com/scottjehl/Respond
License: Dual-licensed under MIT and GPLv2
License URI: /js/response.js/readme.md


**FitVids.js, Copyright 2011, Chris Coyier - http://css-tricks.com + Dave Rupert - http://daverupert.co**

Source: https://github.com/davatron5000/FitVids.js
License: WTFPL
License URI: /js/fitvids.js/jquery.fitvids.js

**TinyNav, Copyright (c) 2011-2012 Viljami Salminen, http://viljamis.com/**

Source: https://github.com/viljamis/TinyNav.js
License: MIT
License URI: /js/tinynav.js/README.md


= Bundled Fonts =

**TexGyre Schola Font, Copyright 2005, 2006 C. R. Holder**

Source: http://www.fontsquirrel.com/fonts/TeX-Gyre-Schola
License: GUST Font License (GFL) (GPL-compatible)
License URI: /fonts/GUST-FONT-LICENSE.txt

**Genericons, Copyright 2013 Automattic**

Source: http://www.genericons.com
License: GNU GPL, Version 2 (or later)
License URI: /fonts/Genericons-LICENSE.txt

= Bundled Images =

**Kirki Customizer Framework, Copyright @aristath**

Source: https://github.com/reduxframework/kirki/
License: GNU GPL Version 2 (or later)

Image files in /images/layouts

**No Copyright**

pxwhite.jpg is a single-pixel image, and not copyrightable

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

== Changelog ==

Note: see changelog.txt file for change details.

= 3.4 [2016.04.15] =
* Maintenance Release

= 3.3 [2014.02.17] =
* Maintenance Release

= 3.2 [2013.04.09] =
* Maintenance Release

= 3.1 [2013.03.02] =
* Maintenance Release

= 3.0 [2012.12.22] =
* Maintenance Release

= 2.6 [2012.06.14] =
* Maintenance Release

= 2.5 [2011.12.16] =
* Maintenance Release

= 2.4 [2011.10.06] =
* Maintenance Release

= 2.3 [2011.08.12] =
* Maintenance Release

= 2.2 [2011.07.25] =
* Maintenance Release

= 2.1 [2011.06.21] =
* Maintenance Release

= 2.0.3 [2011.06.11] =
* Minor Bugfix Release

= 2.0.2 [2011.06.10] =
* Minor Bugfix Release

= 2.0.1 [2011.06.09] =
* Minor Bugfix Release

= 2.0 [2011.06.09] =
* Major Update Release

= 1.2.2 [2011.05.16] =
* Minor Bugfix Release

= 1.2.1 [2011.04.25] =
* Minor Bugfix Release

= 1.2 [2011.04.25] =
* Update Release

= 1.1 [2011.02.23] =
* Update Release

= 1.0 [2010.12.08] =
* Maintenance Release

= 0.9.2 [2010.11.04] =
* Minor BugFix release

= 0.9.1 [2010.09.24] =
* Initial Release