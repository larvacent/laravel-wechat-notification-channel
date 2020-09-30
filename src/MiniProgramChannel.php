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
 * 小程序通知渠道
 *
 * @author Tongle Xu <xutongle@gmail.com>
 */
class MiniProgramChannel
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
        $message = $notification->toWechatMiniProgram($notifiable);
        if ($message) {
            WeChat::miniProgram()->template_message->send($message);
        }
    }
}