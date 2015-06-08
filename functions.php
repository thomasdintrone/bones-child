<?php
/*
Author: Thomas Dintrone ("The D" for short..)

This is where you can drop your custom functions.

* Note this theme uses the BONES framework as it's parent theme so 
you'll need to download it for fwee @ http://themble.com/bones/

Then take the following steps:
1. Include the theme into the themes directory
2. RENAME the folder to "bones"
3. Make sure the style.css for this child theme is set up correctly
   -- All you have to do is add this : "Template: bones" underneath the "Author" text at the top
   -- What this does is set the bones framework as the parent.
4. The Custom Fonts can are being loaded below (line44)
   -- Edit this as needed because I know some people would rather use the demo.css file.
   -- In which case you'd replace that with this:
   "wp_register_style( 'fonts-dotcom-stylesheet', get_stylesheet_directory_uri() . '/css/fonts/REPLACEWITHFONTFOLDERNAME/demo.css', array(), '', 'all' );"
5. Come over and give me a HIGH FIVE because I am that awesome for setting this up.

... WELL??? I'm waiting for my high five

*/

/**
 * Enqueues child theme stylesheet, loading first the parent theme stylesheet.
 */
function themify_custom_enqueue_child_theme_styles() {
	wp_enqueue_style( 'parent-theme-css', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'themify_custom_enqueue_child_theme_styles', 11 );

// UNDO BONES STUFF
// remove custom post type
// got this code from: http://themify.me/docs/deregistering-custom-post-types
function custom_unregister_theme_post_types() {
    global $wp_post_types;
    foreach( array( 'custom_type' ) as $post_type ) { 
        if ( isset( $wp_post_types[ $post_type ] ) ) {
            unset( $wp_post_types[ $post_type ] );
        }
    }
}
add_action( 'init', 'custom_unregister_theme_post_types', 20 );

// remove the 2 menus
// got this code from: http://wordpress.stackexchange.com/questions/49861/unregister-nav-menu-from-child-theme
function wpse_remove_parent_theme_locations()
{
    // @link http://codex.wordpress.org/Function_Reference/unregister_nav_menu
    unregister_nav_menu( 'main-nav' );
    unregister_nav_menu( 'footer-links' );
}
add_action( 'after_setup_theme', 'wpse_remove_parent_theme_locations', 20 );


//add_action('admin_head-post.php','remove_template');

// Removing page template from child theme.
// got this code from: 
// http://wordpress.stackexchange.com/questions/13671/how-to-remove-a-parent-theme-page-template-from-a-child-theme/13675#13675
// ** Answer #8
function tfc_remove_page_templates( $templates ) {
    unset( $templates['page-custom.php'] );
    return $templates;
}
add_filter( 'theme_page_templates', 'tfc_remove_page_templates' );

// Remove Sidebars
function remove_some_widgets(){

	// Unregister some of the TwentyTen sidebars
	unregister_sidebar( 'sidebar1' );
	//unregister_sidebar( 'second-footer-widget-area' );
}
add_action( 'widgets_init', 'remove_some_widgets', 11 );

/*******************************************
BEGIN CHILD THEME FUNCTIONS

* I've been kind of building these as I go
* with other sites I've worked on so some
* are relevant, others are not
* I'll leave it up to you to decide.
********************************************/
// MY CODE
		
// Dev Template Directory
// * I changed this location so I could more easily integrate my dev template 
// with the bones-child theme.
function dev_dir(){	
	$dev_dir = 'dev-template';
	return $dev_dir;
}

if (!is_admin()) { require_once(get_stylesheet_directory() . '/'.dev_dir().'/includes/initialize.php'); }

/* REGISTER SCRIPTS & STYLESHEETS -- !!THE ORDER IS IMPORTANT!! -- */
function custom_scripts_and_styles() {
	global $wp_styles;
	
	if (!is_admin()) {
		
		// Fonts
		//wp_register_style( 'fonts-dotcom-stylesheet', 'http://fast.fonts.net/cssapi/7e4ae751-f577-47a5-97f9-182d49763e10.css', array(), '', 'all' );
		//wp_register_style( 'fontawesome-stylesheet', get_stylesheet_directory_uri() . '/'.dev_dir().'/css/fonts/font-awesome-4.2.0/css/font-awesome.min.css', array(), '', 'all' );
	
		// Main Styles
		wp_register_style( 'main-stylesheet', get_stylesheet_directory_uri() . '/style.css', array(), '', 'all' );
		wp_register_style( 'responsive-stylesheet', get_stylesheet_directory_uri() . '/'.dev_dir().'/css/responsive.css', array(), '', 'all' );
		wp_register_style( 'browsers-stylesheet', get_stylesheet_directory_uri() . '/'.dev_dir().'/css/browsers.css', array(), '', 'all' );
		wp_register_style( 'devices-stylesheet', get_stylesheet_directory_uri() . '/'.dev_dir().'/css/devices.css', array(), '', 'all' );
		wp_register_style( 'developer1-stylesheet', get_stylesheet_directory_uri() . '/'.dev_dir().'/css/developer1.css', array(), '', 'all' );
		
		// IE Styles
		wp_register_style( 'ie9-only', get_stylesheet_directory_uri() . '/'.dev_dir().'/css/ie9.css', array(), '' );
		wp_register_style( 'ie8-and-below', get_stylesheet_directory_uri() . '/'.dev_dir().'/css/ie.css', array(), '' );
		wp_register_style( 'ie7-only', get_stylesheet_directory_uri() . '/'.dev_dir().'/css/ie7.css', array(), '' );
		
		// Add JS files in the footer
		wp_register_script( 'modernizr-js', get_stylesheet_directory_uri() . '/'.dev_dir().'/js/modernizr.js', array( 'jquery' ), '', true );
		wp_register_script( 'jquery-js', '//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js', array( 'jquery' ), '', true );
		wp_register_script( 'jquery-ui-js', '//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js', array( 'jquery' ), '', true );
		wp_register_script( 'validate-js', 'http://ajax.microsoft.com/ajax/jquery.validate/1.9/jquery.validate.min.js', array( 'jquery' ), '', true );
		wp_register_script( 'functions-js', get_stylesheet_directory_uri() . '/'.dev_dir().'/js/functions.js', array( 'jquery' ), '', true );
		wp_register_script( 'animations-js', get_stylesheet_directory_uri() . '/'.dev_dir().'/js/animations.js', array( 'jquery' ), '', true );
		
		/***********************************************************************************
		/* ADD CUSTOM PLUGINS STYLES & SCRIPTS 
		/* For References & Helpers look in the dev-template/plugins/{{plugin name folder}}
		***********************************************************************************/
		// ADAPTIVE BACKGROUNDS
		wp_register_script( 'adaptive-backgrounds-js', get_stylesheet_directory_uri() .'/plugins/adaptive-backgrounds/src/jquery.adaptive-backgrounds.js', array( 'jquery' ), '', true); 
		
		// BOOTSTRAP
		wp_register_style( 'bootstrap-stylesheet', get_stylesheet_directory_uri() . '/'.dev_dir().'/bootstrap/css/bootstrap.min.css', array(), '', 'all' );
		wp_register_script( 'bootstrap-js', get_stylesheet_directory_uri() . '/'.dev_dir().'/bootstrap/js/bootstrap.min.js', array( 'jquery' ), '', true );
			
		// CHARTS
		wp_register_script( 'chart-js', get_stylesheet_directory_uri() . '/'.dev_dir().'/plugins/chart/Chart.min.js'); 
		
		// DATA CHART 
		wp_register_style( 'data-chart-stylesheet', get_stylesheet_directory_uri() . '/'.dev_dir().'/plugins/data-chart/css/data-chart.css', array(), '', 'all'); 
		wp_register_script( 'data-chart-js', get_stylesheet_directory_uri() . '/'.dev_dir().'/plugins/data-chart/js/data-chart.js'); 
			
		// FINANCIAL TABLES
		wp_register_style( 'financial-tables-stylesheet', get_stylesheet_directory_uri() . '/'.dev_dir().'/plugins/financial-tables/css/financialTable.css', array(), '', 'all'); 
		wp_register_script( 'financial-tables-js', get_stylesheet_directory_uri() . '/'.dev_dir().'/plugins/financial-tables/js/jquery.financialTable.js'); 
			
		// FITTEXT
		wp_register_script( 'fittext-js', get_stylesheet_directory_uri() . '/'.dev_dir().'/plugins/fittext/jquery.fittext.js'); 
			
		// FLOWPLAYER
		wp_register_style( 'flowplayer-stylesheet', get_stylesheet_directory_uri() . '/'.dev_dir().'/plugins/flowplayer/skin/minimalist.css', array(), '', 'all'); 
		wp_register_script( 'flowplayer-js', get_stylesheet_directory_uri() . '/'.dev_dir().'/plugins/flowplayer/flowplayer.min.js'); 
			
		// FORCE NON-RESPONSIVE
		wp_register_style( 'antibootstrap-stylesheet', get_stylesheet_directory_uri() . '/'.dev_dir().'/css/force-non-responsive.css', array(), '', 'all'); 	
		
		// GOOGLE MAPS API
		wp_register_script( 'googlemap-js', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyARge1ZblVIGmpLPS5Ous6ym0aJwZl6MPI&sensor=true&libraries=places', array( 'jquery' ), '', true );
			
		// HOTKEYS
		wp_register_script( 'hotkeys-js', get_stylesheet_directory_uri() . '/'.dev_dir().'/plugins/hotkeys/jquery.hotkeys.js'); 
			
		// JSZIP
		wp_register_script( 'jszip-js', get_stylesheet_directory_uri() . '/'.dev_dir().'/plugins/jszip/jszip.js'); 
			
		// JQUERY ADDRESSS
		wp_register_script( 'jquery-address-js', get_stylesheet_directory_uri() . '/'.dev_dir().'/plugins/jquery-address/jquery.address-1.5.min.js'); 
			
		// LAZYLOAD
		wp_register_script( 'lazyload-js', get_stylesheet_directory_uri() . '/'.dev_dir().'/plugins/lazyload/jquery.lazyload.min.js'); 
			
		// Lightbox
		wp_register_style( 'lightbox-stylesheet', get_stylesheet_directory_uri() . '/'.dev_dir().'/plugins/lightbox/lightbox.css', array(), '', 'all'); 
		wp_register_script( 'lightbox-js', get_stylesheet_directory_uri() . '/'.dev_dir().'/plugins/lightbox/lightbox.js'); 
		
		// MASON
		wp_register_script( 'mason-js', get_stylesheet_directory_uri() . '/'.dev_dir().'/plugins/mason/mason.js', array( 'jquery' ), '', true );
			
		// MOUSEWHEEL
		wp_register_script( 'mousewheel-js', get_stylesheet_directory_uri() . '/'.dev_dir().'/plugins/mousewheel/jquery.mousewheel.min.js'); 			
			
		// PARALLAX
		wp_register_script( 'parallax-js', get_stylesheet_directory_uri() . '/'.dev_dir().'/plugins/parallax/parallax.min.js'); 
			
		// PRETTY PHOTO
		wp_register_style( 'prettyphoto-stylesheet', get_stylesheet_directory_uri() . '/'.dev_dir().'/plugins/prettyphoto/css/prettyPhoto.css', array(), '', 'all'); 
		wp_register_script( 'prettyphoto-js', get_stylesheet_directory_uri() . '/'.dev_dir().'/plugins/prettyphoto/js/jquery.prettyPhoto.js'); 
			
		// SCROLL TO FIXED
		wp_register_script( 'scroll-to-fixed-js', get_stylesheet_directory_uri() . '/'.dev_dir().'/plugins/scroll-to-fixed/jquery-scrolltofixed-min.js'); 
			
		// SCROLLBAR
		wp_register_style( 'scrollbar-stylesheet', get_stylesheet_directory_uri() . '/'.dev_dir().'/plugins/scrollbar/jquery.mCustomScrollbar.css', array(), '', 'all'); 
		wp_register_script( 'scrollbar-js', get_stylesheet_directory_uri() . '/'.dev_dir().'/plugins/scrollbar/jquery.mCustomScrollbar.concat.min.js'); 
			
		// SIMPLE WEATHER
		wp_register_script( 'simpleweather-js', get_stylesheet_directory_uri() . '/'.dev_dir().'/plugins/simpleweather/jquery.simpleWeather.min.js'); // The path to the JS 
			
		// SLIDER
		wp_register_style( 'slider-stylesheet', get_stylesheet_directory_uri() . '/'.dev_dir().'/plugins/slider/slider.css', array(), '', 'all'); 
		wp_register_script( 'slider-js', get_stylesheet_directory_uri() . '/'.dev_dir().'/plugins/slider/slider.js'); 
			
		// Stories
		wp_register_style( 'storybox-stylesheet', get_stylesheet_directory_uri() . '/'.dev_dir().'/plugins/storybox/storybox.css', array(), '', 'all'); 
		wp_register_style( 'storybox-stylesheet2', '//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css', array(), '', 'all'); // For share buttons
		wp_register_style( 'storybox-stylesheet3', get_stylesheet_directory_uri() . '/'.dev_dir().'/plugins/storybox/share.css', array(), '', 'all'); 
		wp_register_script( 'storybox-js', get_stylesheet_directory_uri() . '/'.dev_dir().'/plugins/storybox/share.js'); 
		wp_register_script( 'storybox2-js', get_stylesheet_directory_uri() . '/'.dev_dir().'/plugins/storybox/storybox.js'); 
			
		// TABLE HOVER
		wp_register_script( 'tablehover-js', get_stylesheet_directory_uri() . '/'.dev_dir().'/plugins/tablehover/jquery.tablehover.min.js'); 
			
		// TOUCHSWIPE
		wp_register_script( 'touchswipe-js', get_stylesheet_directory_uri() . '/'.dev_dir().'/plugins/touchswipe/jquery.touchSwipe.min.js'); 
			
		// WAYPOINTS
		wp_register_script( 'waypoints-js', get_stylesheet_directory_uri() . '/'.dev_dir().'/plugins/waypoints/lib/jquery.waypoints.min.js'); 
		wp_register_script( 'waypoints-js2', get_stylesheet_directory_uri() . '/'.dev_dir().'/plugins/waypoints/lib/shortcuts/infinite.min.js'); 
		wp_register_script( 'waypoints-js3', get_stylesheet_directory_uri() . '/'.dev_dir().'/plugins/waypoints/lib/shortcuts/inview.min.js'); 
		wp_register_script( 'waypoints-js4', get_stylesheet_directory_uri() . '/'.dev_dir().'/plugins/waypoints/lib/shortcuts/sticky.min.js'); 				
			
		// Youtube Google Analytics
		wp_register_script( 'youtube-google-analytics-js', get_stylesheet_directory_uri() . '/'.dev_dir().'/plugins/youtube-google-analytics/lunametrics-youtube-v7.gtm.js'); 
			
		/***************************************************************** 
		KEEP THIS LAST SO IT LOADS AFTER ALL CSS (NEEDS TO BE IN THE HEADER) 
		// SHARE THIS -- 
		$this->plugins_css[]		= '<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "ur-caa5e7b2-bec0-a6fc-5ca9-4067c210cd58", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
';*/
						
		/***************************************************************** 
		// Enqueue All the Styles and Scripts
		****************************************************************/
		// TEMPLATE SCRIPTS & STYLES
		wp_enqueue_script( 'modernizr-js' );
		wp_enqueue_script( 'jquery-js' );
		wp_enqueue_script( 'jquery-ui-js' );
		wp_enqueue_script( 'validate-js' );
		wp_enqueue_script( 'functions-js' );
		wp_enqueue_script( 'animations-js' );
		
		//wp_enqueue_style( 'fonts-dotcom-stylesheet' );
		//wp_enqueue_style( 'fontawesome-stylesheet' );
		wp_enqueue_style( 'main-stylesheet' );
		wp_enqueue_style( 'responsive-stylesheet' );
		wp_enqueue_style( 'browsers-stylesheet' );
		wp_enqueue_style( 'devices-stylesheet' );
		wp_enqueue_style( 'developer1-stylesheet' );
		wp_enqueue_style( 'ie9-only' );
		wp_enqueue_style( 'ie8-and-below' );
		wp_enqueue_style( 'ie7-only' );
		
		
		// PLUGIN SCRIPTS & STYLES
		//wp_enqueue_script( 'adaptive-backgrounds-js' );
		wp_enqueue_script( 'bootstrap-js' );
		//wp_enqueue_script( 'chart-js' );
		//wp_enqueue_script( 'data-chart-js' );
		//wp_enqueue_script( 'financial-tables-js' );
		//wp_enqueue_script( 'fittext-js' );
		//wp_enqueue_script( 'flowplayer-js' );
		//wp_enqueue_script( 'googlemap-js' );
		//wp_enqueue_script( 'hotkeys-js' );
		//wp_enqueue_script( 'jszip-js' );
		//wp_enqueue_script( 'jquery-address-js' );
		//wp_enqueue_script( 'lazyload-js' );
		//wp_enqueue_script( 'lightbox-js' );
		//wp_enqueue_script( 'mason-js' );
		//wp_enqueue_script( 'mousewheel-js' );
		//wp_enqueue_script( 'parallax-js' );
		//wp_enqueue_script( 'prettyphoto-js' );
		//wp_enqueue_script( 'scroll-to-fixed-js' );
		//wp_enqueue_script( 'scrollbar-js' );
		//wp_enqueue_script( 'simpleweather-js' );
		//wp_enqueue_script( 'slider-js' );
		//wp_enqueue_script( 'storybox-js' );
		//wp_enqueue_script( 'storybox2-js' );
		//wp_enqueue_script( 'tablehover-js' );
		//wp_enqueue_script( 'touchswipe-js' );
		//wp_enqueue_script( 'waypoints-js' );
		//wp_enqueue_script( 'waypoints-js2' );
		//wp_enqueue_script( 'waypoints-js3' );
		//wp_enqueue_script( 'waypoints-js4' );
		//wp_enqueue_script( 'youtube-google-analytics-js' );
		
		wp_enqueue_style( 'bootstrap-stylesheet' );
		//wp_enqueue_style( 'data-chart-stylesheet' );
		//wp_enqueue_style( 'financial-tables-stylesheet' );
		//wp_enqueue_style( 'flowplayer-stylesheet' );
		//wp_enqueue_style( 'lightbox-stylesheet' );
		//wp_enqueue_style( 'antibootstrap-stylesheet' );
		//wp_enqueue_style( 'prettyphoto-stylesheet' );
		//wp_enqueue_style( 'scrollbar-stylesheet' );
		//wp_enqueue_style( 'slider-stylesheet' );
		//wp_enqueue_style( 'storybox-stylesheet' );
		//wp_enqueue_style( 'storybox-stylesheet2' );
		//wp_enqueue_style( 'storybox-stylesheet3' );
	
		// Add IE Conditionals
		$wp_styles->add_data( 'ie9-only', 'conditional', 'IE 9' ); // add conditional wrapper around ie stylesheet
		$wp_styles->add_data( 'ie8-and-below', 'conditional', 'lt IE 9' ); // add conditional wrapper around ie stylesheet
		$wp_styles->add_data( 'ie7-only', 'conditional', 'IE 7' ); // add conditional wrapper around ie stylesheet
		
	}
}
add_action( 'wp_enqueue_scripts', 'custom_scripts_and_styles', 0 );


/* SITE OPTIONS FILES */
require_once(get_stylesheet_directory() . '/admin/admin-functions.php');
require_once(get_stylesheet_directory() . '/admin/admin-interface.php');
require_once(get_stylesheet_directory() . '/admin/theme-settings.php');

/* INCLUDE TGM ACTIVATION */
require_once(get_stylesheet_directory() . '/library/class-tgm-plugin-activation.php');

/* CUSTOM POST TYPES */
require_once(get_stylesheet_directory() . '/library/custom-post-type.php');

/* PLUGINS */
require_once(get_stylesheet_directory() . '/library/plugins.php');

/* MENUS */
require_once(get_stylesheet_directory() . '/library/menus.php');

/* SHORTCODES */
require_once(get_stylesheet_directory() . '/library/shortcodes.php');

/* POSTS BY FORMAT WIDGET */
require_once(get_stylesheet_directory() . '/library/wp-recent-posts-by-format.php');

/* SIDEBAR SET UP */
require_once(get_stylesheet_directory() . '/library/sidebar.php');

// add a link to the WP Toolbar
function custom_toolbar_link($wp_admin_bar) {
    $args = array(
	        'id' => 'wpbeginner',
	        'title' => 'Site Options',
	        'href' => site_url().'/wp-admin/themes.php?page=siteoptions',
	        'meta' => array(
	            'class' => 'wpbeginner',
	            'title' => 'Search WPBeginner Tutorials'
	            )
	    );
	    $wp_admin_bar->add_node($args);
}
add_action('admin_bar_menu', 'custom_toolbar_link', 999);

// Get The Content with formatting
function get_the_content_with_formatting ($more_link_text = '(more...)', $stripteaser = 0, $more_file = '') {
	$content = get_the_content($more_link_text, $stripteaser, $more_file);
	$content = apply_filters('the_content', $content);
	$content = str_replace(']]>', ']]&gt;', $content);
	return $content;
}

//Add "parent" class to pages with subpages, change submenu class name, add depth class
/*class Prio_Walker extends Walker_Nav_Menu {
    function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ){
        $GLOBALS['dd_children'] = ( isset($children_elements[$element->ID]) )? 1:0;
        $GLOBALS['dd_depth'] = (int) $depth;
        parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }

     function start_lvl(&$output, $depth) {
    $indent = str_repeat("\t", $depth);
    $output .= "\n$indent<div class=\"dropDown\"><ul class=\"dropDown list-inline sub-menu level-".$depth."\"><div class=\"text-left container\">\n";
  }
}*/

function data_filter($var) {
	$data_filter = str_replace(' ', '', $var);
	$data_filter = str_replace('&', '', $data_filter);
	$data_filter = str_replace('amp;', '', $data_filter);
	$data_filter = str_replace(',', '', $data_filter);
	$data_filter = str_replace('-', '', $data_filter);
	$data_filter = str_replace('/', '', $data_filter);
	$data_filter = strtolower($data_filter);
	
	return $data_filter;
}

// Add parent class to maps
class WPQuestions_Walker extends Walker_Category {

    function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {

        extract($args);

        $cat_name = esc_attr( $category->name );
        $cat_name = apply_filters( 'list_cats', $cat_name, $category );
		
		$data_filter = str_replace(' ', '', $cat_name);
		$data_filter = str_replace('&', '', $data_filter);
		$data_filter = str_replace('amp;', '', $data_filter);
		$data_filter = str_replace(',', '', $data_filter);
		$data_filter = str_replace('-', '', $data_filter);
		$data_filter = str_replace('/', '', $data_filter);
		$data_filter = strtolower($data_filter);
		
		$cat_type = get_field('parent_item_type', 'map_items_categories_'.$category->term_id);
				
	$termchildren = get_term_children( $category->term_id, $category->taxonomy );

        if(count($termchildren)>0) { // parent
			$aclass =  ' class="topFilter '.$cat_type.'" data-filterby="cat" data-filtervalue="'.$data_filter.'"'; 
		} else { // child
			$aclass =  ' data-filterby="type" data-filtervalue="'.$data_filter.'" id="poly'.$data_filter.'"';
		}

        $link = '<a '.$aclass.' href="' . esc_url( get_term_link($category) ) . '" ';

        if ( $use_desc_for_title == 0 || empty($category->description) )

            $link .= 'title="' . esc_attr( sprintf(__( 'View all posts filed under %s' ), $cat_name) ) . '"';

        else

            $link .= 'title="' . esc_attr( strip_tags( apply_filters( 'category_description', $category->description, $category ) ) ) . '"';

            $link .= '>';
            $link .= $cat_name . '</a>';

        if ( !empty($show_count) )

            $link .= ' (' . intval($category->count) . ')';

                if ( 'list' == $args['style'] ) {

                        $output .= "\t<li";
                        $class = 'cat-item cat-item-' . $category->term_id;

                        if ( !empty($current_category) ) {

                                $_current_category = get_term( $current_category, $category->taxonomy );

                                if ( $category->term_id == $current_category )

                                        $class .=  ' current-cat';

                                elseif ( $category->term_id == $_current_category->parent )

                                        $class .=  ' current-cat-parent';

                        }

                        $output .=  ' class="' . $class . '"';
                        $output .= ">$link\n";

                } else {

                       $output .= "\t$link<br />\n";

                }
        }
    }

// determine the topmost parent of a term
function get_term_top_most_parent($term_id, $taxonomy){
    // start from the current term
    $parent  = get_term_by( 'id', $term_id, $taxonomy);
    // climb up the hierarchy until we reach a term with parent = '0'
    while ($parent->parent != '0'){
        $term_id = $parent->parent;

        $parent  = get_term_by( 'id', $term_id, $taxonomy);
    }
    return $parent;
}	
	

add_filter('nav_menu_css_class','add_parent_css',10,2);
function  add_parent_css($classes, $item){
     global  $dd_depth, $dd_children;
     $classes[] = 'depth'.$dd_depth;
     if($dd_children)
         $classes[] = 'parent';
    return $classes;
}

//Add class to parent pages to show they have subpages (only for automatic wp_nav_menu)
function add_parent_class( $css_class, $page, $depth, $args )
{
   if ( ! empty( $args['has_children'] ) )
       $css_class[] = 'parent';
   return $css_class;
}
add_filter( 'page_css_class', 'add_parent_class', 10, 4 );


/* Show shortcodes in widgets */
add_filter('widget_text', 'do_shortcode');

/* Limit Excerpt length by characters */
function get_the_selected_excerpt($length=40){
	$excerpt = get_the_content();
	$excerpt = preg_replace(" (\[.*?\])",'',$excerpt);
	$excerpt = strip_shortcodes($excerpt);
	$excerpt = strip_tags($excerpt);
	$excerpt = substr($excerpt, 0, $length);
	$excerpt = substr($excerpt, 0, strripos($excerpt, " "));
	$excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));
	//$excerpt = $excerpt.'... <a href="'.$permalink.'">more</a>';
	return $excerpt;
}

