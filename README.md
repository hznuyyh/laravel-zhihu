# laravel-zhihu
### 第一次改动 2017-3-13
PHP版本过低，更新PHP版本5.4->7.0 

弃用Laravel5.3，改用5.0版本<br>
5.1及后续版本更新了Route,并修复了5.0的BUG<br>
感觉还是5.0好用<br>
增加了SendCloud配置<br>
### 3-14更新  
完成了注册内容，邮件发送需要以下几个配置<br>
`Naux/SendCloud
`
`
Guzzplehttp/guzzle
`
windows下在文件根目录执行<br>
```
composer require guzzlehttp/guzzle
```
```
  composer require naux/sendcloud
```
之后我们我们Composer.json看到我们成功安装了这两个配置

Laravel5版本取消了auth,所以需要我们手动重新加载<br>
```
php artisan make:auth
```
### 3-16更新<br>
完成了登录部分及邮箱验证，将laravel重新更新到5.4<br>添加了重置密码的邮箱发送。Bug注册后邮箱未验证情况下，已经直接登录<br>

### 3-25更新<br>
增加了问题的发布，编辑，更新，删除等<br>为问题绑定了标签，启用select2增强了标签选择的界面<br>
增加了用户认证，问题的首页显示，修复了部分bug<br>
问题发布采用百度的Ueditor,可自定义工具栏，加强了发布功能<br>
增加了用户对问题关注，第一次使用的Toggle方法来完善多对多关系，简化了用户关注

### 4-9更新<br>
增加了用户之间的相互关注模块，放弃了Vue的组件开发<br>
对Auth关系和model有了更进一步的理解，对get和post的关系还需要继续深入。<br>
为用户之间的相互关注增加了邮件发送提醒

### 4-10更新<br>
增加了用户对答案的点赞功能

### 4-12更新<br>
增加了webpack对js和css的管理，参见Package.json<br>
Laravel 5.4升级Elixir 为Mix,全新的Mix使用webpack构建，具体参照<br>
[Laravel Mix](http://laravelacademy.org/post/6798.html)<br>
因此能重新开始进行组件化开发<br>
同时更新的发送私信功能就采用了vue+webpack的新模式<br>

### 4-13更新<br>
增加了用户评论，同样采用了Vue的组件化开发<br>
但还存在一点小瑕疵<br>
比如Auth::id()的值取不到等问题<br>

### 4-15更新<br>
对用户私信增加了私信列表用以查看已经发送的私信<br>
完善了用户评论<br>

### 4-16更新<br>
私信列表变得更好看了<br>
修复了以前的一点小Bug，包括评论组件的用户名及头像显示等问题<br>
