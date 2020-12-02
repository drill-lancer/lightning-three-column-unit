<?php
/**
 * Lightning Three Column Unit Main
 *
 * @package Lightning Customize Unit
 */

/**
 * Lightning Three Column Unit
 */
class Lightning_Three_Column_Unit {

	/**
	 * Constructor
	 */
	public function __construct() {
		add_filter( 'lighghtning_columns_setting_choice', array( __CLASS__, 'add_column_setting_choice' ) );
	}

	/**
	 * Add Column Setting Chioice
	 *
	 * @param array $choice Choice of Setting.
	 */
	public static function add_column_setting_choice( $choice ) {
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
	 * Lightning is 2 Column
	 */
	public static function lightning_is_layout_two_column() {
		$two_column = false;
		$options    = get_option( 'lightning_theme_options' );
		global $wp_query;

		$array = lightning_layout_target_array();

		foreach ( $array as $key => $value ) {
			if ( call_user_func( $value['function'] ) ) {
				if ( isset( $options['layout'][ $key ] ) ) {
					if ( 'col-two' === $options['layout'][ $key ] ) {
						$two_column = true;
					}
				}
			}
		}

		if ( is_front_page() && ! is_home() ) {
			if ( isset( $options['layout']['front-page'] ) ) {
				if ( 'col-two' === $options['layout']['front-page'] ) {
					$two_column = true;
				}
			}
		} elseif ( is_front_page() && is_home() ) {
			if ( isset( $options['layout']['front-page'] ) ) {
				if ( 'col-two' === $options['layout']['front-page'] ) {
					$two_column = true;
				} elseif ( isset( $options['layout']['archive-post'] ) ) {
					if ( 'col-two' === $options['layout']['archive-post'] ) {
						$two_column = true;
					}
				}
			}
		} elseif ( ! is_front_page() && is_home() ) {
			if ( isset( $options['layout']['archive-post'] ) ) {
				if ( 'col-two' === $options['layout']['archive-post'] ) {
					$two_column = true;
				}
			}
		}

		$additional_post_types = get_post_types(
			array(
				'public'   => true,
				'_builtin' => false,
			),
			'names'
		);

		/**
		 * アーカイブページの場合
		 */
		if ( is_archive() && ! is_search() ) {
			$current_post_type_info = lightning_get_post_type();
			$archive_post_types     = array( 'post' ) + $additional_post_types;
			foreach ( $archive_post_types as $archive_post_type ) {
				if ( isset( $options['layout'][ 'archive-' . $archive_post_type ] ) && $current_post_type_info['slug'] === $archive_post_type ) {
					if ( 'col-two' === $options['layout'][ 'archive-' . $archive_post_type ] ) {
						$two_column = true;
					}
				}
			}
		}

		if ( is_singular() ) {
			global $post;
			$single_post_types = array( 'post', 'page' ) + $additional_post_types;
			foreach ( $single_post_types as $single_post_type ) {
				if ( isset( $options['layout'][ 'single-' . $single_post_type ] ) && get_post_type() === $single_post_type ) {
					if ( 'col-two' === $options['layout'][ 'single-' . $single_post_type ] ) {
						$two_column = true;
					}
				}
			}
			if ( isset( $post->_lightning_design_setting['layout'] ) ) {
				if ( 'col-two' === $post->_lightning_design_setting['layout'] ) {
					$two_column = true;
				}
			}
		}
		return apply_filters( 'lightning_is_layout_two_column', $two_column );
	}

	/**
	 * Lightning is 3 Column Content Left
	 */
	public static function lightning_is_layout_three_column_left() {
		$three_column_left = false;
		$options           = get_option( 'lightning_theme_options' );
		global $wp_query;

		$array = lightning_layout_target_array();

		foreach ( $array as $key => $value ) {
			if ( call_user_func( $value['function'] ) ) {
				if ( isset( $options['layout'][ $key ] ) ) {
					if ( 'col-three-content-left' === $options['layout'][ $key ] ) {
						$three_column_left = true;
					}
				}
			}
		}

		if ( is_front_page() && ! is_home() ) {
			if ( isset( $options['layout']['front-page'] ) ) {
				if ( 'col-three-content-left' === $options['layout']['front-page'] ) {
					$three_column_left = true;
				}
			}
		} elseif ( is_front_page() && is_home() ) {
			if ( isset( $options['layout']['front-page'] ) ) {
				if ( 'col-three-content-left' === $options['layout']['front-page'] ) {
					$three_column_left = true;
				} elseif ( isset( $options['layout']['archive-post'] ) ) {
					if ( 'col-three-content-left' === $options['layout']['archive-post'] ) {
						$two_column = true;
					}
				}
			}
		} elseif ( ! is_front_page() && is_home() ) {
			if ( isset( $options['layout']['archive-post'] ) ) {
				if ( 'col-three-content-left' === $options['layout']['archive-post'] ) {
					$three_column_left = true;
				}
			}
		}

		$additional_post_types = get_post_types(
			array(
				'public'   => true,
				'_builtin' => false,
			),
			'names'
		);

		/**
		 * アーカイブページの場合
		 */
		if ( is_archive() && ! is_search() ) {
			$current_post_type_info = lightning_get_post_type();
			$archive_post_types     = array( 'post' ) + $additional_post_types;
			foreach ( $archive_post_types as $archive_post_type ) {
				if ( isset( $options['layout'][ 'archive-' . $archive_post_type ] ) && $current_post_type_info['slug'] === $archive_post_type ) {
					if ( 'col-three-content-left' === $options['layout'][ 'archive-' . $archive_post_type ] ) {
						$three_column_left = true;
					}
				}
			}
		}

		if ( is_singular() ) {
			global $post;
			$single_post_types = array( 'post', 'page' ) + $additional_post_types;
			foreach ( $single_post_types as $single_post_type ) {
				if ( isset( $options['layout'][ 'single-' . $single_post_type ] ) && get_post_type() === $single_post_type ) {
					if ( 'col-three-content-left' === $options['layout'][ 'single-' . $single_post_type ] ) {
						$three_column_left = true;
					}
				}
			}
			if ( isset( $post->_lightning_design_setting['layout'] ) ) {
				if ( 'col-three-content-left' === $post->_lightning_design_setting['layout'] ) {
					$three_column_left = true;
				}
			}
		}
		return apply_filters( 'lightning_is_layout_two_column', $two_column );
	}

	/**
	 * Lightning is 3 Column Content Center
	 */
	public static function lightning_is_layout_three_column_center() {
		$three_column_center = false;
		$options             = get_option( 'lightning_theme_options' );
		global $wp_query;

		$array = lightning_layout_target_array();

		foreach ( $array as $key => $value ) {
			if ( call_user_func( $value['function'] ) ) {
				if ( isset( $options['layout'][ $key ] ) ) {
					if ( 'col-three-content-center' === $options['layout'][ $key ] ) {
						$three_column_center = true;
					}
				}
			}
		}

		if ( is_front_page() && ! is_home() ) {
			if ( isset( $options['layout']['front-page'] ) ) {
				if ( 'col-three-content-center' === $options['layout']['front-page'] ) {
					$three_column_center = true;
				}
			}
		} elseif ( is_front_page() && is_home() ) {
			if ( isset( $options['layout']['front-page'] ) ) {
				if ( 'col-three-content-center' === $options['layout']['front-page'] ) {
					$three_column_center = true;
				} elseif ( isset( $options['layout']['archive-post'] ) ) {
					if ( 'col-three-content-center' === $options['layout']['archive-post'] ) {
						$two_column = true;
					}
				}
			}
		} elseif ( ! is_front_page() && is_home() ) {
			if ( isset( $options['layout']['archive-post'] ) ) {
				if ( 'col-three-content-center' === $options['layout']['archive-post'] ) {
					$three_column_center = true;
				}
			}
		}

		$additional_post_types = get_post_types(
			array(
				'public'   => true,
				'_builtin' => false,
			),
			'names'
		);

		/**
		 * アーカイブページの場合
		 */
		if ( is_archive() && ! is_search() ) {
			$current_post_type_info = lightning_get_post_type();
			$archive_post_types     = array( 'post' ) + $additional_post_types;
			foreach ( $archive_post_types as $archive_post_type ) {
				if ( isset( $options['layout'][ 'archive-' . $archive_post_type ] ) && $current_post_type_info['slug'] === $archive_post_type ) {
					if ( 'col-three-content-center' === $options['layout'][ 'archive-' . $archive_post_type ] ) {
						$three_column_center = true;
					}
				}
			}
		}

		if ( is_singular() ) {
			global $post;
			$single_post_types = array( 'post', 'page' ) + $additional_post_types;
			foreach ( $single_post_types as $single_post_type ) {
				if ( isset( $options['layout'][ 'single-' . $single_post_type ] ) && get_post_type() === $single_post_type ) {
					if ( 'col-three-content-center' === $options['layout'][ 'single-' . $single_post_type ] ) {
						$three_column_center = true;
					}
				}
			}
			if ( isset( $post->_lightning_design_setting['layout'] ) ) {
				if ( 'col-three-content-center' === $post->_lightning_design_setting['layout'] ) {
					$three_column_center = true;
				}
			}
		}
		return apply_filters( 'lightning_is_layout_two_column', $two_column );
	}

	/**
	 * Lightning is 3 Column Content Right
	 */
	public static function lightning_is_layout_three_column_right() {
		$three_column_right = false;
		$options            = get_option( 'lightning_theme_options' );
		global $wp_query;

		$array = lightning_layout_target_array();

		foreach ( $array as $key => $value ) {
			if ( call_user_func( $value['function'] ) ) {
				if ( isset( $options['layout'][ $key ] ) ) {
					if ( 'col-three-content-right' === $options['layout'][ $key ] ) {
						$three_column_right = true;
					}
				}
			}
		}

		if ( is_front_page() && ! is_home() ) {
			if ( isset( $options['layout']['front-page'] ) ) {
				if ( 'col-three-content-right' === $options['layout']['front-page'] ) {
					$three_column_right = true;
				}
			}
		} elseif ( is_front_page() && is_home() ) {
			if ( isset( $options['layout']['front-page'] ) ) {
				if ( 'col-three-content-right' === $options['layout']['front-page'] ) {
					$three_column_right = true;
				} elseif ( isset( $options['layout']['archive-post'] ) ) {
					if ( 'col-three-content-right' === $options['layout']['archive-post'] ) {
						$two_column = true;
					}
				}
			}
		} elseif ( ! is_front_page() && is_home() ) {
			if ( isset( $options['layout']['archive-post'] ) ) {
				if ( 'col-three-content-right' === $options['layout']['archive-post'] ) {
					$three_column_right = true;
				}
			}
		}

		$additional_post_types = get_post_types(
			array(
				'public'   => true,
				'_builtin' => false,
			),
			'names'
		);

		/**
		 * アーカイブページの場合
		 */
		if ( is_archive() && ! is_search() ) {
			$current_post_type_info = lightning_get_post_type();
			$archive_post_types     = array( 'post' ) + $additional_post_types;
			foreach ( $archive_post_types as $archive_post_type ) {
				if ( isset( $options['layout'][ 'archive-' . $archive_post_type ] ) && $current_post_type_info['slug'] === $archive_post_type ) {
					if ( 'col-three-content-right' === $options['layout'][ 'archive-' . $archive_post_type ] ) {
						$three_column_right = true;
					}
				}
			}
		}

		if ( is_singular() ) {
			global $post;
			$single_post_types = array( 'post', 'page' ) + $additional_post_types;
			foreach ( $single_post_types as $single_post_type ) {
				if ( isset( $options['layout'][ 'single-' . $single_post_type ] ) && get_post_type() === $single_post_type ) {
					if ( 'col-three-content-right' === $options['layout'][ 'single-' . $single_post_type ] ) {
						$three_column_right = true;
					}
				}
			}
			if ( isset( $post->_lightning_design_setting['layout'] ) ) {
				if ( 'col-three-content-right' === $post->_lightning_design_setting['layout'] ) {
					$three_column_right = true;
				}
			}
		}
		return apply_filters( 'lightning_is_layout_two_column', $two_column );
	}

}

new Lightning_Three_Column_Unit();
