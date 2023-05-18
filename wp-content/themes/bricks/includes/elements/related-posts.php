<?php
namespace Bricks;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Element_Related_Posts extends Element {
	public $category     = 'single';
	public $name         = 'related-posts';
	public $icon         = 'ti-pin-alt';
	public $css_selector = 'li';

	public function get_label() {
		return esc_html__( 'Related Posts', 'bricks' );
	}

	public function set_control_groups() {
		$this->control_groups['query'] = [
			'title' => esc_html__( 'Query', 'bricks' ),
			'tab'   => 'content',
		];

		$this->control_groups['layout'] = [
			'title' => esc_html__( 'Layout', 'bricks' ),
			'tab'   => 'content',
		];

		$this->control_groups['fields'] = [
			'title' => esc_html__( 'Fields', 'bricks' ),
			'tab'   => 'content',
		];

		$this->control_groups['image'] = [
			'title' => esc_html__( 'Image', 'bricks' ),
			'tab'   => 'content',
		];

		$this->control_groups['content'] = [
			'title' => esc_html__( 'Content', 'bricks' ),
			'tab'   => 'content',
		];
	}

	public function set_controls() {
		// QUERY
		$this->controls['post_type'] = [
			'tab'         => 'content',
			'group'       => 'query',
			'label'       => esc_html__( 'Post type', 'bricks' ),
			'type'        => 'select',
			'options'     => bricks_is_builder() ? Helpers::get_registered_post_types() : [],
			'clearable'   => true,
			'inline'      => true,
			'placeholder' => esc_html__( 'Default', 'bricks' ),
		];

		$this->controls['count'] = [
			'tab'         => 'content',
			'group'       => 'query',
			'label'       => esc_html__( 'Max. related posts', 'bricks' ),
			'type'        => 'number',
			'min'         => 1,
			'max'         => 4,
			'placeholder' => 3,
		];

		$this->controls['order'] = [
			'tab'         => 'content',
			'group'       => 'query',
			'label'       => esc_html__( 'Order', 'bricks' ),
			'type'        => 'select',
			'options'     => $this->control_options['queryOrder'],
			'inline'      => true,
			'placeholder' => esc_html__( 'Descending', 'bricks' ),
		];

		$this->controls['orderby'] = [
			'tab'         => 'content',
			'group'       => 'query',
			'label'       => esc_html__( 'Order by', 'bricks' ),
			'type'        => 'select',
			'options'     => $this->control_options['queryOrderBy'],
			'inline'      => true,
			'placeholder' => esc_html__( 'Random', 'bricks' ),
		];

		$this->controls['taxonomies'] = [
			'tab'         => 'content',
			'group'       => 'query',
			'label'       => esc_html__( 'Common taxonomies', 'bricks' ),
			'type'        => 'select',
			'options'     => Setup::$control_options['taxonomies'],
			'multiple'    => true,
			'default'     => [
				'category',
				'post_tag'
			],
			'description' => esc_html__( 'Taxonomies related posts must have in common.', 'bricks' ),
		];

		// LAYOUT

		$this->controls['gap'] = [
			'tab'         => 'content',
			'group'       => 'layout',
			'label'       => esc_html__( 'Gap', 'bricks' ),
			'type'        => 'number',
			'units'       => true,
			'css'         => [
				[
					'property' => 'gap',
					'selector' => '',
				],
			],
			'placeholder' => '30px',
		];

		$this->controls['columns'] = [
			'tab'         => 'content',
			'group'       => 'layout',
			'label'       => esc_html__( 'Posts per row', 'bricks' ),
			'type'        => 'number',
			'min'         => 1,
			'max'         => 6,
			'css'         => [
				[
					'selector' => '',
					'property' => 'grid-template-columns',
					'value'    => 'repeat(%s, 1fr)', // NOTE: Undocumented (@since 1.3)
				],
				[
					'selector' => '',
					'property' => 'grid-auto-flow',
					'value'    => 'unset',
				],
			],
			'placeholder' => 3,
		];

		// FIELDS

		$this->controls['content'] = [
			'tab'           => 'content',
			'group'         => 'fields',
			'type'          => 'repeater',
			'selector'      => 'fieldId',
			'titleProperty' => 'dynamicData',
			'default'       => [
				[
					'dynamicData'   => '{post_title:link}',
					'tag'           => 'h3',
					'dynamicMargin' => [
						'top' => 10,
					],
					'id'            => Helpers::generate_random_id( false ),
				],
				[
					'dynamicData' => '{post_date}',
					'id'          => Helpers::generate_random_id( false ),
				],
				[
					'dynamicData'   => '{post_excerpt:20}',
					'dynamicMargin' => [
						'top' => 10,
					],
					'id'            => Helpers::generate_random_id( false ),
				],
			],
			'fields'        => [
				'dynamicData'       => [
					'label' => esc_html__( 'Dynamic data', 'bricks' ),
					'type'  => 'text',
				],

				'tag'               => [
					'label'       => esc_html__( 'HTML tag', 'bricks' ),
					'type'        => 'select',
					'options'     => [
						'div' => 'div',
						'p'   => 'p',
						'h1'  => 'h1',
						'h2'  => 'h2',
						'h3'  => 'h3',
						'h4'  => 'h4',
						'h5'  => 'h5',
						'h6'  => 'h6',
					],
					'inline'      => true,
					'placeholder' => 'div',
				],

				'dynamicMargin'     => [
					'label' => esc_html__( 'Margin', 'bricks' ),
					'type'  => 'spacing',
					'css'   => [
						[
							'property' => 'margin',
						],
					],
				],

				'dynamicPadding'    => [
					'label' => esc_html__( 'Padding', 'bricks' ),
					'type'  => 'spacing',
					'css'   => [
						[
							'property' => 'padding',
						],
					],
				],

				'dynamicBackground' => [
					'label' => esc_html__( 'Background color', 'bricks' ),
					'type'  => 'color',
					'css'   => [
						[
							'property' => 'background-color',
						],
					],
				],

				'dynamicBorder'     => [
					'label' => esc_html__( 'Border', 'bricks' ),
					'type'  => 'border',
					'css'   => [
						[
							'property' => 'border',
						],
					],
				],

				'dynamicTypography' => [
					'label' => esc_html__( 'Typography', 'bricks' ),
					'type'  => 'typography',
					'css'   => [
						[
							'property' => 'font',
						],
					],
				],
			],
		];

		// IMAGE

		$this->controls['noImage'] = [
			'tab'   => 'content',
			'group' => 'image',
			'label' => esc_html__( 'Disable', 'bricks' ),
			'type'  => 'checkbox',
		];

		$this->controls['imageSize'] = [
			'tab'         => 'content',
			'group'       => 'image',
			'label'       => esc_html__( 'Image size', 'bricks' ),
			'type'        => 'select',
			'options'     => $this->control_options['imageSizes'],
			'inline'      => true,
			'placeholder' => esc_html__( 'Default', 'bricks' ),
			'required'    => [ 'noImage', '=', '' ],
		];

		$this->controls['imagePosition'] = [
			'tab'         => 'content',
			'group'       => 'image',
			'label'       => esc_html__( 'Position', 'bricks' ),
			'type'        => 'select',
			'options'     => [
				'top'    => esc_html__( 'Top', 'bricks' ),
				'right'  => esc_html__( 'Right', 'bricks' ),
				'bottom' => esc_html__( 'Bottom', 'bricks' ),
				'left'   => esc_html__( 'Left', 'bricks' ),
			],
			'inline'      => true,
			'placeholder' => esc_html__( 'Top', 'bricks' ),
			'required'    => [ 'noImage', '=', '' ],
		];

		$this->controls['imageHeight'] = [
			'tab'      => 'content',
			'group'    => 'image',
			'label'    => esc_html__( 'Height', 'bricks' ),
			'type'     => 'number',
			'units'    => true,
			'small'    => false,
			'css'      => [
				[
					'property' => 'height',
					'selector' => '.post-thumbnail-wrapper',
				],
				[
					'property' => 'padding-top',
					'selector' => '.post-thumbnail-wrapper',
				],
			],
			'required' => [ 'noImage', '=', '' ],
		];

		$this->controls['imageWidth'] = [
			'tab'      => 'content',
			'group'    => 'image',
			'label'    => esc_html__( 'Width', 'bricks' ),
			'type'     => 'number',
			'units'    => true,
			'small'    => false,
			'css'      => [
				[
					'property' => 'width',
					'selector' => '.post-thumbnail-wrapper',
				],
			],
			'required' => [ 'noImage', '=', '' ],
		];

		$this->controls['imageMargin'] = [
			'tab'      => 'content',
			'group'    => 'image',
			'label'    => esc_html__( 'Margin', 'bricks' ),
			'type'     => 'spacing',
			'css'      => [
				[
					'property' => 'margin',
					'selector' => '.post-thumbnail-wrapper',
				],
			],
			'required' => [ 'noImage', '=', '' ],
		];

		// CONTENT

		$this->controls['contentWidth'] = [
			'tab'   => 'content',
			'group' => 'content',
			'label' => esc_html__( 'Width', 'bricks' ),
			'type'  => 'number',
			'units' => true,
			'css'   => [
				[
					'property' => 'width',
					'selector' => '.post-content',
				],
			],
		];

		$this->controls['contentPadding'] = [
			'tab'   => 'content',
			'group' => 'content',
			'label' => esc_html__( 'Padding', 'bricks' ),
			'type'  => 'spacing',
			'css'   => [
				[
					'property' => 'padding',
					'selector' => '.post-content',
				],
			],
		];

		$this->controls['contentBackground'] = [
			'tab'   => 'content',
			'group' => 'content',
			'label' => esc_html__( 'Background color', 'bricks' ),
			'type'  => 'color',
			'css'   => [
				[
					'property' => 'background-color',
					'selector' => '.post-content',
				],
			],
		];

		$this->controls['overlay'] = [
			'tab'   => 'content',
			'group' => 'content',
			'label' => esc_html__( 'Overlay content', 'bricks' ),
			'type'  => 'checkbox',
		];

		$this->controls['overlayAlignItems'] = [
			'tab'      => 'content',
			'group'    => 'content',
			'label'    => esc_html__( 'Horizontal alignment', 'bricks' ),
			'type'     => 'align-items',
			'exclude'  => 'stretch',
			'css'      => [
				[
					'property' => 'align-items',
					'selector' => '.post-content',
				],
			],
			'required' => [ 'overlay', '!=', '' ],
		];

		$this->controls['overlayJustifyContent'] = [
			'tab'      => 'content',
			'group'    => 'content',
			'label'    => esc_html__( 'Vertical alignment', 'bricks' ),
			'type'     => 'justify-content',
			'exclude'  => 'space',
			'css'      => [
				[
					'property' => 'justify-content',
					'selector' => '.post-content',
				],
			],
			'required' => [ 'overlay', '!=', '' ],
		];
	}

