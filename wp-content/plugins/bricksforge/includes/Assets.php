<?php

namespace Bricksforge;

/**
 * Scripts and Styles Class
 */
class Assets
{

    function __construct()
    {

        if (is_admin()) {
            add_action('admin_enqueue_scripts', [$this, 'register'], 5);
        } else {
            add_action('wp_enqueue_scripts', [$this, 'register'], 5);
        }
    }

    /**
     * Register our app scripts and styles
     *
     * @return void
     */
    public function register()
    {
        $this->register_scripts($this->get_scripts());
        $this->register_styles($this->get_styles());
    }

    /**
     * Register scripts
     *
     * @param  array $scripts
     *
     * @return void
     */
    private function register_scripts($scripts)
    {
        // Return if JS folder not exists
        if (!is_dir(BRICKSFORGE_PATH . '/assets/js')) {
            return;
        }

        foreach ($scripts as $handle => $script) {
            $deps = isset($script['deps']) ? $script['deps'] : false;
            $in_footer = isset($script['in_footer']) ? $script['in_footer'] : false;
            $version = isset($script['version']) ? $script['version'] : BRICKSFORGE_VERSION;

            wp_register_script($handle, $script['src'], $deps, $version, $in_footer);
        }
    }

    /**
     * Register styles
     *
     * @param  array $styles
     *
     * @return void
     */
    public function register_styles($styles)
    {
        foreach ($styles as $handle => $style) {
            $deps = isset($style['deps']) ? $style['deps'] : false;

            wp_register_style($handle, $style['src'], $deps, BRICKSFORGE_VERSION);
        }
    }

