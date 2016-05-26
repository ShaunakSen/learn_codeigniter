<?php
class Users extends CI_Controller{
    public function show($user_id){
        //$this -> load -> model('user_model'); //load up the module OR use autoload

        $data['results'] = $this -> User_model -> get_users($user_id,'shaunak');
        $data['welcome'] = "Welcome To User View";
        $this->load->view('user_view',$data);
    }

    public function insert(){
        $username = "pappi";
        $password = "0000";
        $this->User_model->create_user([
            'username'=>$username,
            'password'=>$password
        ]);
    }
    public function update(){
        $id = 4;
        $username = "bhagu";
        $password = "1235";
        $this->User_model->update_user([
            'username'=>$username,
            'password'=>$password
        ], $id);
    }
    public function delete(){
        $id = 4;
        $this->User_model->delete_user($id);
    }
}