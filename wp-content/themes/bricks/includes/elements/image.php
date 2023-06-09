<?php
namespace Bricks;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Element_Image extends Element {
	public $block             = 'core/image';
	public $category          = 'basic';
	public $name              = 'image';
	public $icon              = 'ti-image';
	public $tag               = 'figure';
	public $custom_attributes = false;

	public function get_label() {
		return esc_html__( 'Image', 'bricks' );
	}

	/**
	 * Enqueue PhotoSwipe lightbox script file as needed (frontend only)
	 *
	 * @since 1.3.4
	 */
	public function enqueue_scripts() {
		if ( isset( $this->settings['link'] ) && $this->settings['link'] === 'lightbox' ) {
			wp_enqueue_script( 'bricks-photoswipe' );
			wp_enqueue_style( 'bricks-photoswipe' );
		}
	}

	public function set_controls() {
		// Apply CSS filters only to img tag
		$this->controls['_cssFilters']['css'] = [
			[
				'selector' => '&:is(img)',
				'property' => 'filter',
			],
			[
				'selector' => 'img',
				'property' => 'filter',
			],
		];

		$this->controls['_typography']['css'][0]['selector'] = 'figcaption';

		// Image

		$this->controls['image'] = [
			'tab'  => 'content',
			'type' => 'image',
		];

		// @since 1.4
		$this->controls['tag'] = [
			'tab'         => 'content',
			'label'       => esc_html__( 'HTML tag', 'bricks' ),
			'type'        => 'select',
			'options'     => [
				'figure'  => 'figure',
				'picture' => 'picture',
				'div'     => 'div',
				'custom'  => esc_html__( 'Custom', 'bricks' ),
			],
			'lowercase'   => true,
			'inline'      => true,
			'placeholder' => '-',
		];

		$this->controls['customTag'] = [
			'tab'            => 'content',
			'label'          => esc_html__( 'Custom tag', 'bricks' ),
			'type'           => 'text',
			'inline'         => true,
			'hasDynamicData' => false,
			'placeholder'    => 'div',
			'required'       => [ 'tag', '=', 'custom' ],
		];

		// @since 1.3.7
		$this->controls['_objectFit'] = [
			'tab'         => 'content',
			'label'       => esc_html__( 'Object fit', 'bricks' ),
			'type'        => 'select',
			'options'     => [
				'fill'       => esc_html__( 'Fill', 'bricks' ),
				'contain'    => esc_html__( 'Contain', 'bricks' ),
				'cover'      => esc_html__( 'Cover', 'bricks' ),
				'none'       => esc_html__( 'None', 'bricks' ),
				'scale-down' => esc_html__( 'Scale down', 'bricks' ),
				'fill'       => esc_html__( 'Fill', 'bricks' ),
			],
			'css'         => [
				[
					'property' => 'object-fit',
					'selector' => '',
				],
				[
					'property' => 'object-fit',
					'selector' => 'img',
				],
			],
			'inline'      => true,
			'placeholder' => esc_html__( 'Fill', 'bricks' ),
		];

		// @since 1.3.7
		$this->controls['_objectPosition'] = [
			'tab'            => 'content',
			'label'          => esc_html__( 'Object position', 'bricks' ),
			'type'           => 'text',
			'css'            => [
				[
					'property' => 'object-position',
					'selector' => '',
				],
				[
					'property' => 'object-position',
					'selector' => 'img',
				],
			],
			'inline'         => true,
			'placeholder'    => '50% 50%',
			'hasDynamicData' => false,
			'required'       => [ '_objectFit' ],
		];

		// Alt text

		$this->controls['altText'] = [
			'tab'      => 'content',
			'label'    => esc_html__( 'Custom alt text', 'bricks' ),
			'type'     => 'text',
			'inline'   => true,
			'rerender' => false,
			'required' => [ 'image', '!=', '' ],
		];

		// Caption
		$caption_options = [
			'none'       => esc_html__( 'No caption', 'bricks' ),
			'attachment' => esc_html__( 'Attachment', 'bricks' ),
			'custom'     => esc_html__( 'Custom', 'bricks' ),
		];

		// Get caption placeholder from theme option value
		$show_caption = ! empty( $this->theme_styles['caption'] ) ? $this->theme_styles['caption'] : 'attachment';

		$this->controls['caption'] = [
			'tab'         => 'content',
			'label'       => esc_html__( 'Caption Type', 'bricks' ),
			'type'        => 'select',
			'options'     => $caption_options,
			'inline'      => true,
			'placeholder' => ! empty( $caption_options[ $show_caption ] ) ? $caption_options[ $show_caption ] : esc_html__( 'Attachment', 'bricks' ),
		];

		$this->controls['captionCustom'] = [
			'tab'         => 'content',
			'label'       => esc_html__( 'Custom caption', 'bricks' ),
			'type'        => 'text',
			'placeholder' => esc_html__( 'Here goes your caption ...', 'bricks' ),
			'required'    => [ 'caption', '=', 'custom' ],
		];

		// 'loading' attribute (@ssince 1.6.2)
		$this->controls['loading'] = [
			'tab'         => 'content',
			'label'       => esc_html__( 'Loading', 'bricks' ),
			'type'        => 'select',
			'inline'      => true,
			'options'     => [
				'eager' => 'eager',
				'lazy'  => 'lazy',
			],
			'placeholder' => 'lazy',
		];

		// 'title' attribute (@since 1.6.2)
		$this->controls['showTitle'] = [
			'tab'      => 'content',
			'label'    => esc_html__( 'Show title', 'bricks' ),
			'type'     => 'checkbox',
			'inline'   => true,
			'required' => [ 'image', '!=', '' ],
		];

		$this->controls['stretch'] = [
			'tab'   => 'content',
			'label' => esc_html__( 'Stretch', 'bricks' ),
			'type'  => 'checkbox',
			'css'   => [
				[
					'property' => 'width',
					'value'    => '100%',
				],
			],
		];

		// Link To
		$this->controls['linkToSeparator'] = [
			'tab'   => 'content',
			'type'  => 'separator',
			'label' => esc_html__( 'Link To', 'bricks' ),
		];

		$this->controls['link'] = [
			'tab'         => 'content',
			'type'        => 'select',
			'options'     => [
				'lightbox'   => esc_html__( 'Lightbox', 'bricks' ),
				'attachment' => esc_html__( 'Attachment Page', 'bricks' ),
				'media'      => esc_html__( 'Media File', 'bricks' ),
				'url'        => esc_html__( 'Other (URL)', 'bricks' ),
			],
			'rerender'    => true,
			'placeholder' => esc_html__( 'None', 'bricks' ),
		];

		$this->controls['lightboxId'] = [
			'tab'         => 'content',
			'label'       => esc_html__( 'Lightbox ID', 'bricks' ),
			'type'        => 'text',
			'inline'      => true,
			'required'    => [ 'link', '=', 'lightbox' ],
			'description' => esc_html__( 'Images of the same lightbox ID are grouped together.', 'bricks' ),
		];

		$this->controls['newTab'] = [
			'tab'      => 'content',
			'label'    => esc_html__( 'Open in new tab', 'bricks' ),
			'type'     => 'checkbox',
			'required' => [ 'link', '=', [ 'attachment', 'media' ] ],
		];

		$this->controls['url'] = [
			'tab'      => 'content',
			'type'     => 'link',
			'required' => [ 'link', '=', 'url' ],
		];

		$this->controls['popupOverlay'] = [
			// 'deprecated' => true, // Redundant: Use _gradient settings instead
			'tab'      => 'content',
			'label'    => esc_html__( 'Image overlay', 'bricks' ),
			'type'     => 'color',
			'css'      => [
				[
					'property' => 'background-color',
					'selector' => '&.overlay::before',
				],
			],
			'rerender' => true,
		];

		// Icon

		$this->controls['popupSeparator'] = [
			'tab'      => 'content',
			'label'    => esc_html__( 'Icon', 'bricks' ),
			'type'     => 'separator',
			'inline'   => true,
			'small'    => true,
			'required' => [ 'link', '!=', '' ],
		];

		// To hide icon for specific elements when image icon set in styles
		$this->controls['popupIconDisable'] = [
			'tab'   => 'content',
			'label' => esc_html__( 'Disable icon', 'bricks' ),
			'type'  => 'checkbox',
		];

		$this->controls['popupIcon'] = [
			'tab'      => 'content',
			'label'    => esc_html__( 'Icon', 'bricks' ),
			'type'     => 'icon',
			'inline'   => true,
			'small'    => true,
			'rerender' => true,
			'required' => [ 'link', '!=', '' ],
		];

		// NOTE: Set popup CSS control outside of control 'link' (CSS is not applied to nested controls)
		$this->controls['popupIconBackgroundColor'] = [
			'tab'      => 'content',
			'label'    => esc_html__( 'Icon background color', 'bricks' ),
			'type'     => 'color',
			'css'      => [
				[
					'property' => 'background-color',
					'selector' => '.icon',
				],
			],
			'required' => [ 'popupIcon', '!=', '' ],
		];

		$this->controls['popupIconBorder'] = [
			'tab'      => 'content',
			'label'    => esc_html__( 'Icon border', 'bricks' ),
			'type'     => 'border',
			'css'      => [
				[
					'property' => 'border',
					'selector' => '.icon',
				],
			],
			'required' => [ 'popupIcon', '!=', '' ],
		];

		$this->controls['popupIconBoxShadow'] = [
			'tab'      => 'content',
			'label'    => esc_html__( 'Icon box shadow', 'bricks' ),
			'type'     => 'box-shadow',
			'css'      => [
				[
					'property' => 'box-shadow',
					'selector' => '.icon',
				],
			],
			'required' => [ 'popupIcon', '!=', '' ],
		];

		$this->controls['popupIconHeight'] = [
			'tab'      => 'content',
			'label'    => esc_html__( 'Icon height', 'bricks' ),
			'type'     => 'number',
			'units'    => true,
			'css'      => [
				[
					'property' => 'line-height',
					'selector' => '.icon',
				],
			],
			'required' => [ 'popupIcon', '!=', '' ],
		];

		$this->controls['popupIconWidth'] = [
			'tab'      => 'content',
			'label'    => esc_html__( 'Icon width', 'bricks' ),
			'type'     => 'number',
			'units'    => true,
			'css'      => [
				[
					'property' => 'width',
					'selector' => '.icon',
				],
			],
			'required' => [ 'popupIcon', '!=', '' ],
		];

		$this->controls['popupIconTypography'] = [
			'tab'         => 'content',
			'label'       => esc_html__( 'Icon typography', 'bricks' ),
			'type'        => 'typography',
			'css'         => [
				[
					'property' => 'font',
					'selector' => '.icon',
				],
			],
			'exclude'     => [
				'font-family',
				'font-weight',
				'font-style',
				'text-align',
				'text-decoration',
				'text-transform',
				'line-height',
				'letter-spacing',
			],
			'placeholder' => [
				'font-size' => 60,
			],
			'required'    => [ 'popupIcon.icon', '!=', '' ],
		];
	}

