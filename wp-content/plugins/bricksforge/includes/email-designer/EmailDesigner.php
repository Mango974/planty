<?php


namespace Bricksforge;

use TypeError;

class EmailDesigner
{

    private static $instance;

    /**
     * Holds the global variables for the Twig Parser
     * @var array
     */
    public $global_twig_vars = [];

    public static function get_instance()
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    public function __construct()
    {
        $this->init();
    }

    /**
     * Init
     * @return void
     */
    public function init()
    {
        if ($this->activated() === true) {
            add_action('admin_enqueue_scripts', [$this, 'load_dependencies']);
            $this->configure();
        }
    }

    /**
     * Load Dependencies
     * @return void
     */
    public function load_dependencies()
    {
        wp_enqueue_style('bricksforge-quill-snow');
    }

    /**
     * Configures the Email Designer
     * @return void
     */
    public function configure()
    {
        $templates = get_option('brf_email_designer_data') ? get_option('brf_email_designer_data') : false;

        if ($templates === false || !is_array($templates)) {
            return;
        }

        // Preps
        add_filter('wp_mail_content_type', [$this, 'set_content_type']);

        // User
        add_filter('wp_new_user_notification_email', [$this, 'run_wp_new_user_notification_email'], 10, 3);
        add_filter('retrieve_password_notification_email', [$this, 'run_retrieve_password_notification_email'], 10, 1);
        add_filter('new_user_email_content', [$this, 'run_new_user_email_content'], 10, 2);
        add_filter('email_change_email', [$this, 'run_email_change_email'], 10, 3);
        add_filter('password_change_email', [$this, 'run_password_change_email'], 10, 3);
        add_filter('user_request_action_email_content', [$this, 'run_user_request_action_email_content'], 10, 2);
        add_filter('wp_privacy_personal_data_email_content', [$this, 'run_wp_privacy_personal_data_email_content'], 10, 3);
        add_filter('comment_notification_text', [$this, 'run_comment_notification_text'], 10, 2);

        // Admin
        add_filter('wp_new_user_notification_email_admin', [$this, 'run_wp_new_user_notification_email_admin'], 10, 3);
        add_filter('wp_password_change_notification_email', [$this, 'run_wp_password_change_notification_email'], 10, 3);
        add_filter('new_admin_email_content', [$this, 'run_new_admin_email_content'], 10, 2);
        add_filter('user_request_confirmed_email_content', [$this, 'run_user_request_confirmed_email_content'], 10, 2);
        add_filter('comment_moderation_text', [$this, 'run_comment_moderation_text'], 10, 2);

        // Others
        add_filter('wp_mail', [$this, 'finish'], 9999, 1);

        // Test Mail
        add_action('wp_ajax_brf_email_designer_test_mail', [$this, 'send_test_mail']);
        add_action('wp_ajax_nopriv_brf_email_designer_test_mail', [$this, 'send_test_mail']);
    }

    /**
     * Finish the Email. This is the last filter that runs before the email is sent.
     * @param array $mail
     * @return array
     */
    public function finish($mail)
    {
        // Check for Bricks Templates
        $is_bricks = isset($_POST['action']) && $_POST['action'] == 'bricks_form_submit';
        $bricks_post_id;
        $bricks_form_id;
        $bricks_page;
        $bricks_fields = [];

        if ($is_bricks) {
            $bricks_post_id = $_POST['postId'];
            $bricks_form_id = $_POST['formId'];
            $bricks_page = $_POST['referrer'];

            foreach ($_POST as $key => $value) {
                if (strpos($key, 'form-field-') !== false) {
                    $field_name = str_replace('form-field-', '', $key);
                    $bricks_fields['brx_' . $field_name] = $value;
                }
            }

            $bricks_conditions = $this->check_for_bricks_conditions($bricks_form_id);

            $bricks_form_found = false;
            foreach ($bricks_conditions as $bricks_condition) {

                if ($bricks_condition->type == "bricks_form") {
                    $mail = $this->run_bricks_single($mail, $bricks_condition->formId, $bricks_fields, $bricks_post_id);
                    $bricks_form_found = true;
                }
            }

            if (!$bricks_form_found) {
                foreach ($bricks_conditions as $bricks_condition) {
                    if ($bricks_condition->type == "all_bricks_forms") {
                        $mail = $this->run_bricks_all($mail, $bricks_form_id, $bricks_fields, $bricks_post_id);
                    }
                }
            }
        }

        /**
         * Last Rechecks
         */

        // The content of our emails starts with: ###TEMPLATE:{$template_key}###.

        $template_key = $this->get_template_key($mail['message']);

        if ($template_key === false) {
            $template_key = "all";
        }

        if ($template_key === "all") {
            $mail = $this->apply_template('all', $mail);
        }

        if (strpos($mail['subject'], '[BRF_TEST]') === false) {
            // Build Subject
            $mail['subject'] = $this->get_subject($template_key, $mail['subject']);

            $mail['subject'] = $this->parse_twig($mail['subject'], $bricks_fields);

            $mail['subject'] = $this->fix_bricks_brackets($mail['subject']);

            // Build Send To
            $mail['to'] = $this->get_send_to($template_key, $mail['to']);
        }

        // Remove the template key from the content
        $mail['message'] = preg_replace('/###(?:BRFTEMPLATE:.*?|.*?)###/', '', $mail['message']);

        // Parse Twig
        $mail['message'] = $this->parse_twig($mail['message'], $bricks_fields);

        // Bricks Dynamic Data Fix
        $mail['message'] = $this->fix_bricks_brackets($mail['message']);

        return $mail;
    }

    /**
     * Clean all variables and remove all tags that are not allowed.
     * @param array $vars
     * @return array
     */
    private function clean_vars($vars)
    {
        $allowed_tags = wp_kses_allowed_html('strip');
        $cleaned_vars = [];

        foreach ($vars as $key => $value) {
            if (is_array($value)) {
                $cleaned_values = [];
                foreach ($value as $value2) {
                    $cleaned_values[] = wp_kses($value2, $allowed_tags);
                }
                $cleaned_vars[$key] = $cleaned_values;
            } else {

                // If string $key contains url, then use esc_url instead of wp_kses
                if (strpos($key, 'url') !== false) {
                    $cleaned_vars[$key] = esc_url_raw($value);
                    continue;
                }

                $cleaned_vars[$key] = wp_kses($value, $allowed_tags);
            }
        }

        return $cleaned_vars;
    }

    /**
     * Parse Twig
     * @param $content
     * @param $bricks_fields
     * @return string
     */
    public function parse_twig($content, $bricks_fields)
    {

        require_once(__DIR__ . '/../vendor/twig/autoload.php');

        $twig = new \Twig\Environment(new \Twig\Loader\ArrayLoader());
        $content = html_entity_decode($content);

        $context = $this->fetch_twig_variables($bricks_fields);

        try {
            return $twig->createTemplate($content)->render($context);
        } catch (\Twig\Error\SyntaxError $e) {
            error_log('Syntax Error: ' . $e->getMessage());
        } catch (\Twig\Error\RuntimeError $e) {
            error_log('Runtime Error: ' . $e->getMessage());
        }

        return $content;
    }

    /**
     * Fetch Twig Variables
     * @param $bricks_fields
     * @return array
     */
    private function fetch_twig_variables($bricks_fields)
    {
        $vars = [];

        foreach ($bricks_fields as $key => $value) {
            // $key to string
            $key = (string)$key;

            $vars[$key] = $value;
        }

        // Include global variables from $this->global_variables
        foreach ($this->global_twig_vars as $key => $value) {
            $vars[$key] = $value;
        }

        $cleaned_vars = $this->clean_vars($vars);

        return $cleaned_vars;
    }