/* EXCLUDE STUFF FROM SEARCH RESULTS */
// search filter
function fb_search_filter($query) {
	if ( !$query->is_admin && $query->is_search) {
		$query->set('post_type', array('post', 'page') ); // id of page or post .. ONLY THESE WILL SHOW
		//$query->set('post_type', array('products') ); // id of page or post .. ONLY THESE WILL SHOW
	}
	return $query;
}
add_filter( 'pre_get_posts', 'fb_search_filter' );

// Prevents p tags from breaking shortcodes
// wrap content in a [raw] shortcode
// ex: [raw]Hey my name is tom and I'm the greatest dude that ever lived[/raw]
function my_formatter($content) {
	$new_content = '';
	$pattern_full = '{(\[raw\].*?\[/raw\])}is';
	$pattern_contents = '{\[raw\](.*?)\[/raw\]}is';
	$pieces = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);

	foreach ($pieces as $piece) {
		if (preg_match($pattern_contents, $piece, $matches)) {
			$new_content .= $matches[1];
		} else {
			$new_content .= wptexturize(wpautop($piece));
		}
	}

	return $new_content;
}
	
remove_filter('the_content', 'wpautop');
remove_filter('the_content', 'wptexturize');

add_filter('the_content', 'my_formatter', 99);

// Add a custom item to a specific menu
//add_filter('wp_nav_menu_items','add_search_box_to_menu', 10, 2);
function add_search_box_to_menu( $items, $args ) {
	$home_class = '';
	if(is_page(122)) { $home_class = ' current-menu-item'; }
    if( $args->theme_location == 'main_nav' )
        return '<li class="homeLink'.$home_class.'"><a href="'.site_url().'">Home</a></li>'.$items.'<li class="last search"><a href="#"><img src="'.get_template_directory_uri().'/img/magnifying-glass.png"></a>'.get_search_form($echo = false).'</li>';
    return $items;
}

