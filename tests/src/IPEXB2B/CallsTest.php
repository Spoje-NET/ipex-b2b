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

use IPEXB2B\Calls;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2018-06-15 at 11:34:23.
 */
class CallsTest extends ApiClientTest
{
    protected Calls $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(): void
    {
        $this->object = new Calls();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown(): void
    {
    }

    /**
     * @covers \IPEXB2B\Calls::getCallsForNumber
     */
    public function testGetCallsForNumber(): void
    {
        $startDate = new \DateTime();
        $startDate->modify('-1 month');
        $calls = $this->object->getCallsForNumber($startDate, \constant('TEST_TEL_NUM'));
    }

    /**
     * @covers \IPEXB2B\Calls::loadCallsForCustomer
     */
    public function testLoadCallsForCustomer(): void
    {
        $startDate = new \DateTime();
        $startDate->modify('-1 month');
        $calls = $this->object->getCallsForCustomer(
            $startDate,
            \constant('TEST_CUSTOMER_ID'),
        );
    }
}