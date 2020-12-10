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
			'col-three-content-left'   => __( '3 Column Content Left', 'lightning-three-column-unit' ),
			'col-three-content-center' => __( '3 Column Content Center', 'lightning-three-column-unit' ),
			'col-three-content-right'  => __( '3 Column Content Right', 'lightning-three-column-unit' ),
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

		$options                 = get_option( 'lightning_theme_options' );
		$options['sidebar_fix']  = 'no-fix';
		$options['section_base'] = 'no';
		update_option( 'lightning_theme_options', $options );

		$one_column_layout   = Lightning_Three_Column_Unit_Condition::lightning_is_layout_one_column();
		$two_column_layout   = Lightning_Three_Column_Unit_Condition::lightning_is_layout_two_column();
		$three_column_layout = Lightning_Three_Column_Unit_Condition::lightning_is_layout_three_column();

		$three_column_content_left_layout   = Lightning_Three_Column_Unit_Condition::lightning_is_layout_three_column_content_left();
		$three_column_content_center_layout = Lightning_Three_Column_Unit_Condition::lightning_is_layout_three_column_content_center();
		$three_column_content_right_layout  = Lightning_Three_Column_Unit_Condition::lightning_is_layout_three_column_content_right();

		$three_column_set = Lightning_Three_Column_Unit_Condition::lightning_is_set_three_column();

		if ( $one_column_layout ) {
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

		if ( $two_column_layout ) {
			if ( ! empty( $options['sidebar_position'] ) && 'left' === $options['sidebar_position'] ) {
				$class_names['mainSection'] = 'col mainSection mainSection-col-two baseSection';
				$class_names['sideSection'] = 'col subSection sideSection sideSection-col-two baseSection';
			} else {
				$class_names['mainSection'] = 'col mainSection mainSection-col-two baseSection';
				$class_names['sideSection'] = 'col subSection sideSection sideSection-col-two baseSection';
			}
		}

		if ( $three_column_content_left_layout ) {
			$class_names['mainSection'] = 'col mainSection  mainSection-col-three baseSection';
			if ( ! empty( $options['sidebar_position'] ) && 'left' === $options['sidebar_position'] ) {
				$class_names['sideSection'] = 'col subSection sideSection sideSection-col-three baseSection';
				$class_names['addSection']  = 'col subSection addSection addSection-col-three baseSection';
			} else {
				$class_names['sideSection'] = 'col subSection sideSection sideSection-col-three baseSection';
				$class_names['addSection']  = 'col subSection addSection addSection-col-three baseSection';
			}
		}

		if ( $three_column_content_center_layout ) {
			$class_names['mainSection'] = 'col mainSection mainSection-col-three baseSection';
			if ( ! empty( $options['sidebar_position'] ) && 'left' === $options['sidebar_position'] ) {
				$class_names['sideSection'] = 'col subSection sideSection sideSection-col-three baseSection';
			} else {
				$class_names['sideSection'] = 'col subSection sideSection sideSection-col-three baseSection';
				$class_names['addSection']  = 'col subSection addSection addSection-col-three baseSection';
			}
		}

		if ( $three_column_content_right_layout ) {
			$class_names['mainSection'] = 'col mainSection mainSection-col-three baseSection';
			if ( ! empty( $options['sidebar_position'] ) && 'left' === $options['sidebar_position'] ) {
				$class_names['sideSection'] = 'col subSection sideSection sideSection-col-three baseSection';
				$class_names['addSection']  = 'col subSection addSection addSection-col-three baseSection';
			} else {
				$class_names['sideSection'] = 'col subSection sideSection sideSection-col-three baseSection';
				$class_names['addSection']  = 'col subSection addSection addSection-col-three baseSection';
			}
		}

		return $class_names;
	}

	/**
	 * Render Style
	 */
	public static function render_style() {
		$options = get_option( 'lightning_three_column_unit_options' );
		$default = Lightning_Three_Column_Unit_Admin::default_option();
		$options = wp_parse_args( $options, $default );

		$one_column_layout   = Lightning_Three_Column_Unit_Condition::lightning_is_layout_one_column();
		$two_column_layout   = Lightning_Three_Column_Unit_Condition::lightning_is_layout_two_column();
		$three_column_layout = Lightning_Three_Column_Unit_Condition::lightning_is_layout_three_column();

		$three_column_content_left_layout   = Lightning_Three_Column_Unit_Condition::lightning_is_layout_three_column_content_left();
		$three_column_content_center_layout = Lightning_Three_Column_Unit_Condition::lightning_is_layout_three_column_content_center();
		$three_column_content_right_layout  = Lightning_Three_Column_Unit_Condition::lightning_is_layout_three_column_content_right();

		$three_column_set = Lightning_Three_Column_Unit_Condition::lightning_is_set_three_column();

		$lightning_theme_option = get_option( 'lightning_theme_options' );

		$sidebar_position = ! empty( $lightning_theme_option['sidebar_position'] ) && 'left' === $lightning_theme_option['sidebar_position'] ? 'left' : 'right';

		$main_width             = $options['main_width'];
		$side_width             = $options['side_width'];
		$column_margin          = $options['column_margin'];
		$outer_container_margin = $options['outer_container_margin'];

		$container_2col_width = $main_width + $side_width + $column_margin;
		$container_3col_width = $container_2col_width + $side_width + $column_margin;
		$max_1col_width       = $container_2col_width + $outer_container_margin - 1;
		$min_2col_width       = $container_2col_width + $outer_container_margin;
		$max_2col_width       = $container_3col_width + $outer_container_margin - 1;
		$min_3col_width       = $container_3col_width + $outer_container_margin;

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
			margin: 0;
			padding: 0;
		}
		';

		if ( $one_column_layout ) {
			// 1 Column Layout.
			if ( $three_column_set ) {
				$dynamic_css .= '
				@media ( max-width: ' . $max_1col_width . 'px ) {
					.container {
						width: calc( 100% - ' . $outer_container_margin . 'px );
						max-width: calc( 100% - ' . $outer_container_margin . 'px );
					}
				}
				@media ( min-width: ' . $min_2col_width . 'px ) and ( max-width: ' . $max_2col_width . 'px ) {
					.container {
						width: calc( ' . $container_2col_width . 'px - ' . $outer_container_margin . 'px );
						max-width: calc( ' . $container_2col_width . 'px - ' . $outer_container_margin . 'px );
					}
				}
				@media ( min-width: ' . $min_3col_width . 'px ) and ( max-width: 9999px ) {
					.container {
						width: calc( ' . $container_3col_width . 'px - ' . $outer_container_margin . 'px );
						max-width: calc( ' . $container_3col_width . 'px - ' . $outer_container_margin . 'px );
					}
				}
				.mainSection,
				.sideSection {
					width: 100%;
					max-width: 100%;
				}
				';
			} else {
				$dynamic_css .= '
				@media ( max-width: ' . $max_1col_width . 'px ) {
					.container {
						width: calc( 100% - ' . $outer_container_margin . 'px );
						max-width: calc( 100% - ' . $outer_container_margin . 'px );
					}
				}
				@media ( min-width: ' . $min_2col_width . 'px ) and ( max-width: 9999px ) {
					.container {
						width: calc( ' . $container_2col_width . 'px - ' . $outer_container_margin . 'px );
						max-width: calc( ' . $container_2col_width . 'px - ' . $outer_container_margin . 'px );
					}
				}
				';
			}
		} elseif ( $two_column_layout ) {
			// 2 Column Layout.
			$main_width_wide = $main_width * ( $container_3col_width - $column_margin ) / ( $container_2col_width - $column_margin );
			$side_width_wide = $side_width * ( $container_3col_width - $column_margin ) / ( $container_2col_width - $column_margin );

			// 1 Column.
			if ( 'wrap-down' === $options['main_sidebar_control'] ) {
				$dynamic_css .= '
				@media ( max-width: ' . $max_1col_width . 'px ) {
					.container {
						width: calc( 100% - ' . $outer_container_margin . 'px );
						max-width: calc( 100% - ' . $outer_container_margin . 'px );
					}
					.mainSection,
					.sideSection {
						width: 100%;
						max-width: 100%;
					}
				}
				';
			} else {
				$dynamic_css .= '
				@media ( max-width: ' . $max_1col_width . 'px ) {
					.container {
						width: calc( 100% - ' . $outer_container_margin . 'px );
						max-width: calc( 100% - ' . $outer_container_margin . 'px );
					}
					.mainSection,
					.sideSection {
						width: 100%;
						max-width: 100%;
					}
					.sideSection {
						display: none;
					}
				}
				';
			}

			// 2 Column.
			if ( 'left' === $sidebar_position ) {
				if ( $three_column_set ) {
					$dynamic_css .= '
					@media ( min-width: ' . $min_2col_width . 'px ) and ( max-width: ' . $max_2col_width . 'px ) {
						.container {
							width: ' . $container_2col_width . 'px;
							max-width: ' . $container_2col_width . 'px;
						}
						.mainSection {
							width: ' . $main_width . 'px;
							max-width: ' . $main_width . 'px;
							margin-left: ' . $column_margin . 'px;
							order: 1;
						}
						.sideSection {
							width: ' . $side_width . 'px;
							max-width: ' . $side_width . 'px;
							order: 0;
						}
					}
					@media ( min-width: ' . $min_3col_width . 'px ) and ( max-width: 9999px ) {
						.container {
							width: ' . $container_3col_width . 'px;
							max-width: ' . $container_3col_width . 'px;
						}
						.mainSection {
							width: ' . $main_width_wide . 'px;
							max-width: ' . $main_width_wide . 'px;
							margin-left: ' . $column_margin . 'px;
							order: 1;
						}
						.sideSection {
							width: ' . $side_width_wide . 'px;
							max-width: ' . $side_width_wide . 'px;
							order: 0;
						}
					}
					';
				} else {
					$dynamic_css .= '
					@media ( min-width: ' . $min_2col_width . 'px ) and ( max-width: 9999px ) {
						.container {
							width: ' . $container_2col_width . 'px;
							max-width: ' . $container_2col_width . 'px;
						}
						.mainSection {
							width: ' . $main_width . 'px;
							max-width: ' . $main_width . 'px;
							margin-left: ' . $column_margin . 'px;
							order: 1;
						}
						.sideSection {
							width: ' . $side_width . 'px;
							max-width: ' . $side_width . 'px;
							order: 0;
						}
					}
					';
				}
			} else {
				if ( $three_column_set ) {
					$dynamic_css .= '
					@media ( min-width: ' . $min_2col_width . 'px ) and ( max-width: ' . $max_2col_width . 'px ) {
						.container {
							width: ' . $container_2col_width . 'px;
							max-width: ' . $container_2col_width . 'px;
						}
						.mainSection {
							width: ' . $main_width . 'px;
							max-width: ' . $main_width . 'px;
							margin-right: ' . $column_margin . 'px;
							order: 0;
						}
						.sideSection {
							width: ' . $side_width . 'px;
							max-width: ' . $side_width . 'px;
							order: 1;
						}
					}
					@media ( min-width: ' . $min_3col_width . 'px ) and ( max-width: 9999px ) {
						.container {
							width: ' . $container_3col_width . 'px;
							max-width: ' . $container_3col_width . 'px;
						}
						.mainSection {
							width: ' . $main_width_wide . 'px;
							max-width: ' . $main_width_wide . 'px;
							margin-right: ' . $column_margin . 'px;
							order: 0;
						}
						.sideSection {
							width: ' . $side_width_wide . 'px;
							max-width: ' . $side_width_wide . 'px;
							order: 1;
						}
					}
					';
				} else {
					$dynamic_css .= '
					@media ( min-width: ' . $min_2col_width . 'px ) and ( max-width: 9999px ) {
						.container {
							width: ' . $container_2col_width . 'px;
							max-width: ' . $container_2col_width . 'px;
						}
						.mainSection {
							width: ' . $main_width . 'px;
							max-width: ' . $main_width . 'px;
							margin-right: ' . $column_margin . 'px;
							order: 0;
						}
						.sideSection {
							width: ' . $side_width . 'px;
							max-width: ' . $side_width . 'px;
							order: 1;
						}
					}
					';
				}
			}
		} elseif ( $three_column_layout ) {
			// 3 column Layout.
			$max_width = 'enable' === $options['three-to-one-via-two'] ? $max_1col_width : $min_2col_width;

			// 1 Column.
			if ( 'wrap-down' === $options['main_sidebar_control'] && 'wrap-down' === $options['sub_sidebar_control'] ) {
				$dynamic_css .= '
				@media ( max-width: ' . $max_width . 'px ) {
					.container {
						width: calc( 100% - ' . $outer_container_margin . 'px );
						max-width: calc( 100% - ' . $outer_container_margin . 'px );
					}
					.mainSection,
					.sideSection,
					.addSection {
						width: 100%;
						max-width: 100%;
					}
				}
				';
			} elseif ( 'wrap-down' === $options['main_sidebar_control'] && 'hidden' === $options['sub_sidebar_control'] ) {
				$dynamic_css .= '
				@media ( max-width: ' . $max_width . 'px ) {
					.container {
						width: calc( 100% - ' . $outer_container_margin . 'px );
						max-width: calc( 100% - ' . $outer_container_margin . 'px );
					}
					.mainSection,
					.sideSection,
					.addSection {
						width: 100%;
						max-width: 100%;
					}
					.addSection {
						display: none;
					}
				}
				';
			} elseif ( 'hidden' === $options['main_sidebar_control'] && 'wrap-down' === $options['sub_sidebar_control'] ) {
				$dynamic_css .= '
				@media ( max-width: ' . $max_width . 'px ) {
					.container {
						width: calc( 100% - ' . $outer_container_margin . 'px );
						max-width: calc( 100% - ' . $outer_container_margin . 'px );
					}
					.mainSection,
					.sideSection,
					.addSection {
						width: 100%;
						max-width: 100%;
					}
					.sideSection {
						display: none;
					}
				}
				';
			} else {
				$dynamic_css .= '
				@media ( max-width: ' . $max_width . 'px ) {
					.container {
						width: calc( 100% - ' . $outer_container_margin . 'px );
						max-width: calc( 100% - ' . $outer_container_margin . 'px );
					}
					.mainSection,
					.sideSection,
					.addSection {
						width: 100%;
						max-width: 100%;
					}
					.sideSection,
					.addSection{
						display: none;
					}
				}
				';
			}

			// 2 Column.
			if ( 'enable' === $options['three-to-one-via-two'] ) {
				if ( $three_column_content_left_layout ) {
					// 3 Column Content Left.
					if ( 'wrap-down' === $options['sub_sidebar_control'] ) {
						$dynamic_css .= '
						@media ( min-width: ' . $min_2col_width . 'px ) and ( max-width: ' . $max_2col_width . 'px ) {
							.container {
								width: ' . $container_2col_width . 'px;
								max-width: ' . $container_2col_width . 'px;
							}
							.mainSection {
								width: ' . $main_width . 'px;
								max-width: ' . $main_width . 'px;
								margin-right: ' . $column_margin . 'px;
								order: 0;
							}
							.sideSection {
								width: ' . $side_width . 'px;
								max-width: ' . $side_width . 'px;
								order: 1;
							}
							.addSection {
								width: 100%;
								max-width: 100%;
								order: 2;
							}
						}
						';
					} else {
						$dynamic_css .= '
						@media ( min-width: ' . $min_2col_width . 'px ) and ( max-width: ' . $max_2col_width . 'px ) {
							.container {
								width: ' . $container_2col_width . 'px;
								max-width: ' . $container_2col_width . 'px;
							}
							.mainSection {
								width: ' . $main_width . 'px;
								max-width: ' . $main_width . 'px;
								margin-right: ' . $column_margin . 'px;
								order: 0;
							}
							.sideSection {
								width: ' . $side_width . 'px;
								max-width: ' . $side_width . 'px;
								order: 1;
							}
							.addSection {
								display: none;
							}
						}
						';
					}
				} elseif ( $three_column_content_center_layout ) {
					// 3 Column Content Center.
					if ( 'left' === $sidebar_position ) {
						// Sidebar Left.
						if ( 'wrap-down' === $options['sub_sidebar_control'] ) {
							$dynamic_css .= '
							@media ( min-width: ' . $min_2col_width . 'px ) and ( max-width: ' . $max_2col_width . 'px ) {
								.container {
									width: ' . $container_2col_width . 'px;
									max-width: ' . $container_2col_width . 'px;
								}
								.mainSection {
									width: ' . $main_width . 'px;
									max-width: ' . $main_width . 'px;
									margin-left: ' . $column_margin . 'px;
									order: 1;
								}
								.sideSection {
									width: ' . $side_width . 'px;
									max-width: ' . $side_width . 'px;
									order: 0;
								}
								.addSection {
									width: 100%;
									max-width: 100%;
									order: 2;
								}
							}
							';
						} else {
							$dynamic_css .= '
							@media ( min-width: ' . $min_2col_width . 'px ) and ( max-width: ' . $max_2col_width . 'px ) {
								.container {
									width: ' . $container_2col_width . 'px;
									max-width: ' . $container_2col_width . 'px;
								}
								.mainSection {
									width: ' . $main_width . 'px;
									max-width: ' . $main_width . 'px;
									margin-left: ' . $column_margin . 'px;
									order: 1;
								}
								.sideSection {
									width: ' . $side_width . 'px;
									max-width: ' . $side_width . 'px;
									order: 0;
								}
								.addSection {
									display: none;
								}
							}
							';
						}
					} else {
						// Sidebar Right.
						if ( 'wrap-down' === $options['sub_sidebar_control'] ) {
							$dynamic_css .= '
							@media ( min-width: ' . $min_2col_width . 'px ) and ( max-width: ' . $max_2col_width . 'px ) {
								.container {
									width: ' . $container_2col_width . 'px;
									max-width: ' . $container_2col_width . 'px;
								}
								.mainSection {
									width: ' . $main_width . 'px;
									max-width: ' . $main_width . 'px;
									margin-right: ' . $column_margin . 'px;
									order: 0;
								}
								.sideSection {
									width: ' . $side_width . 'px;
									max-width: ' . $side_width . 'px;
									order: 1;
								}
								.addSection {
									width: 100%;
									max-width: 100%;
									order: 2;
								}
							}
							';
						} else {
							$dynamic_css .= '
							@media ( min-width: ' . $min_2col_width . 'px ) and ( max-width: ' . $max_2col_width . 'px ) {
								.container {
									width: ' . $container_2col_width . 'px;
									max-width: ' . $container_2col_width . 'px;
								}
								.mainSection {
									width: ' . $main_width . 'px;
									max-width: ' . $main_width . 'px;
									margin-right: ' . $column_margin . 'px;
									order: 0;
								}
								.sideSection {
									width: ' . $side_width . 'px;
									max-width: ' . $side_width . 'px;
									order: 1;
								}
								.addSection {
									display: none;
								}
							}
							';
						}
					}
				} elseif ( $three_column_content_right_layout ) {
					// 3 Column Content Right.
					if ( 'wrap-down' === $options['sub_sidebar_control'] ) {
						$dynamic_css .= '
						@media ( min-width: ' . $min_2col_width . 'px ) and ( max-width: ' . $max_2col_width . 'px ) {
							.container {
								width: ' . $container_2col_width . 'px;
								max-width: ' . $container_2col_width . 'px;
							}
							.mainSection {
								width: ' . $main_width . 'px;
								max-width: ' . $main_width . 'px;
								margin-left: ' . $column_margin . 'px;
								order: 1;
							}
							.sideSection {
								width: ' . $side_width . 'px;
								max-width: ' . $side_width . 'px;
								order: 0;
							}
							.addSection {
								width: 100%;
								max-width: 100%;
								order: 2;
							}
						}
						';
					} else {
						$dynamic_css .= '
						@media ( min-width: ' . $min_2col_width . 'px ) and ( max-width: ' . $max_2col_width . 'px ) {
							.container {
								width: ' . $container_2col_width . 'px;
								max-width: ' . $container_2col_width . 'px;
							}
							.mainSection {
								width: ' . $main_width . 'px;
								max-width: ' . $main_width . 'px;
								margin-left: ' . $column_margin . 'px;
								order: 1;
							}
							.sideSection {
								width: ' . $side_width . 'px;
								max-width: ' . $side_width . 'px;
								order: 0;
							}
							.addSection {
								display: none;
							}
						}
						';
					}
				}
			}

			// 3 Column.
			if ( $three_column_content_left_layout ) {
				if ( 'left' === $sidebar_position ) {
					$dynamic_css .= '
					@media ( min-width: ' . $min_3col_width . 'px ) and ( max-width: 9999px ) {
						.container {
							width: ' . $container_3col_width . 'px;
							max-width: ' . $container_3col_width . 'px;
						}
						.mainSection {
							width: ' . $main_width . 'px;
							max-width: ' . $main_width . 'px;
							margin-right: ' . $column_margin . 'px;
							order: 0;
						}
						.sideSection {
							width: ' . $side_width . 'px;
							max-width: ' . $side_width . 'px;
							margin-right: ' . $column_margin . 'px;
							order: 1;
						}
						.addSection {
							width: ' . $side_width . 'px;
							max-width: ' . $side_width . 'px;
							order: 2;
							display: block;
						}
					}
					';
				} else {
					$dynamic_css .= '
					@media ( min-width: ' . $min_3col_width . 'px ) and ( max-width: 9999px ) {
						.container {
							width: ' . $container_3col_width . 'px;
							max-width: ' . $container_3col_width . 'px;
						}
						.mainSection {
							width: ' . $main_width . 'px;
							max-width: ' . $main_width . 'px;
							margin-right: ' . $column_margin . 'px;
							order: 0;
						}
						.sideSection {
							width: ' . $side_width . 'px;
							max-width: ' . $side_width . 'px;
							order: 2;
						}
						.addSection {
							width: ' . $side_width . 'px;
							max-width: ' . $side_width . 'px;
							margin-right: ' . $column_margin . 'px;
							order: 1;
							display: block;
						}
					}
					';
				}
			} elseif ( $three_column_content_center_layout ) {
				if ( 'left' === $sidebar_position ) {
					$dynamic_css .= '
					@media ( min-width: ' . $min_3col_width . 'px ) and ( max-width: 9999px ) {
						.container {
							width: ' . $container_3col_width . 'px;
							max-width: ' . $container_3col_width . 'px;
						}
						.mainSection {
							width: ' . $main_width . 'px;
							max-width: ' . $main_width . 'px;
							margin-left: ' . $column_margin . 'px;
							margin-right: ' . $column_margin . 'px;
							order: 1;
						}
						.sideSection {
							width: ' . $side_width . 'px;
							max-width: ' . $side_width . 'px;
							order: 0;
						}
						.addSection {
							width: ' . $side_width . 'px;
							max-width: ' . $side_width . 'px;
							order: 2;
							display: block;
						}
					}
					';
				} else {
					$dynamic_css .= '
					@media ( min-width: ' . $min_3col_width . 'px ) and ( max-width: 9999px ) {
						.container {
							width: ' . $container_3col_width . 'px;
							max-width: ' . $container_3col_width . 'px;
						}
						.mainSection {
							width: ' . $main_width . 'px;
							max-width: ' . $main_width . 'px;
							margin-left: ' . $column_margin . 'px;
							margin-right: ' . $column_margin . 'px;
							order: 1;
						}
						.sideSection {
							width: ' . $side_width . 'px;
							max-width: ' . $side_width . 'px;
							order: 2;
						}
						.addSection {
							width: ' . $side_width . 'px;
							max-width: ' . $side_width . 'px;
							order: 0;
							display: block;
						}
					}
					';
				}
			} elseif ( $three_column_content_right_layout ) {
				if ( 'left' === $sidebar_position ) {
					$dynamic_css .= '
					@media ( min-width: ' . $min_3col_width . 'px ) and ( max-width: 9999px ) {
						.container {
							width: ' . $container_3col_width . 'px;
							max-width: ' . $container_3col_width . 'px;
						}
						.mainSection {
							width: ' . $main_width . 'px;
							max-width: ' . $main_width . 'px;
							margin-left: ' . $column_margin . 'px;
							order: 2;
						}
						.sideSection {
							width: ' . $side_width . 'px;
							max-width: ' . $side_width . 'px;
							order: 0;
						}
						.addSection {
							width: ' . $side_width . 'px;
							max-width: ' . $side_width . 'px;
							margin-left: ' . $column_margin . 'px;
							order: 1;
							display: block;
						}
					}
					';
				} else {
					$dynamic_css .= '
					@media ( min-width: ' . $min_3col_width . 'px ) and ( max-width: 9999px ) {
						.container {
							width: ' . $container_3col_width . 'px;
							max-width: ' . $container_3col_width . 'px;
						}
						.mainSection {
							width: ' . $main_width . 'px;
							max-width: ' . $main_width . 'px;
							margin-left: ' . $column_margin . 'px;
							order: 2;
						}
						.sideSection {
							width: ' . $side_width . 'px;
							max-width: ' . $side_width . 'px;
							margin-left: ' . $column_margin . 'px;
							order: 1;
						}
						.addSection {
							width: ' . $side_width . 'px;
							max-width: ' . $side_width . 'px;
							order: 0;
							display: block;
						}
					}
					';
				}
			}
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
