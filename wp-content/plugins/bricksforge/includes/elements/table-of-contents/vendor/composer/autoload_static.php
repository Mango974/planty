<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit4c2aa953305afe5177224de35d0d9d2d
{
    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'TOC\\' => 4,
        ),
        'M' => 
        array (
            'Masterminds\\' => 12,
        ),
        'K' => 
        array (
            'Knp\\Menu\\' => 9,
        ),
        'C' => 
        array (
            'Cocur\\Slugify\\' => 14,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'TOC\\' => 
        array (
            0 => __DIR__ . '/..' . '/caseyamcl/toc/src',
            1 => __DIR__ . '/..' . '/caseyamcl/toc/tests',
        ),
        'Masterminds\\' => 
        array (
            0 => __DIR__ . '/..' . '/masterminds/html5/src',
        ),
        'Knp\\Menu\\' => 
        array (
            0 => __DIR__ . '/..' . '/knplabs/knp-menu/src/Knp/Menu',
        ),
        'Cocur\\Slugify\\' => 
        array (
            0 => __DIR__ . '/..' . '/cocur/slugify/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit4c2aa953305afe5177224de35d0d9d2d::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit4c2aa953305afe5177224de35d0d9d2d::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit4c2aa953305afe5177224de35d0d9d2d::$classMap;

        }, null, ClassLoader::class);
    }
}
