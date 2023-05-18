<?php

namespace Bricksforge\Api;

class FormsHelper
{

    public function create_post($form_settings, $form_data)
    {
        $post_status;
        $post_categories;
        $post_title;
        $post_content;
        $custom_fields;

        $post_status = $form_settings['pro_forms_post_action_post_create_post_status'] ? $form_settings['pro_forms_post_action_post_create_post_status'] : 'draft';

        $post_categories = $form_settings['pro_forms_post_action_post_create_categories'] ? $form_settings['pro_forms_post_action_post_create_categories'] : [];

        // Loop trough categories and create an array with only the "category" key
        foreach ($post_categories as $key => $value) {
            $post_categories[$key] = $value['category'];

            // Get the category id from the category slug
            $post_categories[$key] = get_category_by_slug($post_categories[$key])->term_id;
        }

        $post_title = $form_settings['pro_forms_post_action_post_create_title'];
        $post_content = $form_settings['pro_forms_post_action_post_create_content'];

        // Loop trough the form_data object
        foreach ($form_data as $key => $value) {
            $form_id = explode('-', $key);
            $form_id = $form_id[2];

            if ($form_id === $form_settings['pro_forms_post_action_post_create_title']) {
                $post_title = $value;
            }

            if ($form_id === $form_settings['pro_forms_post_action_post_create_content']) {
                $post_content = $value;
            }

            foreach ($form_settings['pro_forms_post_action_post_create_custom_fields'] as $custom_field) {
                $custom_fields[$custom_field['name']] = $this->get_form_field_by_id($custom_field['value'], $form_data);

                if ($form_id === $custom_field['value']) {
                    $custom_fields[$custom_field['name']] = $this->get_form_field_by_id($custom_field['value'], $form_data);
                }
            }
        }

        $post = array(
            'post_title'    => $post_title ? bricks_render_dynamic_data($post_title) : 'Untitled',
            'post_content'  => $post_content ? bricks_render_dynamic_data($post_content) : '',
            'post_status'   => $post_status,
            'post_type'     => $form_settings['pro_forms_post_action_post_create_pt'] ? $form_settings['pro_forms_post_action_post_create_pt'] : 'post',
            'meta_input'    => $custom_fields ? $custom_fields : array(),
            'post_category' => $post_categories ? $post_categories : array(),
        );

        $post_id = wp_insert_post($post);

        return $post_id;
    }

    public function add_option($form_settings, $form_data)
    {
        $option_data = $form_settings['pro_forms_post_action_option_add_option_data'];

        $option_data = array_map(function ($item) {
            return array(
                'name'  => bricks_render_dynamic_data($item['name']),
                'value' => bricks_render_dynamic_data($item['value']),
            );
        }, $option_data);

        // Add Option for each $option_data
        foreach ($option_data as $option) {
            $option_name = $option['name'];
            $option_value = $option['value'];

            if (!isset($option_name) || !isset($option_value)) {
                continue;
            }

            $option_name = $this->get_form_field_by_id($option_name, $form_data);
            $option_value = $this->get_form_field_by_id($option_value, $form_data);

            $option_value = $this->sanitize_value($option_value);

            add_option($option_name, $option_value);
        }

        return true;
    }

