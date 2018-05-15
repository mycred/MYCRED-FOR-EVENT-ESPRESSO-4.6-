<?php
if ( ! defined( 'EE_MYCRED_PAYMENT_METHOD_VERSION' ) ) exit;

/**
 * ------------------------------------------------------------------------
 *
 * Class  EE_myCRED_Payment_Method
 *
 * @package			Event Espresso
 * @subpackage		espresso-new-payment-method
 * @author			Gabriel S Merovingi
 * @ version		2.0
 *
 * ------------------------------------------------------------------------
 */
define( 'EE_MYCRED_PAYMENT_METHOD_BASENAME', plugin_basename( EE_MYCRED_PAYMENT_METHOD_PLUGIN_FILE ) );
define( 'EE_MYCRED_PAYMENT_METHOD_PATH',     plugin_dir_path( __FILE__ ) );
define( 'EE_MYCRED_PAYMENT_METHOD_URL',      plugin_dir_url( __FILE__ ) );

class EE_MyCRED_Payment_Method extends EE_Addon {

	/**
	 * class constructor
	 */
	public function __construct() { }

	public static function register_addon() {
		// register addon via Plugin API
		EE_Register_Addon::register(
			'MyCRED_Payment_Method',
			array(
				'version'              => EE_MYCRED_PAYMENT_METHOD_VERSION,
				'min_core_version'     => '4.6.0',
				'main_file_path'       => EE_MYCRED_PAYMENT_METHOD_PLUGIN_FILE,
				'payment_method_paths' => array( EE_MYCRED_PAYMENT_METHOD_PATH . 'myCRED_Onsite' )
			)
		);
	}

	/**
	 * 	additional_admin_hooks
	 *
	 *  @access 	public
	 *  @return 	void
	 */
	public function additional_admin_hooks() {
		// is admin and not in M-Mode ?
		if ( is_admin() && ! EE_Maintenance_Mode::instance()->level() ) {
			add_filter( 'plugin_action_links', array( $this, 'plugin_actions' ), 10, 2 );
		}
	}



	/**
	 * plugin_actions
	 *
	 * Add a settings link to the Plugins page, so people can go straight from the plugin page to the settings page.
	 * @param $links
	 * @param $file
	 * @return array
	 */
	public function plugin_actions( $links, $file ) {
		if ( $file == EE_MYCRED_PAYMENT_METHOD_BASENAME ) {
			// before other links
			array_unshift( $links, '<a href="admin.php?page=espresso_payments">' . __( 'Settings', 'mycred_ee' ) . '</a>' );
		}
		return $links;
	}

}

?>