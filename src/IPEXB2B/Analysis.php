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
 * This class handles operations related to analysis.
 *
 * @url https://restapi.ipex.cz/documentation#!/v1%2Fanalysis
 */
class Analysis extends ApiClient
{
    /**
     * The API section for analysis.
     */
    public string $section = 'v1/analysis';

    /**
     * Get connector analysis.
     *
     * @param array $params Required: 'periodFrom'. Optional: 'periodTo'.
     *
     * @return array|bool An array of analysis data or false on failure.
     */
    public function getConnectorAnalysis(array $params): array|bool
    {
        $this->setUrlParams($params);
        return $this->requestData('connector');
    }
}
