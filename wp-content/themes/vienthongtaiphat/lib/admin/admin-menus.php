<?php
/**
 * N Framework
 *
 * WARNING: This file is part of the core N Framework. DO NOT edit this file under any circumstances.
 * Please do all modifications in the form of a child theme.
 *
 * @since      0.0.1
 * @package    N
 * @subpackage N/lib/admin
 */

if (!defined('ABSPATH')):
	exit; // Exit if accessed directly.
endif;

/**
 * Add admin menus
 *
 * @since 0.0.1
 */
function _n_admin_menus(){
	add_submenu_page('edit.php?post_type=package', 'Nhập gói cước', 'Nhập gói cước', 'manage_options', 'package-importer', '_n_package_importer');
	add_submenu_page('edit.php?post_type=package', 'Lịch sử nhập', 'Lịch sử nhập', 'manage_options', 'import-history', '_n_import_history');
	add_submenu_page('edit.php?post_type=package_order', 'Báo cáo', 'Báo cáo', 'manage_options', 'package-order-report', '_n_package_order_report');
	add_submenu_page('edit.php?post_type=cashback', 'Nhập', 'Nhập', 'manage_options', 'cashback-importer', '_n_cashback_importer');
}

add_action('admin_menu', '_n_admin_menus');

/**
 * Nhập gói cước
 *
 * @since 0.0.1
 */
function _n_package_importer(){
	require_once N_CHILD_DIR . '/lib/admin/views/package-importer.php';
}

/**
 * Sim import history
 *
 * @since 0.0.1
 */
function _n_import_history(){
	require_once N_CHILD_DIR . '/lib/admin/views/import-history.php';
}

/**
 * Package order report
 *
 * @since 0.0.1
 */
function _n_package_order_report(){
	require_once N_CHILD_DIR . '/lib/admin/views/package-order-report.php';
}

/**
 * Cashback importer
 *
 * @since 0.0.1
 */
function _n_cashback_importer(){
	require_once N_CHILD_DIR . '/lib/admin/views/cashback-importer.php';
}