    /**
     * Fix Bricks Brackets
     * @param $content
     * @return mixed
     */
    private function fix_bricks_brackets($content)
    {
        // Bricks renders variables with a {} syntax, but Twig uses {{}}. We need to replace {} regex to output the plain match
        preg_match_all('/{([\wÀ-ÖØ-öø-ÿ\-\s\.\/:\(\)\'@|,]+)}/', $content, $matches);

        // Replace {} with match
        foreach ($matches[0] as $match) {
            $content = str_replace($match, $matches[1][0], $content);
        }

        return $content;
    }

    /**
     * Get Template Key
     * @param $content
     * @return bool|string
     */
    public function get_template_key($content)
    {
        $matches = [];
        preg_match('/###BRFTEMPLATE:(.*?)###/', $content, $matches);
        return isset($matches[1]) ? $matches[1] : false;
    }

    /**
     * Check for Bricks Conditions
     * @param $bricks_form_id
     * @return array
     */
    public function check_for_bricks_conditions($bricks_form_id)
    {
        $templates = get_option('brf_email_designer_data') ? get_option('brf_email_designer_data') : false;

        $bricks_conditions = [];

        foreach ($templates as $temp) {
            if (isset($temp->conditions) && is_array($temp->conditions)) {
                foreach ($temp->conditions as $condition) {
                    if ($condition->type === "all_bricks_forms") {
                        $bricks_conditions[] = $condition;
                    }

                    if ($condition->type == "bricks_form" && $condition->formId == $bricks_form_id) {
                        $bricks_conditions[] = $condition;
                    }
                }
            }
        }

        return $bricks_conditions;
    }

    /**
     * Get Email Subject
     * @param $template_key
     * @param $default_subject
     * @return mixed
     */
    public function get_subject($template_key, $default_subject)
    {

        $template = $this->get_template($template_key);

        if (!isset($template) || $template === false) {
            return $default_subject;
        }

        if (!isset($template->canvas)) {
            return $default_subject;
        }

        if ($template->canvas->emailSubject) {
            return $template->canvas->emailSubject;
        }

        return $default_subject;
    }

    /**
     * Get Email Send To
     * @param $template_key
     * @param $default_to
     * @return mixed
     */
    public function get_send_to($template_key, $default_to)
    {

        $template = $this->get_template($template_key);

        if (!isset($template) || $template === false) {
            return $default_to;
        }

        if (!isset($template->canvas)) {
            return $default_to;
        }

        if ($template->canvas->emailSendTo) {
            return $template->canvas->emailSendTo;
        }

        return $default_to;
    }

    /**
     * Set Email Content Type
     * @param $content_type
     * @return string
     */
    public function set_content_type($content_type)
    {
        return 'text/html';
    }

    /**
     * Run Template: all
     * @param $args
     * @return mixed
     */
    public function run_all($args)
    {
        return $this->apply_template('all', $args);
    }

    /**
     * Run Template: all_bricks_forms
     * @param $args
     * @return mixed
     */
    public function run_bricks_all($mail, $form_id, $bricks_fields, $post_id)
    {
        return $this->apply_template('all_bricks_forms', $mail);
    }

    /**
     * Run Template: bricks_form
     * @param $args
     * @return mixed
     */
    public function run_bricks_single($mail, $form_id, $bricks_fields, $post_id)
    {
        return $this->apply_template('bricks_form', $mail);
    }

    /**
     * Run Template: wp_new_user_notification_email
     * @param $args
     * @return mixed
     */
    public function run_wp_new_user_notification_email($email, $user, $blogname)
    {
        $email['user'] = $user;
        return $this->apply_template('wp_new_user_notification_email', $email);
    }

    /**
     * Run Template: retrieve_password_notification_email
     * @param $args
     * @return mixed
     */
    public function run_retrieve_password_notification_email($email)
    {
        return $this->apply_template('retrieve_password_notification_email', $email);
    }

    /**
     * Run Template: wp_new_user_notification_email_admin
     * @param $args
     * @return mixed
     */
    public function run_wp_new_user_notification_email_admin($email, $user, $blogname)
    {
        $email['user'] = $user;
        return $this->apply_template('wp_new_user_notification_email_admin', $email);
    }

    /**
     * Run Template: new_user_email_content
     * @param $args
     * @return mixed
     */
    public function run_new_user_email_content($email_text, $new_user_email)
    {
        $email = ['message' => $email_text, 'to' => null, 'newemail' => $new_user_email['newemail'], 'hash' => $new_user_email['hash']];
        $result = $this->apply_template('new_user_email_content', $email);
        return $result['message'];
    }

    /**
     * Run Template: email_change_email
     * @param $args
     * @return mixed
     */
    public function run_email_change_email($email, $user, $userdata)
    {
        $email['user'] = $user;
        return $this->apply_template('email_change_email', $email);
    }

    /**
     * Run Template: password_change_email
     * @param $args
     * @return mixed
     */
    public function run_password_change_email($email, $user, $userdata)
    {
        $email['user'] = $user;
        return $this->apply_template('password_change_email', $email);
    }

    /**
     * Run Template: user_request_action_email_content
     * @param $args
     * @return mixed
     */
    public function run_user_request_action_email_content($email_text, $request_data)
    {

        $email = ['message' => $email_text, 'to' => null, 'confirm_url' => $request_data['confirm_url'], 'request_type' => $request_data['request']->action_name];
        $result = $this->apply_template('user_request_action_email_content', $email);
        return $result['message'];
    }

    /**
     * Run Template: wp_privacy_personal_data_email_content
     * @param $args
     * @return mixed
     */
    public function run_wp_privacy_personal_data_email_content($email_text, $request_id, $email_data)
    {
        $email = ['message' => $email_text, 'to' => null, 'expiration' => $email_data['expiration'], 'export_file_url' => $email_data['export_file_url']];
        $result = $this->apply_template('wp_privacy_personal_data_email_content', $email);
        return $result['message'];
    }

    /**
     * Run Template: wp_password_change_notification_email
     * @param $args
     * @return mixed
     */
    public function run_wp_password_change_notification_email($email,  $user, $blogname)
    {
        $email['user'] = $user;
        return $this->apply_template('wp_password_change_notification_email', $email);
    }

    /**
     * Run Template: new_admin_email_content
     * @param $args
     * @return mixed
     */
    public function run_new_admin_email_content($email_text, $new_admin_email)
    {
        $email = ['message' => $email_text, 'to' => null, 'newadminemail' => $new_admin_email['newemail'], 'hash' => $new_admin_email['hash']];
        $result = $this->apply_template('new_admin_email_content', $email);
        return $result['message'];
    }

    /**
     * Run Template: user_request_confirmed_email_content
     * @param $args
     * @return mixed
     */
    public function run_user_request_confirmed_email_content($email_text, $email_data)
    {
        $email = ['message' => $email_text, 'to' => $email_data['user_email'], 'request_type' => $email_data['request']->action_name, 'manage_url' => $email_data['manage_url']];
        $result = $this->apply_template('user_request_confirmed_email_content', $email);
        return $result['message'];
    }

