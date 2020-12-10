<?php
/**
 * Lightning 3 Column Unit Configuration
 *
 * @package Lightning Customize Unit
 */

if ( function_exists( 'lightning_get_post_type' ) ) {
	if ( ! class_exists( 'Lightning_Three_Column_Unit_Admin' ) ) {
		require plugin_dir_path( __FILE__ ) . 'package/class-lightning-three-column-unit-admin.php';
	}

	if ( ! class_exists( 'Lightning_Three_Column_Unit_Condition' ) ) {
		require plugin_dir_path( __FILE__ ) . 'package/class-lightning-three-column-unit-condition.php';
	}

	if ( ! class_exists( 'Lightning_Three_Column_Unit' ) ) {
		require plugin_dir_path( __FILE__ ) . 'package/class-lightning-three-column-unit.php';
	}

	if ( ! class_exists( 'Lightning_Three_Column_Unit_Widget_Area' ) ) {
		require plugin_dir_path( __FILE__ ) . 'package/class-lightning-three-column-unit-widget-area.php';
	}
}
