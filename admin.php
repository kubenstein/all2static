<?php
function all2static_plugin_action_links( $links, $file ) {
		if ( $file == plugin_basename( dirname(__FILE__).'/all2static.php' ) ) {
		$links[] = '<a href="plugins.php?page=all2static-config">'.__('Settings').'</a>';
	}
	return $links;
}
add_filter( 'plugin_action_links', 'all2static_plugin_action_links', 10, 2 );










function all2static_config_page() {
	if ( function_exists('add_submenu_page') )
		add_submenu_page('', __('all2static Configuration'), __('all2static Configuration'), 'manage_options', 'all2static-config', 'all2static_conf');
}

add_action( 'admin_menu', 'all2static_config_page' );










// init
function all2static_admin_init() {
    global $wp_version;
    
    // all admin functions are disabled in old versions
    if ( !function_exists('is_multisite') && version_compare( $wp_version, '2.7', '<' ) ) {
        
        function all2static_version_warning() {
            echo "
            <div id='all2static-warning' class='updated fade'><p><strong>".sprintf(__('all2static %s wymaga WordPressa 2.7 lub nowszego'), all2static_VERSION) ."</strong> </p></div>
            ";
        }
        add_action('admin_notices', 'all2static_version_warning'); 
        
        return; 
    }
}
add_action('admin_init', 'all2static_admin_init');










function all2static_update_page( $post_id ) {
	all2static_cleanCache();
}
add_action( 'save_post', 'all2static_update_page' );









function all2static_nonce_field($action = -1) {
	return wp_nonce_field($action);
}
$all2static_nonce = 'all2static-update-key';










function all2static_cleanCache() {
	array_map( "unlink", glob( '../wp-content/plugins/all2static/cached/*' ) );
}










function all2static_conf() {
	global $all2static_nonce;

	if ( isset($_POST['submit']) ) {
		if ( function_exists('current_user_can') && !current_user_can('manage_options') )
			exit();
	all2static_cleanCache();
	}

$dirname = str_replace('wp-admin', '', dirname($_SERVER['SCRIPT_NAME']) );
?>
<?php if ( !empty($_POST['submit'] ) ) : ?>
<div id="message" class="updated fade"><p><strong><?php _e('Options saved.') ?></strong></p></div>
<?php endif; ?>
<div class="wrap">
<h2>all2static - Info</h2>
<div class="narrow">


<p>All2static plugin will cache all sites depends on their urls. Caching takes place caching takes place before start of WordPress machine. All2static stores cached sites under:
<i>wp-content/plugins/all2static/cached/*</i> </p>
<p>Default expriation time is set to 5min.</p>
<p>Number of pages currently cached: <?= count(glob( '../wp-content/plugins/all2static/cached/*' )) ?></p>
<form action="" method="post" id="all2static-conf" style="margin: auto; width: 400px; ">
<p class="submit"><input type="submit" name="submit" value="<?php _e('Delete cache now'); ?>" /></p>
<?php all2static_nonce_field($all2static_nonce) ?>
</form>

<h3>How to install</h3>
<p>You have to add this line to <strong>.htaccess</strong> file. Remember that rules order matters!</p>
<pre style='font-family: "Courier New"; background-color: #eee; padding:5px 5px;width:605px'>
...
<strong style='color: #0c0'>RewriteRule ^index\.php$ wp-content/plugins/all2static/indexWrapper.php [L]</strong>
RewriteRule ^index\.php$ - [L]
...
</pre>

<p>If you dont have any .htaccess file, here is example how it should look: </p>
<pre style='font-family: "Courier New"; background-color: #eee; padding:5px 5px;width:605px'>
# BEGIN WordPress
&lt;IfModule mod_rewrite.c&gt;
RewriteEngine On
RewriteBase <?= $dirname ?>

RewriteRule ^index\.php$ wp-content/plugins/all2static/indexWrapper.php [L]
RewriteRule ^index\.php$ - [L]
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule . <?= $dirname ?>index.php [L]
&lt;/IfModule&gt;

# END WordPress</pre>

<h3>How to uninstall</h3>
<p>Since it has been decided not to change .htaccess file automaticly, disabling plugin will not disable its functionality. To disable plugin comment this linie in .htaccess file: </p>
<pre style='font-family: "Courier New"; background-color: #eee; padding:5px 5px;width:605px'>
...
<strong style='color: #800'>#RewriteRule ^index\.php$ wp-content/plugins/all2static/indexWrapper.php [L]</strong>
RewriteRule ^index\.php$ - [L]
...
</pre>
</div>
</div>
<?php
}
