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
 * This class handles operations related to ICT price lists.
 *
 * @url https://restapi.ipex.cz/documentation#!/v1%2FictPriceList
 */
class IctPriceList extends ApiClient
{
    /**
     * The API section for ICT price lists.
     */
    public string $section = 'v1/ictPriceList';

    /**
     * Get all pricelists.
     *
     * @param array $params Optional parameters to filter the list.
     *
     * @return array|bool An array of pricelist data or false on failure.
     */
    public function getIctPriceLists(array $params = []): array|bool
    {
        $this->setUrlParams($params);
        return $this->requestData();
    }

    /**
     * Create a new pricelist as a copy of an existing one.
     *
     * @param array $data The data for the copy operation.
     *
     * @return array|bool The result of the copy operation.
     */
    public function copyIctPriceList(array $data): array|bool
    {
        $this->setPostFields(json_encode($data));
        return $this->requestData('copy', 'POST');
    }

    /**
     * Get pricelist detail.
     *
     * @param int $id The ID of the pricelist.
     *
     * @return array|bool An array of pricelist data or false on failure.
     */
    public function getIctPriceList(int $id): array|bool
    {
        return $this->requestData((string) $id);
    }

    /**
     * Update a pricelist's name.
     *
     * @param int   $id   The ID of the pricelist to update.
     * @param array $data The data to update.
     *
     * @return array|bool The result of the update operation.
     */
    public function patchIctPriceList(int $id, array $data): array|bool
    {
        $this->setPostFields(json_encode($data));
        return $this->requestData((string) $id, 'PATCH');
    }

    /**
     * Get a pricelist item.
     *
     * @param int $itemId The ID of the pricelist item.
     *
     * @return array|bool An array of pricelist item data or false on failure.
     */
    public function getIctPriceListItem(int $itemId): array|bool
    {
        return $this->requestData('items/' . $itemId);
    }

    /**
     * Change a pricelist item's price.
     *
     * @param int   $itemId The ID of the pricelist item to update.
     * @param array $data   The data to update.
     *
     * @return array|bool The result of the update operation.
     */
    public function patchIctPriceListItem(int $itemId, array $data): array|bool
    {
        $this->setPostFields(json_encode($data));
        return $this->requestData('items/' . $itemId, 'PATCH');
    }
}