    /**
     * Get all registered scripts
     *
     * @return array
     */
    public function get_scripts()
    {
        // Return if JS folder not exists
        if (!is_dir(BRICKSFORGE_PATH . '/assets/js')) {
            return;
        }

        $prefix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '.min' : '';

        $scripts = [
            'bricksforge-runtime'        => [
                'src'       => BRICKSFORGE_ASSETS . '/bundle/runtime.js',
                'version'   => filemtime(BRICKSFORGE_PATH . '/assets/bundle/runtime.js'),
                'in_footer' => true
            ],
            'bricksforge-vendor'         => [
                'src'       => BRICKSFORGE_ASSETS . '/bundle/vendors.js',
                'version'   => filemtime(BRICKSFORGE_PATH . '/assets/bundle/vendors.js'),
                'in_footer' => true
            ],
            'bricksforge-frontend'       => [
                'src'       => BRICKSFORGE_ASSETS . '/bundle/frontend.js',
                'deps'      => ['bricksforge-vendor', 'bricksforge-runtime'],
                'version'   => filemtime(BRICKSFORGE_PATH . '/assets/bundle/frontend.js'),
                'in_footer' => true
            ],
            'bricksforge-admin'          => [
                'src'       => BRICKSFORGE_ASSETS . '/bundle/admin.js',
                'deps'      => ['bricksforge-vendor', 'bricksforge-runtime'],
                'version'   => filemtime(BRICKSFORGE_PATH . '/assets/bundle/admin.js'),
                'in_footer' => true
            ],
            'bricksforge-font-uploader'  => [
                'src'       => BRICKSFORGE_ASSETS . '/js/bricksforge_font_uploader.js',
                'deps'      => [],
                'version'   => filemtime(BRICKSFORGE_PATH . '/assets/js/bricksforge_font_uploader.js'),
                'in_footer' => true
            ],
            'brf_gsap'                   => [
                'src'       => BRICKSFORGE_ASSETS . '/vendor/gsap.min.js',
                'deps'      => ['bricks-scripts'],
                'version'   => filemtime(BRICKSFORGE_PATH . '/assets/vendor/gsap.min.js'),
                'in_footer' => true
            ],
            'brf_gsap_motionpath'        => [
                'src'       => BRICKSFORGE_ASSETS . '/vendor/MotionPathPlugin.min.js',
                'deps'      => ['bricks-scripts', 'brf_gsap'],
                'version'   => filemtime(BRICKSFORGE_PATH . '/assets/vendor/MotionPathPlugin.min.js'),
                'in_footer' => true
            ],
            'brf_gsap_motionpath_helper' => [
                'src'       => BRICKSFORGE_ASSETS . '/vendor/MotionPathHelper.min.js',
                'deps'      => ['bricks-scripts', 'brf_gsap'],
                'version'   => filemtime(BRICKSFORGE_PATH . '/assets/vendor/MotionPathHelper.min.js'),
                'in_footer' => true
            ],
            'brf_gsap_scrolltrigger'     => [
                'src'       => BRICKSFORGE_ASSETS . '/vendor/ScrollTrigger.min.js',
                'deps'      => ['bricks-scripts', 'brf_gsap'],
                'version'   => filemtime(BRICKSFORGE_PATH . '/assets/vendor/ScrollTrigger.min.js'),
                'in_footer' => true
            ],
            'brf_gsap_draggable'         => [
                'src'       => BRICKSFORGE_ASSETS . '/vendor/Draggable.min.js',
                'deps'      => ['brf_gsap'],
                'version'   => filemtime(BRICKSFORGE_PATH . '/assets/vendor/Draggable.min.js'),
                'in_footer' => true
            ],
            'brf_gsap_flip'              => [
                'src'       => BRICKSFORGE_ASSETS . '/vendor/Flip.min.js',
                'deps'      => ['brf_gsap'],
                'version'   => filemtime(BRICKSFORGE_PATH . '/assets/vendor/Flip.min.js'),
                'in_footer' => true
            ],
            'brf_gsap_scrollsmoother'    => [
                'src'       => BRICKSFORGE_ASSETS . '/vendor/ScrollSmoother.min.js',
                'deps'      => ['brf_gsap', 'brf_gsap_scrolltrigger'],
                'version'   => filemtime(BRICKSFORGE_PATH . '/assets/vendor/ScrollSmoother.min.js'),
                'in_footer' => true
            ],
            'brf_gsap_splittext'         => [
                'src'       => BRICKSFORGE_ASSETS . '/vendor/SplitText.min.js',
                'deps'      => ['brf_gsap'],
                'version'   => filemtime(BRICKSFORGE_PATH . '/assets/vendor/SplitText.min.js'),
                'in_footer' => true
            ],
            'bricksforge-animator'       => [
                'src'       => BRICKSFORGE_ASSETS . '/js/bricksforge_animator.js',
                'deps'      => [],
                'version'   => filemtime(BRICKSFORGE_PATH . '/assets/js/bricksforge_animator.js'),
                'in_footer' => true
            ],
            'bricksforge-elements'       => [
                'src'       => BRICKSFORGE_ASSETS . '/js/bricksforge_elements.js',
                'deps'      => [],
                'version'   => filemtime(BRICKSFORGE_PATH . '/assets/js/bricksforge_elements.js'),
                'in_footer' => true
            ],
            'bricksforge-panel'          => [
                'src'       => BRICKSFORGE_ASSETS . '/js/bricksforge_panel.js',
                'deps'      => ['bricks-scripts'],
                'version'   => filemtime(BRICKSFORGE_PATH . '/assets/js/bricksforge_panel.js'),
                'in_footer' => true
            ],
            'bricksforge-terminal'       => [
                'src'       => BRICKSFORGE_ASSETS . '/js/bricksforge_terminal.js',
                'deps'      => ['bricks-scripts'],
                'version'   => filemtime(BRICKSFORGE_PATH . '/assets/js/bricksforge_terminal.js'),
                'in_footer' => true
            ],
            'bricksforge-popups'         => [
                'src'       => BRICKSFORGE_ASSETS . '/js/bricksforge_popups.js',
                'deps'      => ['brf_gsap'],
                'version'   => filemtime(BRICKSFORGE_PATH . '/assets/js/bricksforge_popups.js'),
                'in_footer' => true
            ],
            'bricksforge-scrollsmoother' => [
                'src'       => BRICKSFORGE_ASSETS . '/js/bricksforge_scrollsmoother.js',
                'deps'      => ['bricks-scripts'],
                'version'   => filemtime(BRICKSFORGE_PATH . '/assets/js/bricksforge_scrollsmoother.js'),
                'in_footer' => true
            ],
            'bricksforge-lenis'          => [
                'src'       => BRICKSFORGE_ASSETS . '/vendor/lenis.js',
                'deps'      => [],
                'version'   => filemtime(BRICKSFORGE_PATH . '/assets/vendor/lenis.js'),
                'in_footer' => true
            ],
            'bricksforge-scrolly-video'  => [
                'src'       => BRICKSFORGE_ASSETS . '/vendor/scrolly-video.js',
                'deps'      => ['bricks-scripts'],
                'version'   => filemtime(BRICKSFORGE_PATH . '/assets/vendor/scrolly-video.js'),
                'in_footer' => true
            ],
            'brf_hcaptcha'               => [
                'src'       => 'https://js.hcaptcha.com/1/api.js',
                'deps'      => ['bricks-scripts'],
                'version'   => '1.0',
                'in_footer' => true
            ],
        ];

        return $scripts;
    }

    /**
     * Get registered styles
     *
     * @return array
     */
    public function get_styles()
    {

        $styles = [
            'bricksforge-style'    => [
                'src'  => BRICKSFORGE_ASSETS . '/css/style.css',
                'deps' => ['bricks-frontend']
            ],
            'bricksforge-frontend' => [
                'src' => BRICKSFORGE_ASSETS . '/css/frontend.css'
            ],
            'bricksforge-admin'    => [
                'src' => BRICKSFORGE_ASSETS . '/css/admin.css'
            ],
        ];

        return $styles;
    }
}
