<?php
/**
 * This is NOT a freeware, use is subject to license terms
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 * @link http://www.larva.com.cn/
 * @license http://www.larva.com.cn/license/
 */

namespace Larva\WeChat\Notifications;

use Illuminate\Notifications\Notification;
use Overtrue\LaravelWeChat\Facade as WeChat;

/**
 * 小程序通知渠道 | 订阅消息
 *
 * @author osindex <yaoiluo@gmail.com>
 */
class WechatSubscribeChannel
{
    /**
     * Send the given notification.
     *
     * @param mixed $notifiable
     * @param Notification $notification
     * @return void
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function send($notifiable, Notification $notification)
    {
        /** @var array $message */
        $message = $notification->toWechatSubscribe($notifiable);
        if ($message) {
            WeChat::miniProgram()->subscribe_message->send($message);
        }
    }
}
