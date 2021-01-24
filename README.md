# larva/laravel-wechat-notification-channel

[![Packagist](https://img.shields.io/packagist/l/larva/laravel-wechat-notification-channel.svg?maxAge=2592000)](https://packagist.org/packages/larva/laravel-wechat-notification-channel)
[![Total Downloads](https://img.shields.io/packagist/dt/larva/laravel-wechat-notification-channel.svg?style=flat-square)](https://packagist.org/packages/larva/laravel-wechat-notification-channel)

适用于 Laravel 的微信模板消息推送通道适配器

该扩展是对 安正超 超哥的微信扩展的补充。

## 安装

```shell

composer require "larva/laravel-wechat-notification-channel"
```

## 配置

无需配置

## 使用

编写如下 通知类然后发出去就行了
```php
namespace App\Models;

class User {
    public function routeNotificationForWechat(){
        return $this->wechatid;
    }
    
    public function routeNotificationForWechatMiniProgram(){
        return $this->wechatminiid;
    }

    public function routeNotificationForWechatSubscribe(){
        return $this->wechatminiid;
        // or
        // $notifiable->routeNotificationFor('wechatMiniProgram',$this) 通过小程序获取 不再设置此方法
    }
}
```

```php
namespace App\Notifications;

use Illuminate\Notifications\Notification;

class WelcomeNotification extends Notification
{
    /**
     * Get the notification's channels.
     *
     * @param mixed $notifiable
     * @return array|string
     */
    public function via($notifiable)
    {
        return ['wechat','wechatMiniProgram'];
    }

    /**
     * Build the wechat representation of the notification.
     *
     * @param mixed $notifiable
     * @return array|false
     */
    public function toWechat($notifiable)
    {
        if (!$toUser = $notifiable->routeNotificationFor('wechat',$this)) {
            return false;
        }
        return [
            'touser' => $toUser,
            'template_id' => 'template-id',
            'page' => 'index',
            'form_id' => 'form-id',
            'data' => [
               'keyword1' => 'VALUE',
               'keyword2' => 'VALUE2',
                    // ...
            ],
        ];
    }
    
    /**
     * Build the MiniProgram representation of the notification.
     *
     * @param mixed $notifiable
     * @return array|false
     */
    public function toWechatMiniProgram($notifiable)
    {
        if (!$toUser = $notifiable->routeNotificationFor('wechatMiniProgram',$this)) {
            return false;
        }
        return [
            'touser' => $toUser,
            'template_id' => 'template-id',
            'page' => 'index',
            'form_id' => 'form-id',
            'data' => [
               'keyword1' => 'VALUE',
               'keyword2' => 'VALUE2',
                   // ...
            ],
        ];
    }

    /**
     * Build the WechatSubscribeChannel representation of the notification.
     *
     * @param mixed $notifiable
     * @return array|false
     */
    public function toWechatSubscribe($notifiable)
    {
        if (!$toUser = $notifiable->routeNotificationFor('wechatSubscribe',$this)) {
            return false;
        }
        return [
            'touser' => $toUser,
            'template_id' => 'template-id',
            'page' => 'pages/index/index',
            'miniprogram_state' => env('APP_DEBUG', false) ? 'trial' : 'formal',
            // 跳转小程序类型：developer 为开发版；trial为体验版；formal为正式版；默认为正式版
            'data' => [
                'name1' => 'name1',
                'thing2' => 'thing2',
                //...
            ],

        ];
    }
}
```