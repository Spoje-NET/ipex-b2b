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
 * This class handles operations related to Single Sign-On (SSO).
 *
 * @url https://restapi.ipex.cz/documentation#!/v1%2Fsso
 */
class Sso extends ApiClient
{
    /**
     * The API section for SSO.
     */
    public string $section = 'v1/sso';

    /**
     * Get a token for ticketing.
     *
     * @return array|bool An array containing the token or false on failure.
     */
    public function getTicketingToken(): array|bool
    {
        return $this->requestData('ticketing/token');
    }

    /**
     * Log in and get a token.
     *
     * @param array $data The login data.
     *
     * @return array|bool An array containing the token or false on failure.
     */
    public function login(array $data): array|bool
    {
        $this->setPostFields(json_encode($data));
        return $this->requestData('login', 'POST');
    }

    /**
     * Refresh a token.
     *
     * @return array|bool An array containing the new token or false on failure.
     */
    public function refresh(): array|bool
    {
        return $this->requestData('refresh', 'POST');
    }
}
