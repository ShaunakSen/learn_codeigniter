<?php

class User_model extends CI_Model
{
    public function get_users($user_id, $username)
    {       /*
            $config['hostname'] = '127.0.0.1';
            $config['username'] = 'root';
            $config['password'] = 'littlemini';
            $config['database'] = 'errand_db';

            $connection = $this->load->database($config);
       */
        /*SELECT
        $query = $this->db->get('users');
        return $query->result();
        $query = $this->db->query("SELECT * FROM users");
        return $query->num_rows();

        $this->db->where(['id'=>$user_id]);
        $query = $this->db->get('users');
        return $query->result();

        */
        $this->db->where([
            'id' => $user_id,
            'username' => $username
        ]);
        $query = $this->db->get('users');
        return $query->result();



    }
    public function create_user($data){
        $this->db->insert('users', $data);
    }
    public function update_user($data, $id){
        $this->db->where(['id'=>$id]);
        $this->db->update('users',$data);
    }
    public function delete_user($id){
        $this->db->where(['id'=>$id]);
        $this->db->delete('users');
    }
}

?>