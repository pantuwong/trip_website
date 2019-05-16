<?php
/*
 * Basic Site Settings and API Configuration
 */

// Database configuration
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'halalwayz');
define('DB_USER_TBL', 'users');

// Google API configuration
define('GOOGLE_CLIENT_ID', '866623462982-euestsfmpftkeue88g9s07lff520dtug.apps.googleusercontent.com');
define('GOOGLE_CLIENT_SECRET', 'KR0vJ0sxEpnosvXZzkrXOddh');
define('GOOGLE_REDIRECT_URL', 'http://localhost');

$clientId = '866623462982-euestsfmpftkeue88g9s07lff520dtug.apps.googleusercontent.com'; //Google client ID
$clientSecret = 'KR0vJ0sxEpnosvXZzkrXOddh'; //Google client secret
$redirectURL = 'http://localhost/halalwayz/'; //Callback URL

// Start session
if(!session_id()){
    session_start();
}

// Include Google API client library
include_once 'google-api-php-client/src/Google_Client.php';
include_once 'google-api-php-client/src/contrib/Google_Oauth2Service.php';

// Call Google API
$gClient = new Google_Client();
$gClient->setApplicationName('login_with_google_using_php');
$gClient->setClientId($clientId);
$gClient->setClientSecret($clientSecret);
$gClient->setRedirectUri($redirectURL);

$google_oauthV2 = new Google_Oauth2Service($gClient);