	public function get_normalized_image_settings( $settings ) {
		if ( empty( $settings['image'] ) ) {
			return [
				'id'   => 0,
				'url'  => false,
				'size' => BRICKS_DEFAULT_IMAGE_SIZE,
			];
		}

		$image = $settings['image'];

		// Size
		$image['size'] = empty( $image['size'] ) ? BRICKS_DEFAULT_IMAGE_SIZE : $settings['image']['size'];

		// Image ID or URL from dynamic data
		if ( ! empty( $image['useDynamicData'] ) ) {
			$images = $this->render_dynamic_data_tag( $image['useDynamicData'], 'image', [ 'size' => $image['size'] ] );

			if ( ! empty( $images[0] ) ) {
				if ( is_numeric( $images[0] ) ) {
					$image['id'] = $images[0];
				} else {
					$image['url'] = $images[0];
				}
			}

			// No dynamic data image found (@since 1.6)
			else {
				return;
			}
		}

		$image['id'] = empty( $image['id'] ) ? 0 : $image['id'];

		// If External URL, $image['url'] is already set
		if ( ! isset( $image['url'] ) ) {
			$image['url'] = ! empty( $image['id'] ) ? wp_get_attachment_image_url( $image['id'], $image['size'] ) : false;
		} else {
			// Parse dynamic data in the external URL (@since 1.5.7)
			$image['url'] = $this->render_dynamic_data( $image['url'] );
		}

		return $image;
	}

