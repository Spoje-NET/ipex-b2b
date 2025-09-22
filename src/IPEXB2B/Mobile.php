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
 * This class handles operations related to mobile services.
 *
 * @url https://restapi.ipex.cz/documentation#!/v1%2Fmobile
 */
class Mobile extends ApiClient
{
    /**
     * The API section for mobile services.
     */
    public string $section = 'v1/mobile';

    /**
     * Get the details of a mobile number.
     *
     * @param string $number The mobile number.
     * @param array  $params Optional parameters.
     *
     * @return array|bool An array of mobile number data or false on failure.
     */
    public function getMobileNumber(string $number, array $params = []): array|bool
    {
        $this->setUrlParams($params);
        return $this->requestData($number);
    }

    /**
     * Create a new mobile phone number.
     *
     * @param array $data The data for the new mobile number.
     *
     * @return array|bool The result of the creation operation.
     */
    public function createMobileNumber(array $data): array|bool
    {
        $this->setPostFields(json_encode($data));
        return $this->requestData('', 'POST');
    }

    /**
     * Update a mobile number.
     *
     * @param array $data The data to update.
     *
     * @return array|bool The result of the update operation.
     */
    public function updateMobileNumber(array $data): array|bool
    {
        $this->setPostFields(json_encode($data));
        return $this->requestData('', 'PUT');
    }

    /**
     * Get a list of available portation dates.
     *
     * @param int $cvop The CVOP/OKU code.
     *
     * @return array|bool An array of available dates or false on failure.
     */
    public function getAvailablePortationDates(int $cvop): array|bool
    {
        return $this->requestData('availablePortationDates/' . $cvop);
    }

    /**
     * Reset the postpaid limit for a mobile number (GET - for backward compatibility).
     *
     * @param int $number The phone number.
     *
     * @return array|bool The result of the operation.
     */
    public function resetPostpaidLimit(int $number): array|bool
    {
        return $this->requestData($number . '/resetPostpaidLimit');
    }

    /**
     * Reset the postpaid limit for a mobile number (PUT).
     *
     * @param int $number The phone number.
     *
     * @return array|bool The result of the operation.
     */
    public function resetPostpaidLimitPut(int $number): array|bool
    {
        return $this->requestData($number . '/resetPostpaidLimit', 'PUT');
    }

    /**
     * Suspend a mobile number (GET - for backward compatibility).
     *
     * @param int $number The phone number.
     *
     * @return array|bool The result of the operation.
     */
    public function suspendMobileNumber(int $number): array|bool
    {
        return $this->requestData($number . '/suspend');
    }

    /**
     * Suspend a mobile number (PUT).
     *
     * @param int $number The phone number.
     *
     * @return array|bool The result of the operation.
     */
    public function suspendMobileNumberPut(int $number): array|bool
    {
        return $this->requestData($number . '/suspend', 'PUT');
    }

    /**
     * Reactivate a mobile number (GET - for backward compatibility).
     *
     * @param int $number The phone number.
     *
     * @return array|bool The result of the operation.
     */
    public function reactivateMobileNumber(int $number): array|bool
    {
        return $this->requestData($number . '/reactivate');
    }

    /**
     * Reactivate a mobile number (PUT).
     *
     * @param int $number The phone number.
     *
     * @return array|bool The result of the operation.
     */
    public function reactivateMobileNumberPut(int $number): array|bool
    {
        return $this->requestData($number . '/reactivate', 'PUT');
    }

    /**
     * Get the credit history for a mobile number.
     *
     * @param string $number The phone number.
     *
     * @return array|bool An array of credit history or false on failure.
     */
    public function getCreditHistory(string $number): array|bool
    {
        return $this->requestData($number . '/credit');
    }

    /**
     * Add credit to a mobile number.
     *
     * @param string $number The phone number.
     * @param array  $data   The credit data.
     *
     * @return array|bool The result of the operation.
     */
    public function addCredit(string $number, array $data): array|bool
    {
        $this->setPostFields(json_encode($data));
        return $this->requestData($number . '/credit', 'PUT');
    }

    /**
     * Change the SIM card for a mobile number (GET - for backward compatibility).
     *
     * @param int $number   The phone number.
     * @param int $newIccId The new ICCID.
     *
     * @return array|bool The result of the operation.
     */
    public function changeSimCard(int $number, int $newIccId): array|bool
    {
        return $this->requestData($number . '/changeSimCard/' . $newIccId);
    }

    /**
     * Renew the SIM card for a service/number.
     *
     * @param int   $number The mobile number.
     * @param array $data   The data for the renewal.
     *
     * @return array|bool The result of the operation.
     */
    public function renewSimCard(int $number, array $data): array|bool
    {
        $this->setPostFields(json_encode($data));
        return $this->requestData($number . '/renew', 'PUT');
    }

    /**
     * Deactivate a mobile service.
     *
     * @param int   $number The phone number.
     * @param array $data   The deactivation data.
     *
     * @return array|bool The result of the operation.
     */
    public function deactivateMobileNumber(int $number, array $data): array|bool
    {
        $this->setPostFields(json_encode($data));
        return $this->requestData($number . '/deactivate', 'PUT');
    }

    /**
     * Update the OKU code for a phone number.
     *
     * @param string $phoneNumber The phone number.
     * @param array  $data        The OKU data.
     *
     * @return array|bool The result of the operation.
     */
    public function updateOku(string $phoneNumber, array $data): array|bool
    {
        $this->setPostFields(json_encode($data));
        return $this->requestData($phoneNumber . '/oku', 'PUT');
    }
}
