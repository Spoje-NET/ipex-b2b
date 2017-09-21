#!/usr/bin/php -f
<?php
/**
 * IPEXB2B - Example how to check connection
 *
 * @author     Vítězslav Dvořák <info@vitexsofware.cz>
 * @copyright  (G) 2017 Vitex Software
 */

namespace Example\IPEXB2B;

include_once './config.php';
include_once '../vendor/autoload.php';

$client   = new \IPEXB2B\ApiClient(null, ['section' => 'services']);
$response = $client->requestData('list');

if (count($response)) {
    $client->addStatusMessage('Connection OK', 'success');
} else {
    $client->addStatusMessage('Connection failed', 'warning');
}
