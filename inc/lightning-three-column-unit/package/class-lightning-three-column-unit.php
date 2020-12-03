<?php
/**
 * Lightning Three Column Unit
 *
 * @package Lightning Three Column Unit
 */

/**
 * Lightning Three Column Unit
 */
class Lightning_Three_Column_Unit {

	/**
	 * Constructor
	 */
	public function __construct() {
		add_filter( 'lighghtning_columns_setting_choice', array( __CLASS__, 'columns_setting_choice' ) );
		add_filter( 'lightning_get_the_class_names', array( __CLASS__, 'get_the_class_names' ) );
		add_action( 'wp_head', array( __CLASS__, 'render_style' ), 5 );
	}

	/**
	 * Add Column Setting Chioice
	 *
	 * @param array $choice Choice of Setting.
	 */
	public static function columns_setting_choice( $choice ) {
		$choice = array(
			'default'                  => __( 'Use common settings', 'lightning-three-column-unit' ),
			'col-one-no-subsection'    => __( '1 column ( No sub section )', 'lightning-three-column-unit' ),
			'col-one'                  => __( '1 column', 'lightning-three-column-unit' ),
			'col-two'                  => __( '2 column', 'lightning-three-column-unit' ),
			'col-three-content-left'   => __( '3 Column Content Left', 'lightning-customize-unit' ),
			'col-three-content-center' => __( '3 Column Content Center', 'lightning-customize-unit' ),
			'col-three-content-right'  => __( '3 Column Content Right', 'lightning-customize-unit' ),
		);
		return $choice;
	}

	/**
	 * Class Change
	 *
	 * @param array  $class_names classnames.
	 * @param string $position position.
	 */
	public static function get_the_class_names( $class_names, $position = '' ) {

		$skin_info = Lightning_Design_Manager::get_current_skin();
		$options   = get_option( 'lightning_theme_options' );

		if ( lightning_is_layout_onecolumn() ) {
			$class_names['mainSection'] = 'col mainSection mainSection-col-one';
			$class_names['sideSection'] = 'col subSection sideSection sideSection-col-one';
			if ( lightning_is_subsection_display() ) {
				$class_names['mainSection'] .= ' mainSection-marginBottom-on';
			}
		} else {
			if ( lightning_is_siteContent_padding_off() ) {
				$class_names['mainSection'] .= ' mainSection-marginVertical-off';
			}
		}

		if ( Lightning_Three_Column_Unit_Condition::lightning_is_layout_two_column() ) {
			if ( ! empty( $options['sidebar_position'] ) && 'left' === $options['sidebar_position'] ) {
				$class_names['mainSection'] = 'col mainSection mainSection-col-two mainSection-pos-right baseSection';
				$class_names['sideSection'] = 'col subSection sideSection sideSection-col-two sideSection-pos-left baseSection';
			} else {
				$class_names['mainSection'] = 'col mainSection mainSection-col-two mainSection-pos-left baseSection';
				$class_names['sideSection'] = 'col subSection sideSection sideSection-col-two sideSection-pos-right baseSection';
			}
		}

		if ( Lightning_Three_Column_Unit_Condition::lightning_is_layout_three_column_content_left() ) {
			$class_names['mainSection'] = 'col mainSection  mainSection-col-three mainSection-col-three-content-left mainSection-left baseSection';
			if ( ! empty( $options['sidebar_position'] ) && 'left' === $options['sidebar_position'] ) {
				$class_names['sideSection'] = 'col subSection sideSection sideSection-col-three sideSection-col-three-content-left sideSection-center baseSection';
				$class_names['addSection']  = 'col subSection addSection addSection-col-three addSection-col-three-content-left addSection-right baseSection';
			} else {
				$class_names['sideSection'] = 'col subSection sideSection sideSection-col-three sideSection-col-three-content-left sideSection-right baseSection';
				$class_names['addSection']  = 'col subSection addSection addSection-col-three addSection-col-three-content-left addSection-center baseSection';
			}
		}

		if ( Lightning_Three_Column_Unit_Condition::lightning_is_layout_three_column_content_center() ) {
			$class_names['mainSection'] = 'col mainSection mainSection-col-three mainSection-col-three-content-center mainSection-center baseSection';
			if ( ! empty( $options['sidebar_position'] ) && 'left' === $options['sidebar_position'] ) {
				$class_names['sideSection'] = 'col subSection sideSection sideSection-col-three sideSection-col-three-content-center sideSection-left baseSection';
				$class_names['addSection']  = 'col subSection addSection addSection-col-three addSection-col-three-content-center addSection-right baseSection';
			} else {
				$class_names['sideSection'] = 'col subSection sideSection sideSection-col-three sideSection-col-three-content-center sideSection-right baseSection';
				$class_names['addSection']  = 'col subSection addSection addSection-col-three addSection-col-three-content-center addSection-left baseSection';
			}
		}

		if ( Lightning_Three_Column_Unit_Condition::lightning_is_layout_three_column_content_right() ) {
			$class_names['mainSection'] = 'col mainSection mainSection-col-three mainSection-col-three-content-right mainSection-right baseSection';
			if ( ! empty( $options['sidebar_position'] ) && 'left' === $options['sidebar_position'] ) {
				$class_names['sideSection'] = 'col subSection sideSection sideSection-col-three sideSection-col-three-content-right sideSection-left baseSection';
				$class_names['addSection']  = 'col subSection addSection addSection-col-three addSection-col-three-content-right addSection-center baseSection';
			} else {
				$class_names['sideSection'] = 'col subSection sideSection sideSection-col-three sideSection-col-three-content-right sideSection-center baseSection';
				$class_names['addSection']  = 'col subSection addSection addSection-col-three addSection-col-three-content-right addSection-left baseSection';
			}
		}

		return $class_names;
	}

	/**
	 * Render Style
	 */
	public static function render_style() {
		$dynamic_css = '
		.siteContent>.container>.row {
			display: flex;
			justify-content: space-between;
			flex-wrap: wrap;
		}
		.sideSection,
		.mainSection,
		.addSection {
			flex-basis: auto;
			float:none;
		}
		';
		if ( lightning_is_layout_onecolumn() ) {
			$dynamic_css = '
			.mainSection,
			.sideSection {
				width: 100%;
				max-width: 100%;
			}
			';
		}
		$dynamic_css = str_replace( PHP_EOL, '', $dynamic_css );
		// delete tab.
		$dynamic_css = preg_replace( '/[\n\r\t]/', '', $dynamic_css );
		// multi space convert to single space.
		$dynamic_css = preg_replace( '/\s(?=\s)/', '', $dynamic_css );
		wp_add_inline_style( 'lightning-design-style', $dynamic_css );

	}
}

new Lightning_Three_Column_Unit();
