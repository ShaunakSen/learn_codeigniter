<?php


class Users extends CI_Controller
{
    /*
    public function show($user_id)
    {
        //$this -> load -> model('user_model'); //load up the module OR use autoload

        $data['results'] = $this->User_model->get_users($user_id, 'shaunak');
        $data['welcome'] = "Welcome To User View";
        $this->load->view('user_view', $data);
    }

    public function insert()
    {
        $username = "pappi";
        $password = "0000";
        $this->User_model->create_user([
            'username' => $username,
            'password' => $password
        ]);
    }

    public function update()
    {
        $id = 4;
        $username = "bhagu";
        $password = "1235";
        $this->User_model->update_user([
            'username' => $username,
            'password' => $password
        ], $id);
    }

    public function delete()
    {
        $id = 4;
        $this->User_model->delete_user($id);
    }
    */
    public function login(){
        $this->form_validation->set_rules('username','Username','trim|required|min_length[3]');
        $this->form_validation->set_rules('password','Password','trim|required|min_length[3]');
        $this->form_validation->set_rules('confirm_password','Confirm Password','trim|required|min_length[3]|matches[password]');
        if($this->form_validation->run() == FALSE){
            $data = array(
                'errors'=>validation_errors()
            );
            $this->session->set_flashdata($data);
            redirect('Home');
        }
    }

}




