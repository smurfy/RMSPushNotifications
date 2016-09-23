<?php

namespace RMS\PushNotifications\Tests\Message;

use RMS\PushNotifications\Device\Types,
    RMS\PushNotifications\Message\MacMessage,
    RMS\PushNotifications\Message\MessageInterface;

class MacMessageTest extends \PHPUnit_Framework_TestCase
{
    public function testCreation()
    {
        $msg = new MacMessage();
        $this->assertInstanceOf("RMS\PushNotifications\Message\MessageInterface", $msg);
        $this->assertEquals(Types::OS_MAC, $msg->getTargetOS());
    }
}
