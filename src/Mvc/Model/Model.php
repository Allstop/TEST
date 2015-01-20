<?php

namespace Mvc\Model;

class Model{

    private static $db = null;

    protected $status = false;

    public function __construct()
    {
        try {
            $conn = new \PDO('mysql:host=127.0.0.1;dbname=member', 'root', '1234');
            //*錯誤處理,方式為拋出異常
            $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            //* 轉型utf8
            $conn->query('set character set utf8');
            self::$db = $conn;
            $this->status = true;
        } catch (PDOException $e) {
            $this->status = false;
            return;
        }
    }
    //*寫入資料
    public function create()
    {
        if ($this->status !== true) {
            return 'error in create!';
        }
        try{
            if (!isset($_POST["name"])) {
                return 'noName！';
            } elseif (!isset($_POST["pwd"])) {
                return 'noPwd！';
            } else {
                $this->memberdata = array();
                $_name = trim($_POST ["name"]);
                $_password = trim($_POST ["pwd"]);
                $_mobilephone = trim($_POST ["mph"]);
                $_memo = trim($_POST ["memo"]);
                $sql = self::$db->prepare("INSERT INTO information (username, password, mobilephone, memo)
                VALUES (:name ,:password, :mobilephone, :memo)");
                $sql->bindvalue (':name', $_name);
                $sql->bindvalue (':password', $_password);
                $sql->bindvalue (':mobilephone', $_mobilephone);
                $sql->bindvalue (':memo', $_memo);
                $this->memberdata = $sql;
                return ($sql->execute()) ? '成功' : '失敗';
            }

        }catch(PDOException $e){
            return 'error in create!';
        }
    }
    //*會員詳細資料
    public function lists(){
        if ($this->status !== true) {
            return 'error';
        }
        try {
            $this->memberlist = array();
            $sql =  self::$db->prepare("SELECT * FROM information
            		where username='".$_POST['name']."' and password='".$_POST['pwd']."' ");
            if ($sql->execute()) {
                $this->memberlist=$sql;
                return $sql->fetchAll(\PDO::FETCH_ASSOC);
            }else{
                return 'error in lists!';
            }
        }catch(\PDOException $e){

        }
    }
    //*檢查登入資料是否已存在
    public function loginCheck(){
        $sql1 = self::$db->query("SELECT id FROM information
        where username='".$_POST['name']."' and password='".$_POST['pwd']."' ");
        $sql2 = self::$db->query("SELECT id FROM information
        where username='".$_POST['name']."' ");
        $sql3 = self::$db->query("SELECT id FROM information
        where password='".$_POST['pwd']."' ");

        if ($sql1->fetch()) {
            return 'success';
        } elseif ($sql2->fetch()) {
            return 'repeatNum';
        } elseif ($sql3->fetch()) {
            return 'repeatPwd';
        } else {
            return 'fail';
        }

    }
}
