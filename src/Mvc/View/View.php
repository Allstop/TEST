<?php

namespace Mvc\View;

class View{

    public $result = null;
    //*登入畫面
    public static function login()
    {
        header("Content-Type:text/html; charset=utf-8");
        echo '<html>';
        echo '<head><meta charset="utf-8"/><title>Login</title></head>';
        echo '<body>';
        echo '<form action="/check" method="post">';
        echo 'username：<input type="text" name="name"><br>';
        echo 'passoword：<input type="text" name="pwd"><br>';
        echo '<input type="submit" name="submit" value="Login"/><br><br>';
        echo '<input type="submit" name="submit" value="申請會員"/> ';
        echo '<input type="submit" name="submit" value="忘記密碼"/>';
        echo '</form>';
    }
    //*新建會員資料
    public static function newMember()
    {
        header("Content-Type:text/html; charset=utf-8");
        echo '<html>';
        echo '<head><meta charset="utf-8"/><title>NewMember</title></head>';
        echo '<body>';
        echo '<form action="/check" method="post">';
        echo 'username：<input type="text" name="name"><br>';
        echo 'passoword：<input type="text" name="pwd"><br>';
        echo 'mobilephone：<input type="text" name="mph"><br>';
        echo 'memo：<input type="text" name="memo"><br>';
        echo '<input type="submit" name="submit" value="送出"/>';
        echo '</form>';
    }
    //*會員資料
    public function show($result)
    {
        header("Content-Type:text/html; charset=utf-8");
        echo '<html>';
        echo '<head><meta charset="utf-8"/><title>NewMember</title></head>';
        echo '<body>';
        echo '<form action="/logout" method="post">';
        echo '<h2>會員資料：</h2>';
        foreach ($result as $row) {
            echo '<br>id:'.$row["id"];
            echo '<br>-Name:'.$row["username"];
            echo '<br>-Password:'.$row["password"];
            echo '<br>-mobilephone:'.$row["mobilephone"];
            echo '<br>-memo:'.$row["memo"].'<br>';
        }
        echo '<input type="submit" name="submit" value="登出"/>';
        echo '</form>';
    }
    //*登出
    public static function logout()
    {
        header("Content-Type:text/html; charset=utf-8");
        echo '<body>';
        echo '<form action="/" method="post">';
        echo "<h2 style='color:blue'>您已登出！謝謝光臨!</h2>";
        echo '</form>';
    }
}