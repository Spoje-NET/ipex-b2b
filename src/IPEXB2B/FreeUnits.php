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
 * This class handles operations related to free units.
 *
 * @url https://restapi.ipex.cz/documentation#!/v1%2FfreeUnits
 */
class FreeUnits extends ApiClient
{
    /**
     * The API section for free units.
     */
    public string $section = 'v1/freeUnits';

    /**
     * Get the history of free units usage.
     *
     * @param array $params Required: 'year', 'month'. Optional: 'number'.
     *
     * @return array|bool An array of free units history or false on failure.
     */
    public function getHistory(array $params): array|bool
    {
        $this->setUrlParams($params);
        return $this->requestData('history');
    }
}