	public function render() {
		$settings   = $this->settings;
		$link       = ! empty( $settings['link'] ) ? $settings['link'] : false;
		$image      = $this->get_normalized_image_settings( $settings );
		$image_id   = isset( $image['id'] ) ? $image['id'] : '';
		$image_url  = isset( $image['url'] ) ? $image['url'] : '';
		$image_size = isset( $image['size'] ) ? $image['size'] : '';

		// STEP: Dynamic data image not found: Show placeholder text
		if ( ! empty( $settings['image']['useDynamicData'] ) && ! $image ) {
			return $this->render_element_placeholder(
				[
					'title' => esc_html__( 'Dynamic data is empty.', 'bricks' )
				]
			);
		}

		$image_placeholder_url = \Bricks\Builder::get_template_placeholder_image();

		// STEP: Image caption
		$show_caption = isset( $this->theme_styles['caption'] ) ? $this->theme_styles['caption'] : 'attachment';

		if ( isset( $settings['caption'] ) ) {
			$show_caption = $settings['caption'];
		}

		$image_caption = false;

		if ( $show_caption === 'none' ) {
			$image_caption = false;
		} elseif ( $show_caption === 'custom' && ! empty( $settings['captionCustom'] ) ) {
			$image_caption = trim( $settings['captionCustom'] );
		} elseif ( $image_id ) {
			$image_data    = get_post( $image_id );
			$image_caption = $image_data ? $image_data->post_excerpt : '';
		}

		$has_overlay = isset( $settings['popupOverlay'] );

		$has_html_tag = $image_caption || $has_overlay || isset( $settings['_gradient'] ) || isset( $settings['tag'] );

		// Check: Element classes for 'popupOverlay' setting to add .overlay class to make ::before work (@since 1.7.1)
		if ( ! $has_overlay && $this->element_classes_have( 'popupOverlay' ) ) {
			$has_overlay = true;
		}

		// Default: 'figure' HTML tag (needed to apply overlay::before to as not possible on self-closing 'img' tag)
		if ( $has_overlay ) {
			$has_html_tag = true;
		}

		// Check: Element classes for 'gradient' setting to add HTML tag to Image element to make ::before work (@since 1.7.1)
		if ( ! $has_html_tag && $this->element_classes_have( '_gradient' ) ) {
			$has_html_tag = true;
		}

		// Check: No image selected: No image ID provided && not a placeholder URL
		if ( ! isset( $image['external'] ) && ! $image_id && ! $image_url && $image_url !== $image_placeholder_url ) {
			return $this->render_element_placeholder( [ 'title' => esc_html__( 'No image selected.', 'bricks' ) ] );
		}

		// Check: Image with ID doesn't exist
		if ( ! isset( $image['external'] ) && ! $image_url ) {
			return $this->render_element_placeholder( [ 'title' => sprintf( esc_html__( 'Image ID (%s) no longer exist. Please select another image.', 'bricks' ), $image_id ) ] );
		}

		$this->set_attribute( 'img', 'class', 'css-filter' );

		$this->set_attribute( 'img', 'class', "size-$image_size" );

		// Check for alternartive "Alt Text" setting
		if ( ! empty( $settings['altText'] ) ) {
			$this->set_attribute( 'img', 'alt', esc_attr( $settings['altText'] ) );
		}

		// Set 'loading' attribute: eager or lazy (@since 1.6.2)
		if ( ! empty( $settings['loading'] ) ) {
			$this->set_attribute( 'img', 'loading', esc_attr( $settings['loading'] ) );
		}

		// Show image 'title' attribute (@since 1.6.2)
		if ( isset( $settings['showTitle'] ) ) {
			$image_title = $image_id ? get_the_title( $image_id ) : false;

			if ( $image_title ) {
				$this->set_attribute( 'img', 'title', esc_attr( $image_title ) );
			}
		}

		// Wrap image element in 'figure' to allow for image caption, overlay, icon
		if ( $has_overlay ) {
			$this->set_attribute( '_root', 'class', 'overlay' );
		}

		/**
		 * Render: Wrap 'img' HTML tag in HTML tag (if 'tag' set) or anchor tag (if 'link' set)
		 */
		$output = '';

		// Add _root attributes to outermost tag
		if ( $has_html_tag ) {
			$this->set_attribute( '_root', 'class', 'tag' );

			// Has image caption (add position: relative through class)
			if ( $image_caption ) {
				$this->set_attribute( '_root', 'class', 'caption' );
			}

			$output .= "<{$this->tag} {$this->render_attributes( '_root' )}>";
		}

		if ( $link ) {
			// Link is outermost tag: Merge _root attributes into link attributes it
			if ( ! $has_html_tag ) {
				foreach ( $this->attributes['_root'] as $key => $value ) {
					$this->attributes['link'][ $key ] = $value;
					unset( $this->attributes['_root'][ $key ] );
				}
			}

			$this->set_attribute( 'link', 'class', 'tag' );

			if ( isset( $settings['newTab'] ) ) {
				$this->set_attribute( 'link', 'target', '_blank' );
			}

			if ( $link === 'media' && $image_id ) {
				$this->set_attribute( 'link', 'href', wp_get_attachment_url( $image_id ) );
			} elseif ( $link === 'attachment' && $image_id ) {
				$this->set_attribute( 'link', 'href', get_permalink( $image_id ) );
			} elseif ( $link === 'url' && ! empty( $settings['url'] ) ) {
				$this->set_link_attributes( 'link', $settings['url'] );
			} elseif ( $link === 'lightbox' ) {
				$this->set_attribute( 'link', 'class', 'bricks-lightbox' );

				$image_src = $image_id ? wp_get_attachment_image_src( $image_id, 'full' ) : [ $image_placeholder_url, 800, 600 ];

				$this->set_attribute( 'link', 'href', $image_src[0] );
				$this->set_attribute( 'link', 'data-pswp-src', $image_src[0] );
				$this->set_attribute( 'link', 'data-pswp-width', $image_src[1] );
				$this->set_attribute( 'link', 'data-pswp-height', $image_src[2] );

				if ( ! empty( $settings['lightboxId'] ) ) {
					$this->set_attribute( 'link', 'data-pswp-id', esc_attr( $settings['lightboxId'] ) );
				}
			}

			$output .= "<a {$this->render_attributes( 'link' )}>";
		}

		// Show popup icon if link is set
		$icon = ! empty( $settings['popupIcon'] ) ? $settings['popupIcon'] : false;

		// Check: Theme style for video 'popupIcon' setting (@since 1.7)
		if ( ! $icon && ! empty( $this->theme_styles['popupIcon'] ) ) {
			$icon = $this->theme_styles['popupIcon'];
		}

		if ( ! isset( $settings['popupIconDisable'] ) && $link && $icon ) {
			$output .= self::render_icon( $icon, [ 'icon' ] );
		}

		// Lazy load atts set via 'wp_get_attachment_image_attributes' filter
		if ( $image_id ) {
			$image_attributes = [];

			// 'img' is root (no caption, no overlay)
			if ( ! $has_html_tag && ! $link ) {
				foreach ( $this->attributes['_root'] as $key => $value ) {
					$image_attributes[ $key ] = is_array( $value ) ? join( ' ', $value ) : $value;
				}
			}

			foreach ( $this->attributes['img'] as $key => $value ) {
				if ( isset( $image_attributes[ $key ] ) ) {
					$image_attributes[ $key ] .= ' ' . ( is_array( $value ) ? join( ' ', $value ) : $value );
				} else {
					$image_attributes[ $key ] = is_array( $value ) ? join( ' ', $value ) : $value;
				}
			}

			// Merge custom attributes with img attributes
			$custom_attributes = $this->get_custom_attributes( $settings );
			$image_attributes  = array_merge( $image_attributes, $custom_attributes );

			$output .= wp_get_attachment_image( $image_id, $image_size, false, $image_attributes );
		} elseif ( $image_url ) {
			if ( ! $has_html_tag && ! $link ) {
				foreach ( $this->attributes['_root'] as $key => $value ) {
					$this->attributes['img'][ $key ] = $value;
				}
			}

			$this->set_attribute( 'img', 'src', $image_url );

			$output .= "<img {$this->render_attributes( 'img', true )}>";
		}

		if ( $image_caption ) {
			$output .= '<figcaption class="bricks-image-caption">' . $image_caption . '</figcaption>';
		}

		if ( $link ) {
			$output .= '</a>';
		}

		if ( $has_html_tag ) {
			$output .= "</{$this->tag}>";
		}

		echo $output;
	}

