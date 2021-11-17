<?php

/**
 * IPEXB2B - Client for Access to IPEX Rights class.
 *
 * @author     Vítězslav Dvořák <vitex@arachne.cz>
 * @copyright  (C) 2017 Spoje.Net
 */

namespace IPEXB2B;

/**
 * Výpis uskutečněných hovorů.
 *
 * @url https://restapi.ipex.cz/documentation#!/v1%2Fcalls/getV1Calls
 */
class Calls extends ApiClient {

    /**
     * Sekce užitá objektem.
     * Section used by object
     *
     * @var string
     */
    public $section = 'calls';

    /**
     * Obtain calls listing for give phone number
     * 
     * @param long $telNo
     * @param \DateTime $dateFrom Start Day of results
     * 
     * @return array
     */
    public function getCallsForNumber($dateFrom, $telNo) {
        return $this->requestData(\Ease\Functions::addUrlParams(null,
                                ['number' => $telNo, 'dateFrom' => ApiClient::dateTimeToIpexDate($dateFrom)]));
    }

    /**
     * 
     * 
     * @param int $customerId
     * @param \DateTime $dateFrom Start Day of results
     * 
     * @return array
     */
    public function getCallsForCustomer($dateFrom, $customerId) {
        return $this->requestData(\Ease\Functions::addUrlParams(null,
                                ['customerId' => $customerId, 'dateFrom' => ApiClient::dateTimeToIpexDate($dateFrom)]));
    }

}
