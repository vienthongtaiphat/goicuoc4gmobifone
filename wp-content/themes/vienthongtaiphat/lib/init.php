<?php
/**
 * N Framework
 *
 * @link       https://nhut.me/n-framework/
 * @since      0.0.1
 *
 * @package    N
 * @subpackage N/lib
 */

if (!defined('ABSPATH')):
	exit; // Exit if accessed directly.
endif;

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function _n_child_theme_supports(){
	/**
	 * Register nav menu
	 */
	register_nav_menus([
		'primary-menu' => 'Primary Menu',
	]);
}

add_action('after_setup_theme', '_n_child_theme_supports');

/**
 * Loads all the framework files and features.
 *
 * @since 0.0.1
 */
function _n_child_theme_setup(){
	$lib_dir = trailingslashit(get_stylesheet_directory()) . 'lib/';

	// Load Functions.
	$functions_dir = $lib_dir . 'functions/';
	require_once $functions_dir . 'cpt.php';
	require_once $functions_dir . 'api.php';
	require_once $functions_dir . 'acf.php';
	require_once $functions_dir . 'general.php';
	require_once $functions_dir . 'advanced-search.php';
	require_once $functions_dir . 'frontend-scripts.php';
	require_once $functions_dir . 'template-functions.php';
	require_once $functions_dir . 'template-hooks.php';

	// Load Classes.
	$classes_dir = $lib_dir . 'classes/';
	require_once $classes_dir . 'class-n-simple-xlsx.php';

	// Load Admin.
	$admin_dir = $lib_dir . 'admin/';
	if (is_admin()):
		require_once $admin_dir . 'admin-menus.php';
		require_once $admin_dir . 'admin-scripts.php';
		require_once $admin_dir . 'package-importer.php';
		require_once $admin_dir . 'import-history.php';
		require_once $admin_dir . 'cashback-importer.php';
	endif;
}

add_action('after_setup_theme', '_n_child_theme_setup');
