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
 * This class handles operations related to maintenance.
 *
 * @url https://restapi.ipex.cz/documentation#!/v1%2Fmaintenance
 */
class Maintenance extends ApiClient
{
    /**
     * The API section for maintenance.
     */
    public string $section = 'v1/maintenance';

    /**
     * Check call price sums and create a ticket if there is a significant drop.
     *
     * @param array $data The data for the check.
     *
     * @return array|bool The result of the check operation.
     */
    public function checkIncomeDrop(array $data): array|bool
    {
        $this->setPostFields(json_encode($data));
        return $this->requestData('calls/checkIncomeDrop', 'POST');
    }
}