    public function update_option($form_settings, $form_data)
    {
        $option_data = $form_settings['pro_forms_post_action_option_update_option_data'];

        $option_data = array_map(function ($item) {
            return array(
                'name'         => bricks_render_dynamic_data($item['name']),
                'value'        => bricks_render_dynamic_data($item['value']),
                'type'         => $item['type'],
                'selector'     => $item['selector'],
                'number_field' => bricks_render_dynamic_data($item['number_field'], $post_id),
            );
        }, $option_data);

        $updated_values = array();

        // Update Option for each $option_data
        foreach ($option_data as $option) {
            $option_name = $option['name'];
            $option_value = $option['value'];
            $option_type = $option['type'];
            $option_selector = $option['selector'];
            $option_number_field = $option['number_field'];

            if (!isset($option_name) || !isset($option_value)) {
                continue;
            }

            $option_name = $this->get_form_field_by_id($option_name, $form_data);
            $option_value = $this->get_form_field_by_id($option_value, $form_data);

            $new_option_value;
            $current_value = get_option($option_name);

            switch ($option_type) {
                case 'replace':
                    $new_option_value = $option_value;
                    break;
                case 'increment':
                    $new_option_value = intval($current_value) + 1;
                    break;
                case 'decrement':
                    $new_option_value = intval($current_value) - 1;
                    break;
                case 'increment_by_number':
                    $option_number_field = $this->get_form_field_by_id($option_number_field, $form_data);
                    $new_option_value = intval($current_value) + intval($option_number_field);
                    break;
                case 'decrement_by_number':
                    $option_number_field = $this->get_form_field_by_id($option_number_field, $form_data);
                    $new_option_value = intval($current_value) - intval($option_number_field);
                    break;
                case 'add_to_array':
                    // If the current value is not an array, make it one and add the new value
                    if (!is_array($current_value)) {
                        $new_option_value = array($current_value, $option_value);
                    } else {
                        $new_option_value = array_merge($current_value, array($option_value));
                    }
                    break;
                case 'remove_from_array':
                    // If the current value is not an array, make it one and remove the new value
                    if (is_array($current_value)) {
                        $new_option_value = array_diff($current_value, array($option_value));
                    }
                    break;
                default:
                    $new_option_value = $option_value;
                    break;
            }

            $new_option_value = $this->sanitize_value($new_option_value);

            update_option($option_name, $new_option_value);

            $allow_live_update = $option_type === 'add_to_array' || $option_type === 'remove_from_array' ? false : true;

            array_push(
                $updated_values,
                array(
                    'name'     => $option_name,
                    'value'    => $new_option_value,
                    'selector' => $option_selector,
                    'live'     => $allow_live_update,
                )
            );
        }

        return $updated_values;
    }

    public function delete_option($form_settings, $form_data)
    {
        $option_data = $form_settings['pro_forms_post_action_option_delete_option_data'];

        $option_data = array_map(function ($item) {
            return array(
                'name' => bricks_render_dynamic_data($item['name']),
            );
        }, $option_data);

        // Delete Option for each $option_data
        foreach ($option_data as $option) {
            $option_name = $option['name'];

            if (!isset($option_name)) {
                continue;
            }

            delete_option($option_name);
        }

        return true;
    }

