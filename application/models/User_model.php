<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User_model class.
 * 
 * @extends CI_Model
 */
class User_model extends CI_Model {

    /**
     * __construct function.
     * 
     * @access public
     * @return void
     */
    public function __construct() {

        parent::__construct();
        $this->load->database();
    }

    /**
     * create_user function.
     * 
     * @access public
     * @param mixed $username
     * @param mixed $email
     * @param mixed $password
     * @return bool true on success, false on failure
     */
    //'idutilisateur', 'email', 'password', 'type', 'nom', 'prenom', 'date_creation', 'idgroupe'
    public function create_user($email, $password, $nom, $prenom) {

        $data = array(
            'email' => $email,
            'password' => $password,
            'nom' => $nom,
            'prenom' => $prenom,
            'date_creation' => date('Y-m-j'),
        );

        return $this->db->insert('utilisateur', $data);
    }

    public function resolve_user_login($email, $password) {

        $this->db->select('password');
        $this->db->from('utilisateur');
        $this->db->where('email', $email);
        $hash = $this->db->get()->row('password');

        return $hash == $password;
    }

    /**
     * get_user_id_from_username function.
     * 
     * @access public
     * @param mixed $username
     * @return int the user id
     */
    public function get_user_id_from_username($email) {

        $this->db->select('idutilisateur');
        $this->db->from('utilisateur');
        $this->db->where('email', $email);

        return $this->db->get()->row('idutilisateur');
    }

    /**
     * get_user function.
     * 
     * @access public
     * @param mixed $user_id
     * @return object the user object
     */
    public function get_user($user_id) {

        $this->db->from('utilisateur');
        $this->db->where('idutilisateur', $user_id);
        return $this->db->get()->row();
    }

    public function get_couches($email) {

        $sql = "SELECT type, url, title FROM sig_view WHERE email='$email'";

        $q=$this->db->query($sql);
        $data = $q->result_array();

        return $data;
    }
    
    public function get_stations_ville($ville) {
        $sql = "SELECT  LIBESTAT,  CATéGORIE, LONGITUDE, LATITUDE FROM station2 where LIBESTAT='$ville'";

        $q=$this->db->query($sql);
        $data = $q->result_array();

        return $data;
    }
        public function get_stations_categorie($categorie) {
        $sql = "SELECT  LIBESTAT,  CATéGORIE, LONGITUDE, LATITUDE FROM station2 where CATéGORIE='$categorie'";

        $q=$this->db->query($sql);
        $data = $q->result_array();

        return $data;
    }
    
    

}
