<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Utilisateur_model extends CI_Model {

    var $table = 'utilisateur_view';
    var $column = array('idutilisateur', 'email', 'password', 'type', 'nom', 'prenom', 'date_creation', 'nom_groupe'); //set column field database for order and search
    var $order = array('idutilisateur' => 'desc'); // default order 

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
        $this->db->where('idutilisateur', $id);
        $query = $this->db->get();

        return $query->row();
    }

    public function save($email, $password, $type, $nom, $prenom, $date_creation, $nom_groupe) {
        $sql = "insert into utilisateur (email,password,type,nom,prenom,date_creation , idgroupe )
values('$email','$password','$type','$nom','$prenom','$date_creation' , 
(select groupe.idgroupe 
from groupe 
where groupe.nom_groupe='$nom_groupe'))";

        $this->db->query($sql);
        //$this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($email, $password, $type, $nom, $prenom, $date_creation, $nom_groupe, $idutilisateur) {

        $sql = "UPDATE utilisateur u 
JOIN groupe g ON u.idgroupe = g.idgroupe 
SET 
u.email = '$email',
u.password='$password',
u.type='$type',
u.nom='$nom',
u.prenom='$prenom',
u.date_creation='$date_creation',
u.idgroupe = (
select groupe.idgroupe
from groupe
where groupe.nom_groupe='$nom_groupe')
where u.idutilisateur='$idutilisateur'";

        $this->db->query($sql);
        return $this->db->affected_rows();
    }

    public function delete_by_id($id) {
        $this->db->where('idutilisateur', $id);
        $this->db->delete('utilisateur');
    }

}
