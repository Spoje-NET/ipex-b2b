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
 * This class handles operations related to invoices.
 *
 * @url https://restapi.ipex.cz/documentation#!/v1%2Finvoices
 */
class Invoices extends ApiClient
{
    /**
     * The API section for invoices.
     */
    public string $section = 'v1/invoices';

    /**
     * Get a list of services for invoicing.
     *
     * @param array $params Required: 'customerId'. Optional: 'monthOffset'.
     *
     * @return array|bool An array of invoice data or false on failure.
     */
    public function getInvoices(array $params): array|bool
    {
        $this->setUrlParams($params);
        return $this->requestData();
    }

    /**
     * Get a list of end-customer invoices for the logged-in provider.
     *
     * @param string $paymentType The payment type ('prepaid', 'postpaid', 'both').
     * @param array  $params      Optional parameters to filter the list.
     *
     * @return array|bool An array of invoice data or false on failure.
     */
    public function getInvoicesByPaymentType(string $paymentType, array $params = []): array|bool
    {
        $this->setUrlParams($params);
        return $this->requestData($paymentType);
    }

    /**
     * Get a printable document from the invoicing documents.
     *
     * @param string $paymentType The payment type ('prepaid', 'postpaid', 'both').
     * @param string $fileFormat  The desired file format ('html', 'xml', 'csv', 'json-html').
     * @param array  $params      Optional parameters for the document.
     *
     * @return array|bool The file content or false on failure.
     */
    public function getInvoiceFile(string $paymentType, string $fileFormat, array $params = []): array|bool
    {
        $this->setUrlParams($params);
        return $this->requestData($paymentType . '/' . $fileFormat);
    }
}
