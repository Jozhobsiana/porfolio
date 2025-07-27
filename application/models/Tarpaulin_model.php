<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tarpaulin_model extends CI_Model
{
    public function insert($data)
    {
        return $this->db->insert('tarpaulin', $data);
    }

    public function get_all()
    {
        return $this->db->where('deleted_at IS NULL')->get('tarpaulin')->result_array();
    }

    public function get($id)
    {
        return $this->db->get_where('tarpaulin', ['id' => $id])->row_array();
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('tarpaulin', $data);
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('tarpaulin');
    }
}
