<?php

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die();
}

// If class `CFLG_Plugin` doesn't exists yet.
if ( ! class_exists( 'CFLG_Plugin' ) ) {

	/**
	 * Sets up and initializes the plugin.
	 */
	class CFLG_Plugin {

		/**
		 * A reference to an instance of this class.
		 *
		 * @since  1.0.0
		 * @access private
		 * @var    object
		 */
		private static $instance = null;

		/**
		 * Sets up needed actions/filters for the plugin to initialize.
		 *
		 * @since 1.0.0
		 * @access public
		 * @return void
		 */
		public function __construct() {

			add_action( 'wp_enqueue_scripts', array( $this, 'assets' ) );

			add_shortcode( 'cf7_layout_generator', array( $this, 'shortcode' ) );
		}

		public function shortcode() {

			ob_start();
			include CFLG_PATH . 'templates/app.php';
			$template = ob_get_clean();

			wp_enqueue_script( 'cf7-layout-generator' );
			add_action( 'wp_footer', array( $this, 'component_templates' ), 0 );

			return '<div id="cf7_layout_generator">' . $template . '</div>';
		}

		public function component_templates() {
			foreach ( glob( CFLG_PATH . 'templates/components/*.html' ) as $file ) {
				$slug = basename( $file, '.html' );

				ob_start();
				include $file;
				$template = ob_get_clean();

				printf(
					'<script type="text/x-template" id="%2$s">%1$s</script>',
					$template,
					'wp-query-' . $slug
				);
			}
		}

		public function assets() {

			if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) {
				$prefix = '';
			} else {
				$prefix = '.min';
			}

			wp_register_script(
				'vuejs',
				CFLG_URL . 'assets/js/vue' . $prefix . '.js',
				array(),
				'2.5.16',
				true
			);

			wp_register_script(
				'vuejs-clipboard',
				CFLG_URL . 'assets/js/vue-clipboard.min.js',
				array(),
				CFLG_VERSION,
				true
			);

			wp_register_script(
				'vue-grid-layout',
				CFLG_URL . 'assets/js/vue-grid-layout.min.js',
				array(),
				CFLG_VERSION,
				true
			);

			wp_register_script(
				'cf7-layout-generator',
				CFLG_URL . 'assets/js/app.js',
				array( 'vuejs', 'vuejs-clipboard', 'vue-grid-layout' ),
				CFLG_VERSION,
				true
			);

			wp_enqueue_style( 'cf7-layout', CFLG_URL . 'assets/css/style.css' );

		}

		/**
		 * Returns the instance.
		 *
		 * @since  1.0.0
		 * @access public
		 * @return object
		 */
		public static function get_instance() {
			// If the single instance hasn't been set, set it now.
			if ( null == self::$instance ) {
				self::$instance = new self;
			}
			return self::$instance;
		}
	}
}
