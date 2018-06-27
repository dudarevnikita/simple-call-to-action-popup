<?php

namespace SimpleCallToActionPopup\Includes\Classes;

use SimpleCallToActionPopup\Includes\Classes\SimpleCall_Config as Form;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Popup_Class {
	public function __construct() {
		add_shortcode( 'simple_popup', array( $this, 'init_shortcode' ) );

		add_action( 'wp_enqueue_scripts', array( $this, 'include_scripts_styles' ) );
	}

	public function init_shortcode( $atts ) {
		$atts = shortcode_atts( array(
			'id'    => 'null',
			'class' => ''
		), $atts );

		if ( $atts['id'] == 'null' ) {
			return '';
		}

		return $this->popup_content( $atts );
	}

	public function popup_content( $atts ) {

		$atts['title']   = get_post_meta( $atts['id'], 'title', true );
		$atts['content'] = get_post_meta( $atts['id'], 'content', true );
		$atts['event']   = get_post_meta( $atts['id'], 'event', true );

		if ( $atts['event'] == 'once' ) {
			$atts['show_seconds'] = get_post_meta( $atts['id'], 'show_seconds', true );
			wp_localize_script( 'simple-popup-script', 'show_seconds', $atts['show_seconds'] * 1000 );
		}

		if ( $atts['event'] == 'click' ) {
			$atts['button_id'] = get_post_meta( $atts['id'], 'button_id', true );
			wp_localize_script( 'simple-popup-script', 'button_id', $atts['button_id'] );
		}

		$title_color   = get_post_meta( $atts['id'], 'title_color', true );
		$content_color = get_post_meta( $atts['id'], 'content_color', true );

		$atts['title_color']   = ( $title_color !== '' ) ? 'style="color: ' . $title_color . '"' : '';
		$atts['content_color'] = ( $title_color !== '' ) ? 'style="color: ' . $content_color . '"' : '';

		wp_localize_script( 'simple-popup-script', 'popup_id', 'simple-popup-' . $atts['id'] );

		$atts = apply_filters( 'simple_popup_popup_arguments', $atts );

		ob_start();

		Form::includeForm( 'popup', $atts );

		return ob_get_clean();
	}

	public function include_scripts_styles() {
		wp_enqueue_style( 'simple-popup-style', SIMPLECALL_URL . 'assets/styles/popup_styles.css', array(), '0.1' );

		wp_enqueue_script( 'simple-popup-script', SIMPLECALL_URL . 'assets/scripts/popup_script.js', array( 'jquery' ), '0.1', true );
	}
}

