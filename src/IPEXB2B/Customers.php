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
 * Základní třída pro čtení z IPEX.
 *
 * @url https://restapi.ipex.cz/documentation#/
 */
class Customers extends ApiClient
{
    /**
     * Sekce užitá objektem.
     * Section used by object.
     */
    public string $section = 'customers';
}
