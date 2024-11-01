<?php
/**
 * @package Silverstream 
 */
/*
Plugin Name: Silverstream Link
Plugin URI: http://www.silverstream.io/
Description: Adds a link to a Silverstream reservation pop-up.
Version: 0.0.1
Author: Makosoft Ltd
Author URI: http://www.github.com/makosoft
License: None
Text Domain: silverstream
*/

if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

function silverstream_link_func( $atts ){
	$output = '';

	$link_atts = shortcode_atts( array(
		'restaurant_id' => 'Restaurant Id'
	), $atts );

	$style = "display: block; height: 81px !important; width: 200px !important; margin: 10px; background-position: center; background-repeat: no-repeat; cursor: pointer;";
	$js = "javascript:window.open('https://my.silverstream.io/" . $link_atts['restaurant_id'] . "/index.php/reserve','_blank','toolbar=no, location=no, status=no,  menubar=no, scrollbars=yes, titlebar=no, resizable=yes, width=400, height=600')";

	$output .= "<!-- SILVERSTREAM -->\n";
	$output .= "<a style=\"$style\"onclick=\"$js\">\nReserve</a>";
	return $output;
}

add_shortcode( 'silverstream-link', 'silverstream_link_func' );

/*
if (is_admin()) {
	add_action( 'admin_init', 'silverstream_register_settings' );
	add_action( 'admin_menu', 'silverstream_menu' );
}

function silverstream_register_settings() {
	register_setting('silverstream-group', 'silverstream_restaurant_id');
}

function silverstream_menu() {
	add_options_page( 'Silverstream Options', 'Silverstream', 'manage_options', 'my-unique-identifier', 'silverstream_options' );
}

function silverstream_options() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
?>
	<div class="wrap">
		<h2>Silverstream Options</h2>
		<form method="post" action="options.php">
<?php
	settings_fields('silverstream-group');
	do_settings_sections('silverstream-group');
?>
		<table class="form-table">
			<tr valign="top">
				<th scope="row">Restaurant Id</th>
				<td>
					<input type="text" name="silverstream_restaurant_id" value="<?php echo esc_attr(get_option('silverstream_restaurant_id')); ?>" />
				</td>
			</tr>
		</table>
<?php	submit_button(); ?>
		</form>
	</div>
<?php
}
*/

// add new buttons
add_filter( 'mce_buttons', 'silverstream_register_buttons' );

function silverstream_register_buttons( $buttons ) {
   array_push( $buttons, 'separator', 'silverstream' );
   return $buttons;
}
 
// Load the TinyMCE plugin : editor_plugin.js (wp2.5)
add_filter( 'mce_external_plugins', 'silverstream_register_tinymce_javascript' );

function silverstream_register_tinymce_javascript( $plugin_array ) {
   $plugin_array['silverstream'] = plugins_url( '/js/tinymce-plugin.js',__FILE__ );
   return $plugin_array;
}

