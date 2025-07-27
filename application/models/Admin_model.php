<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

    protected $table = 'users'; // your admin table name

    public function __construct()
    {
        parent::__construct();
    }

    public function authenticate($username, $password)
    {
        $this->db->where('username', $username);
        $query = $this->db->get($this->table);

        if ($query->num_rows() === 1) {
            $admin = $query->row();

            // Assume password is hashed using password_hash()
            if (password_verify($password, $admin->password)) {
                return $admin; // return user record if valid
            }
        }

        return false;
    }

    public function user_exists($username)
    {
        return $this->db->where('username', $username)->get($this->table)->num_rows() > 0;
    }

    public function create_user($data)
    {
        return $this->db->insert($this->table, $data);
    }

}
