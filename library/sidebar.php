<?php 
// DEFINE SIDEBAR SIZES - BETA
// Haven't worked the kinks out with this yet but will someday... #singleTear
//
// I used to put this right on every page which got to be
// annoying after a while because I'd get lost in what page had what
// sidebar. I've condensed it into this one file.

// This gets the ID of the page outside loop (get_the_ID() wasn't working)
// Reference: https://wordpress.org/support/topic/get-pagepost-id-in-functionsphp-file
/*
$url = explode('?', 'http://'.$_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
$ID = url_to_postid($url[0]);

// Get sidebar value
$sidebar = get_field('sidebar', $ID);

// Set up the quadrants
if($sidebar == 'Yes') {
	$content_size = 'col-sm-8 withSidebar';
	$sidebar_size = 'col-sm-4';
} else {
	$content_size = 'col-sm-12';
	$sidebar_size = 'hide';
}

define('content_size', $content_size);
define('sidebar_size', $sidebar_size);
*/
?>