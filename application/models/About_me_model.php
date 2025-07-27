<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About_me_model extends CI_Model
{
    public function insert($data)
    {
        return $this->db->insert('about_me', $data);
    }

    public function get_all()
    {
        return $this->db->get('about_me')->result_array();
    }

    public function get($id)
    {
        return $this->db->get_where('about_me', ['id' => $id])->row_array();
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('about_me', $data);
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('about_me');
    }
}
