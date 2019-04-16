<?php

namespace App\Model;
use System\Model as Model;

class User extends Model{
    public function createUser($name, $username, $password, $account){
        date_default_timezone_set('Asia/Jakarta');
        $fields = array("name", "user_type", "username", "password", "date_created");
        $values = array($name, $account, $username, password_hash($password, PASSWORD_BCRYPT, ['cost'=>12]) , date('Y-m-d H:i:s'));

        $user = $this->db->insert("tbl_user", $fields, $values);
        if($user){
            return true;
        }else{
            return false;
        }
    }

    public function checkUser($username, $password){
        $user = $this->db->select("tbl_user", "username = ?", array($username));
        if(count($user) > 0){
            $hashpass = $user[0]['password'];
            if(password_verify($password, $hashpass)){
                return array("status"=>true, "data"=>array("type"=>$user[0]['user_type'], "id"=>$user[0]['id']));
            }else{
                return array("status"=>false, "msg"=>"password untuk akun ini salah.");
            }
        }else{
            return array("status"=>false, "msg"=>"user tidak ditemukan");
        }
    }

    public function getUser($id){
        $user = $this->db->select("tbl_user", "id = ?", array($id));
        if(count($user) > 0){
            return $user[0];
        }else{
            return null;
        }
    }

    public function changeAccount($id, $username, $password){
        $fields = array("username", "password");
        $values = array($username, password_hash($password, PASSWORD_BCRYPT, ['cost'=>12]));
        $user = $this->db->update("tbl_user", $fields, $values, "id = $id");
        return $user;
    }

    public function changeName($id, $name){
        $fields = array("name");
        $values = array($name);
        $user = $this->db->update("tbl_user", $fields, $values, "id = $id");
        return $user;
    }

    public function delete($id){
        return $this->db->delete("tbl_user", "id = ?", array($id));
    }
}