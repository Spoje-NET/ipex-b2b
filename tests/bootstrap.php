<?php

declare(strict_types=1);

/**
 * This file is part of the IpexB2B package
 *
 * https://github.com/Spoje-NET/ipex-b2b
 *
 * (c) Spoje.Net <https://spoje.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

if (file_exists('../vendor/autoload.php')) {
    include_once '../vendor/autoload.php';
} else {
    if (file_exists('vendor/autoload.php')) { // For Test Generator
        include_once 'vendor/autoload.php';
    }
}

/**
 * Write logs as:
 */
\define('EASE_APPNAME', 'IPEXB2B_Test');

if (!\defined('EASE_LOGGER')) {
    \define('EASE_LOGGER', 'syslog');
}

/*
 * URL ipex-b2b API
 */
\define('IPEX_URL', 'https://restapi.ipex.cz');
/*
 * Uživatel ipex-b2b API
 */
\define('IPEX_LOGIN', 'xxxx');
/*
 * Heslo ipex-b2b API
 */
\define('IPEX_PASSWORD', 'xxxx');
