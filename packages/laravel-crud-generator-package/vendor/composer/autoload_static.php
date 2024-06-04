<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit90162d5da56dd64eb71954ea05cc6757
{
    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Frs\\LaravelCrudGenerator\\' => 25,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Frs\\LaravelCrudGenerator\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit90162d5da56dd64eb71954ea05cc6757::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit90162d5da56dd64eb71954ea05cc6757::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit90162d5da56dd64eb71954ea05cc6757::$classMap;

        }, null, ClassLoader::class);
    }
}