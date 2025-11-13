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
 * This class handles operations related to wholesale invoices.
 *
 * @url https://restapi.ipex.cz/documentation#!/v1%2Fwholesale-invoices
 */
class WholesaleInvoices extends ApiClient
{
    /**
     * The API section for wholesale invoices.
     */
    public string $section = 'v1/wholesale-invoices';

    /**
     * Get a list of wholesale invoices.
     *
     * @param array $params Optional parameters to filter the list.
     *
     * @return array|bool An array of wholesale invoice data or false on failure.
     */
    public function getWholesaleInvoices(array $params = []): array|bool
    {
        $this->setUrlParams($params);
        return $this->requestData();
    }
}
