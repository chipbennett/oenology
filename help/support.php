<?php
/**
 * Support Reference Help Tab Content
 */

$oenology_github_data_issues_open = oenology_get_github_api_data( 'issues', 'open' );
$oenology_github_data_roadmap = oenology_get_github_api_data( 'issues', 'open', '*', true );
$oenology_github_data_issues_closed = oenology_get_github_api_data( 'issues', 'closed' );
$oenology_github_data_commits = oenology_get_github_api_data( 'commits' );

$tabtext = '';
$tabtext .= '<h2>' . __( 'Support options and links for Oenology', 'oenology' ) . '</h2>';

// Support Options
$tabtext .= '<h3><span>' . __( 'Oenology Support Options', 'oenology' ) . '</span></h3>';
$tabtext .= '<div class="postbox"><div class="inside">';
$tabtext .= '<p>' . __( 'For Oenology support, please use one of the below options. I will do my best to fix all bug reports as quickly as possible, and to respond to all support queries.', 'oenology' ) . '</p>';
$tabtext .= '<h4>' . __( 'Bug Reports and Feature Requests:', 'oenology' ) . '</h4>';
$tabtext .= '<p>';
$tabtext .= '<a class="oenology-support-submit" target="_blank" href="https://github.com/chipbennett/oenology/issues/new">';
$tabtext .= __( 'Submit a bug report or feature request', 'oenology' );
$tabtext .= '</a><br />';
$tabtext .= '<span style="font-size:11px;"><em>' . __( 'Note: requires a (free) GitHub account.', 'oenology' ) . '</span></em>';
$tabtext .= '</p>';
$tabtext .= '<p>' . __( 'Use this option for the following types of issues:', 'oenology' ) . '</p>';
$tabtext .= '<ol style="font-size:11px;">';
$tabtext .= '<li style="line-height:1em;">' . __( 'Theme functionality, style, or design is broken', 'oenology' ) . '</li>';
$tabtext .= '<li style="line-height:1em;">' . __( 'Theme functionality, style, or design doesn\'t work right, or as expected', 'oenology' ) . '</li>';
$tabtext .= '<li style="line-height:1em;">' . __( 'Theme functionality, style, or design could be improved', 'oenology' ) . '</li>';
$tabtext .= '<li style="line-height:1em;">' . __( 'Theme functionality or feature could be added', 'oenology' ) . '</li>';
$tabtext .= '</ol>';
$tabtext .= '<h4 style="padding-top:10px;">' . __( 'General Support Requests:', 'oenology' ) . '</h4>';
$tabtext .= '<p>';
$tabtext .= '<a class="oenology-support-submit" target="_blank" href="http://wordpress.org/tags/oenology?forum_id=5#postform">';
$tabtext .= __( 'Submit a general support request', 'oenology' );
$tabtext .= '</a><br />';
$tabtext .= '<span style="font-size:11px;"><em>' . __( 'Note: requires a (free) WordPress.org account.', 'oenology' ) . '</span></em>';
$tabtext .= '</p>';
$tabtext .= '<p>' . __( 'Use this option for the following types of issues:', 'oenology' ) . '</p>';
$tabtext .= '<ol style="font-size:11px;">';
$tabtext .= '<li style="line-height:1em;">' . __( 'Help with using the Theme', 'oenology' ) . '</li>';
$tabtext .= '<li style="line-height:1em;">' . __( 'Help with Theme options', 'oenology' ) . '</li>';
$tabtext .= '<li style="line-height:1em;">' . __( 'Help with modifying the Theme', 'oenology' ) . '</li>';
$tabtext .= '</ol>';
$tabtext .= '</div></div>';

// Open Bug Reports
$tabtext .= '<h3>';
$tabtext .= '<span>' . __( 'Open Oenology Bug Reports', 'oenology' ) . '</span>';
$tabtext .= ' (<a href="https://github.com/chipbennett/oenology/issues/?sort=created&direction=asc&state=open">' . __( 'See All', 'oenology' ) . '</a>)';
$tabtext .= '</h3>';
$tabtext .= '<div class="postbox"><div class="inside">';
$tabtext .= '<div class="text-widget">' . $oenology_github_data_issues_open . '</div>';
$tabtext .= '</div></div>';

// Latest Support Forum Topics
$tabtext .= '<h3>';
$tabtext .= '<span>' . __( 'Latest Oenology Support Topics', 'oenology' ) . '</span> ';
$tabtext .= ' (<a href="http://wordpress.org/tags/oenology">' . __( 'See All', 'oenology' ) . '</a>)';
$tabtext .= '</h3>';
$tabtext .= '<div class="postbox"><div class="inside">';
$tabtext .= '<div class="rss-widget">' . oenology_get_support_feed() . '</div>';
$tabtext .= '</div></div>';

// Roadmap
$tabtext .= '<h3>';
$tabtext .= '<span>' . __( 'Oenology Roadmap', 'oenology' ) . '</span> ';
$tabtext .= '</h3>';
$tabtext .= '<div class="postbox"><div class="inside">';
$tabtext .= '<div class="text-widget">' . $oenology_github_data_roadmap . '</div>';
$tabtext .= '</div></div>';

// Bug Reports Closed Since Last Release
$tabtext .= '<h3>';
$tabtext .= '<span>' . __( 'Oenology Bug Reports Closed Since Last Release', 'oenology' ) . '</span>';
$tabtext .= ' (<a href="https://github.com/chipbennett/oenology/commits/master">' . __( 'See All', 'oenology' ) . '</a>)';
$tabtext .= '</h3>';
$tabtext .= '<div class="postbox"><div class="inside">';
$tabtext .= '<div class="text-widget">' . $oenology_github_data_issues_closed . '</div>';
$tabtext .= '</div></div>';

// Development Commits Since Last Release
$tabtext .= '<h3>';
$tabtext .= '<span>' . __( 'Oenology Development Commits Since Last Release', 'oenology' ) . '</span>';
$tabtext .= ' (<a href="https://github.com/chipbennett/oenology/issues/?sort=created&direction=asc&state=open">' . __( 'See All', 'oenology' ) . '</a>)';
$tabtext .= '</h3>';
$tabtext .= '<div class="postbox"><div class="inside">';
$tabtext .= '<div class="text-widget">' . $oenology_github_data_commits . '</div>';
$tabtext .= '</div></div>';

return $tabtext;
?>