    public function update_post_meta($form_settings, $form_data, $post_id, $dynamic_post_id)
    {
        if (isset($dynamic_post_id) && $dynamic_post_id) {
            $dynamic_post_id = absint($dynamic_post_id);
        }

        $post_meta_data = $form_settings['pro_forms_post_action_update_post_meta_data'];

        $post_meta_data = array_map(function ($item) use ($post_id, $dynamic_post_id) {
            $post_id = isset($item['post_id']) && $item['post_id'] ? intval($item['post_id']) : intval($post_id);
            $post_id = $dynamic_post_id ? $dynamic_post_id : $post_id;

            return array(
                'post_id'      => $post_id,
                'name'         => bricks_render_dynamic_data($item['name'], $post_id),
                'value'        => bricks_render_dynamic_data($item['value'], $post_id),
                'type'         => $item['type'],
                'selector'     => bricks_render_dynamic_data($item['selector'], $post_id),
                'number_field' => bricks_render_dynamic_data($item['number_field'], $post_id),
            );
        }, $post_meta_data);

        $updated_values = array();

        // Update Post Meta for each $post_meta_data
        foreach ($post_meta_data as $post_meta) {
            $post_id = $post_meta['post_id'];
            $post_meta_name = $post_meta['name'];
            $post_meta_value = $post_meta['value'];
            $post_meta_type = $post_meta['type'];
            $post_meta_selector = $post_meta['selector'];
            $post_meta_number_field = $post_meta['number_field'];

            if (!isset($post_meta_name) || !isset($post_meta_value)) {
                continue;
            }

            // Loop trough the form_data object
            foreach ($form_data as $key => $value) {
                $form_id = explode('-', $key);
                $form_id = $form_id[2];

                if ($form_id === $post_meta_value) {
                    $post_meta_value = $value;
                }
            }

            $new_post_meta_value;
            $current_value = get_post_meta($post_id, $post_meta_name, true);

            switch ($post_meta_type) {
                case 'replace':
                    $new_post_meta_value = $post_meta_value;
                    break;
                case 'increment':
                    $new_post_meta_value = intval($current_value) + 1;
                    break;
                case 'decrement':
                    $new_post_meta_value = intval($current_value) - 1;
                    break;
                case 'increment_by_number':
                    $post_meta_number_field = $this->get_form_field_by_id($post_meta_number_field, $form_data);
                    $new_post_meta_value = intval($current_value) + intval($post_meta_number_field);
                    break;
                case 'decrement_by_number':
                    $post_meta_number_field = $this->get_form_field_by_id($post_meta_number_field, $form_data);
                    $new_post_meta_value = intval($current_value) - intval($post_meta_number_field);
                    break;
                case 'add_to_array':
                    // Add the new value to the array
                    if (!is_array($current_value)) {
                        $new_post_meta_value = array($current_value, $post_meta_value);
                    } else {
                        $new_post_meta_value = array_merge($current_value, array($post_meta_value));
                    }
                    break;
                case 'remove_from_array':
                    // If the current value is not an array, make it one and remove the new value
                    if (is_array($current_value)) {
                        $new_post_meta_value = array_diff($current_value, array($post_meta_value));
                    }

                    break;
                default:
                    $new_post_meta_value = $post_meta_value;
                    break;
            }

            $new_post_meta_value = $this->sanitize_value($new_post_meta_value);

            update_post_meta($post_id, $post_meta_name, $new_post_meta_value);

            // Allow Live Update if post_meta_type is not array related
            $allow_live_update = $post_meta_type === 'add_to_array' || $post_meta_type === 'remove_from_array' ? false : true;

            array_push($updated_values, [
                'selector' => $post_meta_selector,
                'value'    => $new_post_meta_value,
                'live'     => $allow_live_update,
            ]);
        }

        return $updated_values;
    }

    public function update_user_meta($form_settings, $form_data, $post_id, $form_id)
    {
        $data = $form_settings['pro_forms_post_action_update_user_meta_data'];

        $data = array_map(function ($item) {
            return array(
                'id'         => bricks_render_dynamic_data($item['id']),
                'key'        => bricks_render_dynamic_data($item['key']),
                'value'        => bricks_render_dynamic_data($item['value']),
            );
        }, $data);

        $updated_values = array();

        foreach ($data as $d) {
            $id = $d['id'];
            $key = $d['key'];
            $value = $d['value'];

            if (!isset($key) || !isset($value) || !isset($id)) {
                continue;
            }

            $key = $this->get_form_field_by_id($key, $form_data);
            $value = $this->get_form_field_by_id($value, $form_data);

            $id = absint($id);
            $key = $this->sanitize_value($key);
            $value = $this->sanitize_value($value);

            array_push($updated_values, [
                'id'     => $id,
                'key'    => $key,
                'value'     => $value,
            ]);

            update_user_meta($id, $key, $value);
        }

        return $updated_values;
    }

