<?php

namespace SimpleCallToActionPopup\Includes\Classes;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class SimpleCall_Config {

	public static function includeForm( $template_name, $args = array() ) {
		if ( ! file_exists( SIMPLECALL_PATH . 'templates/' . $template_name . '.tp.php' ) ) {
			$debug_back_trace = debug_backtrace();
			self::writeLog( 'File ' . $template_name . '.tp.php not exists', $debug_back_trace[0]['file'], $debug_back_trace[0]['line'] );

			return 0;
		}

		$located = apply_filters( 'simplecall_located_template', SIMPLECALL_PATH . 'templates/' . $template_name . '.tp.php' );

		if ( ! empty( $args ) && is_array( $args ) ) {
			extract( $args );
		}

		do_action( 'simplecall_before_template_part' );

		include_once $located;

		do_action( 'simplecall_after_template_part' );
	}

	public static function writeLog( $log, $file, $line ) {
		if ( is_array( $log ) || is_object( $log ) ) {
			error_log( print_r( $log, true ) );
		} else {
			error_log( $log . ' - ' . $file . ':' . $line );
		}
	}
}
