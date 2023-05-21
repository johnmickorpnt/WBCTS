<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit59b5d06079f4a4c7d8019e11ce1e482c
{
    public static $prefixLengthsPsr4 = array (
        'D' => 
        array (
            'DASPRiD\\Enum\\' => 13,
        ),
        'B' => 
        array (
            'BaconQrCode\\' => 12,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'DASPRiD\\Enum\\' => 
        array (
            0 => __DIR__ . '/..' . '/dasprid/enum/src',
        ),
        'BaconQrCode\\' => 
        array (
            0 => __DIR__ . '/..' . '/bacon/bacon-qr-code/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit59b5d06079f4a4c7d8019e11ce1e482c::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit59b5d06079f4a4c7d8019e11ce1e482c::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit59b5d06079f4a4c7d8019e11ce1e482c::$classMap;

        }, null, ClassLoader::class);
    }
}