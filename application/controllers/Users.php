<?php
class Users extends CI_Controller{
    public function show($user_id){
        //$this -> load -> model('user_model'); //load up the module OR use autoload

        $data['results'] = $this -> User_model -> get_users($user_id);
        $data['welcome'] = "Welcome To User View";
        $this->load->view('user_view',$data);
    }
}