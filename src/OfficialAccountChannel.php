<?php
/**
 * This is NOT a freeware, use is subject to license terms
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 * @link http://www.larva.com.cn/
 * @license http://www.larva.com.cn/license/
 */

namespace Larva\WeChat\Notifications;

use Overtrue\LaravelWeChat\Facade as WeChat;
use Illuminate\Notifications\Notification;

/**
 * 公众号通知渠道
 *
 * @author Tongle Xu <xutongle@gmail.com>
 */
class OfficialAccountChannel
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
        $message = $notification->toWechat($notifiable);
        if ($message) {
            WeChat::officialAccount()->template_message->send($message);
        }
    }
}