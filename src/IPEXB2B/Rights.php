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
 * This class handles operations related to user rights.
 *
 * @url https://restapi.ipex.cz/documentation#!/v1%2Frights/getV1Rights
 */
class Rights extends ApiClient
{
    /**
     * The API section for rights.
     */
    public string $section = 'v1/rights';

    /**
     * Get a list of the current user's permissions.
     *
     * @return array|bool An array of rights data or false on failure.
     */
    public function getRights(): array|bool
    {
        return $this->requestData();
    }
}
