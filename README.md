# larva/laravel-wechat-notification-channel

适用于 Laravel 的微信模板消息推送通道适配器


## 安装

```shell

composer require "composer require larva/laravel-wechat-notification-channel"
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
     * Build the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toWechat($notifiable)
    {
        return [
            'touser' => 'user-openid',//这一行不需要
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
     * Build the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toWechatMiniProgram($notifiable)
    {
        return [
            'touser' => 'user-openid',//这一行不需要
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
}
```