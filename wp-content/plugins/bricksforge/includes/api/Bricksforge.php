<?php

namespace Bricksforge\Api;

use WP_REST_Controller;

/**
 * REST_API Handler
 */
class Bricksforge extends WP_REST_Controller
{

    /**
     * [__construct description]
     */
    public function __construct()
    {
        $this->namespace = 'bricksforge/v1';
    }

    /**
     * Register the routes
     *
     * @return void
     */
    public function register_routes()
    {
        register_rest_route(
            $this->namespace,
            '/get_shortcode_content',
            array(
                array(
                    'methods'             => \WP_REST_Server::CREATABLE,
                    'callback'            => array($this, 'get_shortcode_content'),
                    'permission_callback' => array($this, 'allowed'),
                )
            )
        );
        register_rest_route(
            $this->namespace,
            '/get_user_roles',
            array(
                array(
                    'methods'             => \WP_REST_Server::READABLE,
                    'callback'            => array($this, 'get_user_roles'),
                    'permission_callback' => array($this, 'allow_permission'),
                )
            )
        );
        register_rest_route(
            $this->namespace,
            '/get_permissions_roles',
            array(
                array(
                    'methods'             => \WP_REST_Server::READABLE,
                    'callback'            => array($this, 'get_permissions_roles'),
                    'permission_callback' => array($this, 'allow_permission'),
                )
            )
        );
        register_rest_route(
            $this->namespace,
            '/save_permissions_roles',
            array(
                array(
                    'methods'             => \WP_REST_Server::CREATABLE,
                    'callback'            => array($this, 'save_permissions_roles'),
                    'permission_callback' => array($this, 'allow_permission'),
                )
            )
        );
        register_rest_route(
            $this->namespace,
            '/remove_user_role',
            array(
                array(
                    'methods'             => \WP_REST_Server::CREATABLE,
                    'callback'            => array($this, 'remove_user_role'),
                    'permission_callback' => array($this, 'allow_permission'),
                )
            )
        );
        register_rest_route(
            $this->namespace,
            '/get_global_classes',
            array(
                array(
                    'methods'             => \WP_REST_Server::READABLE,
                    'callback'            => array($this, 'get_global_classes'),
                    'permission_callback' => array($this, 'allow_permission'),
                )
            )
        );
        register_rest_route(
            $this->namespace,
            '/save_global_classes',
            array(
                array(
                    'methods'             => \WP_REST_Server::CREATABLE,
                    'callback'            => array($this, 'save_global_classes'),
                    'permission_callback' => array($this, 'allow_permission'),
                )
            )
        );
        register_rest_route(
            $this->namespace,
            '/save_tools',
            array(
                array(
                    'methods'             => \WP_REST_Server::CREATABLE,
                    'callback'            => array($this, 'save_tools'),
                    'permission_callback' => array($this, 'allow_permission'),
                )
            )
        );
        register_rest_route(
            $this->namespace,
            '/save_elements',
            array(
                array(
                    'methods'             => \WP_REST_Server::CREATABLE,
                    'callback'            => array($this, 'save_elements'),
                    'permission_callback' => array($this, 'allow_permission'),
                )
            )
        );
        register_rest_route(
            $this->namespace,
            '/save_popups',
            array(
                array(
                    'methods'             => \WP_REST_Server::CREATABLE,
                    'callback'            => array($this, 'save_popups'),
                    'permission_callback' => array($this, 'allow_permission'),
                )
            )
        );
        register_rest_route(
            $this->namespace,
            '/save_maintenance',
            array(
                array(
                    'methods'             => \WP_REST_Server::CREATABLE,
                    'callback'            => array($this, 'save_maintenance'),
                    'permission_callback' => array($this, 'allow_permission'),
                )
            )
        );
        register_rest_route(
            $this->namespace,
            '/save_whitelabel',
            array(
                array(
                    'methods'             => \WP_REST_Server::CREATABLE,
                    'callback'            => array($this, 'save_whitelabel'),
                    'permission_callback' => array($this, 'allow_permission'),
                )
            )
        );
        register_rest_route(
            $this->namespace,
            '/save_panel',
            array(
                array(
                    'methods'             => \WP_REST_Server::CREATABLE,
                    'callback'            => array($this, 'save_panel'),
                    'permission_callback' => array($this, 'allow_permission'),
                )
            )
        );
        register_rest_route(
            $this->namespace,
            '/save_settings',
            array(
                array(
                    'methods'             => \WP_REST_Server::CREATABLE,
                    'callback'            => array($this, 'save_settings'),
                    'permission_callback' => array($this, 'allow_permission'),
                )
            )
        );
        register_rest_route(
            $this->namespace,
            '/save_option',
            array(
                array(
                    'methods'             => \WP_REST_Server::CREATABLE,
                    'callback'            => array($this, 'save_option'),
                    'permission_callback' => array($this, 'allow_permission'),
                )
            )
        );
        register_rest_route(
            $this->namespace,
            '/get_option',
            array(
                array(
                    'methods'             => \WP_REST_Server::READABLE,
                    'callback'            => array($this, 'get_option'),
                    'permission_callback' => array($this, 'allow_permission'),
                )
            )
        );
        register_rest_route(
            $this->namespace,
            '/reset_to_default',
            array(
                array(
                    'methods'             => \WP_REST_Server::CREATABLE,
                    'callback'            => array($this, 'reset_to_default'),
                    'permission_callback' => array($this, 'allow_permission'),
                )
            )
        );
        register_rest_route(
            $this->namespace,
            '/export_settings',
            array(
                array(
                    'methods'             => \WP_REST_Server::CREATABLE,
                    'callback'            => array($this, 'export_settings'),
                    'permission_callback' => array($this, 'allow_permission'),
                )
            )
        );
        register_rest_route(
            $this->namespace,
            '/import_settings',
            array(
                array(
                    'methods'             => \WP_REST_Server::CREATABLE,
                    'callback'            => array($this, 'import_settings'),
                    'permission_callback' => array($this, 'allow_permission'),
                )
            )
        );
        register_rest_route(
            $this->namespace,
            '/before_form_submit',
            array(
                array(
                    'methods'             => \WP_REST_Server::CREATABLE,
                    'callback'            => array($this, 'before_form_submit'),
                    'permission_callback' => array($this, 'allowed'),
                )
            )
        );
        register_rest_route(
            $this->namespace,
            '/form_init',
            array(
                array(
                    'methods'             => \WP_REST_Server::CREATABLE,
                    'callback'            => array($this, 'form_init'),
                    'permission_callback' => array($this, 'allowed'),
                )
            )
        );
        register_rest_route(
            $this->namespace,
            '/create_global_classes_backup',
            array(
                array(
                    'methods'             => \WP_REST_Server::CREATABLE,
                    'callback'            => array($this, 'create_global_classes_backup'),
                    'permission_callback' => array($this, 'allow_permission'),
                )
            )
        );
        register_rest_route(
            $this->namespace,
            '/restore_global_classes_backup',
            array(
                array(
                    'methods'             => \WP_REST_Server::CREATABLE,
                    'callback'            => array($this, 'restore_global_classes_backup'),
                    'permission_callback' => array($this, 'allow_permission'),
                )
            )
        );
        register_rest_route(
            $this->namespace,
            '/submissions',
            array(
                array(
                    'methods'             => \WP_REST_Server::READABLE,
                    'callback'            => array($this, 'get_submissions'),
                    'permission_callback' => array($this, 'allow_permission'),
                )
            )
        );
        register_rest_route(
            $this->namespace,
            '/delete_submissions',
            array(
                array(
                    'methods'             => \WP_REST_Server::CREATABLE,
                    'callback'            => array($this, 'delete_submissions'),
                    'permission_callback' => array($this, 'allow_permission'),
                )
            )
        );
        register_rest_route(
            $this->namespace,
            '/delete_submissions_table',
            array(
                array(
                    'methods'             => \WP_REST_Server::CREATABLE,
                    'callback'            => array($this, 'delete_submissions_table'),
                    'permission_callback' => array($this, 'allow_permission'),
                )
            )
        );
        register_rest_route(
            $this->namespace,
            '/get_form_title',
            array(
                array(
                    'methods'             => \WP_REST_Server::READABLE,
                    'callback'            => array($this, 'get_form_title_by_id'),
                    'permission_callback' => array($this, 'allow_permission'),
                )
            )
        );
        register_rest_route(
            $this->namespace,
            '/render_dynamic_data',
            array(
                array(
                    'methods'             => \WP_REST_Server::READABLE,
                    'callback'            => array($this, 'render_dynamic_data'),
                    'permission_callback' => array($this, 'allowed'),
                )
            )
        );
        register_rest_route(
            $this->namespace,
            '/temporary_upload_file',
            array(
                array(
                    'methods'             => \WP_REST_Server::CREATABLE,
                    'callback'            => array($this, 'temporary_upload_file'),
                    'permission_callback' => array($this, 'allowed'),
                )
            )
        );
    }

