<?php 

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Advanced_Themer_Shade_Generator extends \Bricks\Element {
  // Element properties
  public $category     = 'advanced themer'; // Use predefined element category 'general'
  public $name         = 'brxc-shade-generator'; // Make sure to prefix your elements
  public $icon         = 'fa fa-moon'; // Themify icon font class
  public $css_selector = ''; // Default CSS selector
  public $scripts      = ['']; // Script(s) run when element is rendered on frontend or updated in builder

  // Return localised element label
  public function get_label() {
    return esc_html__( 'Shade Generator', 'bricks' );
  }

  // Set builder control groups
  public function set_control_groups() {
    $this->control_groups['general'] = [ // Unique group identifier (lowercase, no spaces)
      'title' => esc_html__( 'General', 'bricks' ), // Localized control group title
      'tab' => 'content', // Set to either "content" or "style"
    ];

  }

  
  // Set builder controls
  public function set_controls() {

    $this->controls['baseColor'] = [
      'tab' => 'content',
      'label' => esc_html__( 'Base color', 'bricks' ),
      'type' => 'color',
      'inline' => true,
      'default' => [
        'hex' => '#3ce77b',
      ],
    ];

    $this->controls['exampleText'] = [
      'tab' => 'content',
      'label' => esc_html__( 'Text', 'bricks' ),
      'type' => 'text',
      'spellcheck' => true, // Default: false
      // 'trigger' => 'enter', // Default: 'enter'
      'inlineEditing' => true,
      'default' => 'Here goes your text ..',
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

    $arr[] = self::adjustBrightness( $hexCode, 0.1 );
    $arr[] = self::adjustBrightness( $hexCode, 0.2 );
    $arr[] = self::adjustBrightness( $hexCode, 0.4 );
    $arr[] = self::adjustBrightness( $hexCode, 0.6 );
    $arr[] = self::adjustBrightness( $hexCode, 0.8 );
    $arr[] = self::adjustBrightness( $hexCode, 0.9 );

  } else {

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
  }

  // Render element HTML
  public function render() {

    // Set element attributes
    $root_classes[] = '';

    $this->set_attribute( '_root', 'class', $root_classes );

    $base_color = isset( $this->settings['exampleText']) ? $this->settings['exampleText']: '#3ce77b';

    $arr = self::returnHexArr( $base_color, false);

    echo "<div {$this->render_attributes( '_root' )}>";

    foreach( $arr as $color ){
      
      echo "<div style='width: 50px; height: 50px; background-color: " . $color . "'></div>";

    }

    echo '</div>';

  }
}