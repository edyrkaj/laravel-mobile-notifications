<?php
/**
 * Created by PhpStorm.
 * User: eledi
 * Date: 23/10/2017
 * Time: 15:56
 */

use Edyrkaj\LaravelPushNotification\Facades\PushNotification;
use Illuminate\Notifications\Notification;

class PushService extends Notification {
    protected $message;
    protected $device_token;
    protected $platform;
    protected $notification_type;
    protected $certificate_location;

    const BADGE_COUNT = 1;
    const PUSH_TITLE = "Push Service Title";
    
    /**
     * PushService constructor.
     *
     * @param $message
     * @param $device_token
     * @param $platform
     * @param $notification_type
     *
     * @internal param $certificate
     * @internal param $title
     */
    public function __construct( $message = null, $device_token = null, $platform = null, $notification_type = null) {
        $this->message              = $message;
        $this->device_token         = $device_token;
        $this->platform             = $platform;
        $this->notification_type    = $notification_type;
    }
    
    /**
     * @author Eledi Dyrkaj
     * @email edyrkaj@gmail.com
     * @return mixed
     */
    public function sendToIOS() {
        $message = PushNotification::Message( $this->message, [
            'title'   => self::PUSH_TITLE,
            'name'    => self::PUSH_TITLE,
            'badge'   => self::BADGE_COUNT,
            'content' => $this->message,
            'custom'  => [ 'type' => $this->notification_type ]
        ] );
        
        $send_push = PushNotification::app( [
            'environment' => 'development',
            'certificate' => $this->certificate_location,
            'passPhrase'  => 5555,
            'service'     => 'apns'
        ] )->to( $this->device_token )->send( $message );
        
        return $send_push->getAdapter()->getResponse();
    }
    
    /**
     * @author Eledi Dyrkaj
     * @email edyrkaj@gmail.com
     * @return mixed
     */
    public function sendToAndroid() {
        $message = PushNotification::Message( $this->message, [
            'title'   => self::PUSH_TITLE,
            'name'    => self::PUSH_TITLE,
            'msgcnt'  => self::BADGE_COUNT,
            'content' => $this->message,
            'custom'  => [ 'type' => $this->notification_type ],
        ] );
    
        $send_push = PushNotification::app( 'appNameAndroid' )->to( $this->device_token )->send( $message );
       
        return $send_push;
    }
    
    /**
     * Send to both platforms
     * @author Eledi Dyrkaj
     * @email edyrkaj@gmail.com
     * @return mixed
     */
    public function send() {
        if ( $this->platform == "ios" ) {
            return $this->sendToIOS();
        } else {
            return $this->sendToAndroid();
        }
    }
}