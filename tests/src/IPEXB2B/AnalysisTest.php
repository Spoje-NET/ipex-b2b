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

use IPEXB2B\Analysis;
use PHPUnit\Framework\TestCase;

/**
 * Tests for the Analysis class.
 */
class AnalysisTest extends TestCase
{
    /**
     * @covers \IPEXB2B\Analysis::getConnectorAnalysis
     */
    public function testGetConnectorAnalysis(): void
    {
        $analysis = $this->getMockBuilder(Analysis::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData', 'setUrlParams'])
            ->getMock();

        $analysis->expects($this->once())->method('setUrlParams');
        $analysis->expects($this->once())
            ->method('requestData')
            ->with('connector')
            ->willReturn(['results' => [['profit' => 100]]]);

        $result = $analysis->getConnectorAnalysis(['periodFrom' => '2023-01-01']);
        $this->assertEquals([['profit' => 100]], $result['results']);
    }
}
