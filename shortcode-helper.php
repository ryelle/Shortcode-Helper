<?php
/*
 * Plugin Name: Shortcode Helper
 * Description: Easily add shortcodes 
 * Version: 0.1
 * Author: Kelly Dwan
 * Author URI: http://redradar.net
 * Plugin URI: http://me.redradar.net/404
 * License: GPL2
 * Date: 6.02.2012
 */

/**
 * Add javascript and css to header files.
 */
function rrn_shortcode_helper_add_plugin( $arr ){
	$arr['rrn_shortcode'] = plugins_url( 'shortcode-helper.js', __FILE__);
	return $arr;
} add_filter( 'mce_external_plugins', 'rrn_shortcode_helper_add_plugin' );

function rrn_shortcode_helper_add_button( $in ){
	$in[] = 'rrn_shortcode'; 
	return $in;
} add_filter( 'mce_buttons_2', 'rrn_shortcode_helper_add_button' );

function rrn_shortcode_helper_popup() { ?>
	<style>
	.rrn-shortcode-helper input[type="text"] {
		width: 100%;
		margin: 5px 1px 1px;
		border: 1px solid #DFDFDF;
		background: white;
		color: #333;
		-webkit-border-radius: 4px;
		-moz-border-radius: 4px;
		border-radius: 4px;
		font-size: 12px;
		padding: 3px;
		-webkit-box-sizing: border-box;
		-moz-box-sizing: border-box;
		box-sizing: border-box;
	}
	.rrn-shortcode-helper .submitbox {
		padding: 5px 10px;
		font-size: 11px;
		overflow: auto;
		height: 29px;
	}
	#rrn-shortcode-helper-cancel {
		line-height: 25px;
		float: left;
	}
	#rrn-shortcode-helper-update {
		line-height: 23px;
		float: right;
	}
	.rrn-shortcode-helper .howto {
		clear: both;
		
	}
	</style>
	<div style="display:none;" id="rrn-shortcode-helper" >
	<form class='rrn-shortcode-helper' tabindex="-1">
		<?php wp_nonce_field( 'create_shortcode', '_ajax_rrn_shortcode_nonce', false ); ?>
		<div id="shortcode-create">
			<p class="howto"><?php _e( 'Enter your shortcode & options, without the brackets.' ); ?></p>
			<div>
				<input id="shortcode-field" type="text" tabindex="10" name="shortcode" />
			</div>
		</div>
		<div class="submitbox">
			<div id="rrn-shortcode-helper-update">
				<input type="submit" tabindex="100" value="<?php esc_attr_e( 'Add Item' ); ?>" class="button-primary" id="rrn-shortcode-helper-submit" name="wys-menu-submit">
			</div>
		</div>
		<p class="howto"><?php printf( __( 'For example, to insert a gallery, type %s or %s. It will auto-detect if it needs a closing tag, and will wrap the currently highlighted text.' ), '<code>gallery</code>', '<code>gallery columns="4"</code>'); ?></p>
	</form>
	</div>
<?php }	add_action( 'admin_footer', 'rrn_shortcode_helper_popup' );