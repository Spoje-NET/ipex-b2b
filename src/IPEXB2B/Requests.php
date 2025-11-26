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
 * This class handles operations related to requests (orders).
 *
 * @url https://restapi.ipex.cz/documentation#!/v1%2Frequests
 */
class Requests extends ApiClient
{
    /**
     * The API section for requests.
     */
    public string $section = 'v1/requests';

    /**
     * Get a list of requests (orders).
     *
     * @param array $params Optional parameters to filter the list.
     *
     * @return array|bool An array of request data or false on failure.
     */
    public function getRequests(array $params = []): array|bool
    {
        $this->setUrlParams($params);
        return $this->requestData();
    }

    /**
     * Get the details of a specific request.
     *
     * @param int $requestId The ID of the request.
     *
     * @return array|bool An array of request data or false on failure.
     */
    public function getRequestById(int $requestId): array|bool
    {
        return $this->requestData((string) $requestId);
    }

    /**
     * Cancel a request (order).
     *
     * @param int $requestId The ID of the request to cancel.
     *
     * @return array|bool The result of the delete operation.
     */
    public function deleteRequest(int $requestId): array|bool
    {
        return $this->requestData((string) $requestId, 'DELETE');
    }
}
