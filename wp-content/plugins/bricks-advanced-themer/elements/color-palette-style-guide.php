<?php 

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Advanced_Themer_Color_Palette_Style_Guide extends \Bricks\Element {
  // Element properties
  public $category     = 'advanced themer'; // Use predefined element category 'general'
  public $name         = 'brxc-color-palette-style-guide'; // Make sure to prefix your elements
  public $icon         = 'ti-ruler-pencil'; // Themify icon font class
  public $css_selector = ''; // Default CSS selector
  public $scripts      = ['']; // Script(s) run when element is rendered on frontend or updated in builder

  // Return localised element label
  public function get_label() {
    return esc_html__( 'Color Palette Style Guide', 'bricks' );
  }

  // Set builder control groups
  public function set_control_groups() {
    $this->control_groups['general'] = [ // Unique group identifier (lowercase, no spaces)
      'title' => esc_html__( 'General', 'bricks' ), // Localized control group title
      'tab' => 'content', // Set to either "content" or "style"
    ];

    $this->control_groups['colors'] = [ // Unique group identifier (lowercase, no spaces)
      'title' => esc_html__( 'Color Wrapper', 'bricks' ), // Localized control group title
      'tab' => 'content', // Set to either "content" or "style"
    ];

    $this->control_groups['colorsShape'] = [ // Unique group identifier (lowercase, no spaces)
      'title' => esc_html__( 'Color Shape', 'bricks' ), // Localized control group title
      'tab' => 'content', // Set to either "content" or "style"
    ];

    $this->control_groups['colorsTitle'] = [ // Unique group identifier (lowercase, no spaces)
      'title' => esc_html__( 'Color Title', 'bricks' ), // Localized control group title
      'tab' => 'content', // Set to either "content" or "style"
    ];


    $this->control_groups['colorsHex'] = [ // Unique group identifier (lowercase, no spaces)
      'title' => esc_html__( 'Hex Value', 'bricks' ), // Localized control group title
      'tab' => 'content', // Set to either "content" or "style"
    ];

    $this->control_groups['colorsShades'] = [ // Unique group identifier (lowercase, no spaces)
      'title' => esc_html__( 'Shades', 'bricks' ), // Localized control group title
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
      //'default' => 'h3',
    ];
    $this->controls['layoutSelect'] = [
      'tab' => 'content',
      'label' => esc_html__( 'Layout', 'bricks' ),
      'group'     => 'general',
      'type' => 'select',
      'options' => [
				'vertical'   => 'Vertical',
				'horizontal' => 'Horizontal',
			],
      'inline' => true,
      'default' => 'vertical',
      'placeholder' => esc_html__( 'Vertical', 'bricks' ),
      'multiple' => false, 
      'searchable' => false,
      'clearable' => true,
    ];

    $this->controls['layoutColumns'] = [
			'tab'      => 'content',
			'label'    => esc_html__( 'Columns', 'bricks' ),
      'group'     => 'general',
			'type'     => 'number',
			'units'    => false,
			'css'      => [
				[
					'property' => '--col',
				],
			],
      'default' => 5,
      'placeholder' => '5',
		];

    

    $this->controls['_columnGap'] = [
			'tab'      => 'content',
			'label'    => esc_html__( 'Column gap', 'bricks' ),
      'group'     => 'general',
			'type'     => 'number',
			'units'    => true,
			'css'      => [
				[
					'property' => 'column-gap',
				],
			],
      'default' => '8rem',
      'placeholder' => '8rem',
			'info'     => sprintf( __( 'Current browser support: %s (no IE). Use margins for max. browser support.', 'bricks' ), '89%' ),

		];

		$this->controls['_rowGap'] = [
			'tab'      => 'content',
			'label'    => esc_html__( 'Row gap', 'bricks' ),
      'group'     => 'general',
			'type'     => 'number',
			'units'    => true,
			'css'      => [
				[
					'property' => 'row-gap',
				],
			],
      'default' => '8rem',
      'placeholder' => '8rem',
			'info'     => sprintf( __( 'Current browser support: %s (no IE). Use margins for max. browser support.', 'bricks' ), '89%' ),

		];

		$this->controls['_rowGapColors'] = [
			'tab'      => 'content',
			'label'    => esc_html__( 'Row gap', 'bricks' ),
      'group'     => 'colors',
			'type'     => 'number',
			'units'    => true,
			'css'      => [
				[
					'property' => 'row-gap',
          'selector' => '.brxc-style-guide__wrapper',
				],
			],
      'default' => '4rem',
      'placeholder' => '4rem',
			'info'     => sprintf( __( 'Current browser support: %s (no IE). Use margins for max. browser support.', 'bricks' ), '89%' ),
		];

    $this->controls['colorShapeWidth'] = [
			'tab'      => 'content',
			'label'    => esc_html__( 'Width', 'bricks' ),
      'group'     => 'colorsShape',
			'type'     => 'number',
			'units'    => true,
			'css'      => [
				[
					'property' => 'width',
          'selector' => '.brxc-style-guide__color',
				],
			],
      'default'   => '8rem',
      'placeholder' => '8rem',
		];

    $this->controls['colorShapeHeight'] = [
			'tab'      => 'content',
			'label'    => esc_html__( 'Height', 'bricks' ),
      'group'     => 'colorsShape',
			'type'     => 'number',
			'units'    => true,
			'css'      => [
        [
					'property' => 'height',
          'selector' => '.brxc-style-guide__color',
				],
			],
      'default'   => '8rem',
      'placeholder' => '8rem',
		];

    $this->controls['colorShapeBorderRadius'] = [
			'tab'      => 'content',
			'label'    => esc_html__( 'Border', 'bricks' ),
      'group'     => 'colorsShape',
			'type'     => 'border',
			'css'      => [
				[
					'property' => 'border',
          'selector' => '.brxc-style-guide__color',
				],
        [
					'property' => 'border',
          'selector' => '.brxc-color-swatch__color',
				],
			],
      'inline' => true,
      'small' => true,
		];

    $this->controls['colorShapeBoxShadow'] = [
      'tab' => 'content',
      'label' => esc_html__( 'Box Shadow', 'bricks' ),
      'group'     => 'colorsShape',
      'type' => 'box-shadow',
      'css' => [
        [
          'property' => 'box-shadow',
          'selector' => '.brxc-style-guide__color',
        ],
      ],
      'inline' => true,
      'small' => true,
    ];

    $this->controls['colorShapeMargins'] = [
      'tab' => 'content',
      'label' => esc_html__( 'Margin', 'bricks' ),
      'group'     => 'colorsShape',
      'type' => 'dimensions',
      'css' => [
        [
          'property' => 'margin',
          'selector' => '.brxc-style-guide__color',
        ]
      ],
    ];

    $this->controls['colorShapePaddings'] = [
      'tab' => 'content',
      'label' => esc_html__( 'Padding', 'bricks' ),
      'group'     => 'colorsShape',
      'type' => 'dimensions',
      'css' => [
        [
          'property' => 'padding',
          'selector' => '.brxc-style-guide__color',
        ]
      ],
    ];

    // Title Group

    $this->controls['colorTitleCheckbox'] = [
      'tab' => 'content',
      'label' => esc_html__( 'Show Color Title', 'bricks' ),
      'group'     => 'colorsTitle',
      'type' => 'checkbox',
      'inline' => true,
      'small' => true,
      'default' => true,
    ];

    $this->controls['colorTitleTag'] = [
      'tab' => 'content',
      'label' => esc_html__( 'Title tag', 'bricks' ),
      'group'     => 'colorsTitle',
      'type' => 'select',
      'options' => [
        'h1' => 'H1',
        'h2' => 'H2',
        'h3' => 'H3',
        'h4' => 'H4',
        'h5' => 'H5',
        'h6' => 'H6',
      ],
      'inline' => true,
      'placeholder' => esc_html__( 'Select tag', 'bricks' ),
      'multiple' => false, 
      'searchable' => true,
      'default' => 'h5',
      'required' => [ 'colorTitleCheckbox', '=', true ],
    ];

    $this->controls['colorTitleTypography'] = [
      'tab' => 'content',
      'label' => esc_html__( 'Typography', 'bricks' ),
      'group'     => 'colorsTitle',
      'type' => 'typography',
      'css' => [
        [
          'property' => 'typography',
          'selector' => '.brxc-style-guide__title',
        ],
      ],
      'inline' => true,
      'required' => [ 'colorTitleCheckbox', '=', true ],
    ];

    $this->controls['colorTitleMargin'] = [
      'tab' => 'content',
      'label' => esc_html__( 'Title Margin', 'bricks' ),
      'group'     => 'colorsTitle',
      'type' => 'dimensions',
      'css' => [
        [
          'property' => 'margin',
          'selector' => '.brxc-style-guide__title',
        ]
      ],
      'required' => [ 'colorTitleCheckbox', '=', true ],
    ];

    $this->controls['colorTitlePadding'] = [
      'tab' => 'content',
      'label' => esc_html__( 'Title Padding', 'bricks' ),
      'group'     => 'colorsTitle',
      'type' => 'dimensions',
      'css' => [
        [
          'property' => 'padding',
          'selector' => '.brxc-style-guide__title',
        ]
      ],
      'required' => [ 'colorTitleCheckbox', '=', true ],
    ];

    // Hex group

    // Title Group

    $this->controls['colorHexCheckbox'] = [
      'tab' => 'content',
      'label' => esc_html__( 'Show Color Hex', 'bricks' ),
      'group'     => 'colorsHex',
      'type' => 'checkbox',
      'inline' => true,
      'small' => true,
      'default' => true,
    ];

    $this->controls['colorHexTypography'] = [
      'tab' => 'content',
      'label' => esc_html__( 'Typography', 'bricks' ),
      'group'     => 'colorsHex',
      'type' => 'typography',
      'css' => [
        [
          'property' => 'typography',
          'selector' => '.brxc-style-guide__hex',
        ],
      ],
      'inline' => true,
      'required' => [ 'colorHexCheckbox', '=', true ],
    ];

    $this->controls['colorHexMargin'] = [
      'tab' => 'content',
      'label' => esc_html__( 'Hex Margin', 'bricks' ),
      'group'     => 'colorsHex',
      'type' => 'dimensions',
      'css' => [
        [
          'property' => 'margin',
          'selector' => '.brxc-style-guide__hex',
        ]
      ],
      'required' => [ 'colorHexCheckbox', '=', true ],
    ];

    $this->controls['colorHexPadding'] = [
      'tab' => 'content',
      'label' => esc_html__( 'Hex Padding', 'bricks' ),
      'group'     => 'colorsHex',
      'type' => 'dimensions',
      'css' => [
        [
          'property' => 'padding',
          'selector' => '.brxc-style-guide__hex',
        ]
      ],
      'required' => [ 'colorHexCheckbox', '=', true ],
    ];

    // Shades group

    $this->controls['colorShadesCheckbox'] = [
      'tab' => 'content',
      'label' => esc_html__( 'Show Shades', 'bricks' ),
      'group'     => 'colorsShades',
      'type' => 'checkbox',
      'inline' => true,
      'small' => true,
      'default' => false,
    ];

    $this->controls['colorShadesWidth'] = [
			'tab'      => 'content',
			'label'    => esc_html__( 'Width', 'bricks' ),
      'group'     => 'colorsShades',
			'type'     => 'number',
			'units'    => true,
			'css'      => [
				[
					'property' => 'width',
          'selector' => '.brxc-style-guide__shade',
				],
			],
      'default'   => '3rem',
      'placeholder' => '3rem',
      'required' => [ 'colorShadesCheckbox', '=', true ],
		];

    $this->controls['colorShadesHeight'] = [
			'tab'      => 'content',
			'label'    => esc_html__( 'Height', 'bricks' ),
      'group'     => 'colorsShades',
			'type'     => 'number',
			'units'    => true,
			'css'      => [
        [
					'property' => 'height',
          'selector' => '.brxc-style-guide__shade',
				],
			],
      'default'   => '3rem',
      'placeholder' => '3rem',
      'required' => [ 'colorShadesCheckbox', '=', true ],
		];

    $this->controls['colorShadesBorderRadius'] = [
			'tab'      => 'content',
			'label'    => esc_html__( 'Border', 'bricks' ),
      'group'     => 'colorsShades',
			'type'     => 'border',
			'css'      => [
				[
					'property' => 'border',
          'selector' => '.brxc-style-guide__shade',
				],
        [
					'property' => 'border',
          'selector' => '.brxc-color-swatch__color',
				],
			],
      'inline' => true,
      'small' => true,
      'required' => [ 'colorShadesCheckbox', '=', true ],
		];

    $this->controls['colorShadesBoxShadow'] = [
      'tab' => 'content',
      'label' => esc_html__( 'Box Shadow', 'bricks' ),
      'group'     => 'colorsShades',
      'type' => 'box-shadow',
      'css' => [
        [
          'property' => 'box-shadow',
          'selector' => '.brxc-style-guide__shade',
        ],
      ],
      'inline' => true,
      'small' => true,
      'required' => [ 'colorShadesCheckbox', '=', true ],
    ];

    $this->controls['colorShadesMargins'] = [
      'tab' => 'content',
      'label' => esc_html__( 'Margin', 'bricks' ),
      'group'     => 'colorsShades',
      'type' => 'dimensions',
      'css' => [
        [
          'property' => 'margin',
          'selector' => '.brxc-style-guide__shade',
        ]
      ],
      'required' => [ 'colorShadesCheckbox', '=', true ],
    ];

    $this->controls['colorShadesPaddings'] = [
      'tab' => 'content',
      'label' => esc_html__( 'Padding', 'bricks' ),
      'group'     => 'colorsShades',
      'type' => 'dimensions',
      'css' => [
        [
          'property' => 'padding',
          'selector' => '.brxc-style-guide__shade',
        ]
      ],
      'default' => [
        'top' => 0,
        'right' => 0,
        'bottom' => 0,
        'left' => 0,
      ],
      'required' => [ 'colorShadesCheckbox', '=', true ],
    ];
  }

  private function adjustBrightness( $hexCode, $adjustPercent ) {
        
    $hexCode = ltrim( sanitize_hex_color( $hexCode ), '#' );

    if ( strlen( $hexCode ) == 3 ) {

        $hexCode = $hexCode[0] . $hexCode[0] . $hexCode[1] . $hexCode[1] . $hexCode[2] . $hexCode[2];

    }

    $hexCode = array_map( 'hexdec', str_split( $hexCode, 2 ) );

    foreach ( $hexCode as & $color ) {

        $adjustableLimit = $adjustPercent < 0 ? $color : 255 - $color;

        $adjustAmount = ceil( $adjustableLimit * $adjustPercent );

        $color = str_pad( dechex ( $color + $adjustAmount ), 2, '0', STR_PAD_LEFT );

    }

    return '#' . implode( $hexCode );

}

private function returnHexArr( $hexCode, $bool ){

  $arr = [];

  if ( $bool === true ) {
    $arr[] = self::adjustBrightness( $hexCode, 0 );
    $arr[] = self::adjustBrightness( $hexCode, 0.1 );
    $arr[] = self::adjustBrightness( $hexCode, 0.2 );
    $arr[] = self::adjustBrightness( $hexCode, 0.4 );
    $arr[] = self::adjustBrightness( $hexCode, 0.6 );
    $arr[] = self::adjustBrightness( $hexCode, 0.8 );
    $arr[] = self::adjustBrightness( $hexCode, 0.9 );

  } else {
    $arr[] = self::adjustBrightness( $hexCode, 0 );
    $arr[] = self::adjustBrightness( $hexCode, -0.1 );
    $arr[] = self::adjustBrightness( $hexCode, -0.2 );
    $arr[] = self::adjustBrightness( $hexCode, -0.4 );
    $arr[] = self::adjustBrightness( $hexCode, -0.6 );
    $arr[] = self::adjustBrightness( $hexCode, -0.8 );
    $arr[] = self::adjustBrightness( $hexCode, -0.9 );

  }

  return $arr;

}

  // Enqueue element styles and scripts
  public function enqueue_scripts() {
    wp_enqueue_style( 'brxc-color-palette-style-guide' );
  }

  // Render element HTML
  public function render() {

    // Set element attributes
    $root_classes[] = '';

    $this->set_attribute( '_root', 'class', $root_classes );

    $title_cb = isset( $this->settings['colorTitleCheckbox']) ? $this->settings['colorTitleCheckbox'] : false;

    $hex_cb = isset( $this->settings['colorHexCheckbox']) ? $this->settings['colorHexCheckbox'] : false;

    $title_tag = isset( $this->settings['colorTitleTag'] ) ? $this->settings['colorTitleTag'] : 'h5';

    if(isset( $this->settings['layoutSelect'] ) ) {

      $this->set_attribute( '_root', 'class', $this->settings['layoutSelect'] );

    } else {

      $this->set_attribute( '_root', 'class', 'vertical' );
    }

    $shades_cb = isset( $this->settings['colorShadesCheckbox']) ? $this->settings['colorShadesCheckbox'] : false;

    $post_id_arr = isset( $this->settings['colorPaletteSelect'] ) ? $this->settings['colorPaletteSelect'] : '';

    echo "<div {$this->render_attributes( '_root' )}>";

    if ( is_array( $post_id_arr ) && count(  $post_id_arr ) ) {

      foreach($post_id_arr as $post_id){

        if ( have_rows( 'brxc_colors_repeater', $post_id ) ) :

          while ( have_rows( 'brxc_colors_repeater', $post_id ) ) :
    
              the_row();
    
              $acf = get_sub_field( 'brxc_color_hex', $post_id );
    
              $label = get_sub_field( 'brxc_color_label', $post_id);
    
              echo '<div class="brxc-style-guide__wrapper">';

                echo '<div class="brxc-style-guide__main-color">';

                  echo '<div class="brxc-style-guide__color" style="background-color: ' . $acf . '"></div>';

                  echo '<div class="brxc-style-guide__content-container">';

                    echo ($title_cb) ? '<' . $title_tag . ' class="brxc-style-guide__title">' . $label . '</' . $title_tag . '>' : '';

                    echo ($hex_cb) ? '<span class="brxc-style-guide__hex">' . $acf . '</span>' : '';

                  echo ' </div>';

                echo ' </div>';

                if ($shades_cb):

                  echo '<div class="brxc-style-guide__shades">';

                    echo '<div class="brxc-style-guide__shades-light">';


                    $arr = self::returnHexArr( $acf, true);

                    foreach( $arr as $color ){
                      
                      echo "<div class='brxc-style-guide__shade' style='background-color: " . $color . "'></div>";

                    }

                    echo ' </div>';

                    echo '<div class="brxc-style-guide__shades-dark">';

                    $arr = self::returnHexArr( $acf, false);

                    foreach( $arr as $color ){
                      
                      echo "<div class='brxc-style-guide__shade' style='background-color: " . $color . "'></div>";

                    }

                    echo ' </div>';

                  echo ' </div>';
                
                endif;
              
              echo ' </div>';
          
          endwhile;
    
        endif;

      } 
      
    } else {

      return $this->render_element_placeholder( [ 'title' => esc_html__( 'No Color Palette selected.', 'bricks' ) ] );

    }

    echo '</div>';

  }
}