// Add a custom item to a specific menu
//add_filter('wp_nav_menu_items','add_link_to_menu', 10, 2);
function add_link_to_menu( $items, $args ) {
	$home_class = '';
	if(is_page(122)) { $home_class = ' current-menu-item'; }
    if( $args->theme_location == 'footer_nav' )
        return '<li class="homeLink'.$home_class.'"><a id="footerHome" href="'.site_url().'">Home</a></li><ul class="list-inline">'.$items.'</ul>';
    return $items;
}

// GET CUSTOM MENU
function clean_custom_menus($menu) {
	$menu_name = $menu; // specify custom menu slug
	if (($locations = get_nav_menu_locations()) && isset($locations[$menu_name])) {
		$menu = wp_get_nav_menu_object($locations[$menu_name]);
		$menu_items = wp_get_nav_menu_items($menu->term_id);

		$menu_list = '<nav>' ."\n";
		$menu_list .= "\t\t\t\t". '<ul>' ."\n";
		foreach ((array) $menu_items as $key => $menu_item) {
			$title = $menu_item->title;
			$url = $menu_item->url;
			$menu_list .= "\t\t\t\t\t". '<li><a href="'. $url .'">'. $title .'</a></li>' ."\n";
		}
		$menu_list .= "\t\t\t\t". '</ul>' ."\n";
		$menu_list .= "\t\t\t". '</nav>' ."\n";
	} else {
		// $menu_list = '<!-- no list defined -->';
	}
	return $menu_list;
}