	public function get_block_html( $settings ) {
		if ( empty( $settings['image'] ) ) {
			return;
		}

		$image_id   = empty( $settings['image']['id'] ) ? 0 : $settings['image']['id'];
		$image_size = empty( $settings['image']['size'] ) ? BRICKS_DEFAULT_IMAGE_SIZE : $settings['image']['size'];

		$figure_classes = [ 'wp-block-image', "size-$image_size" ];

		if ( isset( $settings['_typography']['text-align'] ) ) {
			$figure_classes[] = 'align' . $settings['_typography']['text-align'];
		}

		$this->set_attribute( 'figure', 'class', $figure_classes );

		$this->set_attribute( 'image', 'src', $settings['image']['url'] );
		$this->set_attribute( 'image', 'alt', isset( $settings['altText'] ) ? $settings['altText'] : '' );

		if ( $image_id ) {
			$this->set_attribute( 'image', 'class', 'wp-image-' . $image_id );
		}

		if ( isset( $settings['_width'] ) && strpos( $settings['_width'], 'px' ) !== false ) {
			$this->set_attribute( 'image', 'width', str_replace( 'px', '', $settings['_width'] ) );
		}

		if ( isset( $settings['_height'] ) && strpos( $settings['_height'], 'px' ) !== false ) {
			$this->set_attribute( 'image', 'height', str_replace( 'px', '', $settings['_height'] ) );
		}

		$block_html = "<figure {$this->render_attributes( 'figure' )}>";

		$link = ! empty( $settings['link'] ) ? $settings['link'] : false;

		if ( $link ) {
			if ( $link === 'media' ) {
				$this->set_link_attributes( 'a', 'href', $image_id ? wp_get_attachment_url( $image_id ) : $settings['image']['url'] );
			} elseif ( ! empty( $settings['url'] ) ) {
				$this->set_link_attributes( 'a', $settings['url'] );
			}

			$this->remove_attribute( 'a', 'class' );

			$block_html .= "<a {$this->render_attributes( 'a' )}>";
		}

		$block_html .= "<img {$this->render_attributes( 'image' )}>";

		if ( $link ) {
			$block_html .= '</a>';
		}

		$block_html .= '</figure>';

		return $block_html;
	}

