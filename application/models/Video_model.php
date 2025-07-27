<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Video_model extends CI_Model
{
    public function insert($data)
    {
        return $this->db->insert('video', $data);
    }

    public function get_all()
    {
        return $this->db->where('deleted_at IS NULL')->get('video')->result_array();
    }

    public function get($id)
    {
        return $this->db->get_where('video', ['id' => $id])->row_array();
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('video', $data);
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('video');
    }
}
