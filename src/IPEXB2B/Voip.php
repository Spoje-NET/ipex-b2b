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
 * This class handles operations related to VoIP services.
 *
 * @url https://restapi.ipex.cz/documentation#!/v1%2Fvoip/getV1VoipProfiles
 */
class Voip extends ApiClient
{
    /**
     * The API section for VoIP.
     */
    public string $section = 'v1/voip';

    /**
     * Get a list of VoIP profiles.
     *
     * @return array|bool An array of VoIP profiles or false on failure.
     */
    public function getVoipProfiles(): array|bool
    {
        return $this->requestData('profiles');
    }

    /**
     * Get the details of a specific VoIP number.
     *
     * @param string $number The VoIP number.
     * @param array  $params Optional parameters for the request, e.g., ['detail' => 'full'].
     *
     * @return array|bool An array of VoIP number details or false on failure.
     */
    public function getVoipNumberDetails(string $number, array $params = []): array|bool
    {
        $this->setUrlParams($params);
        return $this->requestData($number);
    }

    /**
     * Get the credit history for a specific VoIP number.
     *
     * @param string $number The VoIP number.
     *
     * @return array|bool An array of credit history or false on failure.
     */
    public function getVoipCreditHistory(string $number): array|bool
    {
        return $this->requestData($number . '/credit');
    }

    /**
     * Add credit to a specific VoIP number.
     *
     * @param string $number The VoIP number.
     * @param array  $data   The credit data, e.g., ['customerId' => 123, 'amount' => 100.0, 'expiration' => 30].
     *
     * @return array|bool The result of the operation or false on failure.
     */
    public function addVoipCredit(string $number, array $data): array|bool
    {
        $this->setPostFields(json_encode($data));
        return $this->requestData($number . '/credit', 'PUT');
    }

    /**
     * Get the state of a specific VoIP number.
     *
     * @param string $number The VoIP number.
     * @param array  $params Optional parameters for the request.
     *
     * @return array|bool An array of the VoIP number's state or false on failure.
     */
    public function getVoipNumberState(string $number, array $params = []): array|bool
    {
        $this->setUrlParams($params);
        return $this->requestData($number . '/state');
    }

    /**
     * Deactivate a VoIP number.
     *
     * @param string $number The VoIP number to deactivate.
     * @param array  $data   The deactivation data, e.g., ['requiredCeaseDate' => '2023-12-31T23:59:59Z'].
     *
     * @return array|bool The result of the deactivation or false on failure.
     */
    public function deactivateVoipNumber(string $number, array $data): array|bool
    {
        $this->setPostFields(json_encode($data));
        return $this->requestData($number . '/deactivate', 'PUT');
    }

    /**
     * Create a new VoIP number (landline).
     *
     * @param array $data The data for the new VoIP number.
     *
     * @return array|bool An array containing the new VoIP number's data or false on failure.
     */
    public function createVoipNumber(array $data): array|bool
    {
        $this->setPostFields(json_encode($data));
        return $this->requestData('', 'POST');
    }

    /**
     * Update a VoIP number's settings.
     *
     * @param array $data The data to update the VoIP number with.
     *
     * @return array|bool An array containing the updated VoIP number's data or false on failure.
     */
    public function updateVoipNumber(array $data): array|bool
    {
        $this->setPostFields(json_encode($data));
        return $this->requestData('', 'PUT');
    }
}
