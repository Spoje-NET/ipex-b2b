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
 * This class handles operations related to reports.
 *
 * @url https://restapi.ipex.cz/documentation#!/v1%2Freports
 */
class Reports extends ApiClient
{
    /**
     * The API section for reports.
     */
    public string $section = 'v1/reports';

    /**
     * Get the number of customers.
     *
     * @return array|bool An array containing the number of customers or false on failure.
     */
    public function getCustomersReport(): array|bool
    {
        return $this->requestData('customers');
    }

    /**
     * Get the number of services.
     *
     * @param array $params Optional parameters to filter the report.
     *
     * @return array|bool An array of service statistics or false on failure.
     */
    public function getNumbersReport(array $params = []): array|bool
    {
        $this->setUrlParams($params);
        return $this->requestData('numbers');
    }

    /**
     * Get CTU statistics.
     *
     * @param array $params Optional parameters to filter the report.
     *
     * @return array|bool An array of CTU statistics or false on failure.
     */
    public function getCtuReport(array $params = []): array|bool
    {
        $this->setUrlParams($params);
        return $this->requestData('cz/ctu');
    }

    /**
     * Get top customers.
     *
     * @param array $params Optional parameters to filter the report.
     *
     * @return array|bool An array of top customers or false on failure.
     */
    public function getTopCustomersReport(array $params = []): array|bool
    {
        $this->setUrlParams($params);
        return $this->requestData('providers/top-customers');
    }

    /**
     * Get the number of customers for a provider.
     *
     * @return array|bool An array containing the number of customers or false on failure.
     */
    public function getCustomersCountReport(): array|bool
    {
        return $this->requestData('providers/customers/count');
    }

    /**
     * Get the number of requests.
     *
     * @param array $params Optional parameters to filter the report.
     *
     * @return array|bool An array containing the number of requests or false on failure.
     */
    public function getRequestsCountReport(array $params = []): array|bool
    {
        $this->setUrlParams($params);
        return $this->requestData('providers/requests/count');
    }

    /**
     * Get the Zoom provider report for a given month.
     *
     * @param string $month The month in 'YYYY-MM-DD' format.
     *
     * @return array|bool An array of Zoom report data or false on failure.
     */
    public function getZoomProviderReport(string $month): array|bool
    {
        return $this->requestData('zoom/provider/' . $month);
    }

    /**
     * Get the number of phone numbers in a connector.
     *
     * @param int $connectorId The ID of the connector.
     *
     * @return array|bool An array containing the number of phone numbers or false on failure.
     */
    public function getConnectorPhoneNumbersCountReport(int $connectorId): array|bool
    {
        return $this->requestData('connectors/' . $connectorId . '/phoneNumbers/count');
    }

    /**
     * Get the number of services for a customer.
     *
     * @param int   $customerId The ID of the customer.
     * @param array $params     Optional parameters to filter the report.
     *
     * @return array|bool An array containing the number of services or false on failure.
     */
    public function getCustomerServicesCountReport(int $customerId, array $params = []): array|bool
    {
        $this->setUrlParams($params);
        return $this->requestData('customers/' . $customerId . '/services/count');
    }

    /**
     * Get the number of requests for a customer.
     *
     * @param int $customerId The ID of the customer.
     *
     * @return array|bool An array containing the number of requests or false on failure.
     */
    public function getCustomerRequestsCountReport(int $customerId): array|bool
    {
        return $this->requestData('customers/' . $customerId . '/requests/count');
    }

    /**
     * Get the Zoom customer report for a given month.
     *
     * @param int    $customerId The ID of the customer.
     * @param string $month      The month in 'YYYY-MM-DD' format.
     *
     * @return array|bool An array of Zoom report data or false on failure.
     */
    public function getZoomCustomerReport(int $customerId, string $month): array|bool
    {
        return $this->requestData('zoom/customer/' . $customerId . '/' . $month);
    }

    /**
     * Get the sum of invoices for a customer for a given month offset.
     *
     * @param int $customerId  The ID of the customer.
     * @param int $monthOffset The month offset.
     *
     * @return array|bool An array containing the sum of invoices or false on failure.
     */
    public function getCustomerInvoicesSumReport(int $customerId, int $monthOffset): array|bool
    {
        return $this->requestData('customers/' . $customerId . '/invoices/sum/' . $monthOffset);
    }
}
