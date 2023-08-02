<?php

namespace Bricksforge;

/**
 * Frontend Pages Handler
 */
class Frontend
{

    public function __construct()
    {

        $this->render_conditionals();

        wp_enqueue_style('bricksforge-style');
        wp_enqueue_style('bricksforge-style');

        if (bricks_is_builder()) {
            wp_enqueue_style('bricksforge-builder');
            wp_enqueue_script('bricksforge-builder');
        }

        add_shortcode('bricksforge', [$this, 'render_frontend']);
    }

    public function render_conditionals()
    {

        // Panel
        if (get_option('brf_activated_tools') && in_array(6, get_option('brf_activated_tools'))) {
            $panel_data = get_option('brf_panel');

            if (bricks_is_builder()) {
                wp_enqueue_script('bricksforge-panel');
                wp_enqueue_script('bricksforge-gsap-draggable');
                wp_enqueue_script('bricksforge-gsap-splittext');
                wp_enqueue_script('bricksforge-gsap-flip');
            }

            if ($panel_data) {

                $panel_data = $panel_data[0];

                $instances = isset($panel_data->instances) ? $panel_data->instances : false;
                $timelines = isset($panel_data->timelines) ? $panel_data->timelines : false;

                if ($timelines) {
                    wp_enqueue_script('bricksforge-panel');
                    wp_enqueue_script('bricksforge-gsap');

                    // Check if $timelines contains an item on which the key "trigger" is equal to "scrollTrigger". If so, return true
                    $has_scrollTrigger = array_filter($timelines, function ($timeline) {
                        return isset($timeline->trigger) && $timeline->trigger == 'scrollTrigger';
                    });

                    // Check if $timelines array "animations" contains an item on which the key "splitText" is equal to "true". If so, return true
                    $has_splitText = array_filter($timelines, function ($timeline) {
                        return array_filter(
                            $timeline->animations,
                            function ($animation) {
                                return isset($animation->splitText) && $animation->splitText == 'true';
                            }
                        );
                    });

                    if ($has_scrollTrigger) {
                        wp_enqueue_script('bricksforge-gsap-scrolltrigger');
                    }

                    if ($has_splitText) {
                        wp_enqueue_script('bricksforge-gsap-splittext');
                    }
                }

                if ($instances) {
                    wp_enqueue_script('bricksforge-panel');

                    // Check if $instances array "actions" contains an object 'action" on which the key "value" is equal to "gsapFlip". If so, return true
                    $has_gsapFlip = array_filter($instances, function ($instance) {
                        return array_filter(
                            $instance->actions,
                            function ($action) {
                                return isset($action->action->value) && $action->action->value == 'gsapFlip';
                            }
                        );
                    });

                    // Check if $instances array "actions" contains an object 'action" on which the key "value" is equal to "gsapSet". If so, return true
                    $has_gsapSet = array_filter($instances, function ($instance) {
                        return array_filter(
                            $instance->actions,
                            function ($action) {
                                return isset($action->action->value) && $action->action->value == 'gsapSet';
                            }
                        );
                    });

                    // Check if $instances array "actions" contains an object 'action" on which the key "value" is equal to "gsapTo". If so, return true
                    $has_gsapTo = array_filter($instances, function ($instance) {
                        return array_filter(
                            $instance->actions,
                            function ($action) {
                                return isset($action->action->value) && $action->action->value == 'gsapTo';
                            }
                        );
                    });

                    // Check if $instances array "actions" contains an object 'action" on which the key "value" is equal to "gsap". If so, return true
                    $has_gsap = array_filter($instances, function ($instance) {
                        return array_filter(
                            $instance->actions,
                            function ($action) {
                                return isset($action->action->value) && $action->action->value == 'gsap';
                            }
                        );
                    });

                    if ($has_gsapSet || $has_gsap || $has_gsapTo) {
                        wp_enqueue_script('bricksforge-gsap');
                    }

                    if ($has_gsapFlip) {
                        wp_enqueue_script('bricksforge-gsap-flip');
                    }
                }
            }
        }

        if (get_option('brf_activated_tools') && in_array(1, get_option('brf_activated_tools'))) {
            add_action('wp_enqueue_scripts', function () {
                wp_localize_script(
                    'bricksforge-animator',
                    'BRFANIMATIONS',
                    array(
                        'nonce'             => wp_create_nonce('wp_rest'),
                        'siteurl'           => get_option('siteurl'),
                        'pluginurl'         => BRICKSFORGE_URL,
                        'apiurl'            => get_rest_url() . "bricksforge/v1/",
                        "pageData"          => \Bricks\Database::get_data(),
                        'bricksPrefix'      => BRICKSFORGE_BRICKS_ELEMENT_PREFIX,
                    )
                );
            });
        }

        if (get_option('brf_activated_tools') && in_array(5, get_option('brf_activated_tools')) && get_option('brf_popups') && count(get_option('brf_popups')) > 0) {
            wp_enqueue_script('bricksforge-popups');
            add_action('wp_enqueue_scripts', function () {
                wp_localize_script(
                    'bricksforge-popups',
                    'BRFPOPUPS',
                    array(
                        'nonce'       => wp_create_nonce('wp_rest'),
                        'popups'      => get_option('brf_popups'),
                        'apiurl'      => get_rest_url() . "bricksforge/v1/",
                        'currentPage' => get_the_ID()
                    )
                );
            });
        }

        // Scroll Smoother

        if (get_option('brf_activated_tools') && in_array(7, get_option('brf_activated_tools'))) {

            $scrollsmooth_provider = 'gsap';

            $scrollsmooth_settings = get_option('brf_tool_settings');

            if ($scrollsmooth_settings) {
                // Get the scrollsmooth settings with the key id equal to 7
                $scrollsmooth_settings = array_filter($scrollsmooth_settings, function ($setting) {
                    return $setting->id == 7;
                });

                if ($scrollsmooth_settings) {
                    $scrollsmooth_settings = $scrollsmooth_settings[0];
                    $scrollsmooth_provider = isset($scrollsmooth_settings->settings->provider) ? $scrollsmooth_settings->settings->provider : 'gsap';
                }
            }

            if (!$scrollsmooth_provider) {
                $scrollsmooth_provider = 'gsap';
            }

            switch ($scrollsmooth_provider) {
                case 'gsap':
                    wp_enqueue_script('bricksforge-gsap-scrollsmoother');

                    // Wrap needed container IDs
                    add_action('bricks_before_site_wrapper', function () {
                        echo '<div id="smooth-wrapper">';
                        echo '<div id="smooth-content">';
                    });
                    add_action('bricks_after_site_wrapper', function () {
                        echo '</div>';
                        echo '</div>';
                    });
                    break;
                case 'lenis':
                    wp_enqueue_script('bricksforge-lenis');
                    break;
                default:
                    break;
            }

            wp_enqueue_script('bricksforge-scrollsmoother');
            add_action('wp_enqueue_scripts', function () {
                $args = array(
                    'toolSettings' => get_option('brf_tool_settings')
                );

                wp_localize_script('bricksforge-scrollsmoother', 'BRFSCROLLSMOOTHER', $args);
            });
        }

        // Bricksforge Terminal
        if (get_option('brf_activated_tools') && in_array(8, get_option('brf_activated_tools')) && bricks_is_builder() && !bricks_is_builder_iframe()) {
            wp_enqueue_script('bricksforge-terminal');

            add_action('wp_enqueue_scripts', function () {
                $args = array(
                    'nonce'   => wp_create_nonce('wp_rest'),
                    'apiurl'  => get_rest_url() . "bricksforge/v1/",
                    'history' => get_option('brf_terminal_history'),
                );

                wp_localize_script('bricksforge-terminal', 'BRFTERMINAL', $args);
            });
        }

        // Global Vars
        add_action('wp_enqueue_scripts', function () {
            $args = array(
                'nonce'                     => wp_create_nonce('wp_rest'),
                'siteurl'                   => get_option('siteurl'),
                'pluginurl'                 => BRICKSFORGE_URL,
                'apiurl'                    => get_rest_url() . "bricksforge/v1/",
                'brfGlobalClassesActivated' => get_option('brf_global_classes_activated'),
                'brfActivatedTools'         => get_option('brf_activated_tools'),
                'panel'                     => get_option('brf_panel'),
                'panelActivated'            => get_option('brf_activated_tools') && in_array(6, get_option('brf_activated_tools')),
            );

            if (bricks_is_builder()) {
                $args['permissions'] = get_option('brf_permissions_roles');
                $args['currentUserRole'] = $this->get_current_user_role();
            }

            wp_localize_script('bricksforge-panel', 'BRFPANEL', $args);
        });
    }

    public function get_current_user_role()
    {
        global $current_user;

        $user_roles = $current_user->roles;
        $user_role = array_shift($user_roles);

        return $user_role;
    }

    /**
     * Render frontend app
     *
     * @param  array $atts
     * @param  string $content
     *
     * @return string
     */
    public function render_frontend($atts, $content = '')
    {
        wp_enqueue_style('bricksforge-builder');
        wp_enqueue_style('bricksforge-style');
        wp_enqueue_script('bricksforge-builder');

        $content .= '<div id="bricksforge-triggers"></div>';

        return $content;
    }
}