    /**
     * Get Shortcode Content
     *
     * @param WP_REST_Request $request Full details about the request.
     *
     * @return WP_REST_Response|WP_Error Response object on success, or WP_Error object on failure.
     */
    public function get_shortcode_content($request)
    {
        $response = $request->get_body();

        if (!$response) {
            return;
        }

        $output = "";

        $template_id = $response;

        /**
         * Workaround: Bricks currently does not load styles if the template is loaded outside.
         */
        $elements = get_post_meta($template_id, BRICKS_DB_PAGE_CONTENT, true);
        $inline_css = \Bricks\Templates::generate_inline_css($template_id, $elements);

        $output .= "<style id=\"bricks-inline-css-template-{$template_id}\">{$inline_css}</style>";
        $output .= do_shortcode("[bricks_template id=" . $template_id . "]");

        return json_encode($output);
    }

    /**
     * Get User Roles
     *
     * @param WP_REST_Request $request Full details about the request.
     *
     * @return WP_REST_Response|WP_Error Response object on success, or WP_Error object on failure.
     */
    public function get_user_roles($request)
    {
        global $wp_roles;

        $all_roles = $wp_roles->roles;
        $editable_roles = apply_filters('editable_roles', $all_roles);

        $response = rest_ensure_response($editable_roles);

        return $response;
    }

