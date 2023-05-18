<?php
namespace Bricks;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Popups
 *
 * @since 1.6
 */
class Popups {
	public static $controls                                   = [];
	public static $generated_template_settings_inline_css_ids = [];
	public static $looping_popup_html                         = '';

	public function __construct() {
		// Add popups HTML to frontend
		if ( ! bricks_is_builder() ) {
			add_action( 'wp_footer', [ $this, 'render_popups' ], 10 );
		}

		self::set_controls();
	}

	public static function get_controls() {
		return self::$controls;
	}

	/**
	 * Set popup controls once initially
	 *
	 * For builder theme style & template settings panel.
	 *
	 * No need to run on hook as it does not contain any db data.
	 */
	public static function set_controls() {
		self::$controls['popupPadding'] = [
			'group' => 'popup',
			'label' => esc_html__( 'Padding', 'bricks' ),
			'type'  => 'spacing',
			'css'   => [
				[
					'property' => 'padding',
					'selector' => '&.brx-popup',
				],
			],
		];

		self::$controls['popupJustifyConent'] = [
			'group'   => 'popup',
			'label'   => esc_html__( 'Align main axis', 'bricks' ),
			'tooltip' => [
				'content'  => 'justify-content',
				'position' => 'top-left',
			],
			'type'    => 'justify-content',
			'inline'  => true,
			'exclude' => [
				'space',
			],
			'css'     => [
				[
					'property' => 'justify-content',
					'selector' => '&.brx-popup',
				],
			],
		];

		self::$controls['popupAlignItems'] = [
			'group'   => 'popup',
			'label'   => esc_html__( 'Align cross axis', 'bricks' ),
			'tooltip' => [
				'content'  => 'align-items',
				'position' => 'top-left',
			],
			'type'    => 'align-items',
			'inline'  => true,
			'exclude' => [
				'stretch',
			],
			'css'     => [
				[
					'property' => 'align-items',
					'selector' => '&.brx-popup',
				],
			],
		];

		self::$controls['popupZindex'] = [
			'group'       => 'popup',
			'label'       => 'Z-index',
			'type'        => 'number',
			'css'         => [
				[
					'property' => 'z-index',
					'selector' => '&.brx-popup',
				],
			],
			'placeholder' => 10000,
		];

		self::$controls['popupBackground'] = [
			'group' => 'popup',
			'label' => esc_html__( 'Background', 'bricks' ),
			'type'  => 'background',
			'css'   => [
				[
					'property' => 'background',
					'selector' => '&.brx-popup',
				],
			],
		];

		self::$controls['popupBodyScroll'] = [
			'group' => 'popup',
			'label' => esc_html__( 'Scroll', 'bricks' ) . ' (body)',
			'type'  => 'checkbox',
		];

		// Popup content

		self::$controls['popupContentSep'] = [
			'group' => 'popup',
			'label' => esc_html__( 'Content', 'bricks' ),
			'type'  => 'separator',
		];

		self::$controls['popupContentPadding'] = [
			'group'       => 'popup',
			'label'       => esc_html__( 'Padding', 'bricks' ),
			'type'        => 'spacing',
			'css'         => [
				[
					'property' => 'padding',
					'selector' => '.brx-popup-content',
				],
			],
			'placeholder' => [
				'top'    => '30px',
				'right'  => '30px',
				'bottom' => '30px',
				'left'   => '30px',

			],
		];

		self::$controls['popupContentWidth'] = [
			'group' => 'popup',
			'label' => esc_html__( 'Width', 'bricks' ),
			'type'  => 'number',
			'units' => true,
			'css'   => [
				[
					'property' => 'width',
					'selector' => '.brx-popup-content',
				],
			],
		];

		self::$controls['popupContentHeight'] = [
			'group' => 'popup',
			'label' => esc_html__( 'Height', 'bricks' ),
			'type'  => 'number',
			'units' => true,
			'css'   => [
				[
					'property' => 'height',
					'selector' => '.brx-popup-content',
				],
			],
		];

		self::$controls['popupContentBackground'] = [
			'group' => 'popup',
			'label' => esc_html__( 'Background', 'bricks' ),
			'type'  => 'background',
			'css'   => [
				[
					'property' => 'background',
					'selector' => '.brx-popup-content',
				],
			],
		];

		self::$controls['popupContentBorder'] = [
			'group' => 'popup',
			'label' => esc_html__( 'Border', 'bricks' ),
			'type'  => 'border',
			'css'   => [
				[
					'property' => 'border',
					'selector' => '.brx-popup-content',
				],
			],
		];

		self::$controls['popupContentBoxShadow'] = [
			'group' => 'popup',
			'label' => esc_html__( 'Box shadow', 'bricks' ),
			'type'  => 'box-shadow',
			'css'   => [
				[
					'property' => 'box-shadow',
					'selector' => '.brx-popup-content',
				],
			],
		];

		// Popup limits

		self::$controls['popupLimitsSep'] = [
			'group'       => 'popup',
			'type'        => 'separator',
			'label'       => esc_html__( 'Popup limit', 'bricks' ),
			'description' => esc_html__( 'Limit how often this popup appears.', 'bricks' ),
		];

		self::$controls['popupLimitWindow'] = [
			'group'   => 'popup',
			'type'    => 'number',
			'label'   => esc_html__( 'Per page load', 'bricks' ),
			'tooltip' => [
				'content'  => 'window.brx_popup_{id}_total',
				'position' => 'top-left',
			],
		];

		self::$controls['popupLimitSessionStorage'] = [
			'group'   => 'popup',
			'type'    => 'number',
			'label'   => esc_html__( 'Per session', 'bricks' ),
			'tooltip' => [
				'content'  => 'sessionStorage.brx_popup_{id}_total',
				'position' => 'top-left',
			],
		];

		self::$controls['popupLimitLocalStorage'] = [
			'group'   => 'popup',
			'type'    => 'number',
			'label'   => esc_html__( 'Across sessions', 'bricks' ),
			'tooltip' => [
				'content'  => 'localStorage.brx_popup_{id}_total',
				'position' => 'top-left',
			],
		];
	}