// SITE OPTIONS TAB SET UP
function return_option($option) {
	$shortname = 'custom';
	return get_option($shortname.$option);
}

// BREADCRUMB FUNCTION
function get_breadcrumbs() {
    global $post;
	$breadcrumbs = '';
    $breadcrumbs .=  '<div class="breadcrumbs">';
    if (!is_home()) {
        $breadcrumbs .=   '<a href="'.get_option('home').'">Home</a> <span>/</span> ';
        
		if (is_category() || is_single()) {
            //get_the_category(' <span>//</span> ');
            if (is_single()) {
                if ( is_singular( 'project' ) ) { 
					
					$project_parent_id = 251; // Development Opportunities ID
					
					$anc = get_post_ancestors( $project_parent_id ); 
					$title = get_the_title();
					foreach ( $anc as $ancestor ) {
						$output = '<a href="'.get_permalink($ancestor).'" title="'.get_the_title($ancestor).'">'.get_the_title($ancestor).'</a> <span>/</span> ';
					}
					$breadcrumbs .= $output;
					$breadcrumbs .= '<a href="'.get_permalink($project_parent_id).'" title="'.get_the_title($project_parent_id).'">'.get_the_title($project_parent_id).'</a> <span>/</span>';
					$breadcrumbs .= '<a class="current" href="'.get_permalink().'">'.$title.'</a>';
					
				} else {
					$category = get_the_category(); 
					$breadcrumbs .= '<a href="'.get_category_link($category[0]->term_id).'" title="'.get_the_title($project_parent_id).'">'.$category[0]->cat_name.'</a> <span>/</span>';
                	$breadcrumbs .= '<a class="current" href="'.get_permalink().'">'.get_the_title().'</a>';
				}
            }
        } elseif (is_page()) {
            if($post->post_parent){
                $anc = get_post_ancestors( $post->ID );
                $title = get_the_title();
                foreach ( $anc as $ancestor ) {
                    $output = '<a href="'.get_permalink($ancestor).'" title="'.get_the_title($ancestor).'">'.get_the_title($ancestor).'</a> <span>/</span> ';
                }
                $breadcrumbs .=   $output;
                $breadcrumbs .=   '<a class="current" href="'.get_permalink().'">'.$title.'</a>';
            } else {
                $breadcrumbs .=   '<a class="current" href="'.get_permalink().'">'.get_the_title().'</a>';
            }
        }
    }
    elseif (is_tag()) {single_tag_title();}
    elseif (is_day()) {$breadcrumbs .=  "<li>Archive for "; the_time('F jS, Y'); $breadcrumbs .=  '</li>';}
    elseif (is_month()) {$breadcrumbs .=  "<li>Archive for "; the_time('F, Y'); $breadcrumbs .=  '</li>';}
    elseif (is_year()) {$breadcrumbs .=  "<li>Archive for "; the_time('Y'); $breadcrumbs .=  '</li>';}
    elseif (is_author()) {$breadcrumbs .=  "<li>Author Archive"; $breadcrumbs .=  '</li>';}
    elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {$breadcrumbs .=   "<li>Blog Archives"; $breadcrumbs .=  '</li>';}
    elseif (is_search()) {$breadcrumbs .=  "<li>Search Results"; $breadcrumbs .=  '</li>';}
    $breadcrumbs .=   '</div>';
	
	return $breadcrumbs;
}