    /**
     * Get Permission Roles
     *
     * @param WP_REST_Request $request Full details about the request.
     *
     * @return WP_REST_Response|WP_Error Response object on success, or WP_Error object on failure.
     */
    public function get_permissions_roles($request)
    {
        $response = rest_ensure_response(get_option('brf_permissions_roles'));
        return $response;
    }

    /**
     * Save Permission Roles
     *
     * @param WP_REST_Request $request Full details about the request.
     *
     * @return WP_REST_Response|WP_Error Response object on success, or WP_Error object on failure.
     */
    public function save_permissions_roles($request)
    {
        global $wp_roles;

        $data = $request->get_body();

        $roles = json_decode($data);


        if (!$roles || !is_array($roles)) {
            return false;
        }

        update_option('brf_permissions_roles', $roles, 'no');

        return true;
    }

    /**
     * Removes a custom User Role
     *
     * @param WP_REST_Request $request Full details about the request.
     *
     * @return WP_REST_Response|WP_Error Response object on success, or WP_Error object on failure.
     */
    public function remove_user_role($request)
    {
        $role = $request->get_body();
        if ($role != 'administrator' && $role->value != 'editor' && $role->value != 'author' && $role->value != 'contributor' && $role->value != 'subscriber') {
            remove_role(json_decode($role));
        }
        return true;
    }

    /**
     * Get Global Classes
     *
     * @param WP_REST_Request $request Full details about the request.
     *
     * @return WP_REST_Response|WP_Error Response object on success, or WP_Error object on failure.
     */
    public function get_global_classes($request)
    {
        $response = rest_ensure_response(get_option('brf_global_classes'));
        return $response;
    }

    /**
     * Save Global Classes
     *
     * @param WP_REST_Request $request Full details about the request.
     *
     * @return WP_REST_Response|WP_Error Response object on success, or WP_Error object on failure.
     */
    public function save_global_classes($request)
    {

        $data = $request->get_body();
        $categories = json_decode($data)[0];
        $activated = json_decode($data)[1];

        if (!isset($categories)) {
            return false;
        }

        if (count($categories) === 0) {
            update_option('brf_global_classes', $categories, "no");
            return false;
        }

        if (!isset($activated)) {
            return false;
        }

        if (!is_array($categories)) {
            return false;
        }

        update_option('brf_global_classes_activated', $activated);
        update_option('brf_global_classes', $categories, "no");

        $global_classes = get_option('bricks_global_classes') ? get_option('bricks_global_classes') : [];
        $global_classes_locked = get_option('bricks_global_classes_locked') ? get_option('bricks_global_classes_locked') : [];

        foreach ($categories as $category) {

            foreach ($category->classes as $class) {
                if (($key = array_search($class, $global_classes_locked)) !== false) {
                    unset($global_classes_locked[$key]);
                }

                foreach ($global_classes as $key => $row) {
                    if (isset($row["source"]) && $row["source"] === 'bricksforge') {
                        unset($global_classes[$key]);
                    }
                }
            }
        }

        $global_classes = array_values($global_classes);
        $global_classes_locked = array_values($global_classes_locked);

        foreach ($categories as $category) {

            $is_active = isset($category->active) ? $category->active : true;

            if (!$is_active) {
                continue;
            }

            if ($category->classes && !empty($category->classes)) {

                // Stop here if global classes are not activated
                if (!get_option('brf_global_classes_activated') || get_option('brf_global_classes_activated') == false) {
                    update_option('bricks_global_classes', $global_classes);
                    update_option('bricks_global_classes_locked', $global_classes_locked);
                    return false;
                }

                foreach ($category->classes as $class) {
                    array_push($global_classes, [
                        "id"       => $class,
                        "name"     => $class,
                        "settings" => array(),
                        "source"   => "bricksforge"
                    ]);

                    array_push($global_classes_locked, $class);
                }
            }
        }
        $global_classes = array_map("unserialize", array_unique(array_map("serialize", $global_classes)));
        $global_classes_locked = array_unique($global_classes_locked);
        $global_classes = array_values($global_classes);
        $global_classes_locked = array_values($global_classes_locked);

        update_option('bricks_global_classes', $global_classes);
        update_option('bricks_global_classes_locked', $global_classes_locked);

        $success = $this->render_css_files($categories);

        return $success === true;
    }

    /**
     * Save Tools
     *
     * @param WP_REST_Request $request Full details about the request.
     *
     * @return WP_REST_Response|WP_Error Response object on success, or WP_Error object on failure.
     */
    public function save_tools($request)
    {
        global $wp_roles;

        $data = $request->get_body();

        $tools = json_decode($data);

        if (!isset($tools) || !is_array($tools)) {
            return false;
        }

        update_option('brf_activated_tools', $tools);

        return true;
    }

