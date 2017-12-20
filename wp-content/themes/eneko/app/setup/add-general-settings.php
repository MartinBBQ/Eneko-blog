<?php
/**
 * Created by PhpStorm.
 * User: Ismaël
 * Date: 16/09/2017
 * Time: 17:24
 */

/**
 * Class to add a new field to the options-general.php page
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
		$this->registerAPIKey();
		$this->registerPermanentDuty();
		$this->registerTemporaryDuty();
		$this->registerDutyAddress();
		$this->registerCheckbox();
	}

	public function registerCheckbox(  ) {
		register_setting( 'general', 'contactEnabled', 'esc_attr' );
        add_settings_field('contactEnabled', '<label for="contactEnabled">'.__("Utiliser l'adresse de contact pour les permanences" , 'contactEnabled' ).'</label>' , array($this, 'checkbox_html') , 'general' );
	}

	public function checkbox_html(  ) {
		$value = get_option( 'contactEnabled');
		echo '<input type="checkbox" name="contactEnabled" value="1" '. checked(1, $value, false) .'/> ';
	}
	public function registerDutyAddress(  ) {
		register_setting( 'general', 'dutyAddress', 'esc_attr' );
		add_settings_field(
			'dutyAddress',
			'<label for="dutyAddress">' . __( "Adresse de contact des permanences" , 'dutyAddress' ) . '</label>',
			array( $this, 'dutyAddress' ),
			'general'
		);
	}

	public function dutyAddress() {
		$value = get_option( 'dutyAddress', '' );
		echo '<input type="email" id="dutyAddress" name="dutyAddress" value="' . esc_attr( $value ) . '" />';
	}
	public function registerTemporaryDuty() {
		register_setting( 'general', 'ephemere', 'esc_attr' );
		add_settings_field(
			'ephemere',
			'<label for="ephemere">' . __( "Permanence éphémère" , 'ephemere' ) . '</label>',
			array( $this, 'sidebar_temp' ),
			'general'
		);
	}
	public function registerPermanentDuty() {
		register_setting( 'general', 'permanence', 'esc_attr' );
		add_settings_field(
			'permanence',
			'<label for="permanence">' . __( "Permanences permanentes" , 'permanence' ) . '</label>',
			array( $this, 'sidebar_permanent' ),
			'general'
		);
	}
	public function registerAPIKey() {
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


	/**
	 * HTML for extra settings
	 */
	public function sidebar_permanent() {
		$value = get_option( 'permanence', '' );
		echo '<input type="text" id="permanence" name="permanence" value="' . esc_attr( $value ) . '" />';
	}

	/**
	 * HTML for extra settings
	 */
	public function sidebar_temp() {
		$value = get_option( 'ephemere', '' );
		echo '<input type="text" id="ephemere" name="ephemere" value="' . esc_attr( $value ) . '" />';
	}

}
new Add_Settings_Field();