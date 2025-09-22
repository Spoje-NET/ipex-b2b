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
 * This class handles operations related to system health.
 *
 * @url https://restapi.ipex.cz/documentation#!/health
 */
class Health extends ApiClient
{
    /**
     * The API section for health.
     */
    public string $section = 'health';

    /**
     * Get the status of dependent systems.
     *
     * @return array|bool An array of health data or false on failure.
     */
    public function getHealth(): array|bool
    {
        return $this->requestData();
    }
}
