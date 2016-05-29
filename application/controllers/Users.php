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
    /**
     *
     */
    public function login()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|min_length[3]|matches[password]');
        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'errors' => validation_errors()
            );
            $this->session->set_flashdata($data);
            redirect('Home');
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $user_id = $this->User_model->login_user($username, $password);
            if ($user_id) {
                $user_data = array(
                    'user_id' => $user_id,
                    'username' => $username,
                    'logged_in' => true
                );
                $this->session->set_userdata($user_data);
                $this->session->set_flashdata('login_success', 'You are now logged in');

                $data['main_view'] = "users/admin_view";
                $this->load->view('layouts/main', $data);
                //redirect('Home/index');
            } else {
                $this->session->set_flashdata('login_failed', 'Sorry ... Wrong Credentials');
                redirect('Home/index');
            }
        }
    }
    public function logout(){
        $this->session->sess_destroy();
        redirect('Home/index');
    }

}




