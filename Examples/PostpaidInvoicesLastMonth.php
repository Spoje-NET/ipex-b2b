#!/usr/bin/php -f
<?php
/**
 * IPEXB2B - Example how to get Invoices
 *
 * @author     Vítězslav Dvořák <info@vitexsofware.cz>
 * @copyright  (G) 2018 Vitex Software
 */

namespace Example\IPEXB2B;

include_once './config.php';
include_once '../vendor/autoload.php';

$grabber = new \IPEXB2B\ApiClient(null, ['section' => 'invoices']);
$grabber->setUrlParams(['monthOffset' => -1]);

$response = $grabber->requestData('postpaid');
if (count($response)) {
    echo json_encode($response, JSON_PRETTY_PRINT);
    $grabber->addStatusMessage(count($response).' Invoices', 'success');
} else {
    $grabber->addStatusMessage('Obtaining Invoices failed', 'warning');
}
