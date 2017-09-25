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

$customers = new \IPEXB2B\Customers();
$response  = $customers->requestData();
if (count($response)) {
        var_dump($response);
    $customers->addStatusMessage('Customers OK', 'success');
} else {
    $customers->addStatusMessage('Obtaining Customers failed', 'warning');
}