    /**
     * Save Elements
     *
     * @param WP_REST_Request $request Full details about the request.
     *
     * @return WP_REST_Response|WP_Error Response object on success, or WP_Error object on failure.
     */
    public function save_elements($request)
    {
        global $wp_roles;

        $data = $request->get_body();

        $elements = json_decode($data);

        if (!isset($elements) || !is_array($elements)) {
            return false;
        }

        update_option('brf_activated_elements', $elements);

        return true;
    }

    /**
     * Save Popups
     *
     * @param WP_REST_Request $request Full details about the request.
     *
     * @return WP_REST_Response|WP_Error Response object on success, or WP_Error object on failure.
     */
    public function save_popups($request)
    {
        global $wp_roles;

        $data = $request->get_body();

        $elements = json_decode($data);

        if (is_null($elements) || !is_array($elements)) {
            return false;
        }

        update_option('brf_popups', $elements);

        return true;
    }

    /**
     * Save Maintenance Settings
     *
     * @param WP_REST_Request $request Full details about the request.
     *
     * @return WP_REST_Response|WP_Error Response object on success, or WP_Error object on failure.
     */
    public function save_maintenance($request)
    {
        global $wp_roles;

        $data = $request->get_body();

        $settings = json_decode($data);

        if (!$settings || !is_array($settings)) {
            return false;
        }

        update_option('brf_maintenance', $settings);

        return true;
    }

    /**
     * Save White Label Settings
     *
     * @param WP_REST_Request $request Full details about the request.
     *
     * @return WP_REST_Response|WP_Error Response object on success, or WP_Error object on failure.
     */
    public function save_whitelabel($request)
    {
        global $wp_roles;

        $data = $request->get_body();

        $settings = json_decode($data);

        if (!$settings || !is_array($settings)) {
            return false;
        }

        update_option('brf_whitelabel', $settings);

        return true;
    }

    /**
     * Save Panel Settings
     *
     * @param WP_REST_Request $request Full details about the request.
     *
     * @return WP_REST_Response|WP_Error Response object on success, or WP_Error object on failure.
     */
    public function save_panel($request)
    {
        global $wp_roles;

        $data = $request->get_body();

        $settings = json_decode($data);

        if (is_null($settings) || !is_array($settings)) {
            return false;
        }

        update_option('brf_panel', $settings);

        return true;
    }

    /**
     * Save Settings
     *
     * @param WP_REST_Request $request Full details about the request.
     *
     * @return WP_REST_Response|WP_Error Response object on success, or WP_Error object on failure.
     */
    public function save_settings($request)
    {
        $data = $request->get_body();

        $settings = json_decode($data);

        update_option('brf_settings', $settings);

        return $settings;
    }

    /**
     * Save Option
     *
     * @param WP_REST_Request $request Full details about the request.
     *
     * @return WP_REST_Response|WP_Error Response object on success, or WP_Error object on failure.
     */
    public function save_option($request)
    {
        $data = $request->get_body();
        $key = json_decode($data)[0];
        $value = json_decode($data)[1];

        update_option($key, $value);
    }

    /**
     * Get Option
     *
     * @param WP_REST_Request $request Full details about the request.
     *
     * @return WP_REST_Response|WP_Error Response object on success, or WP_Error object on failure.
     */
    public function get_option($request)
    {
        $key = $request->get_param('_key');

        return get_option($key);
    }

    /**
     * Reset to default
     *
     * @param WP_REST_Request $request Full details about the request.
     *
     * @return WP_REST_Response|WP_Error Response object on success, or WP_Error object on failure.
     */
    public function reset_to_default($request)
    {
        delete_option('brf_permissions_roles');
        delete_option('brf_global_classes_activated');
        delete_option('brf_global_classes');
        delete_option('brf_activated_tools');
        delete_option('brf_activated_elements');
        delete_option('brf_popups');
        delete_option('brf_maintenance');
        delete_option('brf_whitelabel');
        delete_option('brf_panel');
        delete_option('brf_tool_settings');
        delete_option('brf_terminal_history');
        delete_option('brf_backend_designer');
        delete_option('brf_unread_submissions');
        delete_option('brf_email_designer_data');
        delete_option('brf_email_designer_themes');
    }

    /**
     * Export all settings
     * @return WP_REST_Response|WP_Error Response object on success, or WP_Error object on failure.
     */
    public function export_settings()
    {
        $current_time = current_time('Y-m-d-H-i-s');
        $options = array(
            'brf_permissions_roles'        => get_option('brf_permissions_roles'),
            'brf_global_classes_activated' => get_option('brf_global_classes_activated'),
            'brf_global_classes'           => get_option('brf_global_classes'),
            'brf_activated_tools'          => get_option('brf_activated_tools'),
            'brf_activated_elements'       => get_option('brf_activated_elements'),
            'brf_popups'                   => get_option('brf_popups'),
            'brf_maintenance'              => get_option('brf_maintenance'),
            'brf_whitelabel'               => get_option('brf_whitelabel'),
            'brf_panel'                    => get_option('brf_panel'),
            'brf_tool_settings'            => get_option('brf_tool_settings'),
            'brf_terminal_history'         => get_option('brf_terminal_history'),
            'brf_backend_designer'         => get_option('brf_backend_designer'),
            'brf_email_designer_data'      => get_option('brf_email_designer_data'),
            'brf_email_designer_themes'    => get_option('brf_email_designer_themes'),

        );
        $json_data = json_encode($options);
        $file_name = 'bricksforge' . $current_time . '.json';

        // Set the appropriate headers
        header('Content-Type: application/json');
        header('Content-Disposition: attachment; filename="' . $file_name . '"');
        header('Content-Length: ' . strlen($json_data));

        // Send the file to the client
        echo $json_data;
        exit;
    }