	public function convert_element_settings_to_block( $settings ) {
		if ( empty( $settings['image'] ) ) {
			return;
		}

		$image = $this->get_normalized_image_settings( $settings );

		$block = [
			'blockName'    => $this->block,
			'attrs'        => [
				'id'       => empty( $image['id'] ) ? '' : $image['id'],
				'sizeSlug' => empty( $image['size'] ) ? BRICKS_DEFAULT_IMAGE_SIZE : $image['size'],
			],
			'innerContent' => [],
		];

		if ( isset( $settings['_typography']['text-align'] ) ) {
			$block['attrs']['align'] = $settings['_typography']['text-align'];
		}

		if ( isset( $settings['_width'] ) && strpos( $settings['_width'], 'px' ) !== false ) {
			$block['attrs']['width'] = intval( str_replace( 'px', '', $settings['_width'] ) );
		}

		if ( isset( $settings['_height'] ) && strpos( $settings['_height'], 'px' ) !== false ) {
			$block['attrs']['height'] = intval( str_replace( 'px', '', $settings['_height'] ) );
		}

		$link = ! empty( $settings['link'] ) ? $settings['link'] : false;

		if ( $link ) {
			$block['attrs']['linkDestination'] = $link === 'media' ? 'media' : 'custom';
		}

		$settings['image'] = $image;

		$inner_content = $this->get_block_html( $settings );

		$block['innerContent'] = [ $inner_content ];

		return $block;
	}

