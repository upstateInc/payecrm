<?php
/**
 * Custom SPL autoloader for the AuthorizeNet SDK
 *
 * @package AuthorizeNet
 */

spl_autoload_register(function($className) {
    static $classMap;

    if (!isset($classMap)) {
        $classMap = require __DIR__ . DIRECTORY_SEPARATOR . 'classmap.php';
        //$classMap = require 'path/to/anet_php_sdk/autoload.php';
    }

    if (isset($classMap[$className])) {
        include $classMap[$className];
    }
});
