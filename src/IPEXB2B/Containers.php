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
 * This class handles operations related to containers (switchboards).
 *
 * @url https://restapi.ipex.cz/documentation#!/v1%2Fcontainers
 */
class Containers extends ApiClient
{
    /**
     * The API section for containers.
     */
    public string $section = 'v1/containers';

    /**
     * Get a list of containers (switchboards) by type.
     *
     * @param string $type The type of the container ('Mobile', 'ISP', 'Other').
     *
     * @return array|bool An array of container data or false on failure.
     */
    public function getContainers(string $type): array|bool
    {
        return $this->requestData($type);
    }

    /**
     * Get a list of roaming profiles for a container.
     *
     * @param int $containerId The ID of the container.
     *
     * @return array|bool An array of roaming profiles or false on failure.
     */
    public function getRoamingProfiles(int $containerId): array|bool
    {
        return $this->requestData($containerId . '/roamingProfiles');
    }

    /**
     * Get a list of phone numbers for a container.
     *
     * @param int   $containerId The ID of the container.
     * @param array $params      Optional parameters to filter the list.
     *
     * @return array|bool An array of phone number data or false on failure.
     */
    public function getPhoneNumbers(int $containerId, array $params = []): array|bool
    {
        $this->setUrlParams($params);
        return $this->requestData($containerId . '/phoneNumbers');
    }

    /**
     * Get a list of data packs for a container.
     *
     * @param int   $containerId The ID of the container.
     * @param array $params      Optional parameters to filter the list.
     *
     * @return array|bool An array of data pack data or false on failure.
     */
    public function getDataPacks(int $containerId, array $params = []): array|bool
    {
        $this->setUrlParams($params);
        return $this->requestData($containerId . '/dataPacks');
    }

    /**
     * Get a list of flat packs for a container.
     *
     * @param int   $containerId The ID of the container.
     * @param array $params      Optional parameters to filter the list.
     *
     * @return array|bool An array of flat pack data or false on failure.
     */
    public function getFlatPacks(int $containerId, array $params = []): array|bool
    {
        $this->setUrlParams($params);
        return $this->requestData($containerId . '/flatPacks');
    }

    /**
     * Get a list of SIM cards for a container.
     *
     * @param int   $containerId The ID of the container.
     * @param array $params      Optional parameters to filter the list.
     *
     * @return array|bool An array of SIM card data or false on failure.
     */
    public function getSimcards(int $containerId, array $params = []): array|bool
    {
        $this->setUrlParams($params);
        return $this->requestData($containerId . '/simcards');
    }

    /**
     * Port numbers into a container.
     *
     * @param int   $containerId The ID of the container.
     * @param array $data        The data for the port-in operation.
     *
     * @return array|bool The result of the port-in operation.
     */
    public function portIn(int $containerId, array $data): array|bool
    {
        $this->setPostFields(json_encode($data));
        return $this->requestData($containerId . '/portIn', 'POST');
    }
}
