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
?>