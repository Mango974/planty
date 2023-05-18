<?php
namespace Bricks;

if (!defined('ABSPATH'))
	exit;

class Brf_Font_Awesome extends Element
{
	public $category = 'bricksforge';
	public $name = 'brf-font-awesome';
	public $icon = 'ti-star';

	public function get_label()
	{
		return esc_html__('Font Awesome', 'bricksforge');
	}

	public function set_controls()
	{
		$element = get_option('brf_activated_elements');
		$settings = array_column($element, null, 'id')[1] ?? false;
		$settings = $settings->settings;

		if (!isset($settings) || !isset($settings->kitID) || empty($settings->kitID)) {
			$this->controls['info'] = [
				'tab'     => 'content',
				'content' => esc_html__('You must enter a valid Kit ID to use the Font Awesome Pro Library. You can find the setting in the Bricksforge options.', 'bricksforge'),
				'type'    => 'info',
			];
			return;
		}

		$this->controls['style'] = [
			'tab'     => 'content',
			'label'   => esc_html__('Icon Style', 'bricksforge'),
			'type'    => 'select',
			'options' => [
				"fa-duotone" => "Duotone",
				"fa-light"   => "Light",
				"fa-regular" => "Regular",
				"fa-solid"   => "Solid",
				"fa-thin"    => "Thin"
			],
			'default' => 'fa-duotone'
		];
		$this->controls['icon'] = [
			'tab'         => 'content',
			'label'       => esc_html__('Icon Class', 'bricksforge'),
			'type'        => 'text',
			'placeholder' => 'fa-layer-group',
			'default'     => 'fa-layer-group'
		];

		$this->controls['spin'] = [
			'tab'     => 'content',
			'label'   => esc_html__('Spin', 'bricksforge'),
			'type'    => 'checkbox',
			'default' => false
		];

		$this->controls['sharp'] = [
			'required' => [['style', '=', 'fa-solid']],
			'tab'      => 'content',
			'label'    => esc_html__('Sharp', 'bricksforge'),
			'type'     => 'checkbox',
			'default'  => false
		];


		$this->controls['iconColor'] = [
			'tab'      => 'content',
			'label'    => esc_html__('Color', 'bricksforge'),
			'type'     => 'color',
			'css'      => [
				[
					'property' => 'color',
				],
				[
					'property' => 'fill',
				],
			],
			'required' => ['icon', '!=', ''],
			'default'  => ['hex' => '#ffc107']
		];

		$this->controls['iconSize'] = [
			'tab'      => 'content',
			'label'    => esc_html__('Size', 'bricksforge'),
			'type'     => 'number',
			'units'    => true,
			'css'      => [
				[
					'property' => 'font-size',
				],
			],
			'required' => ['icon', '!=', ''],
			'default'  => 35
		];

		$this->controls['link'] = [
			'tab'   => 'content',
			'label' => esc_html__('Link', 'bricksforge'),
			'type'  => 'link',
		];
	}

	public function get_icons()
	{
		$json = file_get_contents(__DIR__ . '/inc/icon-list.json');
		$icons = json_decode($json);

		$list = [];
		foreach ($icons as $icon) {
			$list[$icon] = "$icon";
		}

		return $list;
	}

	public function get_token()
	{
		$element = get_option('brf_activated_elements');
		$settings = array_column($element, null, 'id')[1] ?? false;

		$settings = $settings->settings;
		$token = isset($settings->kitID) && !empty($settings->kitID) ? $settings->kitID : false;

		return $token === false ? false : $token;
	}

	public function enqueue_scripts()
	{
		if ($this->get_token() === false) {
			return;
		}

		wp_enqueue_script('brf-font-awesome-6', "https://kit.fontawesome.com/" . $this->get_token() . "}.js", false, time(), true);
		add_filter(
			'script_loader_tag',
			function ($tag, $handle, $source) {
			    if ($handle != 'brf-font-awesome-6') {
				    return $tag;
			    }

			    $tag = '<script type="text/javascript" src="' . $source . '" crossorigin="anonymous"></script>';
			    return $tag;
		    },
			10,
			3
		);
	}

	public function render()
	{
		$settings = $this->settings;
		$style = !empty($settings['style']) ? $settings['style'] : 'fa-solid';
		$icon = !empty($settings['icon']) ? $settings['icon'] : false;
		$link = !empty($settings['link']) ? $settings['link'] : false;
		$spin = !empty($settings['spin']) && $settings['spin'] === true ? 'fa-spin ' : '';
		$sharp = !empty($settings['sharp']) && $settings['sharp'] === true ? 'fa-sharp ' : '';

		if (!$icon) {
			return $this->render_element_placeholder(
				[
					'title' => esc_html__('No icon selected.', 'bricks'),
				]
			);
		}

		$icon = ["icon" => $style . ' ' . $icon . ' ' . $spin . ' ' . $sharp];
		$icon = self::render_icon($icon, $this->attributes['_root']);

		if ($link) {
			$this->set_link_attributes('link', $link);
			echo "<a {$this->render_attributes('link')}>{$icon}</a>";
		}
		else {
			echo "<span>$icon</span>";
		}
	}
}