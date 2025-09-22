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
 * This class handles operations related to the helpdesk.
 *
 * @url https://restapi.ipex.cz/documentation#!/v1%2Fhelpdesk
 */
class Helpdesk extends ApiClient
{
    /**
     * The API section for the helpdesk.
     */
    public string $section = 'v1/helpdesk';

    /**
     * Get service helpdesk detail.
     *
     * @param int $id The ID of the service.
     *
     * @return array|bool An array of helpdesk data or false on failure.
     */
    public function getHelpdesk(int $id): array|bool
    {
        return $this->requestData((string) $id);
    }

    /**
     * Create a new service of type helpdesk.
     *
     * @param array $data The data for the new helpdesk service.
     *
     * @return array|bool The result of the creation operation.
     */
    public function createHelpdesk(array $data): array|bool
    {
        $this->setPostFields(json_encode($data));
        return $this->requestData('', 'POST');
    }

    /**
     * Change helpdesk properties.
     *
     * @param int   $serviceId The service ID of the helpdesk to update.
     * @param array $data      The data to update.
     *
     * @return array|bool The result of the update operation.
     */
    public function patchHelpdesk(int $serviceId, array $data): array|bool
    {
        $this->setPostFields(json_encode($data));
        return $this->requestData((string) $serviceId, 'PATCH');
    }
}
