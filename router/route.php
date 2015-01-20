<?php
/**
 * Created by PhpStorm.
 * User: cara
 * Date: 2015/1/19
 * Time: 下午 2:29
 */
require_once("vendor/autoload.php");

use Pux\Mux;

$mux = new Mux;

$mux->any('/', ['Mvc\Controller\Controller', 'run']);
//*登入
$mux->any('/login', ['Mvc\Controller\Controller', 'login']);
//*檢查
$mux->post('/check', ['Mvc\Controller\Controller', 'Check']);
//*會員資料
$mux->post('/userData', ['Mvc\MController\Controller', 'userData']);
//*建立會員
$mux->post('/newMember', ['Mvc\Controller\Controller', 'newMember']);
//*登出
$mux->post('/logout', ['Mvc\Controller\Controller', 'logout']);

return $mux;
