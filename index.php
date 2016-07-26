<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2014 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用入口文件

// 检测PHP环境
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');
// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
define('APP_DEBUG',true);
if(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER']){
    $fe = preg_replace('#(http://.+?)(/.*|$)#','$1',$_SERVER['HTTP_REFERER']);
    header("Access-Control-Allow-Credentials: true");
    header('Access-Control-Allow-Origin: '.$fe);
}
//header('Access-Control-Request-Headers:accept, content-type');
//header("Content-type: application/json; charset=utf-8"); 
// 定义应用目录
define('APP_PATH','./CES/');

// 引入ThinkPHP入口文件
require './ThinkPHP/ThinkPHP.php';

// 亲^_^ 后面不需要任何代码了 就是如此简单