# RMSPushNotifications ![](https://secure.travis-ci.org/richsage/RMSPushNotifications.png)

A Library to allow sending of push notifications to mobile devices.  Currently supports Android (C2DM, GCM, FCM), Blackberry and iOS devices.

## Installation

To use this bundle in your Symfony2 project add the following to your `composer.json`:

    {
        "require": {
            // ...
            "richsage/rms-push-notifications-bundle": "dev-master"
        }
    }

## Usage

A little example of how to push your first message to an iOS device, we'll assume that you've set up the configuration correctly:

    use RMS\PushNotifications\Message\iOSMessage;
    use RMS\PushNotifications\Notification;
    use RMS\PushNotifications\Handlers\AppleNotificationHandler;
    use RMS\PushNotifications\Device\Types;
    
    // you need to alter the constructor 
    $appleHandler = new AppleNotificationHandler($sandbox, $pem, $passphrase, $jsonUnescapedUnicode, $timeout, $cachedir);
    
    $notification = new Notification();
    $notification->addHandler(Types::OS_IOS, $appleHandler);

    $message = new iOSMessage();
    $message->setMessage('Oh my! A push notification!');
    $message->setDeviceIdentifier('test012fasdf482asdfd63f6d7bc6d4293aedd5fb448fe505eb4asdfef8595a7');
    
    // If you only use one target devicetype you can use the $appleHandler directly
    $notification->send($message);
    

The send method will detect the type of message so if you'll pass it an `AndroidMessage` it will automatically send it through the C2DM/GCM servers, and likewise for Mac and Blackberry.

## Android messages

Since both C2DM and GCM are still available, the `AndroidMessage` class has a small flag on it to toggle which service to send it to.  Use as follows:

    use RMS\PushNotifications\Message\AndroidMessage;

    $message = new AndroidMessage();
    $message->setGCM(true);
    $message->setFCM(true); // Use to Firebase Cloud Messaging

to send as a FCM message rather than GCM or C2DM.

## iOS Feedback service

The Apple Push Notification service also exposes a Feedback service where you can get information about failed push notifications - see [here](https://developer.apple.com/library/ios/documentation/NetworkingInternet/Conceptual/RemoteNotificationsPG/Chapters/CommunicatingWIthAPS.html#//apple_ref/doc/uid/TP40008194-CH101-SW3) for further details.

This service is available within the bundle.  The following code demonstrates how you can retrieve data from the service:

    $feedbackService = new iOSFeedback($sandbox, $pem, $passphrase, $timeout);
    $uuids = $feedbackService->getDeviceUUIDs();

Here, `$uuids` contains an array of [Feedback](https://github.com/richsage/RMSPushNotifications/blob/master/Device/iOS/Feedback.php) objects, with timestamp, token length and the device UUID all populated.

Apple recommend you poll this service daily.

## Windows Phone - Toast support

The bundle has beta support for Windows Phone, and supports the Toast notification. Use the `WindowsphoneMessage` message class to send accordingly.

## Windows (Universal, WNS) - Toast support

The bundle has beta support for Windows Notification Service (WNS), and supports the Toast notification. Use the `WindowsMessage` message class to send accordingly.


# Thanks

Firstly, thanks to all contributors to this bundle!

![](https://www.jetbrains.com/phpstorm/documentation/docs/logo_phpstorm.png)

Secondly, thanks to [JetBrains](http://www.jetbrains.com) for their sponsorship of an open-source [PhpStorm](https://www.jetbrains.com/phpstorm/) licence for this project.