    public function set_storage_item($form_settings, $form_data, $post_id)
    {
        $option_data = $form_settings['pro_forms_post_action_set_storage_item_data'];

        $option_data = array_map(function ($item) {
            return array(
                'name'         => bricks_render_dynamic_data($item['name']),
                'value'        => bricks_render_dynamic_data($item['value']),
                'type'         => $item['type'],
                'selector'     => $item['selector'],
                'number_field' => bricks_render_dynamic_data($item['number_field'], $post_id),
            );
        }, $option_data);

        $updated_values = array();

        // Update Option for each $option_data
        foreach ($option_data as $option) {
            $option_name = $option['name'];
            $option_value = $option['value'];
            $option_type = $option['type'];
            $option_selector = $option['selector'];
            $option_number_field = $option['number_field'];

            if (!isset($option_name) || !isset($option_value)) {
                continue;
            }

            // Loop trough the form_data object
            foreach ($form_data as $key => $value) {
                $form_id = explode('-', $key);
                $form_id = $form_id[2];

                if ($form_id === $option_value) {
                    $option_value = $value;
                }
            }

            $new_option_value;
            $current_value = 0;

            switch ($option_type) {
                case 'replace':
                    $new_option_value = $option_value;
                    break;
                case 'increment':
                    $new_option_value = 1;
                    break;
                case 'decrement':
                    $new_option_value = 1;
                    break;
                case 'increment_by_number':
                    $option_number_field = $this->get_form_field_by_id($option_number_field, $form_data);
                    $new_option_value = intval($option_number_field);
                    break;
                case 'decrement_by_number':
                    $option_number_field = $this->get_form_field_by_id($option_number_field, $form_data);
                    $new_option_value = intval($option_number_field);
                    break;
                case 'add_to_array':
                    $new_option_value = $option_value;
                    break;
                case 'remove_from_array':
                    $new_option_value = $option_value;

                    break;
                default:
                    $new_option_value = $option_value;
                    break;
            }

            $allow_live_update = $option_type === 'add_to_array' || $option_type === 'remove_from_array' ? false : true;

            array_push($updated_values, [
                'name'     => $option_name,
                'value'    => $new_option_value,
                'live'     => $allow_live_update,
                'selector' => $option_selector,
                'type'     => $option_type
            ]);
        }

        return $updated_values;
    }

    public function create_submission($form_settings, $form_data, $post_id, $form_id)
    {
        global $wpdb;
        $form_fields = $this->get_form_fields_from_ids($form_settings, $form_data);

        if (isset($form_settings['submission_prevent_duplicates']) && $form_settings['submission_prevent_duplicates']) {
            $is_duplicate = $this->check_for_duplicates($form_settings, $form_data, $form_id);
            if ($is_duplicate[0] === true) {
                return [
                    'status'  => 'duplicate',
                    'message' => $is_duplicate[1]
                ];
            }
        }

        if (isset($form_settings['submission_max']) && !empty($form_settings['submission_max'])) {
            $max_submissions = intval(sanitize_text_field($form_settings['submission_max']));

            global $wpdb;
            $table_name = $wpdb->prefix . BRICKSFORGE_SUBMISSIONS_DB_TABLE;

            $form_id = sanitize_text_field($form_id);
            $submissions_count = $wpdb->get_var(
                $wpdb->prepare(
                    "SELECT COUNT(*) FROM $table_name WHERE form_id = %s",
                    $form_id
                )
            );

            if ($submissions_count >= $max_submissions) {
                return "Maximum submissions reached";
            }
        }

        $submission_data = array();
        $submission_data['fields'] = array();

        foreach ($form_fields as $field) {
            array_push(
                $submission_data['fields'],
                array(
                    'label' => $field['label'],
                    'value' => $field['value'],
                    'id'    => $field['id']
                )
            );
        }

        $submission_data['post_id'] = $post_id;
        $submission_data['form_id'] = $form_id;

        // Convert submission data to JSON
        $submission_json = json_encode($submission_data);

        // Insert submission data into database
        global $wpdb;
        $table_name = $wpdb->prefix . BRICKSFORGE_SUBMISSIONS_DB_TABLE;
        $result = $wpdb->insert(
            $table_name,
            array(
                'form_id'   => $form_id,
                'post_id'   => $post_id,
                'timestamp' => current_time('mysql'),
                'fields'    => $submission_json
            )
        );

        // Handle Unread Submissions
        $unread_submissions = get_option("brf_unread_submissions", array());
        array_push($unread_submissions, $wpdb->insert_id);
        update_option("brf_unread_submissions", $unread_submissions);

        return $submission_data;
    }

    public function handle_hcaptcha($form_settings, $form_data, $captcha_result)
    {
        $key = $this->get_hcaptcha_key();

        if (!$key) {
            return true;
        }

        // Get the hCaptcha response from the client-side form
        $hcaptcha_response = $captcha_result;

        if (!$hcaptcha_response || empty($hcaptcha_response)) {
            return false;
        }

        // Verify the hCaptcha response with a server-side request
        return $this->verify_hcaptcha_response($hcaptcha_response, $key);
    }

