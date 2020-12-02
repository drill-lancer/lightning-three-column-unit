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
	}

	/**
	 * Add Column Setting Chioice
	 *
	 * @param array $choice Choice of Setting.
	 */
	public static function columns_setting_choice( $choice ) {
		$choice = array(
			'default'                  => __( 'Use common settings', 'lightning-pro' ),
			'col-one-no-subsection'    => __( '1 column ( No sub section )', 'lightning-pro' ),
			'col-one'                  => __( '1 column', 'lightning-pro' ),
			'col-two'                  => __( '2 column', 'lightning-pro' ),
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
		}

		if ( Lightning_Three_Column_Unit_Condition::lightning_is_layout_two_column() ) {
			$class_names['mainSection'] = 'col mainSection mainSection-col-two';
			if ( 'left' === $options['sidebar_position'] ) {
				$class_names['sideSection'] = 'col subSection sideSection sideSection-col-two sideSection-left';
			} else {
				$class_names['sideSection'] = 'col subSection sideSection sideSection-col-two sideSection-right';
			}
		}

		if ( Lightning_Three_Column_Unit_Condition::lightning_is_layout_three_column_content_left() ) {
			$class_names['mainSection'] = 'col mainSection mainSection-col-three-content-left';
			if ( 'left' === $options['sidebar_position'] ) {
				$class_names['sideSection'] = 'col subSection sideSection sideSection-col-three-content-left sideSection-left';
				$class_names['addSection']  = 'col subSection addSection addSection-col-three-content-left sideSection-right';
			} else {
				$class_names['sideSection'] = 'col subSection sideSection sideSection-col-three-content-left sideSection-right';
				$class_names['addSection']  = 'col subSection addSection addSection-col-three-content-left sideSection-left';
			}
		}

		if ( Lightning_Three_Column_Unit_Condition::lightning_is_layout_three_column_content_center() ) {
			$class_names['mainSection'] = 'col mainSection mainSection-col-three-content-center';
			if ( 'left' === $options['sidebar_position'] ) {
				$class_names['sideSection'] = 'col subSection sideSection sideSection-col-three-content-center sideSection-center';
				$class_names['addSection']  = 'col subSection addSection addSection-col-three-content-center sideSection-right';
			} else {
				$class_names['sideSection'] = 'col subSection sideSection sideSection-col-three-content-center sideSection-right';
				$class_names['addSection']  = 'col subSection addSection addSection-col-three-content-center sideSection-center';
			}
		}

		if ( Lightning_Three_Column_Unit_Condition::lightning_is_layout_three_column_content_right() ) {
			$class_names['mainSection'] = 'col mainSection mainSection-col-three-content-right';
			if ( 'left' === $options['sidebar_position'] ) {
				$class_names['sideSection'] = 'col subSection sideSection sideSection-col-three-content-right sideSection-right';
				$class_names['addSection']  = 'col subSection addSection addSection-col-three-content-right sideSection-right';
			} else {
				$class_names['sideSection'] = 'col subSection sideSection sideSection-col-three-content-right sideSection-right';
				$class_names['addSection']  = 'col subSection addSection addSection-col-three-content-right sideSection-right';
			}
		}

		return $class_names;
	}
}

new Lightning_Three_Column_Unit();
