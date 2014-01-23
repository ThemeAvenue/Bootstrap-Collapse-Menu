<?php
/*
Plugin Name: Bootstrap Collapse Menu Widget
Plugin URI: https://github.com/ThemeAvenue/Bootstrap-Collapse-Menu
Description: Add a WordPress custom menu in any widget area to display it using the Bootstrap Collapse style.
Version: 1.0.0
Author: ThemeAvenue
Author URI: http://themeavenue.net
Author Email: hello@themeavenue.net
Text Domain: bcmw
Domain Path: /lang/
Network: false
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Copyright 2013 ThemeAvenue (web@themeavenue.net)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

class Bootstrap_Collapse_Menu extends WP_Widget {

	/*--------------------------------------------------*/
	/* Constructor
	/*--------------------------------------------------*/

	/**
	 * Specifies the classname and description, instantiates the widget,
	 * loads localization files, and includes necessary stylesheets and JavaScript.
	 */
	public function __construct() {

		// load plugin text domain
		add_action( 'init', array( $this, 'widget_textdomain' ) );

		parent::__construct(
			'bootstrap-collapse-menu',
			__( 'Bootstrap Collapse Menu Widget', 'bcmw' ),
			array(
				'classname'		=>	'Bootstrap_Collapse_Menu',
				'description'	=>	__( 'Add a WordPress custom menu in any widget area to display it using the Bootstrap Collapse style.', 'bcmw' )
			)
		);

		require_once( plugin_dir_path( __FILE__ ) . '/bootstrap-collapse-nav-walker.php' );

	} // end constructor

	/*--------------------------------------------------*/
	/* Widget API Functions
	/*--------------------------------------------------*/

	/**
	 * Outputs the content of the widget.
	 *
	 * @param	array	args		The array of form elements
	 * @param	array	instance	The current instance of the widget
	 */
	public function widget( $args, $instance ) {

		extract( $args, EXTR_SKIP );

		echo $before_widget;

		echo $before_title . strip_tags( $instance['title'] ) . $after_title;

		// TODO:	Here is where you manipulate your widget's values based on their input fields

		include( plugin_dir_path( __FILE__ ) . 'views/widget.php' );

		echo $after_widget;

	} // end widget

	/**
	 * Processes the widget's options to be saved.
	 *
	 * @param	array	new_instance	The new instance of values to be generated via the update.
	 * @param	array	old_instance	The previous instance of values before the update.
	 */
	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['menu']  = strip_tags( $new_instance['menu'] );

		return $instance;

	} // end widget

	/**
	 * Generates the administration form for the widget.
	 *
	 * @param	array	instance	The array of keys and values for the widget.
	 */
	public function form( $instance ) {

    	// TODO:	Define default values for your variables
		$instance = wp_parse_args(
			(array) $instance,
			array( 'menu' => '', 'title' => '' )
		);

		// Display the admin form
		include( plugin_dir_path(__FILE__) . 'views/admin.php' );

	} // end form

	/*--------------------------------------------------*/
	/* Public Functions
	/*--------------------------------------------------*/

	/**
	 * Loads the Widget's text domain for localization and translation.
	 */
	public function widget_textdomain() {

		// TODO be sure to change 'widget-name' to the name of *your* plugin
		load_plugin_textdomain( 'bcmw', false, plugin_dir_path( __FILE__ ) . 'lang/' );

	} // end widget_textdomain

} // end class

add_action( 'widgets_init', create_function( '', 'register_widget("Bootstrap_Collapse_Menu");' ) );