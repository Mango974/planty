<?php
namespace Bricks;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Element_Map extends Element {
	public $category  = 'general';
	public $name      = 'map';
	public $icon      = 'ti-location-pin';
	public $scripts   = [ 'bricksMap' ];
	public $draggable = false;

	public function get_label() {
		return esc_html__( 'Map', 'bricks' );
	}

	public function enqueue_scripts() {
		wp_enqueue_script( 'bricks-google-maps' );
		wp_enqueue_script( 'bricks-google-maps-infobox' );
	}

	public function set_control_groups() {
		$this->control_groups['addresses'] = [
			'title'    => esc_html__( 'Addresses', 'bricks' ),
			'tab'      => 'content',
			'required' => [ 'apiKeyGoogleMaps', '!=', '', 'globalSettings' ],
		];

		$this->control_groups['markers'] = [
			'title'    => esc_html__( 'Markers', 'bricks' ),
			'tab'      => 'content',
			'required' => [ 'apiKeyGoogleMaps', '!=', '', 'globalSettings' ],
		];

		$this->control_groups['settings'] = [
			'title'    => esc_html__( 'Settings', 'bricks' ),
			'tab'      => 'content',
			'required' => [ 'apiKeyGoogleMaps', '!=', '', 'globalSettings' ],
		];
	}