    /**
     * Run Template: comment_moderation_text
     * @param $args
     * @return mixed
     */
    public function run_comment_moderation_text($notify_message, $comment_id)
    {
        $comment = get_comment($comment_id);
        $post = get_post($comment->comment_post_ID);

        $comment_author = $comment->comment_author;
        $comment_author_ip = $comment->comment_author_IP;
        $comment_author_domain = @gethostbyaddr($comment_author_ip);
        $comment_author_email = $comment->comment_author_email;
        $comment_author_url = $comment->comment_author_url;
        $comment_content = $comment->comment_content;

        $approve_comment_url = add_query_arg(array(
            'action' => 'approve',
            'c' => $comment_id
        ), get_edit_comment_link($comment_id));

        $trash_comment_url = add_query_arg(array(
            'action' => 'trash',
            'c' => $comment_id
        ), get_edit_comment_link($comment_id));

        $spam_comment_url = add_query_arg(array(
            'action' => 'spam',
            'c' => $comment_id
        ), get_edit_comment_link($comment_id));

        $delete_comment_url = add_query_arg(array(
            'action' => 'delete',
            'c' => $comment_id
        ), get_edit_comment_link($comment_id));


        $comment_count = get_comments_number($comment->comment_post_ID);
        $moderation_panel_url = admin_url('comment.php');
        $post_title = $post->post_title;

        $admin_url = admin_url('comment.php');

        $email =
            [
                'message' => $notify_message,
                'to' => null, 'comment_author' => $comment_author,
                'comment_author_ip' => $comment_author_ip,
                'comment_author_domain' => $comment_author_domain,
                'comment_author_email' => $comment_author_email,
                'comment_author_url' => $comment_author_url,
                'comment_content' => $comment_content,
                'approve_comment_url' => esc_url($admin_url . '' . $approve_comment_url),
                'trash_comment_url' => esc_url($admin_url . '' . $trash_comment_url),
                'spam_comment_url' => esc_url($admin_url . '' . $spam_comment_url),
                'delete_comment_url' => esc_url($admin_url . '' . $delete_comment_url),
                'comment_count' => $comment_count,
                'moderation_panel_url' => $moderation_panel_url,
                'post_title' => $post_title
            ];
        $result = $this->apply_template('comment_moderation_text', $email);
        return $result['message'];
    }

    /**
     * Run Template: comment_notification_text
     * @param $args
     * @return mixed
     */
    public function run_comment_notification_text($notify_message, $comment_id)
    {
        $comment = get_comment($comment_id);
        $post = get_post($comment->comment_post_ID);

        $comment_author = $comment->comment_author;
        $comment_author_ip = $comment->comment_author_IP;
        $comment_author_domain = @gethostbyaddr($comment_author_ip);
        $comment_author_email = $comment->comment_author_email;
        $comment_author_url = $comment->comment_author_url;
        $comment_content = $comment->comment_content;

        $approve_comment_url = add_query_arg(array(
            'action' => 'approve',
            'c' => $comment_id
        ), get_edit_comment_link($comment_id));

        $trash_comment_url = add_query_arg(array(
            'action' => 'trash',
            'c' => $comment_id
        ), get_edit_comment_link($comment_id));

        $spam_comment_url = add_query_arg(array(
            'action' => 'spam',
            'c' => $comment_id
        ), get_edit_comment_link($comment_id));

        $delete_comment_url = add_query_arg(array(
            'action' => 'delete',
            'c' => $comment_id
        ), get_edit_comment_link($comment_id));

        $comment_count = get_comments_number($comment->comment_post_ID);
        $moderation_panel_url = admin_url('comment.php');
        $post_title = $post->post_title;

        $admin_url = admin_url('comment.php');

        $email =
            [
                'message' => $notify_message,
                'to' => null, 'comment_author' => $comment_author,
                'comment_author_ip' => $comment_author_ip,
                'comment_author_domain' => $comment_author_domain,
                'comment_author_email' => $comment_author_email,
                'comment_author_url' => $comment_author_url,
                'comment_content' => $comment_content,
                'approve_comment_url' => esc_url($admin_url . '' . $approve_comment_url),
                'trash_comment_url' => esc_url($admin_url . '' . $trash_comment_url),
                'spam_comment_url' => esc_url($admin_url . '' . $spam_comment_url),
                'delete_comment_url' => esc_url($admin_url . '' . $delete_comment_url),
                'comment_count' => $comment_count,
                'moderation_panel_url' => $moderation_panel_url,
                'post_title' => $post_title
            ];

        $result = $this->apply_template('comment_notification_text', $email);
        return $result['message'];
    }

    /**
     * Apply the template
     * @param $template_key
     * @param $email
     * @param bool $test_mode
     * @return mixed
     */
    private function apply_template($template_key, $email, $test_mode = false)
    {
        $initial_message = $email['message'];

        $template = $this->get_template($template_key);

        if ($template === null) {
            return $email;
        }

        $settings = $template->canvas;

        if ($settings === false) {
            return $email;
        }

        if (strpos($initial_message, 'data-brf-email') !== false) {
            return $email;
        }

        $initial_message = wpautop($initial_message);

        $email['headers'] = ['Content-Type: text/html; charset=UTF-8'];
        $email['message'] = $this->build($initial_message, $settings, $template_key);

        $extra_vars = [];
        if (isset($email['newemail'])) $extra_vars['newemail'] = $email['newemail'];
        if (isset($email['newadminemail'])) $extra_vars['newadminemail'] = $email['newadminemail'];
        if (isset($email['hash'])) $extra_vars['hash'] = $email['hash'];
        if (isset($email['confirm_url'])) $extra_vars['confirm_url'] = $email['confirm_url'];
        if (isset($email['request_type'])) $extra_vars['request_type'] = $email['request_type'];
        if (isset($email['expiration'])) $extra_vars['expiration'] = $email['expiration'];
        if (isset($email['export_file_url'])) $extra_vars['export_file_url'] = $email['export_file_url'];
        if (isset($email['user'])) $extra_vars['user'] = $email['user'];
        if (isset($email['manage_url'])) $extra_vars['manage_url'] = $email['manage_url'];
        if (isset($email['comment_author'])) $extra_vars['comment_author'] = $email['comment_author'];
        if (isset($email['comment_author_ip'])) $extra_vars['comment_author_ip'] = $email['comment_author_ip'];
        if (isset($email['comment_author_domain'])) $extra_vars['comment_author_domain'] = $email['comment_author_domain'];
        if (isset($email['comment_author_email'])) $extra_vars['comment_author_email'] = $email['comment_author_email'];
        if (isset($email['comment_author_url'])) $extra_vars['comment_author_url'] = $email['comment_author_url'];
        if (isset($email['comment_content'])) $extra_vars['comment_content'] = $email['comment_content'];
        if (isset($email['approve_comment_url'])) $extra_vars['approve_comment_url'] = $email['approve_comment_url'];
        if (isset($email['trash_comment_url'])) $extra_vars['trash_comment_url'] = $email['trash_comment_url'];
        if (isset($email['spam_comment_url'])) $extra_vars['spam_comment_url'] = $email['spam_comment_url'];
        if (isset($email['delete_comment_url'])) $extra_vars['delete_comment_url'] = $email['delete_comment_url'];
        if (isset($email['comment_count'])) $extra_vars['comment_count'] = $email['comment_count'];
        if (isset($email['moderation_panel_url'])) $extra_vars['moderation_panel_url'] = $email['moderation_panel_url'];
        if (isset($email['post_title'])) $extra_vars['post_title'] = $email['post_title'];

        if ($test_mode === false) {
            $email['message'] = $this->handle_vars($email['message'], $email['to'], $extra_vars);
        } else {
            $email['message'] = $this->handle_vars_testmode($email['message'], $email['to'], $extra_vars);
        }

        return $email;
    }

