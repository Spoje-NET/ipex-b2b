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
 * This class handles operations related to invoice items.
 *
 * @url https://restapi.ipex.cz/documentation#!/v1%2FinvoiceItem
 */
class InvoiceItem extends ApiClient
{
    /**
     * The API section for invoice items.
     */
    public string $section = 'v1/invoiceItem';

    /**
     * Get a list of inserted invoice item IDs.
     *
     * @return array|bool An array of invoice item IDs or false on failure.
     */
    public function getInvoiceItemIds(): array|bool
    {
        return $this->requestData('idList');
    }

    /**
     * Get virtual service detail.
     *
     * @param int $id The ID of the service.
     *
     * @return array|bool An array of invoice item data or false on failure.
     */
    public function getInvoiceItem(int $id): array|bool
    {
        return $this->requestData((string) $id);
    }
}