	/**
	 * Build query loop popup HTML and store under self::$looping_popup_html
	 *
	 * Render in footer when executing render_popups()
	 *
	 * Included inline styles.
	 *
	 * @param int $popup_id
	 *
	 * @return void
	 *
	 * @since 1.7.1
	 */
	public static function build_looping_popup_html( $popup_id ) {
		$html = self::generate_popup_html( $popup_id );

		/**
		 * Inside query loop: Get popup template settings
		 *
		 * To generate inline CSS for the popup template located inside a query loop.
		 */
		if ( Query::is_looping() && ! in_array( $popup_id, self::$generated_template_settings_inline_css_ids ) ) {
			$popup_template_settings = Helpers::get_template_settings( $popup_id );

			if ( $popup_template_settings ) {
				$template_settings_controls = Settings::get_controls_data( 'template' );

				if ( ! empty( $template_settings_controls['controls'] ) ) {
					$template_settings_inline_css = Assets::generate_inline_css_from_element(
						[
							'settings'             => $popup_template_settings,
							'_templateCssSelector' => ".brxe-popup-{$popup_id}"
						],
						$template_settings_controls['controls'],
						'popup'
					);

					if ( $template_settings_inline_css ) {
						$html .= "<style>$template_settings_inline_css</style>";

						self::$generated_template_settings_inline_css_ids[] = $popup_id;
					}
				}
			}
		}

		self::$looping_popup_html .= $html;
	}

