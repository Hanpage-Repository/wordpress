<?php  
	/*
		Plugin Name: Social Media Meta Tags
		Description: The Social Media Meta Tags, are HTML tags that allow you to make the most out of the content you share from your site.
		Plugin URI: https://wordpress.org/plugins/facebook-ogg-meta-tags/
		Version: 1.8
		Author: Bassem Rabia
		Author URI: mailto:bassem.rabia@gmail.com
		License: GPLv2
	*/

	require_once(dirname(__FILE__).'/metaTags/metaTags.php');
	new metaTags('1.8');
?>