// REMOVE TAG SUPPORT FOR POSTS 
/*add_action( 'init', 'wpse48017_remove_tags' );
function wpse48017_remove_tags(){
    global $wp_taxonomies;
    unset($wp_taxonomies['post_tag']);
    global $pagenow;
    if( $pagenow == 'index.php' ){
        add_action( 'admin_head', 'ob_start', 0, 0 );
        add_action( 'right_now_content_table_end', 'wpse48017_remove_tags_dashboard' );
    }
}
function wpse48017_remove_tags_dashboard(){
    #echo '<pre>'.htmlentities( ob_get_clean(), 0, null, true );die();
    echo preg_replace('#(Categories</a></td></tr>)<tr>([\s\S]*?number_format\(\) expects parameter 1 to be double, object given[\s\S]*?)?<td class="first b b-tags.*?</tr>#','$1',ob_get_clean());
}*/

// ALLOW HTML IN WIDGET TITLES
remove_filter( 'widget_title', 'esc_html' );

// FEATURED POST ON ADMIN 
/*function my_page_columns($columns)
{
	$columns = array(
		'cb'	 	=> '<input type="checkbox" />',
		//'thumbnail'	=>	'Thumbnail',
		'title' 	=> 'Title',
		'featured' 	=> 'Featured',
		'author'	=>	'Author',
		'date'		=>	'Date',
	);
	return $columns;
}

function my_custom_columns($column)
{
	global $post;
	if($column == 'thumbnail')
	{
		echo wp_get_attachment_image( get_field('page_image', $post->ID), array(200,200) );
	}
	elseif($column == 'featured')
	{
		if(get_field('featured'))
		{
			echo 'Yes';
		}
		else
		{
			echo 'No';
		}
	}
}

add_action("manage_pages_custom_column", "my_custom_columns");
add_filter("manage_edit-page_columns", "my_page_columns");

function my_column_register_sortable( $columns )
{
	$columns['featured'] = 'featured';
	return $columns;
}

add_filter("manage_edit-page_sortable_columns", "my_column_register_sortable" );
*/

