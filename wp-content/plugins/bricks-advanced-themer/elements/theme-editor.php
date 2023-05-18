<?php 

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Advanced_Themer_Theme_Editor extends \Bricks\Element {
  // Element properties
  public $category     = 'advanced themer'; // Use predefined element category 'general'
  public $name         = 'brxc-theme-editor'; // Make sure to prefix your elements
  public $icon         = 'fas fa-swatchbook'; // Themify icon font class
  public $css_selector = ''; // Default CSS selector
  public $scripts      = ['']; // Script(s) run when element is rendered on frontend or updated in builder

  // Return localised element label
  public function get_label() {
    return esc_html__( 'Theme Editor', 'bricks' );
  }

  // Set builder control groups
  public function set_control_groups() {
    $this->control_groups['wrapper'] = [ // Unique group identifier (lowercase, no spaces)
      'title' => esc_html__( 'Wrapper', 'bricks' ), // Localized control group title
      'tab' => 'content', // Set to either "content" or "style"
    ];

    $this->control_groups['inputs'] = [ // Unique group identifier (lowercase, no spaces)
      'title' => esc_html__( 'Color Inputs', 'bricks' ), // Localized control group title
      'tab' => 'content', // Set to either "content" or "style"
    ];

    $this->control_groups['labels'] = [ // Unique group identifier (lowercase, no spaces)
      'title' => esc_html__( 'Labels', 'bricks' ), // Localized control group title
      'tab' => 'content', // Set to either "content" or "style"
    ];

  }

  private function get_color_palette_list() {

    $args = array(
      'post_type'      => 'brxc_color_palette',
      'posts_per_page' => -1,
      'post_status'    => 'publish',
    );
    
    $query = new WP_Query($args);

    $arr = [];

    if ( $query->have_posts() ) :

      while ( $query->have_posts() ) :
  
          $query->the_post();

          global $post;
          
          $backup = $post;

          $arr[get_the_ID()] =  get_the_title(); 

          $post = $backup;

      endwhile;
    
    endif;

    wp_reset_postdata();

    return $arr;

  }
  
  // Set builder controls
  public function set_controls() {

    $this->controls['colorPaletteSelect'] = [
      'tab' => 'content',
      'label' => esc_html__( 'Color Palette', 'bricks' ),
      'type' => 'select',
      'options' => self::get_color_palette_list(),
      'inline' => true,
      'placeholder' => esc_html__( 'Select the Color Palette', 'bricks' ),
      'multiple' => true, 
      'searchable' => true,
      'clearable' => true,
    ];

    $this->controls['_display'] = [
			'tab'       => 'content',
			'label'     => esc_html__( 'Display', 'bricks' ),
      'group'     => 'wrapper',
			'type'      => 'select',
			'options'   => [
				'flex'         => 'flex',
				'block'        => 'block',
				'inline-block' => 'inline-block',
				'inline'       => 'inline',
				'none'         => 'none',
			],
			'inline'    => true,
      'default'   => 'flex',
      'placeholder' => 'flex',
			'lowercase' => true,
			'css'       => [
				[
					'property' => 'display',
					'selector' => '',
				],
			],
		];

    $this->controls['_flexWrap'] = [
			'tab'      => 'content',
			'label'    => esc_html__( 'Flex wrap', 'bricks' ),
      'group'     => 'wrapper',
			'tooltip'  => [
				'content'  => 'flex-wrap',
				'position' => 'top-left',
			],
			'type'     => 'select',
			'options'  => [
          'wrap' => 'Wrap',
          'nowrap' => 'No wrap',
      ],
			'inline'   => true,
			'css'      => [
				[
					'property' => 'flex-wrap',
				],
			],
			'required' => [ '_display', '=', 'flex' ],
      'default'   => 'nowrap',
      'placeholder' => 'No Wrap',
		];


    $this->controls['directionPaletteSelect'] = [ // Setting key
      'tab'   => 'content',
      'label' => esc_html__( 'Direction', 'bricks' ),
      'group'     => 'wrapper',
      'type'  => 'direction',
      'css'   => [
        [
          'property' => 'flex-direction',
          'selector' => '',
        ],
      ],
      'required' => [ '_display', '=', 'flex' ],
    ];

    $this->controls['justifyContentPaletteSelect'] = [
      'tab'   => 'content',
      'label' => esc_html__( 'Justify content', 'bricks' ),
      'group'     => 'wrapper',
      'type'  => 'justify-content',
      'css'   => [
        [
          'property' => 'justify-content',
          'selector' => '',
        ],
      ],
      'required' => [ '_display', '=', 'flex' ],
    ];

    $this->controls['alignItemsPaletteSelect'] = [ // Setting key
      'tab'   => 'content',
      'label' => esc_html__( 'Align items', 'bricks' ),
      'group'     => 'wrapper',
      'type'  => 'align-items',
      'css'   => [
        [
          'property' => 'align-items',
          'selector' => '',
        ],
      ],
      'required' => [ '_display', '=', 'flex' ],
    ];

    $this->controls['_columnGap'] = [
			'tab'      => 'content',
			'label'    => esc_html__( 'Column gap', 'bricks' ),
      'group'     => 'wrapper',
			'type'     => 'number',
			'units'    => true,
			'css'      => [
				[
					'property' => 'column-gap',
				],
			],
			'info'     => sprintf( __( 'Current browser support: %s (no IE). Use margins for max. browser support.', 'bricks' ), '89%' ),
			'required' => [ '_display', '=', 'flex' ],
		];

		$this->controls['_rowGap'] = [
			'tab'      => 'content',
			'label'    => esc_html__( 'Row gap', 'bricks' ),
      'group'     => 'wrapper',
			'type'     => 'number',
			'units'    => true,
			'css'      => [
				[
					'property' => 'row-gap',
				],
			],
			'info'     => sprintf( __( 'Current browser support: %s (no IE). Use margins for max. browser support.', 'bricks' ), '89%' ),
			'required' => [ '_display', '=', 'flex' ],
		];

    $this->controls['inputWidth'] = [
			'tab'      => 'content',
			'label'    => esc_html__( 'Width', 'bricks' ),
      'group'     => 'inputs',
			'type'     => 'number',
			'units'    => true,

			'css'      => [
				[
					'property' => 'width',
          'selector' => 'input[type="color"]',
				],
			],
      'default'   => '5rem',
      'placeholder' => '5rem',
		];

    $this->controls['inputHeight'] = [
			'tab'      => 'content',
			'label'    => esc_html__( 'Height', 'bricks' ),
      'group'     => 'inputs',
			'type'     => 'number',
			'units'    => true,
			'css'      => [
        [
					'property' => 'height',
          'selector' => 'input[type="color"]',
				],
			],
      'default'   => '5rem',
      'placeholder' => '5rem',
		];

    $this->controls['inputBorderRadius'] = [
			'tab'      => 'content',
			'label'    => esc_html__( 'Border', 'bricks' ),
      'group'     => 'inputs',
			'type'     => 'border',
			'css'      => [
				[
					'property' => 'border',
          'selector' => 'input[type="color"]',
				],
        [
					'property' => 'border',
          'selector' => 'input[type="color"]::-webkit-color-swatch',
				],
			],
      'inline' => true,
      'small' => true,
		];

    $this->controls['inputBoxShadow'] = [
      'tab' => 'content',
      'label' => esc_html__( 'Box Shadow', 'bricks' ),
      'group'     => 'inputs',
      'type' => 'box-shadow',
      'css' => [
        [
          'property' => 'box-shadow',
          'selector' => 'input[type="color"]',
        ],
      ],
      'inline' => true,
      'small' => true,
    ];

    $this->controls['inputMargins'] = [
      'tab' => 'content',
      'label' => esc_html__( 'Margin', 'bricks' ),
      'group'     => 'inputs',
      'type' => 'dimensions',
      'css' => [
        [
          'property' => 'margin',
          'selector' => 'input[type="color"]',
        ]
      ],
    ];

    $this->controls['inputPaddings'] = [
      'tab' => 'content',
      'label' => esc_html__( 'Padding', 'bricks' ),
      'group'     => 'inputs',
      'type' => 'dimensions',
      'css' => [
        [
          'property' => 'padding',
          'selector' => 'input[type="color"]',
        ]
      ],
    ];

    // Labels

    $this->controls['labelsCheckbox'] = [
      'tab' => 'content',
      'label' => esc_html__( 'Show Color Title', 'bricks' ),
      'group'     => 'labels',
      'type' => 'checkbox',
      'inline' => true,
      'small' => true,
      'default' => true,
    ];

    $this->controls['labelsTag'] = [
      'tab' => 'content',
      'label' => esc_html__( 'Title tag', 'bricks' ),
      'group'     => 'labels',
      'type' => 'select',
      'options' => [
        'h1' => 'H1',
        'h2' => 'H2',
        'h3' => 'H3',
        'h4' => 'H4',
        'h5' => 'H5',
        'h6' => 'H6',
        'span' => 'SPAN',
        'label' => 'LABEL',
      ],
      'inline' => true,
      'placeholder' => esc_html__( 'Select tag', 'bricks' ),
      'multiple' => false, 
      'searchable' => true,
      'default' => 'h5',
      'required' => [ 'labelsCheckbox', '=', true ],
    ];

    $this->controls['labelsTypography'] = [
      'tab' => 'content',
      'label' => esc_html__( 'Typography', 'bricks' ),
      'group'     => 'labels',
      'type' => 'typography',
      'css' => [
        [
          'property' => 'typography',
          'selector' => '.brxc-style-guide__label',
        ],
      ],
      'inline' => true,
      'required' => [ 'labelsCheckbox', '=', true ],
    ];

    $this->controls['labelsMargin'] = [
      'tab' => 'content',
      'label' => esc_html__( 'Title Margin', 'bricks' ),
      'group'     => 'labels',
      'type' => 'dimensions',
      'css' => [
        [
          'property' => 'margin',
          'selector' => '.brxc-style-guide__label',
        ]
      ],
      'required' => [ 'labelsCheckbox', '=', true ],
    ];

    $this->controls['labelsPadding'] = [
      'tab' => 'content',
      'label' => esc_html__( 'Title Padding', 'bricks' ),
      'group'     => 'labels',
      'type' => 'dimensions',
      'css' => [
        [
          'property' => 'padding',
          'selector' => '.brxc-style-guide__label',
        ]
      ],
      'required' => [ 'labelsCheckbox', '=', true ],
    ];

  }


  // Enqueue element styles and scripts
  public function enqueue_scripts() {
    wp_enqueue_script( 'brxc-theme-editor' );
    wp_enqueue_style( 'brxc-theme-editor' );
  }

  // Render element HTML
  public function render() {

    // Set element attributes
    $root_classes[] = '';

    $this->set_attribute( '_root', 'class', $root_classes );

    $post_id_arr = isset( $this->settings['colorPaletteSelect'] ) ? $this->settings['colorPaletteSelect'] : '';

    $label_cb = isset( $this->settings['labelsCheckbox']) ? $this->settings['labelsCheckbox'] : false;

    $label_tag = isset( $this->settings['labelsTag'] ) ? $this->settings['labelsTag'] : 'label';

    echo "<div {$this->render_attributes( '_root' )}>";

    if ( is_array( $post_id_arr ) && count(  $post_id_arr ) ) {

      foreach ($post_id_arr as $post_id){

        $prefix = get_field('brxc_variable_prefix', $post_id);

        if ( have_rows( 'brxc_colors_repeater', $post_id ) ) :

          while ( have_rows( 'brxc_colors_repeater', $post_id ) ) :
    
              the_row();
    
              $acf = get_sub_field( 'brxc_color_hex', $post_id );
    
              $label = get_sub_field( 'brxc_color_label', $post_id);
    
              echo '<div class="brxc-theme-editor__color-container"><input type="color" value="' . sanitize_hex_color($acf) . '" class="brxc-theme-editor__color" data-label="' . strtolower( preg_replace( '/\s+/', '-', $label ) ) . '" data-prefix="' . strtolower( preg_replace( '/\s+/', '-', $prefix ) ) . '">';

              echo ($label_cb) ? '<' . $label_tag . ' class="brxc-style-guide__label">' . $label . '</' . $label_tag . '>' : '';

              echo '</div>';


          
          endwhile;
    
        endif;

      }

    } else {

      return $this->render_element_placeholder( [ 'title' => esc_html__( 'No Color Palette selected.', 'bricks' ) ] );

    }

    echo '</div>';

  }
}