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
 * This class handles operations related to provider accounts.
 *
 * @url https://restapi.ipex.cz/documentation#!/v1%2Faccounts
 */
class Accounts extends ApiClient
{
    /**
     * The API section for accounts.
     */
    public string $section = 'v1/accounts';

    /**
     * Get provider user details.
     *
     * @param string $username The username of the provider user.
     *
     * @return array|bool An array of account data or false on failure.
     */
    public function getAccount(string $username): array|bool
    {
        return $this->requestData($username);
    }

    /**
     * Update a provider user.
     *
     * @param string $username The username of the provider user to update.
     * @param array  $data     The data to update.
     *
     * @return array|bool The result of the update operation.
     */
    public function updateAccount(string $username, array $data): array|bool
    {
        $this->setPostFields(json_encode($data));
        return $this->requestData($username, 'PUT');
    }

    /**
     * Delete a provider user.
     *
     * @param string $username The username of the provider user to delete.
     *
     * @return array|bool The result of the delete operation.
     */
    public function deleteAccount(string $username): array|bool
    {
        return $this->requestData($username, 'DELETE');
    }

    /**
     * Create a new provider user.
     *
     * @param array $data The data for the new provider user.
     *
     * @return array|bool The result of the creation operation.
     */
    public function createAccount(array $data): array|bool
    {
        $this->setPostFields(json_encode($data));
        return $this->requestData('', 'POST');
    }
}
