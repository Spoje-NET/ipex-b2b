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

use IPEXB2B\Voip;
use PHPUnit\Framework\TestCase;

/**
 * Tests for the Voip class.
 */
class VoipTest extends TestCase
{
    /**
     * @covers \IPEXB2B\Voip::getVoipProfiles
     */
    public function testGetVoipProfiles(): void
    {
        $voip = $this->getMockBuilder(Voip::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData'])
            ->getMock();

        $voip->expects($this->once())
            ->method('requestData')
            ->with('profiles')
            ->willReturn(['results' => [['id' => 1, 'name' => 'Default Profile']]]);

        $result = $voip->getVoipProfiles();
        $this->assertEquals([['id' => 1, 'name' => 'Default Profile']], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Voip::getVoipNumberDetails
     */
    public function testGetVoipNumberDetails(): void
    {
        $voip = $this->getMockBuilder(Voip::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData', 'setUrlParams'])
            ->getMock();

        $voip->expects($this->once())->method('setUrlParams');
        $voip->expects($this->once())
            ->method('requestData')
            ->with('123456789')
            ->willReturn(['results' => [['number' => '123456789']]]);

        $result = $voip->getVoipNumberDetails('123456789');
        $this->assertEquals([['number' => '123456789']], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Voip::getVoipCreditHistory
     */
    public function testGetVoipCreditHistory(): void
    {
        $voip = $this->getMockBuilder(Voip::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData'])
            ->getMock();

        $voip->expects($this->once())
            ->method('requestData')
            ->with('123456789/credit')
            ->willReturn(['results' => [['amount' => 100]]]);

        $result = $voip->getVoipCreditHistory('123456789');
        $this->assertEquals([['amount' => 100]], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Voip::addVoipCredit
     */
    public function testAddVoipCredit(): void
    {
        $voip = $this->getMockBuilder(Voip::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData', 'setPostFields'])
            ->getMock();

        $voip->expects($this->once())->method('setPostFields');
        $voip->expects($this->once())
            ->method('requestData')
            ->with('123456789/credit', 'PUT')
            ->willReturn(['results' => [['success' => true]]]);

        $result = $voip->addVoipCredit('123456789', ['amount' => 100]);
        $this->assertEquals([['success' => true]], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Voip::getVoipNumberState
     */
    public function testGetVoipNumberState(): void
    {
        $voip = $this->getMockBuilder(Voip::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData', 'setUrlParams'])
            ->getMock();

        $voip->expects($this->once())->method('setUrlParams');
        $voip->expects($this->once())
            ->method('requestData')
            ->with('123456789/state')
            ->willReturn(['results' => [['status' => 'active']]]);

        $result = $voip->getVoipNumberState('123456789');
        $this->assertEquals([['status' => 'active']], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Voip::deactivateVoipNumber
     */
    public function testDeactivateVoipNumber(): void
    {
        $voip = $this->getMockBuilder(Voip::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData', 'setPostFields'])
            ->getMock();

        $voip->expects($this->once())->method('setPostFields');
        $voip->expects($this->once())
            ->method('requestData')
            ->with('123456789/deactivate', 'PUT')
            ->willReturn(['results' => [['success' => true]]]);

        $result = $voip->deactivateVoipNumber('123456789', ['requiredCeaseDate' => '2023-12-31T23:59:59Z']);
        $this->assertEquals([['success' => true]], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Voip::createVoipNumber
     */
    public function testCreateVoipNumber(): void
    {
        $voip = $this->getMockBuilder(Voip::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData', 'setPostFields'])
            ->getMock();

        $voip->expects($this->once())->method('setPostFields');
        $voip->expects($this->once())
            ->method('requestData')
            ->with('', 'POST')
            ->willReturn(['results' => [['id' => 123]]]);

        $result = $voip->createVoipNumber(['number' => '987654321']);
        $this->assertEquals([['id' => 123]], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Voip::updateVoipNumber
     */
    public function testUpdateVoipNumber(): void
    {
        $voip = $this->getMockBuilder(Voip::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData', 'setPostFields'])
            ->getMock();

        $voip->expects($this->once())->method('setPostFields');
        $voip->expects($this->once())
            ->method('requestData')
            ->with('', 'PUT')
            ->willReturn(['results' => [['id' => 123]]]);

        $result = $voip->updateVoipNumber(['number' => '987654321']);
        $this->assertEquals([['id' => 123]], $result['results']);
    }
}
