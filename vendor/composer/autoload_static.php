<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitef1248a4f4d45312276d4d2bfc0f13ed
{
    public static $prefixLengthsPsr4 = array (
        'W' => 
        array (
            'WPClonePage\\' => 12,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'WPClonePage\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitef1248a4f4d45312276d4d2bfc0f13ed::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitef1248a4f4d45312276d4d2bfc0f13ed::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
