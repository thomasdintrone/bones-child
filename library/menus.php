<?php 
register_nav_menus( array(
	'main_nav' 			=> 'Main Navigation',
	'footer_nav'			=> 'Footer Navigation',
	// copy and paste above and rename to add a new nav menu
) );

function siblings_widgets_init() {

// ADD PAGE SIDEBARS
register_sidebar( array(
'name' => 'Default',
'id' => 'sidebar-defaultsb',
'before_widget' => '<div id="%1$s" class="widget %2$s">',
'after_widget' => '</div>',
'before_title' => '<h4 class="title-module ">',
'after_title' => '</h4>',
) );

// copy and paste the whole register_sidebar function and rename accordingly
// to add another sidebar

}

add_action( 'widgets_init', 'siblings_widgets_init' );
?>