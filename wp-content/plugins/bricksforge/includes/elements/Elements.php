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
                'globalClasses'             => get_option('bricks_global_classes'),
                'globalClassesLocked'       => get_option('bricks_global_classes_locked'),
                'brfGlobalClassesActivated' => get_option('brf_global_classes_activated'),
                'brfActivatedTools'         => get_option('brf_activated_tools'),
                "pageData"                  => \Bricks\Database::get_data(),
                'bricksPrefix'              => BRICKSFORGE_BRICKS_ELEMENT_PREFIX,
                'breakpoints'               => \Bricks\Breakpoints::$breakpoints,
                'icons'                     => \Bricks\Builder::get_icon_font_classes(),
                'currentUserRole'           => $this->get_current_user_role(),
                'permissions'               => get_option('brf_permissions_roles'),
                'panel'                     => get_option('brf_panel'),
                'panelActivated'            => get_option('brf_activated_tools') && in_array(6, get_option('brf_activated_tools')),
                'megaMenuActivated'         => get_option('brf_activated_tools') && in_array(3, get_option('brf_activated_tools')),
                'headerData'                => \Bricks\Database::get_template_data('header')
            );

            wp_localize_script('bricksforge-elements', 'BRFVARS', $args);
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