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
 * This class handles operations related to the RUIAN address registry.
 *
 * @url https://restapi.ipex.cz/documentation#!/v1%2Fruian
 */
class Ruian extends ApiClient
{
    /**
     * The API section for RUIAN.
     */
    public string $section = 'v1/ruian';

    /**
     * Get a list of addresses found by full-text search.
     *
     * @param string $fulltext The full-text string to search by.
     * @param array  $params   Optional parameters.
     *
     * @return array|bool An array of address data or false on failure.
     */
    public function getAddresses(string $fulltext, array $params = []): array|bool
    {
        $this->setUrlParams($params);
        return $this->requestData($fulltext);
    }

    /**
     * Get address detail from RUIAN.
     *
     * @param int $ruianId The RUIAN address ID.
     *
     * @return array|bool An array of address data or false on failure.
     */
    public function getAddressById(int $ruianId): array|bool
    {
        return $this->requestData('address/' . $ruianId);
    }
}
