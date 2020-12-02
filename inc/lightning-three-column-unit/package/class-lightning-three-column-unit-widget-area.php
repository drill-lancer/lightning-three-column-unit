<?php
/**
 * Lightning Three Column Unit Widget Area
 *
 * @package Lightning Three Column Unit
 */

/**
 * Lightning Three Column Unit Widget Area
 */
class Lightning_Three_Column_Unit_Widget_Area {

	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'widget_init', array( __CLASS__, 'register_sidebar' ) );
		add_action( 'lightning_additional_section', array( __CLASS__, 'add_sidebar' ) );
	}

	/**
	 * Register Sidebar
	 */
	public static function register_sidebar() {
		register_sidebar(
			array(
				'name'          => __( 'Additional Sidebar', 'lightning-three-column-unit' ),
				'id'            => 'lightning-addtional-sidebar',
				'description'   => __( 'Display only Three Column Layout', 'lightning-three-column-unit' ),
				'before_widget' => '<aside class="widget %2$s" id="%1$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h1 class="widget-title subSection-title">',
				'after_title'   => '</h1>',
			)
		);
	}

	/**
	 * Add Sidebar
	 */
	public static function add_sidebar() {
		if ( Lightning_Three_Column_Unit_Condition::lightning_is_layout_three_column() ) {
			?>
			<div class="<?php lightning_the_class_name( 'addSection' ); ?>">
				<?php
				if ( is_active_sidebar( 'lightning-addtional-sidebar' ) ) {
					dynamic_sidebar( 'lightning-addtional-sidebar' );
				}
				?>
			</div>
			<?php
		}
	}

}

new Lightning_Three_Column_Unit_Widget_Area();
