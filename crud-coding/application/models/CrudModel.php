<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudModel extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function store_product($name, $email)
    {
        $data = array(
            'name'     => $name,
            'email'    => $email,
            'reg_date' => date('Y-m-d H:i:s')
        );

        $this->db->insert('mooncrud', $data);

        return ($this->db->insert_id() > 0) ? TRUE : FALSE;
    }

    // Fetch all records
    public function getAll()
    {
        $query = $this->db->get('mooncrud');
        return $query->result_array();
    }

    // Fetch a single record by ID
    public function getDataById($id)
    {
        $query = $this->db->get_where('mooncrud', array('id' => $id));
        return $query->row_array();
    }

    // Update a record

    public function updateData($id, $data) {
    $this->db->where('id', $id);
    return $this->db->update('mooncrud', $data);
}
    // Delete a record
    public function deleteData($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('mooncrud');
    }

}