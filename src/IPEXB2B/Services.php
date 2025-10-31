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
 * This class handles operations related to services.
 *
 * @url https://restapi.ipex.cz/documentation#!/v1%2Fservices/getV1Services
 */
class Services extends ApiClient
{
    /**
     * The API section for services.
     */
    public string $section = 'v1/services';

    /**
     * Get a list of services.
     *
     * @param array $params Optional parameters to filter the list of services.
     *
     * @return array|bool An array of service data or false on failure.
     */
    public function getServices(array $params = []): array|bool
    {
        $this->setUrlParams($params);
        return $this->requestData();
    }

    /**
     * Get the details of a specific service.
     *
     * @param int $serviceId The ID of the service.
     *
     * @return array|bool An array of service data or false on failure.
     */
    public function getServiceById(int $serviceId): array|bool
    {
        return $this->requestData((string) $serviceId);
    }

    /**
     * Delete a service.
     *
     * @param int $serviceId The ID of the service to delete.
     *
     * @return array|bool The result of the delete operation or false on failure.
     */
    public function deleteService(int $serviceId): array|bool
    {
        return $this->requestData((string) $serviceId, 'DELETE');
    }

    /**
     * Search for services using a full-text search.
     *
     * @param array $params Parameters for the full-text search.
     *
     * @return array|bool An array of service data or false on failure.
     */
    public function fulltextSearch(array $params = []): array|bool
    {
        $this->setUrlParams($params);
        return $this->requestData('fulltext');
    }

    /**
     * Get a list of shared services.
     *
     * @param array $params Optional parameters to filter the list of shared services.
     *
     * @return array|bool An array of shared service data or false on failure.
     */
    public function getSharedServices(array $params = []): array|bool
    {
        $this->setUrlParams($params);
        return $this->requestData('shared');
    }

    /**
     * Get the properties of a specific service.
     *
     * @param int $serviceId The ID of the service.
     *
     * @return array|bool An array of service properties or false on failure.
     */
    public function getServiceProperties(int $serviceId): array|bool
    {
        return $this->requestData($serviceId . '/properties');
    }

    /**
     * Update the properties of a specific service.
     *
     * @param int   $serviceId The ID of the service.
     * @param array $data      The properties to update.
     *
     * @return array|bool The result of the update operation or false on failure.
     */
    public function updateServiceProperties(int $serviceId, array $data): array|bool
    {
        $this->setPostFields(json_encode($data));
        return $this->requestData($serviceId . '/properties', 'PUT');
    }

    /**
     * Binds a system user to a service.
     *
     * @param int   $serviceId The ID of the service.
     * @param array $data      The binding data, e.g., ['allowed' => true].
     *
     * @return array|bool The result of the binding operation or false on failure.
     */
    public function bindSystemUser(int $serviceId, array $data): array|bool
    {
        $this->setPostFields(json_encode($data));
        return $this->requestData($serviceId . '/systemUserBinding', 'PUT');
    }
}
