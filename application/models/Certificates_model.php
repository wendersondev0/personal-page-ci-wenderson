<?php
class Certificates_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function show_certificates()
    {
        $this->db->from("certificates");
        return $this->db->get()->result_array();
    }

    public function get_data($id, $select = null)
    {
        if (!empty($select)) {
            $this->db->select($select);
        }
        $this->db->from("certificates");
        $this->db->where("certificate_id", $id);

        return $this->db->get();
    }

    public function insert($data)
    {

        $this->db->insert("certificates", $data);
    }

    public function update($id, $data)
    {
        $this->db->where("certificate_id", $id);
        $this->db->update("certificates", $data);
    }

    public function delete($id)
    {
        $this->db->where("certificate_id", $id);
        $this->db->delete("certificates");
    }

    public function is_duplicated($field, $value, $id = null)
    {
        if (!empty($id)) {
            $this->db->where("certificate_id<>", $id);
        }
        $this->db->from("certificates");
        $this->db->where($field, $value);
        return $this->db->get()->num_rows() > 0;
    }



    var $column_search = ["certificate_title", "certificate_description"];
    var $column_order = ["certificate_title", "", "", "certificate_duration"];

    private function _get_datatable()
    {
        $search = null;
        if ($this->input->post("search")) {
            $search = $this->input->post("search")["value"];
        }
        $order_column = null;
        $order_dir = null;
        $order = $this->input->post("order");
        if (isset($order)) {
            $order_column = $order[0]["column"];
            $order_dir = $order[0]["dir"];
        }
        $this->db->from("certificates");
        if (isset($search)) {
            $first = true;
            foreach ($this->column_search as $field) {
                if ($first) {
                    $this->db->group_start();
                    $this->db->like($field, $search);
                    $first = false;
                } else {
                    $this->db->or_like($field, $search);
                }
            }
            if (!$first) {
                $this->db->group_end();
            }
        }
        if (isset($order)) {
            $this->db->order_by($this->column_order[$order_column], $order_dir);
        }
    }
    public function get_datatable()
    {
        $length = $this->input->post("length");
        $start = $this->input->post("start");

        $this->_get_datatable();

        if (isset($length) && $length != -1) {
            $this->db->limit($length, $start);
        }
        return $this->db->get()->result();
    }

    public function records_filtered()
    {
        $this->_get_datatable();
        return $this->db->get()->num_rows();
    }

    public function records_total()
    {
        $this->db->from("certificates");
        return $this->db->count_all_results();
    }
}