	/**
	 * Not done yet: Custom block alt & caption strings have to be extracted from $block['innerHTML']
	 */
	public function convert_block_to_element_settings( $block, $attributes ) {
		$element_settings = [];

		$image_id   = isset( $attributes['id'] ) ? intval( $attributes['id'] ) : 0;
		$image_size = isset( $attributes['sizeSlug'] ) ? $attributes['sizeSlug'] : BRICKS_DEFAULT_IMAGE_SIZE;
		$image_url  = wp_get_attachment_image_src( $image_id, $image_size );

		if ( is_array( $image_url ) && isset( $image_url[0] ) ) {
			$image_url = $image_url[0];
		}

		// External URL
		if ( ! $image_id ) {
			preg_match_all( '#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $block['innerHTML'], $match );

			$image_url = isset( $match[0] ) ? $match[0] : false;

			if ( is_array( $image_url ) && isset( $image_url[0] ) ) {
				$image_url = $image_url[0];
			}

			$element_settings['image'] = [
				'external' => true,
				'url'      => $image_url,
				'filename' => basename( $image_url ),
				'full'     => $image_url,
				'size'     => $image_size,
			];
		}

		// WordPress image
		if ( $image_id && $image_url ) {
			$element_settings['image'] = [
				'id'       => $image_id,
				'filename' => basename( get_attached_file( $image_id ) ),
				'full'     => wp_get_attachment_image_src( $image_id, 'full' ),
				'size'     => $image_size,
				'url'      => $image_url,
			];
		}

		return $element_settings;
	}
}
