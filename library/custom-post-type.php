<?php
/* 
CUSTOM POST TYPES ... You're WELCOME

** Copy and paste the whole "custom_post_XXX" funbction to add another custom post type
*** NOTE: make sure to rename EVERYTHING acorrdingly, including the add_action function
*/

function custom_post_custompost() { 
	// creating (registering) the custom type 
	register_post_type( 'custom_type',
	        array(
	            'labels' => array(
	                'name' => __( 'Custom' ),
	                'singular_name' => __( 'Custom' ),
	                'add_new' => __( 'Add New Custom' ),
	                'add_new_item' => __( 'Add New Custom' ),
	                'edit_item' => __( 'Edit Custom' ),
	                'new_item' => __( 'Add New Custom' ),
	                'view_item' => __( 'View Custom' ),
	                'search_items' => __( 'Search Custom' ),
	                'not_found' => __( 'No Custom found' ),
	                'not_found_in_trash' => __( 'No Custom found in trash' )
	            ),
				//'taxonomies' => array('category'),
	            'public' => true,
	            'supports' => array( 'title', 'editor', 'thumbnail' ),
	            'capability_type' => 'post',
	            'rewrite' => array("slug" => "custom"), // Permalinks format
	            'menu_position' => 5,
				'menu_icon' => 'dashicons-nametag', /* the icon for the custom post type menu */
	            //'register_meta_box_cb' => 'add_team_members_metaboxes'
				//'yarpp_support' => true
	        )
	    ); /* end of register post type */
	
	/* this adds your post categories to your custom post type */
	//register_taxonomy_for_object_type( 'category', 'stories' );
	/* this adds your post tags to your custom post type */
	//register_taxonomy_for_object_type( 'post_tag', 'custom_post_faq' );
	
}

// UNCOMMENT THE add_action CALL TO ADD THIS POST TYPE
// adding the function to the Wordpress init
//add_action( 'init', 'custom_post_custompost');
	
	/*
	for more information on taxonomies, go here:
	http://codex.wordpress.org/Function_Reference/register_taxonomy
	*/
	
	// now let's add custom categories (these act like categories)
	 register_taxonomy( 'custom_cat', 
		array('custom_type'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
		array('hierarchical' => true,     /* if this is true, it acts like categories */
			'labels' => array(
				'name' => __( 'Custom Categories', 'bonestheme' ), /* name of the custom taxonomy */
				'singular_name' => __( 'Custom Category', 'bonestheme' ), /* single taxonomy name */
				'search_items' =>  __( 'Search Custom Categories', 'bonestheme' ), /* search title for taxomony */
				'all_items' => __( 'All Custom Categories', 'bonestheme' ), /* all title for taxonomies */
				'parent_item' => __( 'Parent Custom Category', 'bonestheme' ), /* parent title for taxonomy */
				'parent_item_colon' => __( 'Parent Custom Category:', 'bonestheme' ), /* parent taxonomy title */
				'edit_item' => __( 'Edit Custom Category', 'bonestheme' ), /* edit custom taxonomy title */
				'update_item' => __( 'Update Custom Category', 'bonestheme' ), /* update title for taxonomy */
				'add_new_item' => __( 'Add New Custom Category', 'bonestheme' ), /* add new title for taxonomy */
				'new_item_name' => __( 'New Custom Category Name', 'bonestheme' ) /* name title for taxonomy */
			),
			'show_admin_column' => true, 
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'custom-slug' ),
		)
	);
	
	// now let's add custom tags (these act like categories)
	register_taxonomy( 'custom_tag', 
		array('custom_type'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
		array('hierarchical' => false,    /* if this is false, it acts like tags */
			'labels' => array(
				'name' => __( 'Custom Tags', 'bonestheme' ), /* name of the custom taxonomy */
				'singular_name' => __( 'Custom Tag', 'bonestheme' ), /* single taxonomy name */
				'search_items' =>  __( 'Search Custom Tags', 'bonestheme' ), /* search title for taxomony */
				'all_items' => __( 'All Custom Tags', 'bonestheme' ), /* all title for taxonomies */
				'parent_item' => __( 'Parent Custom Tag', 'bonestheme' ), /* parent title for taxonomy */
				'parent_item_colon' => __( 'Parent Custom Tag:', 'bonestheme' ), /* parent taxonomy title */
				'edit_item' => __( 'Edit Custom Tag', 'bonestheme' ), /* edit custom taxonomy title */
				'update_item' => __( 'Update Custom Tag', 'bonestheme' ), /* update title for taxonomy */
				'add_new_item' => __( 'Add New Custom Tag', 'bonestheme' ), /* add new title for taxonomy */
				'new_item_name' => __( 'New Custom Tag Name', 'bonestheme' ) /* name title for taxonomy */
			),
			'show_admin_column' => true,
			'show_ui' => true,
			'query_var' => true,
		)
	);
	
// Custom Taxonomy: http://bit.ly/1dupN6L
function themes_taxonomy() {  
    register_taxonomy(  
        'custom_categories',  //The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces). 
        'custom_type',        //post type name
        array(  
            'hierarchical' => true,  
            'label' => 'Custom Categories',  //Display name
            'query_var' => true,
            'rewrite' => array(
                'slug' => 'custom-categories', // This controls the base slug that will display before each term
                'with_front' => false // Don't display the category base before 
            )
        )  
    );  
} 
// UNCOMMENT TO REGISTER 
//add_action( 'init', 'themes_taxonomy');
	
/*
looking for custom meta boxes?
check out this fantastic tool:
https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
*/
?>