    /**
     * Import settings
     *
     * @param WP_REST_Request $request Full details about the request.
     *
     * @return WP_REST_Response|WP_Error Response object on success, or WP_Error object on failure.
     */
    public function import_settings($request)
    {
        $settings = json_decode($request->get_body());

        if (is_null($settings) || !is_object($settings)) {
            return false;
        }

        update_option('brf_permissions_roles', $settings->brf_permissions_roles, 'no');
        update_option('brf_global_classes_activated', $settings->brf_global_classes_activated);
        update_option('brf_global_classes', $settings->brf_global_classes, 'no');
        update_option('brf_activated_tools', $settings->brf_activated_tools);
        update_option('brf_activated_elements', $settings->brf_activated_elements);
        update_option('brf_popups', $settings->brf_popups);
        update_option('brf_maintenance', $settings->brf_maintenance);
        update_option('brf_whitelabel', $settings->brf_whitelabel);
        update_option('brf_panel', $settings->brf_panel);
        update_option('brf_tool_settings', $settings->brf_tool_settings);
        update_option('brf_terminal_history', $settings->brf_terminal_history);
        update_option('brf_backend_designer', $settings->brf_backend_designer);
        update_option('brf_email_designer_data', $settings->brf_email_designer_data);
        update_option('brf_email_designer_themes', $settings->brf_email_designer_themes);

        return true;
    }

    /**
     * Checks if a given request has access to read the data.
     *
     * @param  WP_REST_Request $request Full details about the request.
     *
     * @return true|WP_Error True if the request has read access, WP_Error object otherwise.
     */
    public function allow_permission($request)
    {
        $nonce = $request->get_header('X-WP-Nonce');
        return is_user_logged_in() && wp_verify_nonce($nonce, 'wp_rest') && current_user_can('manage_options');
    }

    /**
     * Allow Permission
     *
     * @param  WP_REST_Request $request Full details about the request.
     *
     * @return true|WP_Error True if the request has read access, WP_Error object otherwise.
     */
    public function allowed($request)
    {
        $nonce = $request->get_header('X-WP-Nonce');
        return wp_verify_nonce($nonce, 'wp_rest');
    }

    public function temporary_upload_file()
    {
        $this->clear_temp_directory();

        $uploaded_files = [];

        // Loop over each key in the $_FILES array
        foreach ($_FILES as $key => $file) {
            // Check if the file was uploaded successfully and has no errors
            if ($file['error'] === 0) {
                // Check the file type
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $file_type = finfo_file($finfo, $file['tmp_name']);
                finfo_close($finfo);
                $allowed_types = array('image/jpeg', 'image/png', 'image/gif');
                if (!in_array($file_type, $allowed_types)) {
                    continue; // Skip the file if it's not an allowed type
                }

                // Check the file size
                $file_size = filesize($file['tmp_name']);
                $max_size = 20971520; // 20 MB (Temporarily)
                if ($file_size > $max_size) {
                    continue; // Skip the file if it's too large
                }

                // Generate a unique filename
                $file_name_new = uniqid('', true) . '_' . $file['name'];
                // Set the destination path for the uploaded file
                $file_directory = BRICKSFORGE_TEMP_DIR . 'temp/';
                if (!is_dir($file_directory)) {
                    mkdir($file_directory, 0755, true); // Create the directory if it doesn't exist
                }
                $file_destination = $file_directory . '/' . $file_name_new;
                // Move the uploaded file to the destination path
                if (move_uploaded_file($file['tmp_name'], $file_destination)) {
                    // Add the temporary file name to the array of uploaded files
                    $uploaded_files[] = $file_name_new;
                }
            }
        }

        // If no files were uploaded, return false
        if (count($uploaded_files) === 0) {
            return false;
        }

        // If only one file was uploaded, return its temporary file name
        if (count($uploaded_files) === 1) {
            return $uploaded_files[0];
        }

        // If multiple files were uploaded, return the array of temporary file names
        return $uploaded_files;
    }

    public function clear_temp_directory()
    {
        $temp_directory = BRICKSFORGE_TEMP_DIR . 'temp/';

        if (is_dir($temp_directory)) {
            $files = glob($temp_directory . '*', GLOB_MARK);

            foreach ($files as $file) {
                if (is_writable($file)) {
                    unlink($file);
                }
            }
        }
    }

