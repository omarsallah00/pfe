<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Couche_model extends CI_Model {

//`idcouche`, `type`, `url`, `title`, `idgroupe`
    var $table = 'couche_view';
    var $column = array('idcouche', 'type', 'url', 'title', 'nom_groupe'); //set column field database for order and search
    var $order = array('idcouche' => 'desc'); // default order 

    public function __construct() {
        parent::__construct();
//        $this->load->database();
    }

    private function _get_datatables_query() {

        $this->db->from($this->table);

        $i = 0;

        foreach ($this->column as $item) { // loop column 
            if ($_POST['search']['value']) { // if datatable send POST for search
                if ($i === 0) { // first loop
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND. 
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $column[$i] = $item; // set column array variable to order processing
            $i++;
        }

        if (isset($_POST['order'])) { // here order processing
            $this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables() {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered() {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all() {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function get_by_id($id) {
        $this->db->from($this->table);
        $this->db->where('idcouche', $id);
        $query = $this->db->get();

        return $query->row();
    }

//    public function save($data) {
//        $this->db->insert($this->table, $data);
//        return $this->db->insert_id();
//    }
    public function save($type, $url, $title, $nom_groupe) {
        $sql = "insert into couche (type,url,title,idgroupe )
values('$type','$url','$title', 
(select groupe.idgroupe 
from groupe 
where groupe.nom_groupe='$nom_groupe'))";

        $this->db->query($sql);
        //$this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

//    public function update($where, $data) {
//        $this->db->update($this->table, $data, $where);
//        return $this->db->affected_rows();
//    }
    public function update($type, $url, $title, $nom_groupe, $idcouche) {

        $sql = "UPDATE couche c 
JOIN groupe g ON c.idgroupe = g.idgroupe 
SET 
c.type = '$type',
c.url='$url',
c.title='$title',
c.idgroupe = (
select groupe.idgroupe
from groupe
where groupe.nom_groupe='$nom_groupe')
where c.idcouche='$idcouche'";

        $this->db->query($sql);
        return $this->db->affected_rows();
    }

    public function delete_by_id($id) {
        $this->db->where('idcouche', $id);
        $this->db->delete('couche');
    }

}