    public function verify_hcaptcha_response($hcaptcha_response, $secret)
    {
        $url = 'https://hcaptcha.com/siteverify';
        $data = [
            'secret' => $secret,
            'response' => $hcaptcha_response
        ];

        $options = [
            'http' => [
                'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($data)
            ]
        ];

        $context = stream_context_create($options);
        $response = file_get_contents($url, false, $context);
        $result = json_decode($response);

        return $result && $result->success;
    }

    public function get_hcaptcha_key()
    {
        $hcaptcha_settings = array_values(array_filter(get_option('brf_activated_elements'), function ($tool) {
            return $tool->id == 5;
        }));

        if (count($hcaptcha_settings) === 0) {
            // Handle case where the option with ID 5 is not found
            return false;
        }

        $hcaptcha_settings = $hcaptcha_settings[0];

        if (!$hcaptcha_settings->settings->useHCaptcha) {
            return false;
        }

        if (empty($hcaptcha_settings->settings->hCaptchaSecret)) {
            return false;
        }

        return $hcaptcha_settings->settings->hCaptchaSecret;
    }

    public function check_for_duplicates($form_settings, $form_data, $form_id)
    {
        $is_duplicate = [false, ''];
        $notice = "";
        $data_to_check = $form_settings['submission_prevent_duplicates_data'];

        if (!isset($data_to_check) || empty($data_to_check)) {
            return false;
        }

        foreach ($data_to_check as $data) {
            $field_id = $data['field'];
            $notice = $data['notice'] ? $data['notice'] : 'Error';

            $field_data = $form_data['form-field-' . $field_id];

            global $wpdb;

            $table_name = $wpdb->prefix . BRICKSFORGE_SUBMISSIONS_DB_TABLE;

            $submissions = $wpdb->get_results(
                $wpdb->prepare(
                    "SELECT fields FROM $table_name WHERE form_id = %s",
                    $form_id
                )
            );

            if (empty($submissions)) {
                continue;
            }

            $submissions = json_decode(json_encode($submissions), true);

            foreach ($submissions as $submission) {
                $submission = json_decode($submission['fields'], true);

                foreach ($submission['fields'] as $submission) {
                    if ($field_data && $submission['id'] == $field_id && $submission['value'] == $field_data) {
                        $is_duplicate = [true, $notice];
                    }
                }
            }
        }


        return $is_duplicate;
    }

    private function get_form_fields_from_ids($form_settings, $form_data)
    {
        $form_fields = array();

        foreach ($form_data as $field_id => $field_value) {
            // Remove "form-field-" prefix from field ID
            $clean_field_id = str_replace('form-field-', '', $field_id);

            // Check whether field ID is included in $form_settings['fields']['id']
            $field = array_filter($form_settings['fields'], function ($field) use ($clean_field_id) {
                return $field['id'] === $clean_field_id;
            });

            // If field is found, add it to $form_fields
            if (count($field) > 0) {
                $field = array_values($field)[0];
                $field['value'] = $field_value;
                array_push($form_fields, $field);
            }
        }

        return $form_fields;
    }

    public function get_form_field_by_id($id, $form_data)
    {
        foreach ($form_data as $key => $value) {
            $form_id = explode('-', $key);
            $form_id = $form_id[2];

            if ($form_id === $id) {
                return bricks_render_dynamic_data($value);
            }
        }

        return bricks_render_dynamic_data($id);
    }

    public function render_dynamic_formular_data($formula, $form_data, $field_settings)
    {
        $formula = bricks_render_dynamic_data($formula);

        // Find each word wrapped by {}. For each field, we need the value and replace it with the value returned by get_form_field_by_id()
        preg_match_all('/{([^}]+)}/', $formula, $matches);

        foreach ($matches[1] as $match) {
            $field_value = $this->get_form_field_by_id($match, $form_data);

            if (isset($field_value) && $field_value !== "") {
                $formula = str_replace('{' . $match . '}', $field_value, $formula);
            } else {
                if (isset($field_settings['setEmptyToZero']) && $field_settings['setEmptyToZero']) {
                    $formula = str_replace('{' . $match . '}', 0, $formula);
                }
            }
        }

        return $formula;
    }

