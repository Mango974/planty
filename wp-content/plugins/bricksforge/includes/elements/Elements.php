<?php

namespace Bricksforge;

/**
 * Global Classes Handler
 */
class Elements
{

    public function __construct()
    {
        $this->init();
    }

    public function init()
    {

        $elements = [
            [
                'id'   => 0,
                'path' => __DIR__ . '/flip-everything/FlipEverything.php',
            ],
            [
                'id'   => 1,
                'path' => __DIR__ . '/font-awesome/FontAwesome.php',
            ],
            [
                'id'   => 2,
                'path' => __DIR__ . '/before-and-after/BeforeAndAfter.php',
            ],
            [
                'id'   => 3,
                'path' => __DIR__ . '/popup-trigger/PopupTrigger.php',
            ],
            [
                'id'   => 4,
                'path' => __DIR__ . '/table-of-contents/TableOfContents.php',
            ],
            [
                'id'   => 5,
                'path' => __DIR__ . '/pro-forms/ProForms.php',
            ],
            [
                'id'   => 5,
                'path' => __DIR__ . '/pro-forms-steps/ProFormsSteps.php',
            ],
            [
                'id'   => 6,
                'path' => __DIR__ . '/scroll-video/ScrollVideo.php',
            ],
            [
                'id'   => 7,
                'path' => __DIR__ . '/option/Option.php',
            ]
        ];

        $options = get_option('brf_activated_elements') ? get_option('brf_activated_elements') : false;

        if ($options === false) {
            return;
        }

        foreach ($elements as $element) {
            $activated = false;

            foreach ($options as $option) {
                if ($option->id == $element['id']) {
                    $activated = true;
                }
            }

            if ($activated === true) {
                \Bricks\Elements::register_element($element['path']);
            }
        }

        $this->injectData();
    }

    public function injectData()
    {
        add_action('wp_enqueue_scripts', function () {
            $args = array(
                'siteurl'                   => get_option('siteurl'),
                'pluginurl'                 => BRICKSFORGE_URL,
                'nonce'                     => wp_create_nonce('wp_rest'),
                'apiurl'                    => get_rest_url() . "bricksforge/v1/",
            );

            wp_localize_script('bricksforge-elements', 'BRFELEMENTS', $args);
        });
    }

    public function get_current_user_role()
    {
        global $current_user;

        $user_roles = $current_user->roles;
        $user_role = array_shift($user_roles);

        return $user_role;
    }
}
