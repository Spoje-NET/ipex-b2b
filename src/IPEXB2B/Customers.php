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
 * This class handles operations related to customers.
 *
 * @url https://restapi.ipex.cz/documentation#!/v1%2Fcustomers/getV1Customers
 */
class Customers extends ApiClient
{
    /**
     * The API section for customers.
     */
    public string $section = 'v1/customers';

    /**
     * Get a list of customers.
     *
     * @param array $params Optional parameters to filter the list of customers.
     *
     * @return array|bool An array of customer data or false on failure.
     */
    public function getCustomers(array $params = []): array|bool
    {
        $this->setUrlParams($params);
        return $this->requestData();
    }

    /**
     * Get the details of a specific customer.
     *
     * @param int $id The ID of the customer.
     *
     * @return array|bool An array of customer data or false on failure.
     */
    public function getCustomerById(int $id): array|bool
    {
        return $this->requestData((string) $id);
    }

    /**
     * Create a new customer.
     *
     * @param array $data The data for the new customer.
     *
     * @return array|bool An array containing the new customer's data or false on failure.
     */
    public function createCustomer(array $data): array|bool
    {
        $this->setPostFields(json_encode($data));
        return $this->requestData('', 'POST');
    }

    /**
     * Update a customer's details (full update).
     *
     * @param int   $id   The ID of the customer to update.
     * @param array $data The data to update.
     *
     * @return array|bool An array containing the updated customer's data or false on failure.
     */
    public function updateCustomer(int $id, array $data): array|bool
    {
        $this->setPostFields(json_encode($data));
        return $this->requestData((string) $id, 'PUT');
    }

    /**
     * Partially update a customer's details.
     *
     * @param int   $id   The ID of the customer to update.
     * @param array $data The data to update.
     *
     * @return array|bool An array containing the updated customer's data or false on failure.
     */
    public function patchCustomer(int $id, array $data): array|bool
    {
        $this->setPostFields(json_encode($data));
        return $this->requestData((string) $id, 'PATCH');
    }

    /**
     * Get the name of a customer by their ID.
     *
     * @param int $id The ID of the customer.
     *
     * @return array|bool An array containing the customer's name or false on failure.
     */
    public function getCustomerNameById(int $id): array|bool
    {
        return $this->requestData('customername/' . $id);
    }

    /**
     * Get all users for a specific customer.
     *
     * @param int $customerId The ID of the customer.
     *
     * @return array|bool An array of user data or false on failure.
     */
    public function getCustomerUsers(int $customerId): array|bool
    {
        return $this->requestData($customerId . '/users');
    }
}
