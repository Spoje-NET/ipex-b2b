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
 * This class handles operations related to SMS.
 *
 * @url https://restapi.ipex.cz/documentation#!/v1%2Fsms
 */
class Sms extends ApiClient
{
    /**
     * The API section for SMS.
     */
    public string $section = 'v1/sms';

    /**
     * Send an SMS.
     *
     * @param array $data The data for the SMS.
     *
     * @return array|bool The result of the send operation.
     */
    public function sendSms(array $data): array|bool
    {
        $this->setPostFields(json_encode($data));
        return $this->requestData('', 'POST');
    }

    /**
     * Get SMS service detail.
     *
     * @param int $serviceId The ID of the service.
     *
     * @return array|bool An array of SMS integration data or false on failure.
     */
    public function getSmsIntegration(int $serviceId): array|bool
    {
        return $this->requestData('integration/' . $serviceId);
    }

    /**
     * Updates an SMS service.
     *
     * @param int   $serviceId The ID of the service to update.
     * @param array $data      The data to update.
     *
     * @return array|bool The result of the update operation.
     */
    public function updateSmsIntegration(int $serviceId, array $data): array|bool
    {
        $this->setPostFields(json_encode($data));
        return $this->requestData('integration/' . $serviceId, 'PUT');
    }

    /**
     * Creates an SMS service.
     *
     * @param array $data The data for the new SMS service.
     *
     * @return array|bool The result of the creation operation.
     */
    public function createSmsIntegration(array $data): array|bool
    {
        $this->setPostFields(json_encode($data));
        return $this->requestData('integration', 'POST');
    }
}
