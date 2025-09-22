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
 * This class handles operations related to numbers.
 *
 * @url https://restapi.ipex.cz/documentation#!/v1%2Fnumbers
 */
class Numbers extends ApiClient
{
    /**
     * The API section for numbers.
     */
    public string $section = 'v1/numbers';

    /**
     * Replace an old OKU with a new one.
     *
     * @param array $data The data for the refresh operation.
     *
     * @return array|bool The result of the refresh operation.
     */
    public function refreshOku(array $data): array|bool
    {
        $this->setPostFields(json_encode($data));
        return $this->requestData('refresh-oku', 'PATCH');
    }
}
