<?php
/**
 * Conditions of Lightning Three Column Unit Admin
 *
 * @package Lightning Three Column Unit
 */

/**
 * Conditions of Lightning Three Column Unit Admin
 */
class Lightning_Three_Column_Unit_Admin {

	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'customize_register', array( __CLASS__, 'resister_customize' ) );
	}

	/**
	 * Default Option.
	 */
	public static function default_option() {
		$args = array(
			'main_width'             => '680',
			'side_width'             => '320',
			'column_margin'          => '20',
			'outer_container_margin' => '40',
			'three-to-one-via-two'   => 'disable',
			'main_sidebar_control'   => 'wrap-down',
			'sub_sidebar_control'    => 'hidden',
		);
		return $args;
	}

	/**
	 * Register Customize
	 */
	public static function resister_customize() {

		global $wp_customize;

		$default_option = self::default_option();

		// Add Section.
		$wp_customize->add_section(
			'lightning_three_column_unit_setting',
			array(
				'title'    => __( 'Lightning Three Column Unit', 'lightning-three-column-unit' ),
				'priority' => 999,
			)
		);

		// Main Culumn Width.
		$wp_customize->add_setting(
			'lightning_three_column_unit_options[main_width]',
			array(
				'default'           => $default_option['main_width'],
				'type'              => 'option',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			'lightning_three_column_unit_options[main_width]',
			array(
				'label'       => __( 'Main Column Width Value', 'lightning-three-column-unit' ),
				'section'     => 'lightning_three_column_unit_setting',
				'settings'    => 'lightning_three_column_unit_options[main_width]',
				'type'        => 'text',
				'input_after' => __( 'px', 'lightning-three-column-unit' ),
			)
		);

		// Side Culumn Width.
		$wp_customize->add_setting(
			'lightning_three_column_unit_options[side_width]',
			array(
				'default'           => $default_option['side_width'],
				'type'              => 'option',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			'lightning_three_column_unit_options[side_width]',
			array(
				'label'       => __( 'Side Column Width Value', 'lightning-three-column-unit' ),
				'section'     => 'lightning_three_column_unit_setting',
				'settings'    => 'lightning_three_column_unit_options[side_width]',
				'type'        => 'text',
				'input_after' => __( 'px', 'lightning-three-column-unit' ),
			)
		);

		// Margin of Between Columns.
		$wp_customize->add_setting(
			'lightning_three_column_unit_options[column_margin]',
			array(
				'default'           => $default_option['column_margin'],
				'type'              => 'option',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			'lightning_three_column_unit_options[column_margin]',
			array(
				'label'       => __( 'Margin of Between Columns', 'lightning-three-column-unit' ),
				'section'     => 'lightning_three_column_unit_setting',
				'settings'    => 'lightning_three_column_unit_options[column_margin]',
				'type'        => 'text',
				'input_after' => __( 'px', 'lightning-three-column-unit' ),
			)
		);

		// Minumum Margin Sum for Out of Container.
		$wp_customize->add_setting(
			'lightning_three_column_unit_options[outer_container_margin]',
			array(
				'default'           => $default_option['outer_container_margin'],
				'type'              => 'option',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			'lightning_three_column_unit_options[outer_container_margin]',
			array(
				'label'       => __( 'Minumum Margin Sum for Out of Container', 'lightning-three-column-unit' ),
				'section'     => 'lightning_three_column_unit_setting',
				'settings'    => 'lightning_three_column_unit_options[outer_container_margin]',
				'type'        => 'text',
				'input_after' => __( 'px', 'lightning-three-column-unit' ),
			)
		);

		// When Three Column Layout is Choosed and Narrowing Window Size, Make Two Column Layout.
		$wp_customize->add_setting(
			'lightning_three_column_unit_options[three-to-one-via-two]',
			array(
				'default'           => $default_option['three-to-one-via-two'],
				'type'              => 'option',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			'lightning_three_column_unit_options[three-to-one-via-two]',
			array(
				'label'    => __( 'When Three Column Layout is Choosed and Narrowing Window Size, Make Two Column Layout', 'lightning-three-column-unit' ),
				'section'  => 'lightning_three_column_unit_setting',
				'settings' => 'lightning_three_column_unit_options[three-to-one-via-two]',
				'type'     => 'select',
				'choices'  => array(
					'disable' => __( 'Disable', 'lightning-three-column-unit' ),
					'enable'  => __( 'Enable', 'lightning-three-column-unit' ),
				),
			)
		);

		// Main Sidebar Control.
		$wp_customize->add_setting(
			'lightning_three_column_unit_options[main_sidebar_control]',
			array(
				'default'           => $default_option['main_sidebar_control'],
				'type'              => 'option',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			'lightning_three_column_unit_options[main_sidebar_control]',
			array(
				'label'    => __( 'Main Sidebar Control', 'lightning-three-column-unit' ),
				'section'  => 'lightning_three_column_unit_setting',
				'settings' => 'lightning_three_column_unit_options[main_sidebar_control]',
				'type'     => 'select',
				'choices'  => array(
					'wrap-down' => __( 'Wrap Down', 'lightning-three-column-unit' ),
					'hidden'    => __( 'Hidden', 'lightning-three-column-unit' ),
				),
			)
		);

		// Sub Sidebar Control.
		$wp_customize->add_setting(
			'lightning_three_column_unit_options[sub_sidebar_control]',
			array(
				'default'           => $default_option['sub_sidebar_control'],
				'type'              => 'option',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			'lightning_three_column_unit_options[sub_sidebar_control]',
			array(
				'label'    => __( 'Sub Sidebar Control', 'lightning-three-column-unit' ),
				'section'  => 'lightning_three_column_unit_setting',
				'settings' => 'lightning_three_column_unit_options[sub_sidebar_control]',
				'type'     => 'select',
				'choices'  => array(
					'wrap-down' => __( 'Wrap Down', 'lightning-three-column-unit' ),
					'hidden'    => __( 'Hidden', 'lightning-three-column-unit' ),
				),
			)
		);
	}


}

new Lightning_Three_Column_Unit_Admin();
