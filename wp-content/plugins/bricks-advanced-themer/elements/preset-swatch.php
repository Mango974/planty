<?php 

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Advanced_Themer_Preset_Swatch extends \Bricks\Element {
  // Element properties
  public $category     = 'advanced themer'; // Use predefined element category 'general'
  public $name         = 'brxc-preset-swatch'; // Make sure to prefix your elements
  public $icon         = 'ion-md-color-fill'; // Themify icon font class
  public $css_selector = ''; // Default CSS selector
  public $scripts      = ['']; // Script(s) run when element is rendered on frontend or updated in builder

  // Return localised element label
  public function get_label() {
    return esc_html__( 'Preset Swatch', 'bricks' );
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

  private function get_color_list() {

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

          if ( have_rows( 'brxc_colors_repeater') ) :

            while ( have_rows( 'brxc_colors_repeater') ) :
      
                the_row();
      
                $label = get_sub_field( 'brxc_color_label');
      
                $arr[$label] = $label; 
            
            endwhile;
      
          endif;

          $post = $backup;

      endwhile;
    
    endif;

    wp_reset_postdata();

    return $arr;

  }
  
  // Set builder controls
  public function set_controls() {

    $this->controls['presetRepeater'] = [
      'tab' => 'content',
      'label' => esc_html__( 'Color Presets', 'bricks' ),
      'type' => 'repeater',
      'titleProperty' => 'title', // Default 'title'

      'placeholder' => esc_html__( 'Preset Color', 'bricks' ),
      'fields' => [
        'label' => [
          'label' => esc_html__( 'Label', 'bricks' ),
          'type' => 'text',
          'inline' => true,
        ],
        'colors' => [
          'label' => esc_html__( 'Colors', 'bricks' ),
          'type' => 'repeater',
          'fields' => [
            'title' => [
              'label' => esc_html__( 'Target Color', 'bricks' ),
              'type' => 'select',
              'options' => self::get_color_list(),
              'multiple' => true, 
              'searchable' => true,
              'clearable' => true,
              'inline' => true,
            ],
            'color' => [
              'label' => esc_html__( 'Hex Color', 'bricks' ),
              'type' => 'color',
            ],
          ],
        ],
      ],
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
          'selector' => '.brxc-preset-swatch__color-container',
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
          'selector' => '.brxc-preset-swatch__color-container',
				],
			],
      'default'   => '5rem',
      'placeholder' => '5rem',
		];

    $this->controls['inputGradientDeg'] = [
			'tab'      => 'content',
			'label'    => esc_html__( 'Gradient orientation (in DEG)', 'bricks' ),
      'group'     => 'inputs',
			'type'     => 'number',
			'units'    => true,
      'units'    => 'deg',
      'default'   => '90deg',
      'placeholder' => '90deg',
		];

    $this->controls['inputBorderRadius'] = [
			'tab'      => 'content',
			'label'    => esc_html__( 'Border', 'bricks' ),
      'group'     => 'inputs',
			'type'     => 'border',
			'css'      => [
				[
					'property' => 'border',
          'selector' => '.brxc-preset-swatch__color-container',
				],
        [
					'property' => 'border',
          'selector' => '.brxc-preset-swatch__color',
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
          'selector' => '.brxc-preset-swatch__color-container',
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
          'selector' => '.brxc-preset-swatch__color-container',
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
          'selector' => '.brxc-preset-swatch__color-container',
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
    wp_enqueue_script( 'brxc-preset-swatch' );
    wp_enqueue_style( 'brxc-preset-swatch' );
  }

  // Render element HTML
  public function render() {

    // Set element attributes
    $root_classes[] = '';

    $this->set_attribute( '_root', 'class', $root_classes );

    $post_id_arr = isset( $this->settings['presetRepeater'] ) ? $this->settings['presetRepeater'] : '';

    $label_cb = isset( $this->settings['labelsCheckbox']) ? $this->settings['labelsCheckbox'] : false;

    $label_tag = isset( $this->settings['labelsTag'] ) ? $this->settings['labelsTag'] : 'h5';

    $gradient_deg = isset( $this->settings['inputGradientDeg'] ) ? $this->settings['inputGradientDeg'] : '90deg';

    $args = array(
      'post_type'      => 'brxc_color_palette',
      'posts_per_page' => -1,
      'post_status'    => 'publish',
    );
    
    $query = new WP_Query($args);

    $arr = [];

    if ( is_array( $post_id_arr ) && count(  $post_id_arr ) ) {

      $index = 0;

      foreach ( $post_id_arr as $preset ){

        if ( $query->have_posts() ) :

          while ( $query->have_posts() ) :
      
              $query->the_post();

              global $post;
              
              $backup = $post;

              $prefix = get_field('brxc_variable_prefix');

              if ( have_rows( 'brxc_colors_repeater') ) :

                while ( have_rows( 'brxc_colors_repeater') ) :
          
                    the_row();
          
                    $label = get_sub_field( 'brxc_color_label');
                    //var_dump($preset['colors'][$index]['title']);
                    foreach($preset['colors'] as $rows){
                      
                      //var_dump($rows['color']['hex']);

                      if(is_array($preset) && in_array($label, $rows['title'])){

                        if ( isset( $rows['color']['raw']) && $rows['color']['raw'] ){

                          $arr[$index][] = [strtolower( preg_replace( '/\s+/', '-', $prefix ) ), strtolower( preg_replace( '/\s+/', '-', $label ) ), $rows['color']['raw']];
            
                        } elseif ( isset( $rows['color']['hex']) && $rows['color']['hex'] ){
            
                          $arr[$index][] = [strtolower( preg_replace( '/\s+/', '-', $prefix ) ), strtolower( preg_replace( '/\s+/', '-', $label ) ), $rows['color']['hex']];
            
                        } elseif ( isset( $rows['color']['rgb']) && $rows['color']['rgb'] ){
            
                          $arr[$index][] = [strtolower( preg_replace( '/\s+/', '-', $prefix ) ), strtolower( preg_replace( '/\s+/', '-', $label ) ), $rows['color']['rgb']];
            
                        } else {
            
                          $arr[$index][] = [strtolower( preg_replace( '/\s+/', '-', $prefix ) ), strtolower( preg_replace( '/\s+/', '-', $label ) ), $rows['color']['hsl']];
            
                        }
  
                      }

                    }
          
                endwhile;
          
              endif;

              $post = $backup;

          endwhile;
        
        endif;

        $query->rewind_posts();

        $index++;
      
      }
    
    }

    
    
    echo "<div {$this->render_attributes( '_root' )}>";

      if ( is_array( $post_id_arr ) && count(  $post_id_arr ) ) {

        $index = 0;

        foreach ( $post_id_arr as $preset ){

          $count = count($preset['colors']);

          $step = 100 / $count;

          $percent = 0;

          echo '<div class="brxc-preset-swatch__wrapper" data-target=' . json_encode($arr[$index]). '><div class="brxc-preset-swatch__color-container"><div style="background-image:linear-gradient(' . $gradient_deg;

          foreach ( $preset['colors'] as $color){

            if ( isset( $color['color']['raw']) && $color['color']['raw'] ){

              echo ',' . $color['color']['raw'] . ' ' . $percent . '% ';

            } elseif ( isset( $color['color']['hex']) && $color['color']['hex'] ){

              echo ',' . $color['color']['hex'] . ' ' . $percent . '% ';

            } elseif ( isset( $color['color']['rgb']) && $color['color']['rgb'] ){

              echo ',' . $color['color']['rgb'] . ' ' . $percent . '% ';

            } elseif ( isset( $color['color']['hsl']) && $color['color']['hsl'] ) {

              echo ',' . $color['color']['hsl'] . ' ' . $percent . '% ';

            }

            $percent = $percent + $step;

            echo $percent . '%';

          }

          echo ')" class="brxc-preset-swatch__color"></div></div>';

          echo ($label_cb) ? '<' . $label_tag . ' class="brxc-style-guide__label">' . $preset['label'] . '</' . $label_tag . '>' : '';

          echo '</div>';

          $index++;

        }

      } else {

        return $this->render_element_placeholder( [ 'title' => esc_html__( 'No Preset Colors selected.', 'bricks' ) ] );

      }
    
    echo "</div>";

    wp_reset_postdata();

  }
}