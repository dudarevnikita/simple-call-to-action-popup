<?php

namespace SimpleCallToActionPopup\Includes;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use SimpleCallToActionPopup\Includes\Admin\SimpleCall_AdminSettings;
use SimpleCallToActionPopup\Includes\Classes\Popup_Class;

class SimpleCall_Main {

	public function __construct() {
		add_action( 'plugins_loaded', array( $this, 'init_setting' ) );
		add_action( 'plugins_loaded', array( $this, 'load_plugin_textdomain' ) );
	}

	public function load_plugin_textdomain() {
		load_plugin_textdomain( 'simple-calltoaction-popup', false, basename( dirname( __FILE__ ) ) . '/languages/' );
	}

	public function init_setting() {
		if ( is_admin() ) {
			require_once SIMPLECALL_PATH . 'includes/admin/admin-settings.class.php';

			if ( class_exists( '\SimpleCallToActionPopup\Includes\Admin\SimpleCall_AdminSettings' ) ) {
				$GLOBALS['SimpleCall_AdminSettings'] = new SimpleCall_AdminSettings();
			}
		}

		if ( ! is_admin() ) {
			require_once SIMPLECALL_PATH . 'includes/classes/popup.class.php';

			if ( class_exists( '\SimpleCallToActionPopup\Includes\Classes\Popup_Class' ) ) {
				$GLOBALS['SimpleCall_PopupClass'] = new Popup_Class();
			}
		}
	}
}

if ( class_exists( '\SimpleCallToActionPopup\Includes\SimpleCall_Main' ) ) {
	$GLOBALS['SimpleCall_Main'] = new SimpleCall_Main();
}