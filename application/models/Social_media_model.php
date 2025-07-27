<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Social_media_model extends CI_Model
{
    public function insert($data)
    {
        return $this->db->insert('social_media', $data);
    }

    public function get_all()
    {
        return $this->db->where('deleted_at IS NULL')->get('social_media')->result_array();
    }

    public function get($id)
    {
        return $this->db->get_where('social_media', ['id' => $id])->row_array();
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('social_media', $data);
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('social_media');
    }
}