    /**
     * Handle all available variables
     * @param $email_content
     * @param null $user_email
     * @param array $extra_vars
     * @return mixed
     */
    public function handle_vars($email_content, $user_email = null, $extra_vars = [])
    {
        $user = wp_get_current_user();

        if ($user_email) {
            $user = get_user_by('email', $user_email);
        }

        if (isset($extra_vars['user'])) {
            $user = $extra_vars['user'];
        }

        if ($user && !$user_email) {
            $user_email = $user->user_email;
        }

        $key = get_password_reset_key($user);

        $user_login = isset($user) && $user ? $user->user_login : null;

        $user_ip = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'];

        $new_email_hash = isset($extra_vars['hash']) ? $extra_vars['hash'] : null;
        $new_email_url = network_site_url("wp-admin/profile.php?newuseremail=$new_email_hash", "login");

        $new_admin_email_hash = isset($extra_vars['hash']) ? $extra_vars['hash'] : null;
        $new_admin_email_url = network_site_url("wp-admin/options.php?adminhash=$new_admin_email_hash", "login");

        $confirm_url = isset($extra_vars['confirm_url']) ? $extra_vars['confirm_url'] : null;
        $request_type = isset($extra_vars['request_type']) ? $extra_vars['request_type'] : null;
        $expiration = isset($extra_vars['expiration']) ? $extra_vars['expiration'] : null;
        $export_file_url = isset($extra_vars['export_file_url']) ? $extra_vars['export_file_url'] : null;

        $manage_url = isset($extra_vars['manage_url']) ? $extra_vars['manage_url'] : null;

        if ($expiration) {
            $expiration = date_i18n(get_option('date_format'), $expiration);
        }

        $reset_password_url = $user_login ? network_site_url("wp-login.php?action=rp&key=" . $key . "&login=" . rawurlencode($user_login), 'login') : '';

        if ($reset_password_url) {
            $reset_password_url = html_entity_decode($reset_password_url);
        }

        $allowed_vars = [
            "site_title" => get_bloginfo('name'),
            "site_url" => get_bloginfo('url'),
            "site_description" => get_bloginfo('description'),
            'admin_email' => get_option('admin_email'),
            'home_url' => home_url(),
            'login_url' => wp_login_url(),
            'current_year' => date('Y'),

            'user_name' => $user ? $user->display_name : '',
            'user_email' => $user_email ? $user_email : '',
            'user_first_name' => $user ? $user->first_name : '',
            'user_last_name' => $user ? $user->last_name : '',
            'reset_password_url' => $reset_password_url,
            'new_password_url' => $reset_password_url,
            'user_ip' => $user_ip,
            'new_user_email' => isset($extra_vars['newemail']) ? $extra_vars['newemail'] : '',
            'new_user_email_url' => $new_email_url,
            'confirm_url' => $confirm_url,
            'request_type' => $request_type,
            'expiration' => $expiration,
            'export_file_url' => $export_file_url,


            'new_admin_email' => isset($extra_vars['newadminemail']) ? $extra_vars['newadminemail'] : '',
            'new_admin_email_url' => $new_admin_email_url,
            'manage_url' => $manage_url,
            'comment_author' => isset($extra_vars['comment_author']) ? $extra_vars['comment_author'] : '',
            'comment_author_ip' => isset($extra_vars['comment_author_ip']) ? $extra_vars['comment_author_ip'] : '',
            'comment_author_domain' => isset($extra_vars['comment_author_domain']) ? $extra_vars['comment_author_domain'] : '',
            'comment_author_email' => isset($extra_vars['comment_author_email']) ? $extra_vars['comment_author_email'] : '',
            'comment_author_url' => isset($extra_vars['comment_author_url']) ? $extra_vars['comment_author_url'] : '',
            'comment_content' => isset($extra_vars['comment_content']) ? $extra_vars['comment_content'] : '',
            'approve_comment_url' => isset($extra_vars['approve_comment_url']) ? $extra_vars['approve_comment_url'] : '',
            'trash_comment_url' => isset($extra_vars['trash_comment_url']) ? $extra_vars['trash_comment_url'] : '',
            'spam_comment_url' => isset($extra_vars['spam_comment_url']) ? $extra_vars['spam_comment_url'] : '',
            'delete_comment_url' => isset($extra_vars['delete_comment_url']) ? $extra_vars['delete_comment_url'] : '',
            'comment_count' => isset($extra_vars['comment_count']) ? $extra_vars['comment_count'] : '',
            'moderation_panel_url' => isset($extra_vars['moderation_panel_url']) ? $extra_vars['moderation_panel_url'] : '',
            'post_title' => isset($extra_vars['post_title']) ? $extra_vars['post_title'] : '',
        ];

        preg_match_all('/\{\{\s*([\w\s]+?)\s*\}\}/', $email_content, $matches);

        if (isset($matches[1]) && is_array($matches[1])) {
            foreach ($matches[1] as $match) {
                if (isset($allowed_vars[$match])) {
                    $this->global_twig_vars[$match] = $allowed_vars[$match];
                }
            }
        }

        return $email_content;
    }

    /**
     * Handle variables for testmode
     * @param $email_content
     * @param null $user_email
     * @param array $extra_vars
     * @return mixed
     */
    public function handle_vars_testmode($email_content, $user_email = null, $extra_vars = [])
    {

        $allowed_vars = [
            "site_title" => get_bloginfo('name'),
            "site_url" => get_bloginfo('url'),
            "site_description" => get_bloginfo('description'),
            'admin_email' => get_option('admin_email'),
            'home_url' => home_url(),
            'login_url' => wp_login_url(),
            'current_year' => date('Y'),
            'user_name' => 'John Doe',
            'user_email' => 'john@doe.com',
            'user_first_name' => 'John',
            'user_last_name' => 'Doe',
            'reset_password_url' => 'https://www.example.com/wp-login.php?action=rp&key=owejfowiejfiowejoijwefi',
            'new_password_url' => 'https://www.example.com/wp-login.php?action=rp&key=owejfowiejfiowejoijwefi',
            'user_ip' => '192.158.1.38',
            'new_user_email' => 'john@doe.com',
            'new_user_email_url' => 'https://www.example.com/wp-login.php?action=rp&key=owejfowiejfiowejoijwefi',
            'confirm_url' => 'https://www.example.com/wp-login.php?action=rp&key=owejfowiejfiowejoijwefi',
            'request_type' => 'Export Data',
            'expiration' => '2028-01-01',
            'export_file_url' => 'https://www.example.com/path-to-file.zip',
            'new_admin_email' => 'john@doe.com',
            'new_admin_email_url' => 'https://www.example.com/path',
            'manage_url' => 'https://www.example.com/path',
            'comment_author' => 'John Doe',
            'comment_author_ip' => '192.158.1.38',
            'comment_author_domain' => 'example.com',
            'comment_author_email' => 'john@doe.com',
            'comment_author_url' => 'https://www.example.com',
            'comment_content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam euismod, nisl eget aliquam ultricies, nunc nisl aliquet nunc, quis aliquam nis',
            'approve_comment_url' => 'https://www.example.com/approve-path',
            'trash_comment_url' => 'https://www.example.com/trash-path',
            'spam_comment_url' => 'https://www.example.com/spam-path',
            'delete_comment_url' => 'https://www.example.com/delete-path',
            'comment_count' => '5',
            'moderation_panel_url' => 'https://www.example.com/moderation-path',
            'post_title' => 'I am a Post Title'
        ];

        preg_match_all('/\{\{\s*([\w\s]+?)\s*\}\}/', $email_content, $matches);

        if (isset($matches[1]) && is_array($matches[1])) {
            foreach ($matches[1] as $match) {
                if (isset($allowed_vars[$match])) {
                    $this->global_twig_vars[$match] = $allowed_vars[$match];
                }
            }
        }

        return $email_content;
    }

