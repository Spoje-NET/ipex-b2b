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
 * This class handles operations related to guaranteed support.
 *
 * @url https://restapi.ipex.cz/documentation#!/v1%2Fsupport
 */
class Support extends ApiClient
{
    /**
     * The API section for support.
     */
    public string $section = 'v1/support';

    /**
     * Get guaranteed support detail.
     *
     * @param int $id The ID of the service.
     *
     * @return array|bool An array of support data or false on failure.
     */
    public function getSupport(int $id): array|bool
    {
        return $this->requestData((string) $id);
    }

    /**
     * Create a new service of guaranteed support.
     *
     * @param array $data The data for the new support service.
     *
     * @return array|bool The result of the creation operation.
     */
    public function createSupport(array $data): array|bool
    {
        $this->setPostFields(json_encode($data));
        return $this->requestData('', 'POST');
    }

    /**
     * Change guaranteed support type, or amount of hours.
     *
     * @param int   $serviceId The service ID of the support service to update.
     * @param array $data      The data to update.
     *
     * @return array|bool The result of the update operation.
     */
    public function patchSupport(int $serviceId, array $data): array|bool
    {
        $this->setPostFields(json_encode($data));
        return $this->requestData((string) $serviceId, 'PATCH');
    }
}
