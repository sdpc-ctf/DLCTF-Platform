<h1 align="center">DL&S-Platform🚩</h1>


## ♻ About DL&S-Platform

```php
DL&S 来自 SDPC

此平台用于DLCTF比赛，欢迎star

Ubuntu16.04+Laravel+Mysql+Nginx

比赛前端界面与0ops的平台一致，皆为开源html5模板
```

## 😋 How to use

1. Route
```php
Route::get('challenges','ctfController@challenges');
Route::get('scoreboard','ctfController@score');
Route::post('flag/submit','ctfController@submitflag');
/*
admin
*/
Route::get('ctfadmin/task','adminController@seetask');
Route::any('ctfadmin/task/add','adminController@addtask');
Route::get('ctfadmin/home','adminController@index');
Route::any('ctfadmin/task/hint','adminController@hintadd');

Auth::routes();

Route::get('/home', 'ctfController@index');
Route::get('/about','ctfController@about');
```

2. Run it

```bash
>mysql pass is root(or vim .env)

>git clone https://github.com/sdpc-ctf/DLCTF-Platform.git

>cd VCTF-Platform

>cp .env.example .env

>vim .env to update database

>php artisan key:generate

>mysql -uroot -p ctf < ctf.sql

>composer install

>php artisan serve --host=0.0.0.0

>http://yourip:8000/ 

>Admin:venenof7@11.com/venenof7

>play ctf:)
```
## 👨‍💻 Contact me

`593220746@qq.com`

## 🎞photo

<img src="https://s2.ax1x.com/2019/08/15/mAiJjP.png">

<img src="https://s2.ax1x.com/2019/08/15/mAiwNQ.png">

<img src="https://s2.ax1x.com/2019/08/15/mAiNB8.png">

## 🏷todo list
- [x] 一血显示
- [x] solved题目显示绿色
- [x] 后台题目相关，单个/批量隐藏，题目修改，删除
- [x] 后台优化，公告添加、notice删除。前台侧边栏增加Notice，打开显示提示。
- [x] 题目展示页面ui改善、积分榜增加Last Submit时间。后台增加比赛相关修改，前台比赛信息在数据库中，后台直接修改即可。
- [x] 侧边栏增加总分类（展开每个题目分类页面），同时不同种类题目样式显示不一样

## 🕊待增加的锅

~~题目动态积分~~

~~积分榜美化~~

