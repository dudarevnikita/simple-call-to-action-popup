<?php

namespace SimpleCallToActionPopup\Includes\Admin;

use SimpleCallToActionPopup\Includes\Classes\SimpleCall_Config as Config;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class SimpleCall_AdminSettings {

	protected $label;
	protected $label_settings;

	public function __construct() {
		$this->set_label();

		add_action( 'admin_menu', array( $this, 'add_menu_submenu_page' ) );

		add_filter( 'plugin_action_links_' . SIMPLECALL_PLUGIN_BASENAME, array( $this, 'add_settings_links' ) );

		add_action( 'init', array( $this, 'simple_popup_taxonomy' ) );
		add_action( 'add_meta_boxes', array( $this, 'remove_meta_boxes' ), 10 );
		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ), 11 );

		add_action( 'save_post', array( $this, 'save_metaboxes' ) );

		// add_filter( 'manage_edit-' . $this->label . '_columns', array( $this, 'add_columns' ) );

		//Admin js scripts and css styles
		add_action( 'admin_enqueue_scripts', array( $this, 'add_admin_scripts' ) );
	}

	protected function set_label() {
		$this->label          = 'simple_action_popup';
		$this->label_settings = 'simple-calltoaction-popup';
	}

	public function simple_popup_taxonomy() {
		$labels = array(
			'name'               => _x( 'Popups', 'post type general name', 'simple-calltoaction-popup' ),
			'singular_name'      => _x( 'Popup', 'post type singular name', 'simple-calltoaction-popup' ),
			'menu_name'          => _x( 'Popups', 'admin menu', 'simple-calltoaction-popup' ),
			'name_admin_bar'     => _x( 'Popup', 'add new on admin bar', 'simple-calltoaction-popup' ),
			'add_new'            => _x( 'Add New', 'popup', 'simple-calltoaction-popup' ),
			'add_new_item'       => __( 'Add New Popup', 'simple-calltoaction-popup' ),
			'new_item'           => __( 'New Popup', 'simple-calltoaction-popup' ),
			'edit_item'          => __( 'Edit Popup', 'simple-calltoaction-popup' ),
			'view_item'          => __( 'View Popup', 'simple-calltoaction-popup' ),
			'all_items'          => __( 'All Popups', 'simple-calltoaction-popup' ),
			'search_items'       => __( 'Search Popups', 'simple-calltoaction-popup' ),
			'parent_item_colon'  => __( 'Parent Popups:', 'simple-calltoaction-popup' ),
			'not_found'          => __( 'No popups found.', 'simple-calltoaction-popup' ),
			'not_found_in_trash' => __( 'No popups found in Trash.', 'simple-calltoaction-popup' )
		);

		$args = array(
			'labels'             => $labels,
			'public'             => false,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => false,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => $this->label ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array()
		);

		register_post_type( $this->label, $args );
	}

	public function add_menu_submenu_page() {
		add_menu_page( __( 'Simple Call-To-Action Popup', 'simple-calltoaction-popup' ), __( 'Simple Call-To-Action Popup', 'simple-calltoaction-popup' ), 'manage_options', 'simple-calltoaction-popup', '', 'dashicons-groups', 63 );

		add_submenu_page( 'simple-calltoaction-popup', __( 'General', 'simple-calltoaction-popup' ), __( 'General', 'simple-calltoaction-popup' ), 'manage_options', 'simple-calltoaction-popup', array(
			$this,
			'general_page'
		) );

		add_submenu_page( 'simple-calltoaction-popup', __( 'All Popup', 'simple-calltoaction-popup' ), __( 'All Popup', 'simple-calltoaction-popup' ), 'manage_options', 'edit.php?post_type=simple_action_popup', null );

		add_submenu_page( 'simple-calltoaction-popup', __( 'Add New Popup', 'simple-calltoaction-popup' ), __( 'Add New', 'simple-calltoaction-popup' ), 'manage_options', 'post-new.php?post_type=simple_action_popup', null );
	}

	public function remove_meta_boxes() {
		remove_meta_box( 'submitdiv', $this->label, 'side' );
		remove_post_type_support( $this->label, 'editor' );
	}

	public function add_meta_boxes() {
		add_meta_box( 'submitdiv_boxes', __( 'Publish', 'simple-calltoaction-popup' ), array(
			$this,
			'submit_meta_boxes'
		), $this->label, 'side', 'core' );

		add_meta_box( 'main_boxes', __( 'Main Settings for Popup', 'simple-calltoaction-popup' ), array(
			$this,
			'main_meta_boxes'
		), $this->label, 'normal', 'core' );

		add_meta_box( 'view_shortcode', __( 'Copy this shortcode', 'simple-calltoaction-popup' ), array(
			$this,
			'shortcode_view'
		), $this->label, 'side', 'core' );
	}


	public function save_metaboxes( $post_id ) {
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		if ( isset( $_POST['title'] ) ) {
			update_post_meta( $post_id, 'title', sanitize_text_field( $_POST['title'] ) );
		}

		if ( isset( $_POST['content'] ) ) {
			update_post_meta( $post_id, 'content', sanitize_text_field( $_POST['content'] ) );
		}

		if ( isset( $_POST['event'] ) ) {
			update_post_meta( $post_id, 'event', sanitize_text_field( $_POST['event'] ) );
		}

		if ( isset( $_POST['show_seconds'] ) && $_POST['show_seconds'] >= 0 ) {
			update_post_meta( $post_id, 'show_seconds', sanitize_text_field( $_POST['show_seconds'] ) );
		}

		if ( isset( $_POST['button_id'] ) ) {
			update_post_meta( $post_id, 'button_id', sanitize_text_field( $_POST['button_id'] ) );
		}
	}

	public function add_columns( $columns ) {
		$columns = array(
			'cb'      => '<input type="checkbox" />',
			'title'   => 'title',
			'preview' => 'Превью',
			'name'    => __( 'Name', 'simple-calltoaction-popup' ),
			'slug'    => __( 'Slug', 'simple-calltoaction-popup' ),
			'date'    => __( 'Posts', 'simple-calltoaction-popup' )
		);

		return $columns;
	}

	public function submit_meta_boxes( $post ) {
		Config::includeForm( 'admin-save-meta-boxes', array( 'post' => $post ) );
	}

	public function main_meta_boxes( $post ) {
		$radio_show_value = get_post_meta( $post->ID, 'event', true );
		$value_array      = [
			'post'          => $post,
			'title'         => get_post_meta( $post->ID, 'title', true ),
			'content'       => get_post_meta( $post->ID, 'content', true ),
			'radio_buttons' => [
				'once'  => [
					'text'    => __( 'Show at once', 'simple-calltoaction-popup' ),
					'inputs'  => [
						[
							'text'  => __( 'Show after (s):', 'simple-calltoaction-popup' ),
							'input' => '<input type="number" min="0" step="1" name="show_seconds"
                                                            class="radio-seconds" value="' . get_post_meta( $post->ID, 'show_seconds', true ) . '">',
						]
					],
					'style'   => ( ( $radio_show_value !== 'once' ) ? 'style="display: none"' : '' ),
					'checked' => ( ( $radio_show_value == 'once' ) ? 'checked' : '' )
				],
				'click' => [
					'text'    => __( 'Show by click', 'simple-calltoaction-popup' ),
					'inputs'  => [
						[
							'text'  => __( 'Button id:', 'simple-calltoaction-popup' ),
							'input' => '<input type="text" name="button_id" class="radio-id" value="' . get_post_meta( $post->ID, 'button_id', true ) . '">',
						]
					],
					'style'   => ( ( $radio_show_value !== 'click' ) ? 'style="display: none"' : '' ),
					'checked' => ( ( $radio_show_value == 'click' ) ? 'checked' : '' )
				]
			]
		];

		$value_array = apply_filters( 'simple_popup_main_block_arguments', $value_array, $radio_show_value );
		Config::includeForm( 'admin-main-meta-boxes', $value_array );
	}

	public function general_page() {
		Config::includeForm( 'admin-settings' );
	}

	public function settings_popup() {
		Config::includeForm( 'admin-settings' );
	}

	public function shortcode_view( $post ) {
		Config::includeForm( 'admin-shortcode', array( 'post' => $post ) );
	}

	public function add_settings_links( $links ) {
		$setting_link = array(
			'<a href="' . admin_url( 'admin.php?page=simple-calltoaction-popup' ) . '">Settings</a>',
		);

		return array_merge( $setting_link, $setting_link );
	}

	public function add_admin_scripts() {
		if ( get_post_type() == $this->label || $_GET['page'] == $this->label_settings ) {

			wp_enqueue_script( $this->label, SIMPLECALL_URL . 'assets/scripts/simple_action_post.js', array( 'jquery' ), '0.1', true );

			wp_enqueue_style( $this->label, SIMPLECALL_URL . 'assets/styles/simple_action_post.css' );

		}
	}
}