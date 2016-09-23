<?php

namespace RMS\PushNotifications;

use RMS\PushNotifications\Handlers\NotificationHandlerInterface;
use RMS\PushNotifications\Message\MessageInterface;

class Notifications
{
    /**
     * Array of handlers
     *
     * @var NotificationHandlerInterface[]
     */
    protected $handlers = array();

    /**
     * Constructor
     */
    public function __construct()
    {
    }

    /**
     * Sends a message to a device, identified by
     * the OS and the supplied device token
     *
     * @param  \RMS\PushNotifications\Message\MessageInterface $message
     * @throws \RuntimeException
     * @return bool
     */
    public function send(MessageInterface $message)
    {
        if (!$this->supports($message->getTargetOS())) {
            throw new \RuntimeException("OS type {$message->getTargetOS()} not supported");
        }
        return $this->handlers[$message->getTargetOS()]->send($message);
    }

    /**
     * Adds a handler
     *
     * @param $osType
     * @param NotificationHandlerInterface $handler
     */
    public function addHandler($osType, NotificationHandlerInterface $handler)
    {
        if (!isset($this->handlers[$osType])) {
            $this->handlers[$osType] = $handler;
        }
    }

    /**
     * Get responses from handler
     *
     * @param  string            $osType
     * @return array
     * @throws \RuntimeException
     */
    public function getResponses($osType)
    {
        if (!isset($this->handlers[$osType])) {
            throw new \RuntimeException("OS type {$osType} not supported");
        }

        if (!method_exists($this->handlers[$osType], 'getResponses')) {
            throw new \RuntimeException("Handler for OS type {$osType} not supported getResponses() method");
        }

        return $this->handlers[$osType]->getResponses();
    }

    /**
     * Check if target OS is supported
     *
     * @param $targetOS
     *
     * @return bool
     */
    public function supports($targetOS)
    {
        return isset($this->handlers[$targetOS]);
    }
}
