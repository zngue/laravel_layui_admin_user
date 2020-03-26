##  安装
```
composer require zngue/laravel_layui_admin_user
```

## 发布命令
```
php artisan zng:user
```
##文件修改 
```
app/Http/Kernel.php
```
将此文件 \App\Http\Middleware\VerifyCsrfToken::class, 这一行注释掉
##运行命令
```
php artisan serve
```

## 赞助
![支付宝](assets/images/wxpy.jpg)![支付宝](assets/images/alipay.jpg)