    public function form_init($request)
    {
        include_once(BRICKSFORGE_PATH . '/includes/api/FormsHelper.php');
        $forms_helper = new FormsHelper();

        $form_settings = \Bricks\Helpers::get_element_settings($request->get_param('postId'), $request->get_param('formId'));

        if (!isset($form_settings) || empty($form_settings)) {
            return false;
        }

        $form_actions = $form_settings['actions'];
        $form_data = $request->get_param('formData');
        $post_id = $request->get_param('postId');
        $dynamic_post_id = $request->get_param('dynamicPostId');

        $submit_conditions = array();
        $submissions_count = null;
        $calculations = array();


        if (isset($form_settings['submitButtonHasCondition']) && $form_settings['submitButtonHasCondition'] == true) {

            foreach ($form_settings["submitButtonConditions"] as $condition) {

                $value1 = bricks_render_dynamic_data($condition['submitButtonConditionValue'], $dynamic_post_id ? $dynamic_post_id : $post_id);
                $value1 = $forms_helper->get_form_field_by_id($value1, $form_data);

                $value2 = bricks_render_dynamic_data($condition['submitButtonConditionValue2'], $dynamic_post_id ? $dynamic_post_id : $post_id);
                $value2 = $forms_helper->get_form_field_by_id($value2, $form_data);

                $submit_conditions[] = array(
                    'condition' => $condition['submitButtonCondition'],
                    'operator'  => $condition['submitButtonConditionOperator'],
                    'dataType'  => $condition['submitButtonConditionType'],
                    'value'     => $value1,
                    'value2'    => $value2,
                    'post_id'   => bricks_render_dynamic_data($condition['submitButtonConditionPostId'], $dynamic_post_id ? $dynamic_post_id : $post_id)
                );


                switch ($condition['submitButtonCondition']) {
                    case 'option':
                        $submit_conditions[count($submit_conditions) - 1]['data'] = get_option($condition['submitButtonConditionValue']);
                        break;
                    case 'post_meta':
                        $s_post_id = $forms_helper->get_form_field_by_id($submit_conditions[count($submit_conditions) - 1]['post_id'], $form_data);
                        $submit_conditions[count($submit_conditions) - 1]['data'] = get_post_meta($s_post_id, $condition['submitButtonConditionValue'], true);
                        break;
                    case 'storage_item':
                        $submit_conditions[count($submit_conditions) - 1]['data'] = get_option($condition['submitButtonConditionValue']);
                        break;
                    case 'form_field':
                        $submit_conditions[count($submit_conditions) - 1]['data'] = $form_data["form-field-" . $condition['submitButtonConditionValue']] ? $form_data["form-field-" . $condition['submitButtonConditionValue']] : $form_data["form-field-" . $condition['submitButtonConditionValue'] . '[]'];
                        break;
                    case 'submission_count_reached':
                        global $wpdb;
                        $table_name = $wpdb->prefix . BRICKSFORGE_SUBMISSIONS_DB_TABLE;

                        $form_id = sanitize_text_field($request->get_param('formId'));
                        $submissions_count = $wpdb->get_var(
                            $wpdb->prepare(
                                "SELECT COUNT(*) FROM $table_name WHERE form_id = %s",
                                $form_id
                            )
                        );
                        break;
                    case 'submission_field':
                        global $wpdb;
                        $table_name = $wpdb->prefix . BRICKSFORGE_SUBMISSIONS_DB_TABLE;

                        $form_id = sanitize_text_field($request->get_param('formId'));

                        $submissions = $wpdb->get_results(
                            $wpdb->prepare(
                                "SELECT fields FROM $table_name WHERE form_id = %s",
                                $form_id
                            )
                        );

                        if (empty($submissions)) {
                            break;
                        }

                        $submissions = json_decode(json_encode($submissions), true);

                        foreach ($submissions as $submission) {
                            $submission = json_decode($submission['fields'], true);

                            foreach ($submission['fields'] as $submission) {
                                if ($submission['id'] == $condition['submitButtonConditionValue'] && $submission['value'] == $condition['submitButtonConditionValue2']) {
                                    $submit_conditions[count($submit_conditions) - 1]['data'][] = $submission;
                                }
                            }
                        }

                        break;
                    default:
                        break;
                }
            }
        }

        if (isset($form_settings['submitButtonConditionsAlternativeText']) && !empty($form_settings['submitButtonConditionsAlternativeText'])) {
            $form_settings['submitButtonConditionsAlternativeText'] = bricks_render_dynamic_data($form_settings['submitButtonConditionsAlternativeText'], $dynamic_post_id ? $dynamic_post_id : $post_id);
        }

        // For each $form_settings['fields'] with type 'calculation' (if exists), get the key "formula". This key contains the formula to calculate the value of the field. 
        if (isset($form_settings['fields']) && !empty($form_settings['fields'])) {
            foreach ($form_settings['fields'] as $key => $field) {
                if ($field['type'] == 'calculation') {
                    $formula = $form_settings['fields'][$key]['formula'] = bricks_render_dynamic_data($field['formula'], $dynamic_post_id ? $dynamic_post_id : $post_id);
                    $result = $forms_helper->calculate_formula($formula, $form_data, $form_settings['fields'][$key]);

                    if ($result !== null && is_numeric($result)) {
                        $empty_message = isset($field['emptyMessage']) ? $field['emptyMessage'] : '';
                        array_push($calculations, array(
                            'id' => $field['id'],
                            'value' => $result,
                            'emptyMessage' => $empty_message,
                            'roundValue' => $field['roundValue'],
                            'hasCurrencyFormat' => $field['hasCurrencyFormat'],
                        ));
                    }
                }
            }
        }

        return [
            "settings"         => $form_settings,
            "fields"           => $form_data,
            "actions"          => $form_actions,
            "postID"           => $dynamic_post_id ? $dynamic_post_id : $post_id,
            "formID"           => $request->get_param('formId'),
            "submitConditions" => $submit_conditions,
            "relation"         => $form_settings['submitButtonConditionsRelation'],
            "submissionsCount" => $submissions_count ? $submissions_count : null,
            "calculations"     => $calculations,
        ];
    }

