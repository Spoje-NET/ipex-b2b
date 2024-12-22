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

namespace IPEXB2B;

/**
 * Výpis uskutečněných hovorů.
 *
 * @url https://restapi.ipex.cz/documentation#!/v1%2Fcalls/getV1Calls
 */
class Calls extends ApiClient
{
    /**
     * Sekce užitá objektem.
     * Section used by object.
     */
    public string $section = 'calls';

    /**
     * Obtain calls listing for give phone number.
     *
     * @param \DateTime $dateFrom Start Day of results
     * @param string    $telNo
     *
     * @return array
     */
    public function getCallsForNumber($dateFrom, $telNo)
    {
        return $this->requestData(\Ease\Functions::addUrlParams(
            '',
            ['number' => $telNo, 'dateFrom' => ApiClient::dateTimeToIpexDate($dateFrom)],
        ));
    }

    /**
     * Obtain call list for customer.
     *
     * @param \DateTime $dateFrom   Start Day of results
     * @param int       $customerId
     *
     * @return array
     */
    public function getCallsForCustomer($dateFrom, $customerId)
    {
        return $this->requestData(\Ease\Functions::addUrlParams(
            '',
            ['customerId' => $customerId, 'dateFrom' => ApiClient::dateTimeToIpexDate($dateFrom)],
        ));
    }
}
