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
 * This class handles operations related to phone numbers (v2).
 *
 * @url https://restapi.ipex.cz/documentation#!/v2%2Fphone-numbers
 */
class PhoneNumbers extends ApiClient
{
    /**
     * The API section for phone numbers.
     */
    public string $section = 'v2/phone-numbers';

    /**
     * Get a list of phone numbers.
     *
     * @param array $params Optional parameters to filter the list.
     *
     * @return array|bool An array of phone number data or false on failure.
     */
    public function getPhoneNumbers(array $params = []): array|bool
    {
        $this->setUrlParams($params);
        return $this->requestData();
    }

    /**
     * Get diagnostic detail for a phone number.
     *
     * @param array $params Required: 'number'. Optional: 'full'.
     *
     * @return array|bool An array of diagnostic data or false on failure.
     */
    public function getDiagnostic(array $params): array|bool
    {
        $this->setUrlParams($params);
        return $this->requestData('diagnostic');
    }

    /**
     * Create a new block of phone numbers.
     *
     * @param array $data The data for the new block.
     *
     * @return array|bool The result of the creation operation.
     */
    public function createBlock(array $data): array|bool
    {
        $this->setPostFields(json_encode($data));
        return $this->requestData('block', 'PUT');
    }
}
