<?php

namespace RMS\PushNotifications\Tests\Message;

use RMS\PushNotifications\Device\Types,
    RMS\PushNotifications\Message\WindowsphoneMessage,
    RMS\PushNotifications\Message\MessageInterface;

class WindowsphoneMessageTest extends \PHPUnit_Framework_TestCase
{
    public function testCreation()
    {
        $msg = new WindowsphoneMessage();
        $this->assertInstanceOf("RMS\PushNotifications\Message\MessageInterface", $msg);
        $this->assertEquals(Types::OS_WINDOWSPHONE, $msg->getTargetOS());
    }

    public function testDefaultBody()
    {
        $msg = new WindowsphoneMessage();
        $this->assertArrayHasKey("text1", $msg->getMessageBody());
        $this->assertArrayHasKey("text2", $msg->getMessageBody());
    }

    public function testSettingBody()
    {
        $expected = "Foo";
        $msg = new WindowsphoneMessage();
        $msg->setMessage("Foo");
        $msgBody = $msg->getMessageBody();
        $this->assertEquals($expected, $msgBody['text2']);
    }

    public function testDefaultTarget()
    {
        $msg = new WindowsphoneMessage();
        $this->assertEquals(WindowsphoneMessage::TYPE_TOAST, $msg->getTarget());
    }
}