	/**
	 * Generate popup HTML
	 *
	 * @param int $popup_id
	 *
	 * @return string
	 *
	 * @since 1.7.1
	 */
	public static function generate_popup_html( $popup_id ) {
		$elements = Database::get_data( $popup_id );

		if ( empty( $elements ) ) {
			return;
		}

		$popup_content = Frontend::render_data( $elements, 'popup' );

		// Skip adding popup HTML if empty (e.g. popup outermost element condition not fulfilled)
		if ( empty( $popup_content ) ) {
			return;
		}

		$is_popup_preview = Templates::get_template_type() === 'popup';

		$popup_template_settings = Helpers::get_template_settings( $popup_id );

		$attributes = [
			'data-popup-id' => $popup_id,
			'class'         => [ 'brx-popup', "brxe-popup-{$popup_id}" ],
		];

		// Add popup loop attributes for JavaScript logic (@since 1.7.1)
		$looping_query_id = Query::is_any_looping();

		if ( $looping_query_id ) {
			$attributes['data-popup-loop']       = Query::get_query_element_id( $looping_query_id );
			$attributes['data-popup-loop-index'] = Query::get_loop_index();

			// Add loop element ID as popup class (e.g. brxe-{loop_container_element_id}) to target correct popup selectors (@since 1.7.1)
			$attributes['class'][] = "brxe-{$attributes['data-popup-loop']}";
		}

		// Allow body scroll when popup is open (@since 1.7.1)
		if ( isset( $popup_template_settings['popupBodyScroll'] ) ) {
			$attributes['data-popup-body-scroll'] = 'true';
		}

		if ( ! $is_popup_preview ) {
			// Not previewing popup template: Hide it
			$attributes['class'][] = 'hide';

			// STEP: Add popup show limits
			$limits = [];

			$limit_options = [
				'popupLimitWindow'         => 'windowStorage',
				'popupLimitSessionStorage' => 'sessionStorage',
				'popupLimitLocalStorage'   => 'localStorage',
			];

			foreach ( $limit_options as $limit => $storage ) {
				if ( empty( $popup_template_settings[ $limit ] ) ) {
					continue;
				}

				$limits[ $storage ] = intval( $popup_template_settings[ $limit ] );
			}

			if ( ! empty( $limits ) ) {
				$attributes['data-popup-limits'] = htmlspecialchars( json_encode( $limits ) );
			}

			// NOTE: Undocumented
			$attributes = apply_filters( 'bricks/popup/attributes', $attributes, $popup_id );
		}

		$attributes = Helpers::stringify_html_attributes( $attributes );

		$popup_content_classes = 'brx-popup-content';

		// Default popup width = Container width
		if ( ! isset( $popup_template_settings['popupContentWidth'] ) ) {
			$popup_content_classes .= ' brxe-container';
		}

		$html  = "<div {$attributes}>";
		$html .= "<div class=\"$popup_content_classes\">$popup_content</div>";
		$html .= '</div>';

		return $html;
	}

	/**
	 * Check if there is any popup to render and adds popup HTML to the footer
	 *
	 * @since 1.6
	 *
	 * @return void
	 */
	public static function render_popups() {
		$popup_ids = Database::$active_templates['popup'];

		$is_popup_preview = Templates::get_template_type() === 'popup';

		// Is popup preview: Add popup ID
		if ( $is_popup_preview ) {
			$popup_ids = [ get_the_ID() ];
		}

		// Output query looping popup HTML (@since 1.7.1)
		if ( ! empty( self::$looping_popup_html ) ) {
			echo self::$looping_popup_html;
		}

		if ( empty( $popup_ids ) ) {
			return;
		}

		foreach ( $popup_ids as $popup_id ) {
			// Refactor HTML generation (@since 1.7.1)
			$html = self::generate_popup_html( $popup_id, $is_popup_preview );

			if ( empty( $html ) ) {
				continue;
			}

			echo $html;
		}

		/**
		 * Template settings "Popup" load as inline CSS
		 *
		 * NOTE: Not optimal, but needed as template settings are not part of popup CSS file
		 */
		if ( Database::get_setting( 'cssLoading' ) === 'file' && ! empty( Assets::$inline_css['popup'] ) ) {
			echo '<style>' . Assets::$inline_css['popup'] . '</style>';
		}
	}
}
