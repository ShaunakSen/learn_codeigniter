<?php

class User_model extends CI_Model
{
    public function get_users($user_id)
    {       /*
            $config['hostname'] = '127.0.0.1';
            $config['username'] = 'root';
            $config['password'] = 'littlemini';
            $config['database'] = 'errand_db';

            $connection = $this->load->database($config);
       */
        //$query = $this->db->get('users');
        //return $query->result();
        //$query = $this->db->query("SELECT * FROM users");
        //return $query->num_rows();

        $this->db->where('id', $user_id);
        $query = $this->db->get('users');
        return $query->result();

    }
}

?>