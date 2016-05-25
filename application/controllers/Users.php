<?php
class Users extends CI_Controller{
    public function show(){
        //$this -> load -> model('user_model'); //load up the module OR use autoload

        $result = $this -> User_model -> get_users();

        foreach($result as $object){
            echo $object->username . '<br/>';
        }
    }
}