<?php
/**
 * FlexiPeeHP - nastavení testů.
 *
 * @author     Vítězslav Dvořák <vitex@arachne.cz>
 * @copyright  2015 Spoje.Net
 */
if (file_exists('../vendor/autoload.php')) {
    include_once '../vendor/autoload.php';
} else {
    if (file_exists('vendor/autoload.php')) { //For Test Generator
        include_once 'vendor/autoload.php';
    }
}
/**
 * Write logs as:
 */
define('EASE_APPNAME', 'IPEXB2B_Test');
if (!defined('EASE_LOGGER')) {
    define('EASE_LOGGER', 'syslog');
}

/*
 * URL ipex-b2b API
 */
define('IPEX_URL', 'https://restapi.ipex.cz');
/*
 * Uživatel ipex-b2b API
 */
define('IPEX_LOGIN', 'spoje.net');
/*
 * Heslo ipex-b2b API
 */
define('IPEX_PASSWORD', 'xxxxx.xxx');
