<?php 

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Advanced_Themer_Darkmode_Toggle extends \Bricks\Element {
  // Element properties
  public $category     = 'advanced themer'; // Use predefined element category 'general'
  public $name         = 'brxc-darkmode-toggle'; // Make sure to prefix your elements
  public $icon         = 'fas fa-toggle-off'; // Themify icon font class
  public $css_selector = ''; // Default CSS selector
  public $scripts      = ['brxc-darkmode']; // Script(s) run when element is rendered on frontend or updated in builder

  // Return localised element label
  public function get_label() {
    return esc_html__( 'Darkmode Toggle', 'bricks' );
  }

  // Set builder control groups
  public function set_control_groups() {
    $this->control_groups['general'] = [ // Unique group identifier (lowercase, no spaces)
      'title' => esc_html__( 'General', 'bricks' ), // Localized control group title
      'tab' => 'content', // Set to either "content" or "style"
    ];

    $this->control_groups['sun'] = [
      'title' => esc_html__( 'Sun View', 'bricks' ),
      'tab' => 'content',
    ];

    $this->control_groups['moon'] = [
        'title' => esc_html__( 'Moon View', 'bricks' ),
        'tab' => 'content',
      ];
  }
 
  // Set builder controls
  public function set_controls() {

    $this->controls['toggleWidth'] = [
        'tab' => 'content',
        'group' => 'general',
        'label' => esc_html__( 'Wrapper Width', 'bricks' ),
        'type' => 'number',
        'units'    => true,
        'inline' => true,
        'css' => [
          [
            'property' => 'width',
            'selector' => '.brxc-toggle-slot',
          ],
        ],
        'default' => '5em',
        'placeholder' => '5em',
      ];

      $this->controls['toggleSize'] = [
        'tab' => 'content',
        'group' => 'general',
        'label' => esc_html__( 'Toggle Size', 'bricks' ),
        'type' => 'number',
        'units'    => true,
        'inline' => true,
        'css' => [
          [
            'property' => '--toggle-size',
          ],
        ],
        'default' => '35px',
        'placeholder' => '35px',
      ];

      $this->controls['togglePadding'] = [
        'tab' => 'content',
        'group' => 'general',
        'label' => esc_html__( 'Padding', 'bricks' ),
        'type' => 'number',
        'units'    => true,
        'inline' => true,
        'css' => [
          [
            'property' => '--toggle-padding',
          ],
        ],
        'default' => '0px',
        'placeholder' => '0px',
      ];

      $this->controls['toggleOutline'] = [
        'tab' => 'content',
        'group' => 'general',
        'label' => esc_html__( 'Toggle Outline', 'bricks' ),
        'type' => 'number',
        'units'    => true,
        'inline' => true,
        'css' => [
          [
            'property' => 'border-width',
            'selector' => '.brxc-toggle-slot',
          ],
        ],
        'default' => '2px',
        'placeholder' => '2px',
      ];

      $this->controls['toggleOutlineColor'] = [
        'tab' => 'content',
        'group' => 'general',
        'label' => esc_html__( 'Toggle Outline Color', 'bricks' ),
        'type' => 'color',
        'inline' => true,
        'css' => [
          [
            'property' => 'border-color',
            'selector' => '.brxc-toggle-slot',
          ]
        ],
        'default' => [
          'hex' => '#000000',
        ],
        'placeholder' => '#000000',
      ];

      $this->controls['toggleBorderRadius'] = [
        'tab' => 'content',
        'group' => 'general',
        'label' => esc_html__( 'Border Radius', 'bricks' ),
        'type' => 'number',
        'units'    => true,
        'inline' => true,
        'css' => [
          [
            'property' => 'border-radius',
            'selector' => '.brxc-toggle-slot',
          ],
          [
            'property' => 'border-radius',
            'selector' => '.brxc-toggle-button',
          ],
        ],
        'default' => '25px',
        'placeholder' => '25px',
      ];

      

      $this->controls['ToggleBoxShadow'] = [
        'tab' => 'content',
        'group' => 'general',
        'label' => esc_html__( 'Toggle BoxShadow', 'bricks' ),
        'type' => 'box-shadow',
        'css' => [
          [
            'property' => 'box-shadow',
            'selector' => '.brxc-toggle-slot',
          ],
        ],
        'inline' => true,
        'small' => true,
        'default' => [
          'values' => [
            'offsetX' => 0,
            'offsetY' => 0,
            'blur' => 0,
            'spread' => 0,
          ],
          'color' => [
            'rgb' => 'rgba(0, 0, 0, 0)',
          ],
        ],
      ];

      $this->controls['sunIconColor'] = [
        'tab' => 'content',
        'group' => 'sun',
        'label' => esc_html__( 'Icon Color', 'bricks' ),
        'type' => 'color',
        'inline' => true,
        'css' => [
          [
            'property' => 'fill',
            'selector' => '.brxc-sun-icon',
          ]
        ],
        'default' => [
          'hex' => '#000000',
        ],
        'placeholder' => '#000000',
      ];

      $this->controls['sunIconSize'] = [
        'tab' => 'content',
        'group' => 'sun',
        'label' => esc_html__( 'Icon Size (Scale in %)', 'bricks' ),
        'type' => 'number',
        'units'    => true,
        'unit' => '%',
        'inline' => true,
        'css' => [
          [
            'property' => 'scale',
            'selector' => '.brxc-sun-icon',
          ],
        ],
        'default' => '100%',
        'placeholder' => '100%',
      ];

      $this->controls['sunBackground'] = [ // Setting key
        'tab' => 'content',
        'group' => 'sun',
        'label' => esc_html__( 'Background Color', 'bricks' ),
        'type' => 'background',
        'css' => [
          [
            'property' => 'background',
            'selector' => '.brxc-toggle-slot',
          ],
        ],
        'inline' => true,
        'small' => true,
        'default' => [
          'color' => [
            'rgb' => 'rgba(0, 0, 0, 0)',
          ],
        ],
      ];

      $this->controls['sunToggleColor'] = [
        'tab' => 'content',
        'group' => 'sun',
        'label' => esc_html__( 'Toggle Color', 'bricks' ),
        'type' => 'color',
        'inline' => true,
        'css' => [
          [
            'property' => 'background-color',
            'selector' => '.brxc-toggle-slot .brxc-toggle-button',
          ]
        ],
        'default' => [
          'hex' => '#ffb061',
        ],
        'placeholder' => '#ffb061',
      ];

      $this->controls['sunBorderColor'] = [
        'tab' => 'content',
        'group' => 'sun',
        'label' => esc_html__( 'Toggle Border Color', 'bricks' ),
        'type' => 'color',
        'inline' => true,
        'css' => [
          [
            'property' => '--sun-border-color',
          ]
        ],
        'default' => [
          'hex' => '#fff261',
        ],
        'placeholder' => '#fff261',
      ];

      $this->controls['sunBorderSize'] = [
        'tab' => 'content',
        'group' => 'sun',
        'label' => esc_html__( 'Toggle Border Size', 'bricks' ),
        'type' => 'number',
        'units'    => true,
        'inline' => true,
        'css' => [
          [
            'property' => '--sun-border-size',
          ],
        ],
        'default' => '3px',
        'placeholder' => '3px',
      ];

      $this->controls['moonIconColor'] = [
        'tab' => 'content',
        'group' => 'moon',
        'label' => esc_html__( 'Icon Color', 'bricks' ),
        'type' => 'color',
        'inline' => true,
        'css' => [
          [
            'property' => 'fill',
            'selector' => '.brxc-moon-icon',
          ]
        ],
        'default' => [
          'hex' => '#ffffff',
        ],
        'placeholder' => '#ffffff',
      ];

      $this->controls['moonIconSize'] = [
        'tab' => 'content',
        'group' => 'moon',
        'label' => esc_html__( 'Icon Size (Scale in %)', 'bricks' ),
        'type' => 'number',
        'units'    => true,
        'unit' => '%',
        'step' => '1',
        'inline' => true,
        'css' => [
          [
            'property' => 'scale',
            'selector' => '.brxc-moon-icon',
          ],
        ],
        'default' => '85%',
        'placeholder' => '85%',
      ];

      $this->controls['moonBackground'] = [ // Setting key
        'tab' => 'content',
        'group' => 'moon',
        'label' => esc_html__( 'Background Color', 'bricks' ),
        'type' => 'background',
        'css' => [
          [
            'property' => 'background',
            'selector' => '.brxc-toggle-checkbox:checked ~ .brxc-toggle-slot',
          ],
        ],
        'inline' => true,
        'small' => true,
        'default' => [
          'color' => [
            'hex' => '#353d4e',
          ],
        ],
        'placeholder' => '#353d4e',
      ];

      $this->controls['moonToggleColor'] = [
        'tab' => 'content',
        'group' => 'moon',
        'label' => esc_html__( 'Toggle Color', 'bricks' ),
        'type' => 'color',
        'inline' => true,
        'css' => [
          [
            'property' => 'background-color',
            'selector' => '.brxc-toggle-checkbox:checked ~ .brxc-toggle-slot .brxc-toggle-button',
          ]
        ],
        'default' => [
          'hex' => '#485367',
        ],
        'placeholder' => '#485367',
      ];

      $this->controls['moonBorderColor'] = [
        'tab' => 'content',
        'group' => 'moon',
        'label' => esc_html__( 'Toggle Border Color', 'bricks' ),
        'type' => 'color',
        'inline' => true,
        'css' => [
          [
            'property' => '--moon-border-color',
          ]
        ],
        'default' => [
          'hex' => '#ffffff',
        ],
        'placeholder' => '#ffffff',
      ];

      $this->controls['moonBorderSize'] = [
        'tab' => 'content',
        'group' => 'moon',
        'label' => esc_html__( 'Toggle Border Size', 'bricks' ),
        'type' => 'number',
        'units'    => true,
        'inline' => true,
        'css' => [
          [
            'property' => '--moon-border-size',
          ],
        ],
        'default' => '3px',
        'placeholder' => '3px',
      ];
    
  }

  // Enqueue element styles and scripts
  public function enqueue_scripts() {
    wp_enqueue_script( 'brxc-darkmode' );
    wp_enqueue_style( 'brxc-darkmode-toggle' );
  }

  // Render element HTML
  public function render() {
    // Set element attributes
    $root_classes[] = '';

    // if ( ! empty( $this->settings['type'] ) ) {
    //   $root_classes[] = "color-{$this->settings['type']}";
    // }

    // Add 'class' attribute to element root tag
    $this->set_attribute( '_root', 'class', $root_classes );

    // Render element HTML
    // '_root' attribute is required since Bricks 1.4 (contains element ID, class, etc.)
    //echo "<div {$this->render_attributes( '_root' )}>"; // Element root attributes
      //if ( ! empty( $this->settings['content'] ) ) {
        //echo "<div>{$this->settings['content']}</div>";
      //}
    //echo '</div>';


    echo "<div {$this->render_attributes( '_root' )}>";
        echo '<label>
            <input class="brxc-toggle-checkbox" type="checkbox"></input>
            <div class="brxc-toggle-slot">
                <div class="brxc-sun-icon-wrapper">
                    <div class="brxc-sun-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="brxc__svg-path"><path d="M24 31q2.9 0 4.95-2.05Q31 26.9 31 24q0-2.9-2.05-4.95Q26.9 17 24 17q-2.9 0-4.95 2.05Q17 21.1 17 24q0 2.9 2.05 4.95Q21.1 31 24 31Zm0 3q-4.15 0-7.075-2.925T14 24q0-4.15 2.925-7.075T24 14q4.15 0 7.075 2.925T34 24q0 4.15-2.925 7.075T24 34ZM3.5 25.5q-.65 0-1.075-.425Q2 24.65 2 24q0-.65.425-1.075Q2.85 22.5 3.5 22.5h5q.65 0 1.075.425Q10 23.35 10 24q0 .65-.425 1.075-.425.425-1.075.425Zm36 0q-.65 0-1.075-.425Q38 24.65 38 24q0-.65.425-1.075.425-.425 1.075-.425h5q.65 0 1.075.425Q46 23.35 46 24q0 .65-.425 1.075-.425.425-1.075.425ZM24 10q-.65 0-1.075-.425Q22.5 9.15 22.5 8.5v-5q0-.65.425-1.075Q23.35 2 24 2q.65 0 1.075.425.425.425.425 1.075v5q0 .65-.425 1.075Q24.65 10 24 10Zm0 36q-.65 0-1.075-.425-.425-.425-.425-1.075v-5q0-.65.425-1.075Q23.35 38 24 38q.65 0 1.075.425.425.425.425 1.075v5q0 .65-.425 1.075Q24.65 46 24 46ZM12 14.1l-2.85-2.8q-.45-.45-.425-1.075.025-.625.425-1.075.45-.45 1.075-.45t1.075.45L14.1 12q.4.45.4 1.05 0 .6-.4 1-.4.45-1.025.45-.625 0-1.075-.4Zm24.7 24.75L33.9 36q-.4-.45-.4-1.075t.45-1.025q.4-.45 1-.45t1.05.45l2.85 2.8q.45.45.425 1.075-.025.625-.425 1.075-.45.45-1.075.45t-1.075-.45ZM33.9 14.1q-.45-.45-.45-1.05 0-.6.45-1.05l2.8-2.85q.45-.45 1.075-.425.625.025 1.075.425.45.45.45 1.075t-.45 1.075L36 14.1q-.4.4-1.025.4-.625 0-1.075-.4ZM9.15 38.85q-.45-.45-.45-1.075t.45-1.075L12 33.9q.45-.45 1.05-.45.6 0 1.05.45.45.45.45 1.05 0 .6-.45 1.05l-2.8 2.85q-.45.45-1.075.425-.625-.025-1.075-.425ZM24 24Z"/></svg></div>
                </div>
                <div class="brxc-toggle-button"></div>
                <div class="brxc-moon-icon-wrapper">
                    <div class="brxc-moon-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="brxc__svg-path"><path d="M24 42q-7.5 0-12.75-5.25T6 24q0-7.5 5.25-12.75T24 6q.4 0 .85.025.45.025 1.15.075-1.8 1.6-2.8 3.95-1 2.35-1 4.95 0 4.5 3.15 7.65Q28.5 25.8 33 25.8q2.6 0 4.95-.925T41.9 22.3q.05.6.075.975Q42 23.65 42 24q0 7.5-5.25 12.75T24 42Zm0-3q5.45 0 9.5-3.375t5.05-7.925q-1.25.55-2.675.825Q34.45 28.8 33 28.8q-5.75 0-9.775-4.025T19.2 15q0-1.2.25-2.575.25-1.375.9-3.125-4.9 1.35-8.125 5.475Q9 18.9 9 24q0 6.25 4.375 10.625T24 39Zm-.2-14.85Z"/></svg></div>
                </div>
            </div>
        </label>
    </div>';
  }
}