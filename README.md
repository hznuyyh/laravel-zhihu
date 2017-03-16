# laravel-zhihu
### 第一次改动 2017-3-13
PHP版本过低，更新PHP版本5.4->7.0 

弃用Laravel5.3，改用5.0版本
5.1及后续版本更新了Route,并修复了5.0的BUG
感觉还是5.0好用

明日更新SendCloud,需要SendCloud配置

### 3-14更新  
完成了注册内容，邮件发送需要以下几个配置

Naux/SendCloud

Guzzplehttp/guzzle

windows下在文件根目录执行

composer require guzzlehttp/guzzle

composer require naux/sendcloud

之后我们我们Composer.json看到我们成功安装了这两个配置

Laravel5版本取消了auth,所以需要我们手动重新加载

php artisan make:auth

### 3-16更新<br>
完成了登录部分及邮箱验证，将laravel重新更新到5.4<br>添加了重置密码的邮箱发送。Bug注册后邮箱未验证情况下，已经直接登录