// Numbered Pagination
function new_bones_page_navi($before = '', $after = '', $echo = true, $custom_query = "") {
    global $wpdb, $wp_query;
	
	$text = '';
	
    //Check for custom query variable, if set, assign to navi_query, if not, assign main wp_query to navi_query
    if (isset($custom_query) && $custom_query != '') {
        $navi_query = $custom_query;
    } else {
        $navi_query = $wp_query;
    }

    //change $posts_per_page variable to be set with the new navi_query
    $posts_per_page = intval($navi_query->query_vars['posts_per_page']);
    $paged = intval(get_query_var('paged'));
    $numposts = $navi_query->found_posts; //update with navi_query
    $max_page = $navi_query->max_num_pages; //update with navi_query
    if ( $numposts <= $posts_per_page ) { return; }
    if(empty($paged) || $paged == 0) {
        $paged = 1;
    }
    $pages_to_show = 7;
    $pages_to_show_minus_1 = $pages_to_show-1;
    $half_page_start = floor($pages_to_show_minus_1/2);
    $half_page_end = ceil($pages_to_show_minus_1/2);
    $start_page = $paged - $half_page_start;
    if($start_page <= 0) {
        $start_page = 1;
    }
    $end_page = $paged + $half_page_end;
    if(($end_page - $start_page) != $pages_to_show_minus_1) {
        $end_page = $start_page + $pages_to_show_minus_1;
    }
    if($end_page > $max_page) {
        $start_page = $max_page - $pages_to_show_minus_1;
        $end_page = $max_page;
    }
    if($start_page <= 0) {
        $start_page = 1;
    }

    $text .= $before.'<nav class="page-navigation"><ol class="bones_page_navi list-inline clearfix">'."";
    if ($start_page >= 2 && $pages_to_show < $max_page) {
        $first_page_text = __( "First", 'bonestheme' );
        $text .= '<li class="bpn-first-page-link"><a href="'.get_pagenum_link().'" title="'.$first_page_text.'">'.$first_page_text.'</a></li>';
    }
    $text .= '<li class="bpn-prev-link">';
    $text .= get_previous_posts_link('<img src="'.get_template_directory_uri().'/img/icon-pagination-left.png">', $custom_query->max_num_pages);
    $text .= '</li>';
    for($i = $start_page; $i  <= $end_page; $i++) {
        if($i == $paged) {
            $text .= '<li class="bpn-current">'.$i.'</li>';
        } else {
            $text .= '<li><a href="'.get_pagenum_link($i).'">'.$i.'</a></li>';
        }
    }
    $text .= '<li class="bpn-next-link">';
    $text .= get_next_posts_link('<img src="'.get_template_directory_uri().'/img/icon-pagination-right.png">', $custom_query->max_num_pages);
    $text .= '</li>';
    if ($end_page < $max_page) {
        $last_page_text = __( "Last", 'bonestheme' );
        $text .= '<li class="bpn-last-page-link"><a href="'.get_pagenum_link($max_page).'" title="'.$last_page_text.'">'.$last_page_text.'</a></li>';
    }
    $text .= '</ol></nav>'.$after."";
	
	if($echo == true) {
		echo $text;
	} else {
		return $text;
	}
	
} /* end page navi */

