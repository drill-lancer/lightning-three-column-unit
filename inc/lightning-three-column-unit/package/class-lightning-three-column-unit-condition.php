<?php
/**
 * Conditions of Lightning Three Column Unit
 *
 * @package Lightning Three Column Unit
 */

/**
 * Conditions of Lightning Three Column Unit
 */
class Lightning_Three_Column_Unit_Condition {

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
				} else {
					$two_column = true;
				}
			}
		}

		if ( is_front_page() && ! is_home() ) {
			if ( isset( $options['layout']['front-page'] ) ) {
				if ( 'col-two' === $options['layout']['front-page'] ) {
					$two_column = true;
				}
			} else {
				$two_column = true;
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
			} else {
				$two_column = true;
			}
		} elseif ( ! is_front_page() && is_home() ) {
			if ( isset( $options['layout']['archive-post'] ) ) {
				if ( 'col-two' === $options['layout']['archive-post'] ) {
					$two_column = true;
				}
			} else {
				$two_column = true;
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
		if ( is_archive() && ! is_search() && ! is_author() ) {
			$current_post_type_info = lightning_get_post_type();
			$archive_post_types     = array( 'post' ) + $additional_post_types;
			foreach ( $archive_post_types as $archive_post_type ) {
				if ( isset( $options['layout'][ 'archive-' . $archive_post_type ] ) && $current_post_type_info['slug'] === $archive_post_type ) {
					if ( 'col-two' === $options['layout'][ 'archive-' . $archive_post_type ] ) {
						$two_column = true;
					}
				} else {
					$two_column = true;
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
				} else {
					$two_column = true;
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
	public static function lightning_is_layout_three_column_content_left() {
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
		if ( is_archive() && ! is_search() && ! is_author() ) {
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
		return apply_filters( 'lightning_is_layout_three_column_content_left', $three_column_left );
	}

	/**
	 * Lightning is 3 Column Content Center
	 */
	public static function lightning_is_layout_three_column_content_center() {
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
		if ( is_archive() && ! is_search() && ! is_author() ) {
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
		return apply_filters( 'lightning_is_layout_three_column_content_center', $three_column_center );
	}

	/**
	 * Lightning is 3 Column Content Right
	 */
	public static function lightning_is_layout_three_column_content_right() {
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
		if ( is_archive() && ! is_search() && ! is_author() ) {
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
		return apply_filters( 'lightning_is_layout_three_column_content_right', $three_column_right );
	}

	/**
	 * Lightning is 3 Column
	 */
	public static function lightning_is_layout_three_column() {
		$three_column_content_left   = self::lightning_is_layout_three_column_content_left();
		$three_column_content_center = self::lightning_is_layout_three_column_content_center();
		$three_column_content_right  = self::lightning_is_layout_three_column_content_right();
		return $three_column_content_left || $three_column_content_center || $three_column_content_right;
	}

	/**
	 * Lightning is 3 Column
	 */
	public static function lightning_is_set_three_column() {
		$three_column_set = false;

		$options = get_option( 'lightning_theme_options' );
		if ( ! empty( $options['layout'] ) ) {
			if ( in_array( 'col-three-content-left', $options['layout'], true ) ) {
				$three_column_set = true;
			}
			if ( in_array( 'col-three-content-center', $options['layout'], true ) ) {
				$three_column_set = true;
			}
			if ( in_array( 'col-three-content-right', $options['layout'], true ) ) {
				$three_column_set = true;
			}
		}

		$three_column_content_left_posts = get_posts(
			array(
				'post_type'      => 'any',
				'posts_per_page' => -1,
				'meta_key'       => '_lightning_design_setting',
				'meta_value'     => array(
					'layout' => 'col-three-content-left',
				),
			)
		);

		if ( ! empty( $three_column_content_left_posts ) ) {
			$three_column_set = true;
		}

		$three_column_content_center_posts = get_posts(
			array(
				'post_type'      => 'any',
				'posts_per_page' => -1,
				'meta_key'       => '_lightning_design_setting',
				'meta_value'     => array(
					'layout' => 'col-three-content-center',
				),
			)
		);

		if ( ! empty( $three_column_content_center_posts ) ) {
			$three_column_set = true;
		}

		$three_column_content_right_posts = get_posts(
			array(
				'post_type'      => 'any',
				'posts_per_page' => -1,
				'meta_key'       => '_lightning_design_setting',
				'meta_value'     => array(
					'layout' => 'col-three-content-right',
				),
			)
		);

		if ( ! empty( $three_column_content_right_posts ) ) {
			$three_column_set = true;
		}

		return $three_column_set;

	}
}

new Lightning_Three_Column_Unit_Condition();
