<?php
/**
 * Created by PhpStorm.
 * User: Ismaël
 * Date: 16/09/2017
 * Time: 17:24
 */

/**
 * Class for adding a new field to the options-general.php page
 */
class Add_Settings_Field {

	/**
	 * Class constructor
	 */
	public function __construct() {
		add_action( 'admin_init' , array( $this , 'register_fields' ) );
	}

	/**
	 * Add new fields to wp-admin/options-general.php page
	 */
	public function register_fields() {
		register_setting( 'general', 'google_api_key', 'esc_attr' );
		add_settings_field(
			'google_api_key',
			'<label for="google_api_key">' . __( "Clé d'API Google Maps" , 'google_api_key' ) . '</label>',
			array( $this, 'fields_html' ),
			'general'
		);
	}

	/**
	 * HTML for extra settings
	 */
	public function fields_html() {
		$value = get_option( 'google_api_key', '' );
		echo '<input type="text" id="google_api_key" name="google_api_key" value="' . esc_attr( $value ) . '" />';
	}

}
new Add_Settings_Field();