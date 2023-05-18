<?php
namespace Bricksforge;

/**
 * Global Classes Handler
 */
class ConditionalLogic
{

    public function __construct()
    {
        $this->init();
    }

    public function init()
    {
        if ($this->activated() === true) {
        }
    }


    public function activated()
    {
        return get_option('brf_activated_tools') && in_array(2, get_option('brf_activated_tools'));
    }

}