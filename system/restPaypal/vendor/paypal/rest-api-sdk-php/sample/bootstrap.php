<?php
/*
 * Sample bootstrap file.
 */

// Include the composer Autoloader
// The location of your project's vendor autoloader.
$composerAutoload = dirname(dirname(dirname(__DIR__))) . '/autoload.php';
if (!file_exists($composerAutoload)) {
    //If the project is used as its own project, it would use rest-api-sdk-php composer autoloader.
    $composerAutoload = dirname(__DIR__) . '/vendor/autoload.php';


    if (!file_exists($composerAutoload)) {
        echo "The 'vendor' folder is missing. You must run 'composer update' to resolve application dependencies.\nPlease see the README for more information.\n";
        exit(1);
    }
}
require $composerAutoload;
require __DIR__ . '/common.php';

use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;

error_reporting(E_ALL);
ini_set('display_errors', '1');

// Replace these values by entering your own ClientId and Secret by visiting https://developer.paypal.com/webapps/developer/applications/myapps
//Demo
//$clientId = 'AYSq3RDGsmBLJE-otTkBtM-jBRd1TCQwFf9RGfwddNXWz0uFU9ztymylOhRS';
//$clientSecret = 'EGnHDxD_qRPdaLdZz8iCr8N7_MzF-YHPTkjs6NKYQvQSBngp4PTTVWkPZRbL';
//Live
/*$clientId = 'ASL3E8j9Jpld0sYkFZ3V88uj7lG-SSe32M_xM5YqsaNwuWkX5Gkfh014JQpwZF11qGI6TySYoaTLvVxR';
$clientSecret = 'EJkKD2B85z31-bYjKA3TX9EIW4gjWy8fKo5Abg1fslkqTZY4FiOR56h5H05M7irvkuDa1y3AUgX96Ugd';*/
//SSdirectbuy
$clientId = 'AZ9SnTyDfA-9-Zj6nOb19ufoSCvGI5ydJXW6h9f4W_4OI_ud7Y6SSwcMg3qNl2g3A6i09iLMnjvmUR6t';
$clientSecret = 'EDkSXoxIkFZZgzriqfFdLW7bLirqREZKm6Kygtm2PxgUMjX9zfLEg8DXYhW1L-4pgdUicNvgqHS2PQi7';

/** @var \Paypal\Rest\ApiContext $apiContext */
$apiContext = getApiContext($clientId, $clientSecret);

return $apiContext;
/**
 * Helper method for getting an APIContext for all calls
 * @param string $clientId Client ID
 * @param string $clientSecret Client Secret
 * @return PayPal\Rest\ApiContext
 */
function getApiContext($clientId, $clientSecret)
{

    // #### SDK configuration
    // Register the sdk_config.ini file in current directory
    // as the configuration source.
    /*
    if(!defined("PP_CONFIG_PATH")) {
        define("PP_CONFIG_PATH", __DIR__);
    }
    */


    // ### Api context
    // Use an ApiContext object to authenticate
    // API calls. The clientId and clientSecret for the
    // OAuthTokenCredential class can be retrieved from
    // developer.paypal.com

    $apiContext = new ApiContext(
        new OAuthTokenCredential(
            $clientId,
            $clientSecret
        )
    );

    // Comment this line out and uncomment the PP_CONFIG_PATH
    // 'define' block if you want to use static file
    // based configuration

    $apiContext->setConfig(
        array(
            'mode' => 'sandbox',
            //'mode' => 'live',
            'log.LogEnabled' => true,
            'log.FileName' => '../PayPal.log',
            //'log.LogLevel' => 'DEBUG', // PLEASE USE `FINE` LEVEL FOR LOGGING IN LIVE ENVIRONMENTS
            'log.LogLevel' => 'FINE', // PLEASE USE `FINE` LEVEL FOR LOGGING IN LIVE ENVIRONMENTS
            'validation.level' => 'log',
            'cache.enabled' => true,
            // 'http.CURLOPT_CONNECTTIMEOUT' => 30
            // 'http.headers.PayPal-Partner-Attribution-Id' => '123123123'
        )
    );

    // Partner Attribution Id
    // Use this header if you are a PayPal partner. Specify a unique BN Code to receive revenue attribution.
    // To learn more or to request a BN Code, contact your Partner Manager or visit the PayPal Partner Portal
    // $apiContext->addRequestHeader('PayPal-Partner-Attribution-Id', '123123123');

    return $apiContext;
}
