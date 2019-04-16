<?php
namespace App\Controller;
use System\Controller as Controller;

class Admin extends Controller{
	public function __construct(){
		
	}
	public function index(){
        if($this->req->session->userdata("islogged")){
            $this->res->render("adminpage/admin-home", array("title"=>"Main"));
        }else{
            $this->res->redirect("login");
        }
    }
    
    public function login(){
        if(!$this->req->session->userdata("islogged")){
            $this->res->render("login-page", array("title"=>"Login"));
        }else{
            $this->res->redirect("");
        }
    }

    public function authentication(){
        if($this->req->getMethod() == "POST"){
            $username = $this->req->Post("identity");
            $password = $this->req->Post("keysecret");
            $redirect = $this->req->Get("redirect");
            if(trim($username) !== "" && trim($password) !== ""){
                $password = md5($password);
                /**
                 * put username and password
                 * to model to matching data in database
                 */

                 if($authenticated){
                    $this->req->session->set_userdata(
                        array(
                            "islogged"=>true,
                            "user_id"=>$admin['user_id'],
                            "username"=>$admin['username'],
                            "fullname"=>$admin['fullname'],
                            "level"=>$admin['level']
                            )
                    );
                    $this->res->json(array("status"=>200, "res"=> array("authenticated"=> true, "redirect"=> $redirect == null ? "/" : $redirect)));
                 }else{
                    $this->res->json(array("status"=>200, "res"=> array("authenticated"=> false, "msg"=> $authenticated_msg)));
                 }
            }else{
                $this->res->json(array("status"=>200, "res"=> array("authenticated"=> false, "msg"=> "Username or Password is empty")));
            }
        }
    }

    public function logout(){
        $this->req->session->destroy();
        $this->res->redirect("");
    }
}