    /**
     * Get template by type
     * @param $type
     * @return null
     */
    public function get_template($type)
    {
        $templates = get_option('brf_email_designer_data') ? get_option('brf_email_designer_data') : false;
        $template = null;

        foreach ($templates as $temp) {
            if (isset($temp->conditions) && is_array($temp->conditions)) {
                foreach ($temp->conditions as $condition) {
                    if ($condition->type === $type) {
                        $template = $temp;
                        break;
                    }
                }
            }
        }

        if ($template === null) {
            return null;
        }

        return $template;
    }

    /**
     * Build the email template
     * @param $initial_message
     * @param $settings
     * @param $template_key
     * @return string
     */
    public function build($initial_message, $settings, $template_key)
    {

        $background_color = isset($settings->backgroundColor) ? $settings->backgroundColor : '';

        $content_background_color = isset($settings->contentBackgroundColor) ? $this->render_color($settings->contentBackgroundColor) : '';
        $text_color = isset($settings->textColor) ? $this->render_color($settings->textColor) : '';
        $content_width = isset($settings->contentWidth) ? (int)$settings->contentWidth . 'px' : 600 . 'px';
        $content_width_plain = isset($settings->contentWidth) ? (int)$settings->contentWidth : 600;
        $content_padding_left = isset($settings->contentPaddingLeft) ? (int)$settings->contentPaddingLeft . 'px' : 20 . 'px';
        $content_padding_right = isset($settings->contentPaddingRight) ? (int)$settings->contentPaddingRight . 'px' : 20 . 'px';
        $content_padding_top = isset($settings->contentPaddingTop) ? (int)$settings->contentPaddingTop . 'px' : 20 . 'px';
        $content_padding_bottom = isset($settings->contentPaddingBottom) ? (int)$settings->contentPaddingBottom . 'px' : 20 . 'px';
        $font_size = isset($settings->fontSize) ? (int)$settings->fontSize . 'px' : 16 . 'px';

        $wordpress_lang = get_locale();

        $content = "###BRFTEMPLATE:{$template_key}###";
        $content .= "<!DOCTYPE html>";
        $content .= "<html lang='{$wordpress_lang}' style='height: 100%;'>";
        $content .= "<head>";
        $content .= "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />";
        $content .= $this->get_global_styles($settings);
        $content .= "</head>";
        $content .= "<body style='height: 100%; margin: 0; padding: 0; background: {$background_color}; font-family: Arial, sans-serif'>";
        $content .= $this->get_custom_css($settings);
        $content .= "<table data-brf-email width='100%' height='100%' cellpadding='0' cellspacing='0' role='presentation' style='background: {$background_color};'>";
        $content .= "<tr><td valign='top'>";
        $content .= "<table class='email-content-wrapper' width='{$content_width_plain}' align='center' cellpadding='0' cellspacing='0' role='presentation' style='background: {$content_background_color}; color: {$text_color}; font-size: {$font_size}; box-sizing:border-box; height: 100%; margin: 0 auto; padding-left: {$content_padding_left}; padding-right: {$content_padding_right}; padding-top: {$content_padding_top}; padding-bottom: {$content_padding_bottom}; width: {$content_width}'><tr><td valign='top'>";

        // For each $settings->elements, add the element to the message
        if (isset($settings->elements) && is_array($settings->elements)) {
            foreach ($settings->elements as $element) {

                if (isset($element->parent) && $element->parent !== null) {
                    continue;
                }

                $content .= $this->render_individual_element($element, $settings, $initial_message);
            }
        }

        $content .= "</td></tr></table>";
        $content .= "</td></tr>";
        $content .= "</table>";
        $content .= "</body>";
        $content .= "</html>";

        return $content;
    }

    /**
     * Get Global Styles
     * @param $settings
     * @return string
     */
    public function get_global_styles($settings)
    {
        $heading_font_family = isset($settings->headingFontFamily) ? $settings->headingFontFamily : 'Arial, sans-serif';
        $heading_font_weight = isset($settings->headingFontWeight) ? $settings->headingFontWeight : 400;
        $text_font_family = isset($settings->textFontFamily) ? $settings->textFontFamily : 'Arial, sans-serif';
        $button_font_family = isset($settings->buttonFontFamily) ? $settings->buttonFontFamily : 'Arial, sans-serif';
        $link_color = isset($settings->linkColor) ? $this->render_color($settings->linkColor) : '';
        $link_hover_color = isset($settings->linkHoverColor) ? $this->render_color($settings->linkHoverColor) : '';

        $font_size = isset($settings->fontSize) ? (int)$settings->fontSize . 'px' : '';
        $text_color = isset($settings->textColor) ? $this->render_color($settings->textColor) : '';
        $font_size_h1 = isset($settings->fontSizeH1) ? (int)$settings->fontSizeH1 . 'px' : '';
        $font_size_h2 = isset($settings->fontSizeH2) ? (int)$settings->fontSizeH2 . 'px' : '';
        $font_size_h3 = isset($settings->fontSizeH3) ? (int)$settings->fontSizeH3 . 'px' : '';
        $heading_text_color = isset($settings->headingTextColor) ? $this->render_color($settings->headingTextColor) : '';

        $responsive_content_padding_top = isset($settings->responsive->contentPaddingTop) ? (int)$settings->responsive->contentPaddingTop . 'px' : $settings->contentPaddingTop . 'px';
        $responsive_content_padding_bottom = isset($settings->responsive->contentPaddingBottom) ? (int)$settings->responsive->contentPaddingBottom . 'px' : $settings->contentPaddingBottom . 'px';
        $responsive_content_padding_left = isset($settings->responsive->contentPaddingLeft) ? (int)$settings->responsive->contentPaddingLeft . 'px' : $settings->contentPaddingLeft . 'px';
        $responsive_content_padding_right = isset($settings->responsive->contentPaddingRight) ? (int)$settings->responsive->contentPaddingRight . 'px' : $settings->contentPaddingRight . 'px';
        $responsive_column_alignment = isset($settings->responsive->columnAlign) ? $settings->responsive->columnAlign : 'left';
        $responsive_column_gap = isset($settings->responsive->columnGap) ? (int)$settings->responsive->columnGap . 'px' : 5 . 'px';

        $styles = [];

        $styles[] = "body { margin: 0; padding: 0; font-family: {$text_font_family}; }";
        $styles[] = ".email-content-wrapper a { color: {$link_color}; text-decoration: none; }";
        $styles[] = "p {margin: 0; padding: 0; margin-bottom: 0.5em; font-family: {$text_font_family}; font-size: {$font_size}; }";
        $styles[] = "h1,h2,h3,h4,h5,h6 {padding: 0; margin: 0; font-family: {$heading_font_family}; font-weight: {$heading_font_weight}; color: {$heading_text_color};}";
        $styles[] = ".email-content-wrapper h1 {font-size: {$font_size_h1};}";
        $styles[] = ".email-content-wrapper h2 {font-size: {$font_size_h2};}";
        $styles[] = ".email-content-wrapper h3 {font-size: {$font_size_h3};}";
        $styles[] = ".email-content-wrapper a:hover { color: {$link_hover_color}; }";
        $styles[] = ".button-default { font-family: {$button_font_family}; }";
        $styles[] = ".button-default:hover { background-color: {$this->render_color($settings->buttonBackgroundHoverColor)}!important; color: {$this->render_color($settings->buttonTextHoverColor)}!important; }";
        $styles[] = "table { table-layout: fixed; } p {hyphens: auto; word-break: break-word;}";

        // Media Query. If the browser width is less than $settings->contentWidth, then the content width to 100%
        $styles[] = "@media only screen and (max-width: {$settings->contentWidth}px) { 
            .email-content-wrapper { 
                width: 100% !important; 
                padding-top: {$responsive_content_padding_top}!important;
                padding-bottom: {$responsive_content_padding_bottom}!important;
                padding-left: {$responsive_content_padding_left}!important;
                padding-right: {$responsive_content_padding_right}!important;
            }  
            .email-content-wrapper img.img-fullwidth { 
                max-width: calc(100% + {$settings->contentPaddingLeft}px + {$settings->contentPaddingRight}px)!important; 
            }
            .column-wrapper-full { 
                width: calc(100% + {$settings->contentPaddingLeft}px + {$settings->contentPaddingRight}px)!important; 
                margin-right: inherit!important 
            }
            .column-child {
                display: block!important;
                width: 100%!important;
                padding-bottom: {$responsive_column_gap}!important;
            }
            .column-child * {
                text-align: {$responsive_column_alignment}!important;
            }
            p {
                width: 100% !important;
            }
        }";

