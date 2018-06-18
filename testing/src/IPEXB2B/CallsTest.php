<?php

namespace Test\IPEXB2B;

use IPEXB2B\Calls;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2018-06-15 at 11:34:23.
 */
class CallsTest extends ApiClientTest
{
    /**
     * @var Calls
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new Calls();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        
    }

    /**
     * @covers IPEXB2B\Calls::getCallsForNumber
     */
    public function testGetCallsForNumber()
    {
        $startDate = new \DateTime();
        $startDate->modify('-1 month');
        $calls = $this->object->getCallsForNumber($startDate, constant('TEST_TEL_NUM'));
    }

    /**
     * @covers IPEXB2B\Calls::loadCallsForCustomer
     */
    public function testLoadCallsForCustomer()
    {
        $startDate = new \DateTime();
        $startDate->modify('-1 month');
        $calls = $this->object->getCallsForCustomer($startDate,
            constant('TEST_CUSTOMER_ID'));
    }
}
