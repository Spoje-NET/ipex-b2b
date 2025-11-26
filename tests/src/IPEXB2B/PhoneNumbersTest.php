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

use IPEXB2B\PhoneNumbers;
use PHPUnit\Framework\TestCase;

/**
 * Tests for the PhoneNumbers class.
 */
class PhoneNumbersTest extends TestCase
{
    /**
     * @covers \IPEXB2B\PhoneNumbers::getPhoneNumbers
     */
    public function testGetPhoneNumbers(): void
    {
        $phoneNumbers = $this->getMockBuilder(PhoneNumbers::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData', 'setUrlParams'])
            ->getMock();

        $phoneNumbers->expects($this->once())->method('setUrlParams');
        $phoneNumbers->expects($this->once())
            ->method('requestData')
            ->willReturn(['results' => [['number' => '123456789']]]);

        $result = $phoneNumbers->getPhoneNumbers();
        $this->assertEquals([['number' => '123456789']], $result['results']);
    }

    /**
     * @covers \IPEXB2B\PhoneNumbers::getDiagnostic
     */
    public function testGetDiagnostic(): void
    {
        $phoneNumbers = $this->getMockBuilder(PhoneNumbers::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData', 'setUrlParams'])
            ->getMock();

        $phoneNumbers->expects($this->once())->method('setUrlParams');
        $phoneNumbers->expects($this->once())
            ->method('requestData')
            ->with('diagnostic')
            ->willReturn(['results' => [['status' => 'ok']]]);

        $result = $phoneNumbers->getDiagnostic(['number' => '123456789']);
        $this->assertEquals([['status' => 'ok']], $result['results']);
    }

    /**
     * @covers \IPEXB2B\PhoneNumbers::createBlock
     */
    public function testCreateBlock(): void
    {
        $phoneNumbers = $this->getMockBuilder(PhoneNumbers::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData', 'setPostFields'])
            ->getMock();

        $phoneNumbers->expects($this->once())->method('setPostFields');
        $phoneNumbers->expects($this->once())
            ->method('requestData')
            ->with('block', 'PUT')
            ->willReturn(['results' => [['id' => 1]]]);

        $result = $phoneNumbers->createBlock(['count' => 10]);
        $this->assertEquals([['id' => 1]], $result['results']);
    }
}