        return '<style>' . implode(' ', $styles) . '</style>';
    }

    /**
     * Get Custom User Css
     * @param $settings
     * @return string
     */
    public function get_custom_css($settings)
    {
        $custom_css = isset($settings->customCss) ? $settings->customCss : false;

        if ($custom_css) {
            // Sanitize the CSS code
            $sanitized_css = $this->sanitize_css($custom_css);

            return "<style>{$sanitized_css}</style>";
        }

        return '';
    }

    /**
     * Sanitize CSS code
     * @param string $css
     * @return string
     */
    function sanitize_css($css)
    {
        // Remove any JavaScript code or HTML tags
        $sanitized_css = preg_replace('/(javascript:|<\s*script|<\s*\/\s*script|<\s*|\s*>)|\s*expression\s*\(/i', '', $css);

        return $sanitized_css;
    }

    /**
     * Get Children Elements for Column Type
     * @param $parent_id
     * @param $elements
     * @param null $parent_index
     * @return array
     */
    public function get_children_elements($parent_id, $elements, $parent_index = null)
    {
        $children = [];

        foreach ($elements as $element) {
            if (isset($element->parent) && $element->parent === $parent_id) {
                if ($parent_index === null || (isset($element->parentIndex) && $element->parentIndex == $parent_index)) {
                    $children[] = $element;
                }
            }
        }

        // Order the children by parentIndex

        usort($children, function ($a, $b) {
            return $a->index - $b->index;
        });

        return $children;
    }

    /**
     * Get Parent Element for Column types
     * @param $parent_id
     * @return bool
     */
    public function get_parent($parent_id)
    {
        $templates = get_option('brf_email_designer_data');

        if (!$templates) {
            return false;
        }

        foreach ($templates as $template) {
            if ($template->canvas->elements) {
                foreach ($template->canvas->elements as $element) {
                    if ($element->id === $parent_id) {
                        return $element;
                    }
                }
            }
        }

        return false;
    }

    /**
     * Render Element
     * @param $element
     * @param $settings
     * @param $initial_message
     * @return string
     */
    public function render_element($element, $settings, $initial_message)
    {
        return $this->render_individual_element($element, $settings, $initial_message);
    }

    /**
     * Sanitize HTML
     * @param $html
     * @return string
     */
    public function sanitize_html($html)
    {

        // Temporary add display to safe_style_css
        add_filter('safe_style_css', function ($styles) {
            $styles[] = 'display';
            return $styles;
        });

        if (!$html) {
            return '';
        }

        $allowed_html = wp_kses_allowed_html('post');

        $clean_html = wp_kses($html, $allowed_html);

        // Remove display from safe_style_css
        remove_filter('safe_style_css', function ($styles) {
            $styles = array_diff($styles, ['display']);
            return $styles;
        });

        return $clean_html;
    }

    /**
     * Render Individual Element
     * @param $element
     * @param $settings
     * @param $initial_message
     * @return string
     */
    public function render_individual_element($element, $settings, $initial_message)
    {
        $args_message = "";
        switch ($element->type) {
            case 'content':
                $args_message .= "<table cellpadding='0' cellspacing='0' role='presentation' {$this->get_styles('content',$element,$settings)}><tr><td valign='top'>";
                $args_message .= $initial_message;
                $args_message .= "</td></tr></table>";
                break;
            case 'h1':
                $args_message .= "<table cellpadding='0' cellspacing='0' role='presentation' style='width: 100%; padding-top: {$this->get_setting("spacingTop",$element, 'px')}; padding-bottom: {$this->get_setting("spacingBottom",$element, 'px')}';><tr><td valign='top'>";
                $args_message .= "<h1 {$this->get_styles('h1',$element,$settings)}>";
                $args_message .= bricks_render_dynamic_data($element->settings->text->value);
                $args_message .= "</h1>";
                $args_message .= "</td></tr></table>";
                break;
            case 'h2':
                $args_message .= "<table cellpadding='0' cellspacing='0' role='presentation' style='width: 100%; padding-top: {$this->get_setting("spacingTop",$element, 'px')}; padding-bottom: {$this->get_setting("spacingBottom",$element, 'px')}';><tr><td valign='top'>";
                $args_message .= "<h2 {$this->get_styles('h2',$element,$settings)}>";
                $args_message .= bricks_render_dynamic_data($element->settings->text->value);
                $args_message .= "</h2>";
                $args_message .= "</td></tr></table>";
                break;
            case 'h3':
                $args_message .= "<table cellpadding='0' cellspacing='0' role='presentation' style='width: 100%; padding-top: {$this->get_setting("spacingTop",$element, 'px')}; padding-bottom: {$this->get_setting("spacingBottom",$element, 'px')}';><tr><td valign='top'>";
                $args_message .= "<h3 {$this->get_styles('h3',$element,$settings)}>";
                $args_message .= bricks_render_dynamic_data($element->settings->text->value);
                $args_message .= "</h3>";
                $args_message .= "</td></tr></table>";
                break;
            case 'text':
                $args_message .= "<table cellpadding='0' cellspacing='0' role='presentation' style='width: 100%;'><tr><td valign='top'>";
                $args_message .= "<table cellpadding='0' cellspacing='0' role='presentation' {$this->get_styles('text',$element,$settings)}>";
                $args_message .= "<tr><td valign='top'>";
                $args_message .= bricks_render_dynamic_data($element->settings->text->value);
                $args_message .= "</td></tr>";
                $args_message .= "</table>";
                $args_message .= "</td></tr></table>";
                break;
            case 'spacing':
                $args_message .= "<table cellpadding='0' cellspacing='0' role='presentation' {$this->get_styles('spacing',$element,$settings)}><tr><td valign='top'>";
                $args_message .= "</td></tr></table>";
                break;
            case 'dynamicData':
                $post_id = isset($element->settings->postId->value) ? $element->settings->postId->value : get_the_ID();

                $args_message .= "<table cellpadding='0' cellspacing='0' role='presentation' style='width: 100%;'><tr><td valign='top'>";
                $args_message .= "<p {$this->get_styles('dynamicData',$element,$settings)}>";
                $args_message .= bricks_render_dynamic_data($element->settings->text->value, $post_id);
                $args_message .= "</p>";
                $args_message .= "</td></tr></table>";
                break;
            case 'html':
                $args_message .= "<table cellpadding='0' cellspacing='0' role='presentation' {$this->get_styles('html',$element,$settings)}><tr><td valign='top'>";
                $args_message .= $this->sanitize_html($element->settings->html->value);
                $args_message .= "</td></tr></table>";
                break;
            case 'image':
                $image_url = isset($element->settings->image->value) && !empty($element->settings->image->value) ? $element->settings->image->value : 'https://placehold.co/600x400';
                $image_link = isset($element->settings->link->value) ? $element->settings->link->value : '';
                $is_fullwidth = isset($element->settings->fullWidth) && $element->settings->fullWidth->value;
                $image_text_align = isset($element->settings->textAlign->value) ? $element->settings->textAlign->value : 'center';

                if ($image_link !== '') {
                    $args_message .= "<table cellpadding='0' cellspacing='0' role='presentation' style='width: 100%;'><tr><td valign='top' align='{$image_text_align}' {$this->get_styles('imageContainer',$element,$settings)}>";
                    $args_message .= "<a href='{$image_link}' {$this->get_styles('imageWrapper',$element,$settings)}" . ($is_fullwidth ? " class='img-fullwidth'" : "") . ">";
                    $args_message .= "<img alt='Image' src='{$image_url}' {$this->get_styles('image',$element,$settings)}"  . ($is_fullwidth ? " class='img-fullwidth'" : "") . ">";
                    $args_message .= "</a>";
                    $args_message .= "</td></tr></table>";
                } else {
                    $args_message .= "<table cellpadding='0' cellspacing='0' role='presentation' style='width: 100%;'><tr><td valign='top' align='{$image_text_align}' {$this->get_styles('imageContainer',$element,$settings)}>";
                    $args_message .= "<img alt='Image' src='{$image_url}' {$this->get_styles('image',$element,$settings)}"  . ($is_fullwidth ? " class='img-fullwidth'" : "") . ">";
                    $args_message .= "</td></tr></table>";
                }

                break;
            case 'button':
                $button_text = isset($element->settings->text->value) ? $element->settings->text->value : '';
                $button_link = isset($element->settings->link->value) ? $element->settings->link->value : '';
                $text_align = isset($element->settings->textAlign->value) ? $element->settings->textAlign->value : 'center';
                $button_bgcolor = $this->render_color($settings->buttonBackgroundColor);
                $button_textcolor = $this->render_color($settings->buttonTextColor);
                $button_padding_top = isset($element->settings->spacingTop->value) ? $element->settings->spacingTop->value . 'px' : '0px';
                $button_padding_bottom = isset($element->settings->spacingBottom->value) ? $element->settings->spacingBottom->value . 'px' : '0px';

                $args_message .= "<table cellpadding='0' cellspacing='0' role='presentation' style='width: 100%'><tr><td valign='top' style='text-align: {$text_align}; padding: {$button_padding_top} 0 {$button_padding_bottom} 0;'>";
                $args_message .= "<!--[if mso]>";
                $args_message .= "<v:roundrect xmlns:v='urn:schemas-microsoft-com:vml' xmlns:w='urn:schemas-microsoft-com:office:word' href='{$button_link}' style='height:36px;v-text-anchor:middle;width:150px;' arcsize='10%' strokecolor='{$button_bgcolor}' fillcolor='{$button_bgcolor}'>";
                $args_message .= "<w:anchorlock/>";
                $args_message .= "<center style='color:{$button_textcolor};font-family:sans-serif;font-size:13px;'>{$button_text}</center>";
                $args_message .= "</v:roundrect>";
                $args_message .= "<![endif]-->";
                $args_message .= "<!--[if !mso]><!-->";
                $args_message .= "<a class='button-default' href='{$button_link}' {$this->get_styles('button',$element,$settings)}>";
                $args_message .= $button_text;
                $args_message .= "</a>";
                $args_message .= "<!--<![endif]-->";
                $args_message .= "</td></tr></table>";
                break;

            case 'columns':
                $column_count = isset($element->settings->count) ? $element->settings->count->value : 1;
                $width_ratio = isset($element->settings->widthRatio) ? $element->settings->widthRatio->value : "50:50";
                $width_ratios = explode(":", $width_ratio);
                $column_widths = array();

                for ($i = 0; $i < $column_count; $i++) {
                    if (isset($width_ratios[$i])) {
                        $column_widths[$i] = $width_ratios[$i] . "%";
                    } else {
                        $column_widths[$i] = "50%";
                    }
                }

                $gap = isset($element->settings->gap) ? $element->settings->gap->value . 'px' : 0 . 'px';

                $args_message .= "<table class='" . ($element->settings->fullWidthWrapper->value == true ? "column-wrapper-full" : "column-wrapper") . "' width='100%' cellpadding='0' cellspacing='0' role='presentation' " . $this->get_styles('columns', $element, $settings) . ">";
                $args_message .= "<tr>";

                for ($i = 0; $i < $column_count; $i++) {

                    if ($i == $column_count - 1) {
                        $gap = 0;
                    }

                    $args_message .= "<td class='column-child' style='width: {$column_widths[$i]}; padding-right: {$gap}' valign='top'>";

                    $column_children_elements = $this->get_children_elements($element->id, $settings->elements, $i + 1);

                    foreach ($column_children_elements as $column_child_element) {
                        $column_content = $this->render_individual_element($column_child_element, $settings, $initial_message);
                        $args_message .= $column_content;
                    }

                    $args_message .= "</td>";
                }

                $args_message .= "</tr>";
                $args_message .= "</table>";
                break;
            case 'if':
                $args_message .= "{% if {$element->settings->condition->value} %}";
                break;
            case 'elseif':
                $args_message .= "{% elseif {$element->settings->condition->value} %}";
                break;
            case 'else':
                $args_message .= "{% else %}";
                break;
            case 'endif':
                $args_message .= "{% endif %}";
                break;
        }

        return $args_message;
    }

    /**
     * Get Single Styles for element. (Included to style attribute)
     * @param $element_type
     * @param $element
     * @param $settings
     * @return string
     */
    public function get_styles($element_type, $element, $settings)
    {

        $is_column_child = isset($element->parent) && $element->parent !== null;
        $parent = null;

        if ($is_column_child) {
            $parent = $this->get_parent($element->parent);
        }

        $styles = [];

        switch ($element_type) {
            case 'content':
                $styles[] = "padding-top: {$this->get_setting("spacingTop",$element, 'px')}";
                $styles[] = "padding-bottom: {$this->get_setting("spacingBottom",$element, 'px')}";
                $styles[] = "text-align: {$this->get_setting("textAlign",$element)}";
                $styles[] = "font-size: {$settings->fontSize}px";
                $styles[] = "color: {$this->render_color($settings->textColor)}";
                $styles[] = "line-height: {$settings->lineHeightText}";
                $styles[] = "width: 100%";
                break;
            case 'h1':
                $styles[] = "margin-block-end: 0";
                $styles[] = "font-size: {$settings->fontSizeH1}px";
                $styles[] = "color: {$this->render_color($settings->headingTextColor)}";
                $styles[] = "text-align: {$this->get_setting("textAlign",$element)}";
                $styles[] = "line-height: {$settings->lineHeightHeadings}";

                if ($is_column_child && $parent) {
                    $styles[] = "color: {$this->render_color($this->get_setting("headingColor",$parent))}";
                }

                break;
            case 'h2':
                $styles[] = "font-size: {$settings->fontSizeH2}px";
                $styles[] = "color: {$this->render_color($settings->headingTextColor)}";
                $styles[] = "text-align: {$this->get_setting("textAlign",$element)}";
                $styles[] = "line-height: {$settings->lineHeightHeadings}";

                if ($is_column_child && $parent) {
                    $styles[] = "color: {$this->render_color($this->get_setting("headingColor",$parent))}";
                }

                break;
            case 'h3':
                $styles[] = "font-size: {$settings->fontSizeH3}px";
                $styles[] = "color: {$this->render_color($settings->headingTextColor)}";
                $styles[] = "text-align: {$this->get_setting("textAlign",$element)}";
                $styles[] = "line-height: {$settings->lineHeightHeadings}";

                if ($is_column_child && $parent) {
                    $styles[] = "color: {$this->render_color($this->get_setting("headingColor",$parent))}";
                }

                break;
            case 'text':
                $styles[] = "font-size: {$settings->fontSize}px";
                $styles[] = "color: {$this->render_color($settings->textColor)}";
                $styles[] = "padding-top: {$this->get_setting("spacingTop",$element, 'px')}";
                $styles[] = "padding-bottom: {$this->get_setting("spacingBottom",$element, 'px')}";
                $styles[] = "text-align: {$this->get_setting("textAlign",$element)}";
                $styles[] = "line-height: {$settings->lineHeightText}";
                $styles[] = "width: 100%";

                if ($is_column_child && $parent) {
                    $styles[] = "color: {$this->render_color($this->get_setting("textColor",$parent))}";
                }

                break;
            case 'spacing':
                $styles[] = "height: {$this->get_setting("height",$element, 'px')}";
                $styles[] = "width: 100%";
                break;
            case 'dynamicData':
                $styles[] = "padding-top: {$this->get_setting("spacingTop",$element, 'px')}";
                $styles[] = "padding-bottom: {$this->get_setting("spacingBottom",$element, 'px')}";
                $styles[] = "text-align: {$this->get_setting("textAlign",$element)}";
                break;
            case 'html':
                $styles[] = "padding-top: {$this->get_setting("spacingTop",$element, 'px')}";
                $styles[] = "padding-bottom: {$this->get_setting("spacingBottom",$element, 'px')}";
                $styles[] = "width: 100%";
                break;
            case 'imageContainer':
                $styles[] = "padding-top: {$this->get_setting("spacingTop",$element, 'px')}";
                $styles[] = "padding-bottom: {$this->get_setting("spacingBottom",$element, 'px')}";
                break;
            case 'imageWrapper':
                $styles[] = "text-align: {$this->get_setting("textAlign",$element)}";
                $styles[] = "display: block";
                break;
            case 'image':
                $styles[] = "width: {$this->get_setting("width",$element, 'px')}";

                $styles[] = "max-width: 100%";

                if ($this->get_setting("fullWidth", $element) == 'true') {
                    $styles[] = "width: {$settings->contentWidth}px";
                    $styles[] = "max-width: {$settings->contentWidth}px";
                    $styles[] = "margin-left: -{$settings->contentPaddingLeft}px";
                    $styles[] = "margin-right: -{$settings->contentPaddingRight}px";
                }

                break;
            case 'button':
                $styles[] = "text-align: {$this->get_setting("textAlign",$element)}";
                $styles[] = "background-color: {$this->render_color($settings->buttonBackgroundColor)}";
                $styles[] = "color: {$this->render_color($settings->buttonTextColor)}";
                $styles[] = "border-radius: {$settings->buttonBorderRadius}px";
                $styles[] = "padding: {$settings->buttonPadding}";
                $styles[] = "text-decoration: none";
                $styles[] = "display: inline-block";
                $styles[] = "font-weight: {$settings->buttonFontWeight}";

                break;
            case 'columns':
                $styles[] = "margin-top: {$this->get_setting("spacingTop",$element, 'px')}";
                $styles[] = "margin-bottom: {$this->get_setting("spacingBottom",$element, 'px')}";
                $styles[] = "background-color: {$this->render_color($this->get_setting("backgroundColor",$element))}";
                $styles[] = "padding: {$this->get_setting("padding",$element, 'px')}";

                if ($this->get_setting("fullWidthWrapper", $element) == 'true') {
                    $styles[] = "width: {$settings->contentWidth}px";
                    $styles[] = "margin-left: -{$settings->contentPaddingLeft}px";
                    $styles[] = "margin-right: -{$settings->contentPaddingRight}px";
                    $styles[] = "padding-left: {$settings->contentPaddingLeft}px";
                    $styles[] = "padding-right: {$settings->contentPaddingRight}px";
                }

                break;
        }

        return "style='" . implode(";", $styles) . "'";
    }

    public function render_color($color)
    {
        // Store original color
        $original_color = $color;

        // Remove any leading '#'
        $color = ltrim($color, '#');

        // Check if color is 8-digit hex
        if (strlen($color) == 8) {
            // Remove the last two characters (alpha channel)
            $color = substr($color, 0, 6);
        }

        // Check if color is RGB or RGBA
        elseif (strpos($color, 'rgb') !== false) {
            // Remove 'rgb(' or 'rgba(', and ')' then convert to array
            $color = str_replace(array('rgb(', 'rgba(', ')'), '', $color);
            $parts = explode(',', $color);

            // Convert each part to hex
            for ($i = 0; $i < 3; $i++) {
                // Convert to decimal and then to hex
                $parts[$i] = dechex(intval(trim($parts[$i])));

                // Ensure each part is two characters
                if (strlen($parts[$i]) == 1) {
                    $parts[$i] = '0' . $parts[$i];
                }
            }

            // Merge parts into one 6-digit hex color
            $color = implode('', $parts);
        }

        // Ensure color is 6 digits
        if (strlen($color) != 6) {
            // If color format doesn't match, return the original color
            return $original_color;
        }

        return '#' . $color;
    }

    /**
     * Get Specific Element Setting
     * @param $setting
     * @param $element
     * @param bool $unit
     * @return bool|string
     */
    public function get_setting($setting, $element, $unit = false)
    {
        if (!isset($element->settings)) {
            return false;
        }

        foreach ($element->settings as $key => $value) {
            if ($key === $setting) {
                $output = $value->value;

                if ($unit) {
                    $output .= $unit;
                }

                return $output;
            }
        }
    }

    /**
     * Send a test email
     * @return void
     */
    public function send_test_mail()
    {

        $template_key = $_POST['templateKey'];

        if (!isset($template_key) || empty($template_key)) {
            wp_die();
        }

        $email = [
            'subject' => '',
            'message' => $this->get_default_message($template_key),
            'headers' => array('Content-Type: text/html; charset=UTF-8'),
            'to' => $_POST['to'],
            'from' => get_option('admin_email')
        ];

        $email = $this->apply_template($template_key, $email, true);

        $email['to'] = $_POST['to'];
        $email['subject'] = '[BRF_TEST] ' . $this->get_subject($template_key, 'Test Email');

        wp_mail($email['to'], $email['subject'], $email['message'], $email['headers']);

        wp_die();
    }

    /**
     * Get the default message for a template
     * @param $template_key
     * @return string
     */
    public function get_default_message($template_key)
    {
        $default_message = "This is a placeholder for the text content of an email. The actual content for this part will be dynamically generated and inserted from your WordPress website.";

        return $default_message;
    }

    /**
     * Check if this extension is activated
     * @return bool
     */
    public function activated()
    {
        $options = get_option('brf_activated_tools') ? get_option('brf_activated_tools') : false;

        if ($options && in_array(13, $options)) {
            return true;
        }

        return false;
    }
}
