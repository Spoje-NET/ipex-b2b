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
 * This class handles operations related to users.
 *
 * @url https://restapi.ipex.cz/documentation#!/v1%2Fusers
 */
class Users extends ApiClient
{
    /**
     * The API section for users.
     */
    public string $section = 'v1/users';

    /**
     * Get the current user by their anvil token.
     *
     * @param array $params Optional parameters.
     *
     * @return array|bool An array of user data or false on failure.
     */
    public function getMe(array $params = []): array|bool
    {
        $this->setUrlParams($params);
        return $this->requestData('me');
    }
}
