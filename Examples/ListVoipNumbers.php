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

$numbers  = new \IPEXB2B\Services();
$response = $numbers->requestData();
if (count($response)) {
    echo json_encode($response, JSON_PRETTY_PRINT);
    $numbers->addStatusMessage(count($response).' Numbers', 'success');
} else {
    $numbers->addStatusMessage('Obtaining Customers failed', 'warning');
}
