<?php
/**
 * IPEXB2B - Shared functions
 *
 * @author     Vítězslav Dvořák <info@vitexsofware.cz>
 * @copyright  (G) 2017 Vitex Software
 */

namespace Example\IPEXB2B;

/**
 * Ask For Invoice ID
 *
 * @param string $type Requested type for documents
 * @return int|string id or code
 */
function askForIPEXID($type = 'number')
{
    $invoiceID = null;
    echo "Please enter $type ID:";
    $input     = fopen("php://stdin", "r");
    $invoiceID = trim(fgets($input));
    fclose($input);
    if (is_numeric($invoiceID)) {
        $invoiceID = intval($invoiceID);
    }
    return $invoiceID;
}