    /**
     * Before Form Submit
     *
     * @param WP_REST_Request $request Full details about the request.
     *
     * @return WP_REST_Response|WP_Error Response object on success, or WP_Error object on failure.
     */
    public function before_form_submit($request)
    {
        include_once(BRICKSFORGE_PATH . '/includes/api/FormsHelper.php');

        $forms_helper = new FormsHelper();

        $form_data = $request->get_param('formData');
        $form_files = $request->get_param('formFiles');
        $post_id = absint($request->get_param('postId'));
        $dynamic_post_id = $request->get_param('dynamicPostId');
        $form_id = $request->get_param('formId');
        $captcha_result = $request->get_param('captchaResult');
        $turnstile_result = $request->get_param('turnstileResult');

        $form_settings = \Bricks\Helpers::get_element_settings($post_id, $form_id);

        $hcaptcha_enabled = $form_settings['enableHCaptcha'];
        $turnstile_enabled = $form_settings['enableTurnstile'];

        if (!isset($form_settings) || empty($form_settings)) {
            return false;
        }

        $form_actions = $form_settings['actions'];
        $return_values = array();

        // First of all, we need to check if the captcha is valid. If not, we need to stop here.
        if ($hcaptcha_enabled === true) {
            if (!$forms_helper->handle_hcaptcha($form_settings, $form_data, $captcha_result ? $captcha_result : null)) {
                return false;
            }
        }

        if ($turnstile_enabled === true) {
            if (!$forms_helper->handle_turnstile($form_settings, $form_data, $turnstile_result ? $turnstile_result : null)) {
                wp_send_json_error(array(
                    'message' => __(isset($form_settings['turnstileErrorMessage']) ? $form_settings['turnstileErrorMessage'] : 'Your submission is being verified. Please wait a moment before submitting again.', 'bricksforge'),
                ));

                return false;
            }
        }

        if (in_array('post_create', $form_actions)) {
            $forms_helper->create_post($form_settings, $form_data);
        }

        if (in_array('post_update', $form_actions)) {
            $forms_helper->update_post($form_settings, $form_data, $post_id, $dynamic_post_id, $form_files);
        }

        if (in_array('add_option', $form_actions)) {
            $forms_helper->add_option($form_settings, $form_data);
        }

        if (in_array('update_option', $form_actions)) {
            $result = $forms_helper->update_option($form_settings, $form_data);
            if ($result) {
                $return_values['update_option'] = $result;
            }
        }

        if (in_array('delete_option', $form_actions)) {
            $forms_helper->delete_option($form_settings, $form_data);
        }

        if (in_array('update_post_meta', $form_actions)) {
            $result = $forms_helper->update_post_meta($form_settings, $form_data, $post_id, $dynamic_post_id);
            if ($result) {
                $return_values['update_post_meta'] = $result;
            }
        }

        if (in_array('set_storage_item', $form_actions)) {
            $result = $forms_helper->set_storage_item($form_settings, $form_data, $post_id);
            if ($result) {
                $return_values['set_storage_item'] = $result;
            }
        }

        if (in_array('create_submission', $form_actions)) {
            $result = $forms_helper->create_submission($form_settings, $form_data, $post_id, $form_id);
            if ($result) {
                $return_values['create_submission'] = $result;
            }
        }

        if (in_array('update_user_meta', $form_actions)) {
            $result = $forms_helper->update_user_meta($form_settings, $form_data, $post_id, $form_id);
            if ($result) {
                $return_values['update_user_meta'] = $result;
            }
        }

        if (in_array('reset_user_password', $form_actions)) {
            $result = $forms_helper->reset_user_password($form_settings, $form_data, $post_id, $form_id);
            if ($result) {
                $return_values['reset_user_password'] = $result;
            }
        }

        return $return_values;
    }

    /**
     * Get Global Classes Backups
     *
     * @param WP_REST_Request $request Full details about the request.
     *
     * @return WP_REST_Response|WP_Error Response object on success, or WP_Error object on failure.
     */
    public function create_global_classes_backup()
    {
        // Include GlobalClasses.php
        include_once(BRICKSFORGE_PATH . '/includes/global-classes/GlobalClasses.php');

        $global_classes = new \Bricksforge\GlobalClasses();

        $new_backup = $global_classes->create_global_classes_backup();

        return $new_backup;
    }

