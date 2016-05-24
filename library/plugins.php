<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.4.0
 * @author     Thomas Griffin <thomasgriffinmedia.com>
 * @author     Gary Jones <gamajo.com>
 * @copyright  Copyright (c) 2014, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/thomasgriffin/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 */

add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function my_theme_register_required_plugins() {

    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(

        /* This is an example of how to include a plugin pre-packaged with a theme.
        array(
            'name'               => 'TGM Example Plugin', // The plugin name.
            'slug'               => 'tgm-example-plugin', // The plugin slug (typically the folder name).
            'source'             => get_stylesheet_directory() . '/lib/plugins/tgm-example-plugin.zip', // The plugin source.
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
            'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url'       => '', // If set, overrides default API URL and points to an external URL.
        ),*/

        /* This is an example of how to include a plugin from a private repo in your theme.
        array(
            'name'               => 'TGM New Media Plugin', // The plugin name.
            'slug'               => 'tgm-new-media-plugin', // The plugin slug (typically the folder name).
            'source'             => 'https://s3.amazonaws.com/tgm/tgm-new-media-plugin.zip', // The plugin source.
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
            'external_url'       => 'https://github.com/thomasgriffin/New-Media-Image-Uploader', // If set, overrides default API URL and points to an external URL.
        ),*/

        // This is an example of how to include a plugin from the WordPress Plugin Repository.
        array(
            'name'      => 'Contact Form 7',
            'slug'      => 'contact-form-7',
            'required'  => true,
        ),
        array(
            'name'      => 'Contact Form DB',
            'slug'      => 'contact-form-7-to-database-extension',
            'required'  => true,
        ),
        array(
            'name'      => 'Advanced Custom Fields',
            'slug'      => 'advanced-custom-fields',
            'required'  => true,
        ),
        array(
            'name'      => 'Duplicate Post (For cloning custom fieldgroups!)',
            'slug'      => 'duplicate-post',
            'required'  => true,
        ),
		array(
            'name'      => 'Adminimize',
            'slug'      => 'adminimize',
            //'required'  => true,
        ),
		array(
            'name'      => 'WP Optimize',
            'slug'      => 'wp-optimize',
            //'required'  => true,
        ),
		array(
            'name'      => 'Gzip Compression',
            'slug'      => 'gzip-ninja-speed-compression',
            //'required'  => true,
        ),
		array(
            'name'      => 'Enhanced Media Library',
            'slug'      => 'enhanced-media-library',
            //'required'  => true,
        ),
		array(
            'name'      => 'Media Search Enhanced',
            'slug'      => 'media-search-enhanced',
            //'required'  => true,
        ),
		array(
            'name'      => 'Page Excerpt',
            'slug'      => 'page-excerpt',
            'required'  => true,
        ),
		array(
            'name'      => 'Widget CSS Classes',
            'slug'      => 'widget-css-classes',
            'required'  => true,
        ),
		array(
            'name'      => 'Reveal IDs',
            'slug'      => 'reveal-ids-for-wp-admin-25',
            'required'  => true,
        ),
		array(
            'name'      => 'Post types Order',
            'slug'      => 'post-types-order',
            'required'  => true,
        ),
		array(
            'name'      => 'Oomph Clone Widgets',
            'slug'      => 'oomph-clone-widgets',
            //'required'  => true,
        ),
		array(
            'name'      => 'Codepress Admin Columns',
            'slug'      => 'codepress-admin-columns',
            //'required'  => true,
        ),
		array(
            'name'      => 'Wordpress SEO by Yoast',
            'slug'      => 'wordpress-seo',
            //'required'  => true,
        ),
		array(
            'name'      => 'WPFront User Role Editor',
            'slug'      => 'wpfront-user-role-editor',
            //'required'  => true,
        ),
		array(
            'name'      => 'BackUpWordPress',
            'slug'      => 'backupwordpress',
            'required'  => true,
        ),
		array(
            'name'      => 'Block Specific Plugin Updates',
            'slug'      => 'block-specific-plugin-updates',
            //'required'  => true,
        ),
		array(
            'name'      => 'Rename WP Login',
            'slug'      => 'rename-wp-login',
            //'required'  => true,
        ),
		array(
            'name'      => 'ACF Repeater Collapser',
            'slug'      => 'advanced-custom-field-repeater-collapser',
            //'required'  => true,
        ),
		array(
            'name'      => 'ACF Nav Menu Field',
            'slug'      => 'advanced-custom-fields-nav-menu-field',
            //'required'  => true,
        ),
		array(
            'name'      => 'ACF Widget Area Field',
            'slug'      => 'advanced-custom-fields-widget-area-field',
            //'required'  => true,
        ),
		array(
            'name'      => 'Really Simple Captcha (for Contact Form 7)',
            'slug'      => 'really-simple-captcha',
            'required'  => true,
        ),
		array(
            'name'      => 'Category Order and Taxonomy Terms Order',
            'slug'      => 'taxonomy-terms-order',
            'required'  => true,
        ),
		array(
            'name'      => 'Ajax Load More',
            'slug'      => 'ajax-load-more',
            //'required'  => true,
        ),
		array(
            'name'      => 'Locatoraid - Store Locator Plugin',
            'slug'      => 'locatoraid',
            //'required'  => true,
        ),
		array(
            'name'      => 'Wordpress Importer',
            'slug'      => 'wordpress-importer',
            'required'  => true,
        ),
		array(
            'name'      => 'Media File Manager',
            'slug'      => 'media-file-manager',
            //'required'  => true,
        ),
		array(
            'name'      => 'iThemes Security',
            'slug'      => 'better-wp-security',
            'required'  => true,
        ),
		array(
            'name'      => 'Eggplant 301 Redirects',
            'slug'      => 'eps-301-redirects',
            'required'  => true,
        ),

    );

    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
        'strings'      => array(
            'page_title'                      => __( 'Install Required Plugins', 'tgmpa' ),
            'menu_title'                      => __( 'Install Plugins', 'tgmpa' ),
            'installing'                      => __( 'Installing Plugin: %s', 'tgmpa' ), // %s = plugin name.
            'oops'                            => __( 'Something went wrong with the plugin API.', 'tgmpa' ),
            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'tgmpa' ), // %1$s = plugin name(s).
            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'tgmpa' ), // %1$s = plugin name(s).
            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'tgmpa' ), // %1$s = plugin name(s).
            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'tgmpa' ), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'tgmpa' ), // %1$s = plugin name(s).
            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'tgmpa' ), // %1$s = plugin name(s).
            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'tgmpa' ), // %1$s = plugin name(s).
            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'tgmpa' ), // %1$s = plugin name(s).
            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'tgmpa' ),
            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'tgmpa' ),
            'return'                          => __( 'Return to Required Plugins Installer', 'tgmpa' ),
            'plugin_activated'                => __( 'Plugin activated successfully.', 'tgmpa' ),
            'complete'                        => __( 'All plugins installed and activated successfully. %s', 'tgmpa' ), // %s = dashboard link.
            'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );

    tgmpa( $plugins, $config );

}
?>