	public function render() {
		$settings = $this->settings;
		$post_id  = $this->post_id;

		global $post;

		$post = get_post( $post_id );

		$args = [
			'posts_per_page' => isset( $settings['count'] ) ? $settings['count'] : 3,
			'post__not_in'   => [ $post_id ],
			'no_found_rows'  => true, // No pagination
			'orderby'        => isset( $settings['orderby'] ) ? $settings['orderby'] : 'rand',
			'order'          => isset( $settings['order'] ) ? $settings['order'] : 'DESC',
		];

		if ( ! empty( $settings['post_type'] ) ) {
			$args['post_type'] = $settings['post_type'];
		}

		$taxonomies = ! empty( $settings['taxonomies'] ) ? $settings['taxonomies'] : [];

		foreach ( $taxonomies as $taxonomy ) {
			$terms_ids = wp_get_post_terms(
				$post_id,
				$taxonomy,
				[ 'fields' => 'ids' ]
			);

			if ( ! empty( $terms_ids ) ) {
				$args['tax_query'][] = [
					'taxonomy' => $taxonomy,
					'field'    => 'term_id',
					'terms'    => $terms_ids,
				];
			}
		}

		if ( count( $taxonomies ) > 1 && isset( $args['tax_query'] ) ) {
			$args['tax_query']['relation'] = 'OR';
		}

		$root_classes = [ 'bricks-related-posts' ];

		if ( isset( $settings['overlay'] ) ) {
			$root_classes[] = 'overlay';
		}

		if ( ! isset( $settings['noImage'] ) && isset( $settings['imagePosition'] ) ) {
			$root_classes[] = "image-{$settings['imagePosition']}";
		}

		$this->set_attribute( '_root', 'class', $root_classes );

		$args['post_status'] = 'publish';

		// NOTE: Undocumented
		$args = apply_filters( 'bricks/related_posts/query_vars', $args, $settings );

		$related_posts_query = new \WP_Query( $args );

		$content_fields = empty( $settings['content'] ) ? false : $settings['content'];
		$image_size     = empty( $settings['imageSize'] ) ? 'medium' : $settings['imageSize'];

		if ( $related_posts_query->post_count && ( $content_fields || ! isset( $settings['noImage'] ) ) ) {
			echo "<ul {$this->render_attributes( '_root' )}>";

			global $post;

			foreach ( $related_posts_query->posts as $post ) {
				setup_postdata( $post );

				echo '<li class="repeater-item">';

				// Image
				if ( ! isset( $settings['noImage'] ) ) {
					echo '<a href="' . get_the_permalink() . '" class="post-thumbnail-wrapper css-filter">';

					if ( has_post_thumbnail() ) {
						echo '<div class="post-thumbnail-inner" role="img" aria-label="' . get_post_meta( get_post_thumbnail_id( $post->ID ), '_wp_attachment_image_alt', true ) . '" style="background-image: url(' . esc_url( get_the_post_thumbnail_url( get_the_ID(), $image_size ) ) . ')"></div>';
					}

					echo '</a>';
				}

				// Content
				if ( is_array( $content_fields ) && count( $content_fields ) ) {
					echo '<div class="post-content">' . Frontend::get_content_wrapper( $settings, $content_fields, $post ) . '</div>';
				}

				echo '</li>';
			}

			echo '</ul>';

			wp_reset_postdata();
		} else {
			return $this->render_element_placeholder( [ 'title' => esc_html__( 'This post has no related posts.', 'bricks' ) ] );
		}
	}
}
