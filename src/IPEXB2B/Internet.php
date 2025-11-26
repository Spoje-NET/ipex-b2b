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
 * This class handles operations related to internet services.
 *
 * @url https://restapi.ipex.cz/documentation#!/v1%2Finternet
 */
class Internet extends ApiClient
{
    /**
     * The API section for internet services.
     */
    public string $section = 'v1/internet';

    /**
     * Get a list of internet service types.
     *
     * @return array|bool An array of internet service types or false on failure.
     */
    public function getInternetTypes(): array|bool
    {
        return $this->requestData('types');
    }

    /**
     * Get service internet detail.
     *
     * @param int $id The ID of the service.
     *
     * @return array|bool An array of internet service data or false on failure.
     */
    public function getInternet(int $id): array|bool
    {
        return $this->requestData((string) $id);
    }

    /**
     * Create a new service of type internet.
     *
     * @param array $data The data for the new internet service.
     *
     * @return array|bool The result of the creation operation.
     */
    public function createInternet(array $data): array|bool
    {
        $this->setPostFields(json_encode($data));
        return $this->requestData('', 'POST');
    }

    /**
     * Change internet type and properties.
     *
     * @param int   $serviceId The service ID of the internet service to update.
     * @param array $data      The data to update.
     *
     * @return array|bool The result of the update operation.
     */
    public function patchInternet(int $serviceId, array $data): array|bool
    {
        $this->setPostFields(json_encode($data));
        return $this->requestData((string) $serviceId, 'PATCH');
    }
}