    public function restore_global_classes_backup($request)
    {

        // Get request param
        $params = $request->get_params();

        $backup_id = $params['id'];

        if (!$backup_id) {
            return false;
        }

        // Include GlobalClasses.php
        include_once(BRICKSFORGE_PATH . '/includes/global-classes/GlobalClasses.php');

        $global_classes = new \Bricksforge\GlobalClasses();

        $result = $global_classes->restore_global_classes(json_decode($backup_id));

        return $result;
    }

    public function get_submissions($request)
    {
        $page = 1;
        $per_page = 9999999;
        $search = '';
        $order_by = 'id';
        $order = 'DESC';
        $form_id = $request->get_param('formId') ? $request->get_param('formId') : null;

        global $wpdb;
        $table_name = $wpdb->prefix . BRICKSFORGE_SUBMISSIONS_DB_TABLE;

        // Calculate offset based on current page and items per page
        $offset = ($page - 1) * $per_page;

        // Build the SQL query. Join with wp_posts to get the post title
        $sql = "SELECT s.*, p.post_title FROM $table_name s JOIN {$wpdb->posts} p ON s.post_id = p.ID";

        // Add form_id filter if provided
        if (!is_null($form_id)) {
            $sql .= " WHERE s.form_id = %s";
        }

        // Add search query if provided
        if (!empty($search)) {
            $sql .= " AND s.fields LIKE '%" . $wpdb->esc_like($search) . "%'";
        }

        // Add sorting criteria
        $sql .= " ORDER BY s.$order_by $order";

        // Add limit and offset
        $sql .= " LIMIT $per_page OFFSET $offset";

        // Prepare the SQL statement
        $prepared = $wpdb->prepare($sql, $form_id);

        // Execute the query
        $results = $wpdb->get_results($prepared);

        return $results;
    }

    public function delete_submissions($request)
    {
        $request = $request->get_body();

        $request = json_decode($request);

        if (!isset($request->submissions) || empty($request->submissions)) {
            return false;
        }

        // Array of submissions
        $submissions = $request->submissions;

        if (!is_array($submissions)) {
            return false;
        }

        global $wpdb;
        $table_name = $wpdb->prefix . BRICKSFORGE_SUBMISSIONS_DB_TABLE;

        // Sanitize and prepare the array of IDs for the query
        $ids = array_map('intval', $submissions);
        $ids = array_filter($ids);
        $ids = implode(',', $ids);

        if (empty($ids)) {
            return false;
        }

        $sql = $wpdb->prepare("DELETE FROM $table_name WHERE id IN ($ids)");

        $wpdb->query($sql);

        return true;
    }

    public function delete_submissions_table()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . BRICKSFORGE_SUBMISSIONS_DB_TABLE;

        // Delete all data in the table
        $wpdb->query("TRUNCATE TABLE `$table_name`");

        // Drop the table
        $wpdb->query("DROP TABLE IF EXISTS `$table_name`");

        if (get_option('brf_submissions_display_settings')) {
            delete_option('brf_submissions_display_settings');
        }

        return true;
    }

    public function get_form_title_by_id($request)
    {
        $form_settings = \Bricks\Helpers::get_element_settings($request->get_param('postId'), $request->get_param('formId'));

        if (!isset($form_settings) || empty($form_settings)) {
            return false;
        }

        if (isset($form_settings['submission_form_title']) && !empty($form_settings['submission_form_title'])) {
            return $form_settings['submission_form_title'];
        }

        return false;
    }

    /**
     * Render CSS files for the global classes
     */
    public function render_css_files($categories)
    {
        clearstatcache();

        if (!file_exists(BRICKSFORGE_CUSTOM_STYLES_FILE) || !is_readable(BRICKSFORGE_CUSTOM_STYLES_FILE)) {
            return false;
        }

        if (!$categories || empty($categories)) {
            return false;
        }

        file_put_contents(BRICKSFORGE_CUSTOM_STYLES_FILE, ' ');

        $css_content = file_get_contents(BRICKSFORGE_CUSTOM_STYLES_FILE);

        $pattern = '/(?:[\.]{1})([a-zA-Z_]+[\w_]*)(?:[\s\.\,\{\>#\:]{0})/im';

        foreach ($categories as $category) {

            if (isset($category->active) && $category->active == false) {
                continue;
            }

            $prefix = $category->prefix;
            if (is_null($prefix)) {
                $css_content .= PHP_EOL . $category->code;
            } else {
                $category->code = preg_replace($pattern, '.' . $prefix . '-${1}', $category->code);
                $css_content .= PHP_EOL . $category->code;
            }
        }

        $result = file_put_contents(BRICKSFORGE_CUSTOM_STYLES_FILE, $css_content);

        return $result;
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

    public function render_dynamic_data($request)
    {
        $value = $request->get_param('_value');
        $post_id = $request->get_param('_post_id');

        if (empty($value)) {
            return false;
        }

        if (empty($post_id)) {
            $post_id = null;
        }

        return bricks_render_dynamic_data($value, $post_id);
    }
}
