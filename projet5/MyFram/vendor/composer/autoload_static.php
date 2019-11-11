<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit3cd77b90c39bc8562f326fd018cc39f5
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'MyFram\\' => 7,
            'Model\\' => 6,
        ),
        'E' => 
        array (
            'Entity\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'MyFram\\' => 
        array (
            0 => __DIR__ . '/../..' . '/',
        ),
        'Model\\' => 
        array (
            0 => __DIR__ . '/../..' . '/../Vendor/Model',
        ),
        'Entity\\' => 
        array (
            0 => __DIR__ . '/../..' . '/../Vendor/Entity',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit3cd77b90c39bc8562f326fd018cc39f5::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit3cd77b90c39bc8562f326fd018cc39f5::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
