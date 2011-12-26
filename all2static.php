<?php
/*
Plugin Name: all2static
Plugin URI: https://github.com/kubenstein/all2static
Description: Cache pages as static html depends on url
Version: 1.0
Author: kubenstein
Author URI: https://github.com/kubenstein
Tags: simple, cache, static, htaccess
*/
define('all2static_VERSION', '1.0');
define('all2static_PLUGIN_URL', plugin_dir_url( __FILE__ ));



// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	exit;
}


// admin
if ( is_admin() ) {
	require_once dirname( __FILE__ ) . '/admin.php';
}