	public function set_controls() {
		$this->controls['infoNoApiKey'] = [
			'tab'      => 'content',
			'content'  => sprintf(
				esc_html__( 'Google Maps API key required! Add key in dashboard under: %s', 'bricks' ),
				'<a href="' . Helpers::settings_url( '#tab-api-keys' ) . '" target="_blank">' . esc_html__( 'Bricks > Settings > API Keys', 'bricks' ) . '</a>'
			),
			'type'     => 'info',
			'required' => [ 'apiKeyGoogleMaps', '=', '', 'globalSettings' ],
		];

		/**
		 * Group: ADDRESSES
		 */

		$this->controls['infoLatLong'] = [
			'tab'      => 'content',
			'group'    => 'addresses',
			'content'  => esc_html__( 'Please enter the latitude/longitude when using multiple markers.', 'bricks' ),
			'type'     => 'info',
			'required' => [ 'apiKeyGoogleMaps', '!=', '', 'globalSettings' ],
		];

		$this->controls['addresses'] = [
			'tab'           => 'content',
			'group'         => 'addresses',
			'placeholder'   => esc_html__( 'Addresses', 'bricks' ),
			'type'          => 'repeater',
			'titleProperty' => 'address',
			'fields'        => [
				'latitude'         => [
					'label'       => esc_html__( 'Latitude', 'bricks' ),
					'type'        => 'text',
					'trigger'     => [ 'blur', 'enter' ],
					'placeholder' => '52.5164154966524',
				],

				'longitude'        => [
					'label'       => esc_html__( 'Longitude', 'bricks' ),
					'type'        => 'text',
					'trigger'     => [ 'blur', 'enter' ],
					'placeholder' => '13.377643715349544',
				],

				'address'          => [
					'label'       => esc_html__( 'Address', 'bricks' ),
					'type'        => 'text',
					'trigger'     => [ 'blur', 'enter' ],
					'placeholder' => esc_html__( 'Berlin, Germany', 'bricks' ),
					'description' => esc_html__( 'Alternative to Latitude/Longitude fields', 'bricks' )
				],

				// Infobox: Toggle on marker click
				'infoboxSeparator' => [
					'label'       => esc_html__( 'Infobox', 'bricks' ),
					'type'        => 'separator',
					'description' => esc_html__( 'Infobox appears on map marker click.', 'bricks' ),
				],

				'infoTitle'        => [
					'label'   => esc_html__( 'Title', 'bricks' ),
					'type'    => 'text',
					'trigger' => [ 'blur', 'enter' ],
				],

				'infoSubtitle'     => [
					'label'   => esc_html__( 'Subtitle', 'bricks' ),
					'type'    => 'text',
					'trigger' => [ 'blur', 'enter' ],
				],

				'infoOpeningHours' => [
					'label'   => esc_html__( 'Content', 'bricks' ),
					'type'    => 'textarea',
					'trigger' => [ 'blur', 'enter' ],
				],

				'infoImages'       => [
					'label'    => esc_html__( 'Info Images', 'bricks' ),
					'type'     => 'image-gallery',
					'unsplash' => false,
				],
			],
			'default'       => [
				[
					'latitude'  => '52.5164154966524',
					'longitude' => '13.377643715349544'
				],
			],
			'required'      => [ 'apiKeyGoogleMaps', '!=', '', 'globalSettings' ],
		];

		/**
		 * Group: MARKERS
		 */

		$this->controls['marker'] = [
			'tab'            => 'content',
			'group'          => 'markers',
			'type'           => 'image',
			'hasDynamicData' => false,
			'unsplash'       => false,
			'description'    => sprintf( '<a href="https://icons8.com/icon/set/map-marker/all" target="_blank">%s</a>', esc_html__( 'Get free marker icons from icons8.com', 'bricks' ) ),
			'required'       => [ 'apiKeyGoogleMaps', '!=', '', 'globalSettings' ],
		];

		$this->controls['markerHeight'] = [
			'tab'      => 'content',
			'group'    => 'markers',
			'label'    => esc_html__( 'Marker height in px', 'bricks' ),
			'type'     => 'number',
			'required' => [ 'apiKeyGoogleMaps', '!=', '', 'globalSettings' ],
		];

		$this->controls['markerWidth'] = [
			'tab'      => 'content',
			'group'    => 'markers',
			'label'    => esc_html__( 'Marker width in px', 'bricks' ),
			'type'     => 'number',
			'required' => [ 'apiKeyGoogleMaps', '!=', '', 'globalSettings' ],
		];

		// ACTIVE MARKER
		$this->controls['markerActiveSeparator'] = [
			'tab'      => 'content',
			'group'    => 'markers',
			'label'    => esc_html__( 'Active marker', 'bricks' ),
			'type'     => 'separator',
			'required' => [ 'apiKeyGoogleMaps', '!=', '', 'globalSettings' ],
		];

		$this->controls['markerActive'] = [
			'tab'            => 'content',
			'group'          => 'markers',
			'type'           => 'image',
			'hasDynamicData' => false,
			'unsplash'       => false,
			'description'    => sprintf( '<a href="https://icons8.com/icon/set/map-marker/all" target="_blank">%s</a>', esc_html__( 'Get free marker icons from icons8.com', 'bricks' ) ),
			'required'       => [ 'apiKeyGoogleMaps', '!=', '', 'globalSettings' ],
		];

		$this->controls['markerActiveHeight'] = [
			'tab'      => 'content',
			'group'    => 'markers',
			'label'    => esc_html__( 'Active marker height in px', 'bricks' ),
			'type'     => 'number',
			'required' => [ 'apiKeyGoogleMaps', '!=', '', 'globalSettings' ],
		];

		$this->controls['markerActiveWidth'] = [
			'tab'      => 'content',
			'group'    => 'markers',
			'label'    => esc_html__( 'Active marker width in px', 'bricks' ),
			'type'     => 'number',
			'required' => [ 'apiKeyGoogleMaps', '!=', '', 'globalSettings' ],
		];

		/**
		 * Group: SETTINGS
		 */

		$this->controls['height'] = [
			'tab'         => 'content',
			'group'       => 'settings',
			'label'       => esc_html__( 'Height', 'bricks' ),
			'type'        => 'number',
			'units'       => true,
			'css'         => [
				[
					'property' => 'height',
				],
			],
			'required'    => [ 'apiKeyGoogleMaps', '!=', '', 'globalSettings' ],
			'placeholder' => '300px',
		];

		$this->controls['zoom'] = [
			'tab'         => 'content',
			'group'       => 'settings',
			'label'       => esc_html__( 'Zoom level', 'bricks' ),
			'type'        => 'number',
			'step'        => 1,
			'min'         => 0,
			'max'         => 20,
			'placeholder' => 12,
			'required'    => [ 'apiKeyGoogleMaps', '!=', '', 'globalSettings' ],
		];

		$this->controls['type'] = [
			'tab'         => 'content',
			'group'       => 'settings',
			'label'       => esc_html__( 'Map type', 'bricks' ),
			'type'        => 'select',
			'options'     => [
				'roadmap'   => esc_html__( 'Roadmap', 'bricks' ),
				'satellite' => esc_html__( 'Satellite', 'bricks' ),
				'hybrid'    => esc_html__( 'Hybrid', 'bricks' ),
				'terrain'   => esc_html__( 'Terrain', 'bricks' ),
			],
			'placeholder' => esc_html__( 'Roadmap', 'bricks' ),
			'required'    => [ 'apiKeyGoogleMaps', '!=', '', 'globalSettings' ],
		];

		$map_styles                   = bricks_is_builder() ? Setup::get_map_styles() : [];
		$map_styles_options['custom'] = esc_html__( 'Custom', 'bricks' );

		foreach ( $map_styles as $key => $value ) {
			$map_styles_options[ $key ] = $value['label'];
		}

		// Requires map type: Roadmap
		$this->controls['style'] = [
			'tab'      => 'content',
			'group'    => 'settings',
			'label'    => esc_html__( 'Map style', 'bricks' ),
			'type'     => 'select',
			'options'  => $map_styles_options,
			'required' => [ 'apiKeyGoogleMaps', '!=', '', 'globalSettings' ],
		];

		$this->controls['customStyle'] = [
			'tab'         => 'content',
			'group'       => 'settings',
			'label'       => esc_html__( 'Custom map style', 'bricks' ),
			'type'        => 'code',
			'mode'        => 'json',
			'description' => sprintf( esc_html__( 'Copy+paste code from one of the maps over at %s', 'bricks' ), '<a target="_blank" href="https://snazzymaps.com/explore">snazzymaps.com/explore</a>' ),
			'required'    => [ 'style', '=', 'custom' ],
		];

		$this->controls['scrollwheel'] = [
			'tab'      => 'content',
			'group'    => 'settings',
			'label'    => esc_html__( 'Scroll', 'bricks' ),
			'type'     => 'checkbox',
			'required' => [ 'apiKeyGoogleMaps', '!=', '', 'globalSettings' ],
			'default'  => true,
		];

		$this->controls['draggable'] = [
			'tab'      => 'content',
			'group'    => 'settings',
			'label'    => esc_html__( 'Draggable', 'bricks' ),
			'type'     => 'checkbox',
			'required' => [ 'apiKeyGoogleMaps', '!=', '', 'globalSettings' ],
			'default'  => true,
		];

		$this->controls['fullscreenControl'] = [
			'tab'      => 'content',
			'group'    => 'settings',
			'label'    => esc_html__( 'Fullscreen Control', 'bricks' ),
			'type'     => 'checkbox',
			'required' => [ 'apiKeyGoogleMaps', '!=', '', 'globalSettings' ],
		];

		$this->controls['mapTypeControl'] = [
			'tab'      => 'content',
			'group'    => 'settings',
			'label'    => esc_html__( 'Map Type Control', 'bricks' ),
			'type'     => 'checkbox',
			'required' => [ 'apiKeyGoogleMaps', '!=', '', 'globalSettings' ],
		];

		$this->controls['streetViewControl'] = [
			'tab'      => 'content',
			'group'    => 'settings',
			'label'    => esc_html__( 'Street View Control', 'bricks' ),
			'type'     => 'checkbox',
			'required' => [ 'apiKeyGoogleMaps', '!=', '', 'globalSettings' ],
			'default'  => true,
		];

		$this->controls['disableDefaultUI'] = [
			'tab'      => 'content',
			'group'    => 'settings',
			'label'    => esc_html__( 'Disable Default UI', 'bricks' ),
			'type'     => 'checkbox',
			'required' => [ 'apiKeyGoogleMaps', '!=', '', 'globalSettings' ],
		];

		$this->controls['zoomControl'] = [
			'tab'      => 'content',
			'group'    => 'settings',
			'label'    => esc_html__( 'Zoom Control', 'bricks' ),
			'type'     => 'checkbox',
			'required' => [ 'apiKeyGoogleMaps', '!=', '', 'globalSettings' ],
			'default'  => true,
		];

		$this->controls['minZoom'] = [
			'tab'      => 'content',
			'group'    => 'settings',
			'label'    => esc_html__( 'Zoom level', 'bricks' ) . ' (' . esc_html__( 'Min', 'bricks' ) . ')',
			'type'     => 'number',
			'step'     => 1,
			'min'      => 0,
			'required' => [ 'zoomControl', '!=', '' ],
		];

		$this->controls['maxZoom'] = [
			'tab'      => 'content',
			'group'    => 'settings',
			'label'    => esc_html__( 'Zoom level', 'bricks' ) . ' (' . esc_html__( 'Max', 'bricks' ) . ')',
			'type'     => 'number',
			'step'     => 1,
			'min'      => 0,
			'required' => [ 'zoomControl', '!=', '' ],
		];
	}

