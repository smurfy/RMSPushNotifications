<?php

namespace RMS\PushNotifications\Handlers;

use RMS\PushNotifications\Message\MessageInterface;

interface NotificationHandlerInterface
{
    /**
     * Send a notification message
     *
     * @param  \RMS\PushNotifications\Message\MessageInterface $message
     * @return mixed
     */
    public function send(MessageInterface $message);
}
