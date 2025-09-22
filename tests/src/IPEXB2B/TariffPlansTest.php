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

namespace Test\IPEXB2B;

use IPEXB2B\TariffPlans;
use PHPUnit\Framework\TestCase;

/**
 * Tests for the TariffPlans class.
 */
class TariffPlansTest extends TestCase
{
    /**
     * @covers \IPEXB2B\TariffPlans::getTariffPlan
     */
    public function testGetTariffPlan(): void
    {
        $tariffPlans = $this->getMockBuilder(TariffPlans::class)
            ->onlyMethods(['requestData', 'setUrlParams'])
            ->getMock();

        $tariffPlans->expects($this->once())->method('setUrlParams');
        $tariffPlans->expects($this->once())
            ->method('requestData')
            ->with('123')
            ->willReturn(['results' => [['id' => 123]]]);

        $result = $tariffPlans->getTariffPlan(123);
        $this->assertEquals([['id' => 123]], $result['results']);
    }

    /**
     * @covers \IPEXB2B\TariffPlans::getTariffPlanPrice
     */
    public function testGetTariffPlanPrice(): void
    {
        $tariffPlans = $this->getMockBuilder(TariffPlans::class)
            ->onlyMethods(['requestData', 'setUrlParams'])
            ->getMock();

        $tariffPlans->expects($this->once())->method('setUrlParams');
        $tariffPlans->expects($this->once())
            ->method('requestData')
            ->with('123/price')
            ->willReturn(['results' => [['price' => 100]]]);

        $result = $tariffPlans->getTariffPlanPrice(123);
        $this->assertEquals([['price' => 100]], $result['results']);
    }

    /**
     * @covers \IPEXB2B\TariffPlans::getTrunkTypes
     */
    public function testGetTrunkTypes(): void
    {
        $tariffPlans = $this->getMockBuilder(TariffPlans::class)
            ->onlyMethods(['requestData', 'setUrlParams'])
            ->getMock();

        $tariffPlans->expects($this->once())->method('setUrlParams');
        $tariffPlans->expects($this->once())
            ->method('requestData')
            ->with('123/trunkTypes')
            ->willReturn(['results' => [['id' => 1]]]);

        $result = $tariffPlans->getTrunkTypes(123);
        $this->assertEquals([['id' => 1]], $result['results']);
    }
}
