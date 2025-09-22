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
 * This class handles operations related to PBX.
 *
 * @url https://restapi.ipex.cz/documentation#!/v1%2Fpbx
 */
class Pbx extends ApiClient
{
    /**
     * The API section for PBX.
     */
    public string $section = 'v1/pbx';

    /**
     * Get information about PBXs.
     *
     * @param array $params Optional parameters to filter the list.
     *
     * @return array|bool An array of PBX data or false on failure.
     */
    public function getPbxInfo(array $params = []): array|bool
    {
        $this->setUrlParams($params);
        return $this->requestData();
    }

    /**
     * Create a new virtual PBX.
     *
     * @param array $data The data for the new PBX.
     *
     * @return array|bool The result of the creation operation.
     */
    public function createPbx(array $data): array|bool
    {
        $this->setPostFields(json_encode($data));
        return $this->requestData('', 'POST');
    }

    /**
     * Delete a PBX.
     *
     * @param int $serviceId The service ID of the PBX to delete.
     *
     * @return array|bool The result of the delete operation.
     */
    public function deletePbx(int $serviceId): array|bool
    {
        return $this->requestData((string) $serviceId, 'DELETE');
    }

    /**
     * Update PBX parameters.
     *
     * @param int   $serviceId The service ID of the PBX to update.
     * @param array $data      The data to update.
     *
     * @return array|bool The result of the update operation.
     */
    public function patchPbx(int $serviceId, array $data): array|bool
    {
        $this->setPostFields(json_encode($data));
        return $this->requestData((string) $serviceId, 'PATCH');
    }
}
