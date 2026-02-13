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
 * This class handles operations related to connectors.
 *
 * @url https://restapi.ipex.cz/documentation#!/v1%2Fconnectors
 */
class Connectors extends ApiClient
{
    /**
     * The API section for connectors.
     */
    public string $section = 'v1/connectors';

    /**
     * Get a list of all connectors.
     *
     * @param array $params Optional parameters to filter the list.
     *
     * @return array|bool An array of connector data or false on failure.
     */
    public function getConnectors(array $params = []): array|bool
    {
        $this->setUrlParams($params);
        return $this->requestData();
    }

    /**
     * Activate a new connector.
     *
     * @param array $data The data for the new connector.
     *
     * @return array|bool The result of the creation operation.
     */
    public function createConnector(array $data): array|bool
    {
        $this->setPostFields(json_encode($data));
        return $this->requestData('', 'POST');
    }

    /**
     * Get the billing list for all connectors.
     *
     * @param array $params Required parameters: 'dateFrom', 'dateTo'. Optional: 'detail'.
     *
     * @return array|bool An array of invoice data or false on failure.
     */
    public function getConnectorsInvoices(array $params): array|bool
    {
        $this->setUrlParams($params);
        return $this->requestData('invoices');
    }

    /**
     * Get the details of a specific connector.
     *
     * @param int $connectorId The ID of the connector.
     *
     * @return array|bool An array of connector data or false on failure.
     */
    public function getConnectorById(int $connectorId): array|bool
    {
        return $this->requestData((string) $connectorId);
    }

    /**
     * Update a connector's settings.
     *
     * @param int   $connectorId The ID of the connector to update.
     * @param array $data        The data to update.
     *
     * @return array|bool The result of the update operation.
     */
    public function updateConnector(int $connectorId, array $data): array|bool
    {
        $this->setPostFields(json_encode($data));
        return $this->requestData((string) $connectorId, 'PUT');
    }

    /**
     * Get the billing list for a specific connector.
     *
     * @param int   $connectorId The ID of the connector.
     * @param array $params      Optional parameters to filter the invoices.
     *
     * @return array|bool An array of invoice data or false on failure.
     */
    public function getConnectorInvoices(int $connectorId, array $params = []): array|bool
    {
        $this->setUrlParams($params);
        return $this->requestData($connectorId . '/invoices');
    }

    /**
     * Get the list of phone numbers in a connector.
     *
     * @param int   $connectorId The ID of the connector.
     * @param array $params      Optional parameters to filter the phone numbers.
     *
     * @return array|bool An array of phone number data or false on failure.
     */
    public function getConnectorPhoneNumbers(int $connectorId, array $params = []): array|bool
    {
        $this->setUrlParams($params);
        return $this->requestData($connectorId . '/phoneNumbers');
    }

    /**
     * Import a block of numbers into a connector.
     *
     * @param int   $connectorId The ID of the connector.
     * @param array $data        The data for the port-in operation.
     *
     * @return array|bool The result of the port-in operation.
     */
    public function portInToConnector(int $connectorId, array $data): array|bool
    {
        $this->setPostFields(json_encode($data));
        return $this->requestData($connectorId . '/portIn', 'POST');
    }

    /**
     * Order a new block of numbers for the connector.
     *
     * @param int   $connectorId The ID of the connector.
     * @param array $data        The data for the new block order.
     *
     * @return array|bool The result of the order operation.
     */
    public function orderNewBlock(int $connectorId, array $data): array|bool
    {
        $this->setPostFields(json_encode($data));
        return $this->requestData($connectorId . '/orderNewBlock', 'POST');
    }

    /**
     * Deactivate a connector.
     *
     * @param int   $connectorId The ID of the connector.
     * @param array $data        The data for the deactivation.
     *
     * @return array|bool The result of the deactivation operation.
     */
    public function deactivateConnector(int $connectorId, array $data): array|bool
    {
        $this->setPostFields(json_encode($data));
        return $this->requestData($connectorId . '/deactivate', 'POST');
    }

    /**
     * Edit a phone number in a connector.
     *
     * @param int    $connectorId The ID of the connector.
     * @param string $number      The phone number to edit.
     * @param array  $data        The data to update.
     *
     * @return array|bool The result of the update operation.
     */
    public function updateConnectorPhoneNumber(int $connectorId, string $number, array $data): array|bool
    {
        $this->setPostFields(json_encode($data));
        return $this->requestData($connectorId . '/phoneNumbers/' . $number, 'PUT');
    }
}
