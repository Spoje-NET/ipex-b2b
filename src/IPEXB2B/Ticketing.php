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
 * This class handles operations related to ticketing.
 *
 * @url https://restapi.ipex.cz/documentation#!/v1%2Fticketing
 */
class Ticketing extends ApiClient
{
    /**
     * The API section for ticketing.
     */
    public string $section = 'v1/ticketing';

    /**
     * Get requestor user by username.
     *
     * @return array|bool An array of user data or false on failure.
     */
    public function checkUser(): array|bool
    {
        return $this->requestData('check-user');
    }
}
