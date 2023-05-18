<?php 

namespace Bricks\Integrations\Dynamic_Data\Providers;

class Provider_Bricksforge extends Base {

    public function __construct() {
        $this->title = __('Bricksforge', 'text-domain');
        $this->description = __('Bricksforge Dynamic Data', 'text-domain');
        $this->id = 'bricksforge';
    }

    public static function load_me() {
		return true;
	}
    
    public function register_tags() {
		$tags = $this->get_tags_config();

		foreach ( $tags as $key => $tag ) {
			$this->tags[ $key ] = [
				'name'     => '{' . $key . '}',
				'label'    => $tag['label'],
				'group'    => $tag['group'],
				'provider' => $this->id,
			];
		}
	}

    public function get_tags_config() {
        $tags = [];

        $tags['brf_form_calculation'] = [
            'name' => 'brf_form_calculation',
            'label' => __('Form Calculation - add id after :', 'text-domain'),
            'group' => __('Bricksforge', 'text-domain'),
            'provider' => $this->id,
        ];

        return $tags;

    }

    public function get_tag_value($tag, $post, $args, $context) {
        $value = '';

        switch($tag) {
            case 'brf_form_calculation':
                if (empty($args)) {
                    break;
                }

                $calculation_id = $args[0];
                $operator = null;
                $post_calc_value = null;

                // args[1] can contain the operator. args[2] can contain the post calculation value
                if (isset($args[1])) {
                    $operator = $args[1];
                }

                if (isset($args[2])) {
                    $post_calc_value = $args[2];
                }

                $value = $this->get_form_calculation_value($calculation_id, $operator, $post_calc_value);

                
                break;
        }

        return $value;
    }

    public function get_form_calculation_value($calculation_id, $operator = null, $post_calc_value = null) {
        $output = "";
        $output .= "<span class='brf-form-calculation-value' data-calculation-id=". $calculation_id ." ". ($operator ? 'data-calculation-operator='. $operator : '') . ($operator ? ' data-calculation-value='. $post_calc_value : '') .">";
        $output .= 0;
        $output .= "</span>";

        return $output;
    }

    public function handle_post_calculation($args, $value, $operator, $post_calc_value) {
        $final_value = $value;


        // If there is no second and third arg, return the value
        if (!isset($args[1]) || !isset($args[2])) {
            return $final_value;
        }

        // If the second arg is not a valid operator, return the value
        if (!in_array($args[1], ['plus', 'minus', 'multiply', 'divide'])) {
            return $final_value;
        }

        // args[1] can contain the operator. args[2] can contain the post calculation value
        if (isset($args[1])) {
            $operator = $args[1];
        }

        if (isset($args[2])) {
            $post_calc_value = $args[2];
        }

        // Make sure that $value and $post_calc_value are floats

        // The operator can be: plus, minus, multiply, divide (in words). Create a switch statement
        switch($operator) {
            case 'plus':
                $final_value = $value + $post_calc_value;
                break;
            case 'minus':
                $final_value = $value - $post_calc_value;
                break;
            case 'multiply':
                $final_value = $value * $post_calc_value;
                break;
            case 'divide':
                $final_value = $value / $post_calc_value;
                break;
        }

        return $final_value;
    }
    
}