	public function render() {
		$settings = $this->settings;

		if ( empty( Database::$global_settings['apiKeyGoogleMaps'] ) ) {
			return $this->render_element_placeholder(
				[
					'title' => sprintf(
						esc_html__( 'Google Maps API key required! Add key in dashboard under: %s', 'bricks' ),
						'<a href="' . Helpers::settings_url( '#tab-api-keys' ) . '" target="_blank">' . esc_html__( 'Bricks > Settings > API Keys', 'bricks' ) . '</a>'
					)
				]
			);
		}

		// Addresses, filter all the fields to render dynamic data before render
		$addresses = ! empty( $settings['addresses'] ) ? $settings['addresses'] : [ [ 'address' => 'Berlin, Germany' ] ];

		// InfoImages Gallery may use a custom field (handle it before)
		$gallery_class_name = isset( Elements::$elements['image-gallery']['class'] ) ? Elements::$elements['image-gallery']['class'] : false;

		if ( $gallery_class_name ) {
			$gallery = new $gallery_class_name();
			$gallery->set_post_id( $this->post_id );

			foreach ( $addresses as $key => $address ) {
				if ( ! empty( $address['infoImages']['useDynamicData'] ) ) {
					$settings                        = $gallery->get_normalized_image_settings( [ 'items' => $address['infoImages'] ] );
					$addresses[ $key ]['infoImages'] = $settings['items'];
					unset( $addresses[ $key ]['infoImages']['useDynamicData'] );
				}
			}
		}

		// Handle remaining text fields to replace dynamic data
		add_filter( 'bricks/acf/google_map/text_output', 'wp_strip_all_tags' );

		$addresses = map_deep( $addresses, [ $this, 'render_dynamic_data' ] );

		remove_filter( 'bricks/acf/google_map/text_output', 'wp_strip_all_tags' );

		$map_options = [
			'addresses'         => $addresses,
			'zoom'              => isset( $settings['zoom'] ) ? intval( $settings['zoom'] ) : 12,
			'scrollwheel'       => isset( $settings['scrollwheel'] ),
			'draggable'         => isset( $settings['draggable'] ),
			'fullscreenControl' => isset( $settings['fullscreenControl'] ),
			'mapTypeControl'    => isset( $settings['mapTypeControl'] ),
			'streetViewControl' => isset( $settings['streetViewControl'] ),
			'zoomControl'       => isset( $settings['zoomControl'] ),
			'disableDefaultUI'  => isset( $settings['disableDefaultUI'] ),
			'type'              => isset( $settings['type'] ) ? $settings['type'] : 'roadmap',
		];

		// Min zoom
		if ( isset( $settings['minZoom'] ) ) {
			$map_options['minZoom'] = intval( $settings['minZoom'] );
		}

		// Max zoom
		if ( isset( $settings['maxZoom'] ) ) {
			$map_options['maxZoom'] = intval( $settings['maxZoom'] );
		}

		// Custom marker
		if ( isset( $settings['marker']['url'] ) ) {
			$map_options['marker'] = $settings['marker']['url'];
		}

		if ( isset( $settings['markerHeight'] ) ) {
			$map_options['markerHeight'] = $settings['markerHeight'];
		}

		if ( isset( $settings['markerWidth'] ) ) {
			$map_options['markerWidth'] = $settings['markerWidth'];
		}

		// Custom active marker
		if ( isset( $settings['markerActive']['url'] ) ) {
			$map_options['markerActive'] = $settings['markerActive']['url'];
		}

		if ( isset( $settings['markerActiveHeight'] ) ) {
			$map_options['markerActiveHeight'] = $settings['markerActiveHeight'];
		}

		if ( isset( $settings['markerActiveWidth'] ) ) {
			$map_options['markerActiveWidth'] = $settings['markerActiveWidth'];
		}

		// Add 'style' or 'customStyle'
		if ( isset( $settings['style'] ) ) {
			$map_options['style'] = $settings['style'];

			if ( $settings['style'] === 'custom' && isset( $settings['customStyle'] ) ) {
				$map_options['customStyle'] = $settings['customStyle'];
			}
		}

		$this->set_attribute( '_root', 'data-bricks-map-options', wp_json_encode( $map_options ) );

		// No more inner .map as DnD only works in structure panel anyway (@since 1.5.4)
		echo "<div {$this->render_attributes( '_root' )}></div>";
	}
}
