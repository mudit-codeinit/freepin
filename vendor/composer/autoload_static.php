<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit98de27a8195ff54fd6a7aa64491c869e
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Psr\\Log\\' => 8,
            'PHPShopify\\' => 11,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
        'PHPShopify\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpclassic/php-shopify/lib',
        ),
    );

    public static $prefixesPsr0 = array (
        'P' => 
        array (
            'PayPal' => 
            array (
                0 => __DIR__ . '/..' . '/paypal/rest-api-sdk-php/lib',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit98de27a8195ff54fd6a7aa64491c869e::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit98de27a8195ff54fd6a7aa64491c869e::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit98de27a8195ff54fd6a7aa64491c869e::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
