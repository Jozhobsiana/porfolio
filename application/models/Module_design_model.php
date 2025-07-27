<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Module_design_model extends CI_Model
{
    public function insert($data)
    {
        return $this->db->insert('module_designs', $data);
    }

    public function get_all()
    {
        return $this->db->where('deleted_at IS NULL')->get('module_designs')->result_array();
    }

    public function get($id)
    {
        return $this->db->get_where('module_designs', ['id' => $id])->row_array();
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('module_designs', $data);
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('module_designs');
    }
}
