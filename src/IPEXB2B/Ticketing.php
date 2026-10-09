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
 * IPEX REST API - Ticketing section.
 *
 * @url https://restapi.ipex.cz/documentation#/
 */
class Ticketing extends ApiClient
{
    /**
     * Section used by object.
     */
    public string $section = 'ticketing';
}
