<?php

namespace Mvc\Controller;

use Mvc\Model\Model;
use Mvc\View\View;

// 動作類別
class Controller
{
    // 共用的物件
    private $Model = NULL;
    // 使用者選擇的動作
    private $action = 'login';
    // 建構函式
    // 初始化要執行的動作以及物件
    public function __construct()
    {
        $this->Model = new Model();
    }
    // 執行選擇的動作
    public final function run()
    {
        $this->{$this->action}();
    }
    //*登入
    private function login(){
    	$_SESSION['user'] = 'wayne';
        View::login('index.php');
    }
    //*檢查
    public function check(){
        switch ($_POST['submit']) {
            case 'Login':
                if ($this->Model->loginCheck() == 'success') {
                    $this->userData();
                    echo "<h2 style='color:blue'>登入成功!</h2>";
                } elseif ($this->Model->loginCheck() == 'fail') {
                    $this->login();
                    echo "<h2 style='color:red'>尚未建立,查無符合資料!</h2>";
                } else {
                    $this->login();
                    echo "<h2 style='color:red'>帳號或密碼輸入錯誤!</h2>";
                }
                break;
            case '申請會員':
                $this->newMember();
                break;
            case '送出':
                if ($this->Model->loginCheck() !== 'success' && $this->Model->loginCheck() !== 'repeatNum') {
                    $this->Model->create();
                    $this->login();;
                    echo "<h2>註冊成功,請重新登入!</h2>";
                } else {
                    $this->newMember();
                    echo "<h2>註冊失敗,資料重複,請重新輸入!</h2>";
                }
                break;
            case '登出':
                $this->logout();
                break;
        }
    }
    //*會員資料
    public function userData(){
        $result = $this->Model->lists();
        View::show($result);
    }
    //*建立會員
    public function newMember(){
        View::newMember('index.php');
    }
    //*登出
    public function logout(){
        View::login('index.php');
        View::logout('index.php');
    }
    // 預設的列表功能
    // 等同於原來的 index.php
    private function index()
    {
        if (!isset($_POST['submit'])) {
            View::login('index.php');
        } else {
            switch ($_POST['submit']) {
                case 'Login':
                    if ($this->Model->loginCheck() == 'success') {
                        $result = $this->Model->lists();
                        View::show($result);
                        echo "<h2 style='color:blue'>登入成功!</h2>";
                    } elseif ($this->Model->loginCheck() == 'fail') {
                        View::login('index.php');
                        echo "<h2 style='color:red'>尚未建立,查無符合資料!</h2>";
                    } else {
                        View::login('index.php');
                        echo "<h2 style='color:red'>帳號或密碼輸入錯誤!</h2>";
                    }
                    break;
                case '申請會員':
                    View::newMember('index.php');
                    break;
                case '送出':
                    if ($this->Model->loginCheck() !== 'success' && $this->Model->loginCheck() !== 'repeatNum') {
                        $this->Model->create();
                        View::login('index.php');
                        echo "<h2>註冊成功,請重新登入!</h2>";
                    } else {
                        View::newMember('index.php');
                        echo "<h2>註冊失敗,資料重複,請重新輸入!</h2>";
                    }
                    break;
                case '登出':
                    View::logout('index.php');
                    break;
            }
        }
    }
    // 解構函式
    public function __destruct()
    {
        $this->Model = NULL;
    }
}

