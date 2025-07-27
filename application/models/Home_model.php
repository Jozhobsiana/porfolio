<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends CI_Model
{
    public function home_insert($data)
    {
        return $this->db->insert('home', $data);
    }

    public function get_all_home()
    {
        return $this->db->get('home')->result_array();
    }

    public function get_home($id)
    {
        return $this->db->get_where('home', ['id' => $id])->row_array();
    }

    public function update_home($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('home', $data);
    }

    public function delete_home($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('home');
    }
}
