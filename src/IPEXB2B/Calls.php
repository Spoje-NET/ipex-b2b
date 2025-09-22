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

use DateTime;

/**
 * This class handles operations related to calls.
 *
 * @url https://restapi.ipex.cz/documentation#!/v1%2Fcalls/getV1Calls
 */
class Calls extends ApiClient
{
    /**
     * The API section for calls.
     */
    public string $section = 'v1/calls';

    /**
     * Get a list of calls for a specific phone number.
     *
     * @param DateTime $dateFrom The start date for the call list.
     * @param string   $number   The phone number to retrieve calls for.
     * @param array    $params   Additional parameters for the request.
     *
     * @return array|bool An array of call data or false on failure.
     */
    public function getCallsForNumber(DateTime $dateFrom, string $number, array $params = []): array|bool
    {
        $params['number'] = $number;
        $params['dateFrom'] = self::dateTimeToIpexDate($dateFrom);
        $this->setUrlParams($params);
        return $this->requestData();
    }

    /**
     * Get a list of calls for a specific customer.
     *
     * @param DateTime $dateFrom   The start date for the call list.
     * @param int      $customerId The ID of the customer.
     * @param array    $params     Additional parameters for the request.
     *
     * @return array|bool An array of call data or false on failure.
     */
    public function getCallsForCustomer(DateTime $dateFrom, int $customerId, array $params = []): array|bool
    {
        $params['customerId'] = $customerId;
        $params['dateFrom'] = self::dateTimeToIpexDate($dateFrom);
        $this->setUrlParams($params);
        return $this->requestData();
    }

    /**
     * Get a technical overview of calls.
     *
     * @param array $params Optional parameters:
     *                      - 'number' (string): The phone number to filter by.
     *                      - 'dateFrom' (DateTime): The start date for the overview.
     *                      - 'dateTo' (DateTime): The end date for the overview.
     *
     * @return array|bool An array of technical overview data or false on failure.
     */
    public function getTechnicalOverview(array $params = []): array|bool
    {
        if (isset($params['dateFrom']) && $params['dateFrom'] instanceof DateTime) {
            $params['dateFrom'] = self::dateTimeToIpexDate($params['dateFrom']);
        }
        if (isset($params['dateTo']) && $params['dateTo'] instanceof DateTime) {
            $params['dateTo'] = self::dateTimeToIpexDate($params['dateTo']);
        }
        $this->setUrlParams($params);
        return $this->requestData('technical-overview');
    }
}