function theme_url () {
	return get_template_directory_uri();
}

// Create New Image Sizes
add_action( 'after_setup_theme', 'baw_theme_setup' );
function baw_theme_setup() {
  add_image_size( 'header-size', 650, 206, true );
  add_image_size( 'slider', 650, 300, true );
}

// GET FEATURED IMAGE URL
function get_featured_image($size='full') {
	$thumb_id = get_post_thumbnail_id();
	//$thumb_url_array = wp_get_attachment_image_src($thumb_id, $size, true);
	$thumb_url_array = wp_get_attachment_image_src($thumb_id, $size);
	$thumb_url = $thumb_url_array[0];
	
	if (strpos($thumb_url,'default.png') !== false || $thumb_url == '') {
		// If there is NO featured image set, use a custom one:
    	//$thumb_url = {{ FEATUREDIMAGE PATH GOES HERE }}
	} 
	
	return $thumb_url;
}

// GET PAGE/POST SLUG
// reference: http://www.wprecipes.com/wordpress-function-to-get-postpage-slug
function get_the_slug() {
    $post_data = get_post($post->ID, ARRAY_A);
    $slug = $post_data['post_name'];
    return $slug; 
}
function the_slug() {
	echo get_the_slug();
}

// Implement Google Analytics click tracking
function get_ga_click_tracking($type,$title,$action='Downloaded') {
		
	return ' onClick="ga(\'send\', \'event\', \''.$type.'\', \''.$action.'\', \''.$title.'\');" ';
	
}

// FOR FILE ZIPPING VIA AJAX - BETA
// havenb't figured this out yet.
/*function zip_init() {
	wp_enqueue_script( 'function', get_template_directory_uri().'/plugins/zipfile/ajax.js', 'jquery', true);
	wp_localize_script( 'function', 'ajax_zipfile', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
}
add_action('template_redirect', 'zip_init');

$dirName = dirname(__FILE__);
$baseName = basename(realpath($dirName));
require_once ("$dirName/plugins/zipfile/ajax.php");

add_action("wp_ajax_nopriv_create_zip", "create_zip");
add_action("wp_ajax_create_zip", "create_zip");*/

/***********************************************
ADD YOUR CUSTOM FUNCTIONS HERE
***********************************************/



/* DON'T DELETE THIS CLOSING TAG .. I'd tell you why but then I'd have to kill you */ 
?>