    public function sanitize_value($value)
    {
        if (is_array($value)) {
            foreach ($value as $key => $sub_value) {
                $value[$key] = sanitize_value($sub_value);
            }
        } elseif (is_numeric($value)) {
            $value = preg_replace('/[^0-9]/', '', $value);
        } else {
            $value = sanitize_text_field($value);
        }
        return $value;
    }

    function shunting_yard($infix)
    {
        $infix = trim($infix);

        $output_queue = [];
        $operator_stack = [];
        $precedence = ['+' => 1, '-' => 1, '*' => 2, '/' => 2];

        // Change the regular expression to handle spaces between negative sign and number
        $tokens = preg_split('/\s*([\+\-\*\/\(\)])\s*/', ' ' . $infix, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);

        $prevToken = '';
        foreach ($tokens as $key => $token) {
            // Handle negative numbers
            if ($token === '-' && (($key === 0) || in_array($prevToken, ['+', '-', '*', '/', '(']))) {
                $next_token = array_shift($tokens);
                $token = $token . $next_token;
            }

            if (is_numeric($token)) {
                $output_queue[] = $token;
            } elseif (in_array($token, ['+', '-', '*', '/'])) {
                while (!empty($operator_stack) && isset($precedence[end($operator_stack)]) && $precedence[end($operator_stack)] >= $precedence[$token]) {
                    $output_queue[] = array_pop($operator_stack);
                }
                $operator_stack[] = $token;
            } elseif ($token == '(') {
                $operator_stack[] = $token;
            } elseif ($token == ')') {
                while (!empty($operator_stack) && end($operator_stack) != '(') {
                    $output_queue[] = array_pop($operator_stack);
                }
                if (!empty($operator_stack) && end($operator_stack) == '(') {
                    array_pop($operator_stack);
                } else {
                    return "Mismatched parentheses in the formula.";
                }
            } else {
                return "Invalid character in the formula.";
            }

            $prevToken = $token;
        }

        while (!empty($operator_stack)) {
            if (end($operator_stack) == '(' || end($operator_stack) == ')') {
                return "Mismatched parentheses in the formula.";
            }
            $output_queue[] = array_pop($operator_stack);
        }

        return $output_queue;
    }

    function evaluate_postfix($postfix)
    {
        $stack = [];

        foreach ($postfix as $token) {
            if (is_numeric($token)) {
                array_push($stack, $token);
            } elseif (in_array($token, ['+', '-', '*', '/'])) {
                if (count($stack) < 2) {
                    throw new InvalidArgumentException("Invalid formula structure.");
                }
                $num2 = array_pop($stack);
                $num1 = array_pop($stack);

                switch ($token) {
                    case '+':
                        array_push($stack, $num1 + $num2);
                        break;
                    case '-':
                        array_push($stack, $num1 - $num2);
                        break;
                    case '*':
                        array_push($stack, $num1 * $num2);
                        break;
                    case '/':
                        if ($num2 == 0) {
                            throw new InvalidArgumentException("Division by zero.");
                        }
                        array_push($stack, $num1 / $num2);
                        break;
                }
            }
        }

        if (count($stack) != 1) {
            throw new InvalidArgumentException("Invalid formula structure.");
        }

        return array_pop($stack);
    }

    public function calculate_formula($formula, $form_data, $field_settings)
    {
        $formula = $this->render_dynamic_formular_data($formula, $form_data, $field_settings);

        $postfix = $this->shunting_yard($formula);

        if (is_string($postfix)) { // Check if the returned value is an error message
            return $postfix;
        }

        $result = $this->evaluate_postfix($postfix);

        if (is_string($result)) { // Check if the returned value is an error message
            return $result;
        }

        if (isset($field_settings['roundValue']) && $field_settings['roundValue']) {
            $result = round($result);
        }

        if (isset($field_settings['hasCurrencyFormat']) && $field_settings['hasCurrencyFormat']) {
            $result = number_format($result, 2, '.', '');
        }

        return $result;
    }
}
