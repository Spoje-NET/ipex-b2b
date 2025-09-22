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
 * This class handles the alive check.
 *
 * @url https://restapi.ipex.cz/documentation#!/alive
 */
class Alive extends ApiClient
{
    /**
     * The API section for the alive check.
     */
    public string $section = 'alive';

    /**
     * Perform an alive check.
     *
     * @return array|bool An array with the alive status or false on failure.
     */
    public function getAlive(): array|bool
    {
        return $this->requestData();
    }
}
