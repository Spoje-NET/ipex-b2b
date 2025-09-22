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
 * This class handles operations related to tariff plans.
 *
 * @url https://restapi.ipex.cz/documentation#!/v1%2FtariffPlans
 */
class TariffPlans extends ApiClient
{
    /**
     * The API section for tariff plans.
     */
    public string $section = 'v1/tariffPlans';

    /**
     * Get the details of a tariff plan.
     *
     * @param int   $tariffPlanId The ID of the tariff plan.
     * @param array $params       Optional parameters.
     *
     * @return array|bool An array of tariff plan data or false on failure.
     */
    public function getTariffPlan(int $tariffPlanId, array $params = []): array|bool
    {
        $this->setUrlParams($params);
        return $this->requestData((string) $tariffPlanId);
    }

    /**
     * Get the price for a tariff plan.
     *
     * @param int   $tariffPlanId The ID of the tariff plan.
     * @param array $params       Optional parameters.
     *
     * @return array|bool An array of price data or false on failure.
     */
    public function getTariffPlanPrice(int $tariffPlanId, array $params = []): array|bool
    {
        $this->setUrlParams($params);
        return $this->requestData($tariffPlanId . '/price');
    }

    /**
     * Get the trunk types for a tariff plan.
     *
     * @param int   $tariffPlanId The ID of the tariff plan.
     * @param array $params       Optional parameters.
     *
     * @return array|bool An array of trunk type data or false on failure.
     */
    public function getTrunkTypes(int $tariffPlanId, array $params = []): array|bool
    {
        $this->setUrlParams($params);
        return $this->requestData($tariffPlanId . '/trunkTypes');
    }
}
