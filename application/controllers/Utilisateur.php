<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Utilisateur extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('utilisateur_model', 'utilisateur');
    }

    public function index() {
        //$this->load->helper('url');

        $this->load->view('utilisateur_view');
    }

    public function ajax_list() {
        $list = $this->utilisateur->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $utilisateur) {
            $no++;
            //'idutilisateur', 'password', 'email', 'type', 'nom', 'prenom', 'date_creation', 'idgroupe'
            $row = array();
//			$row[] = $utilisateur->idutilisateur;
            $row[] = $utilisateur->email;
            $row[] = $utilisateur->password;
            $row[] = $utilisateur->type;
            $row[] = $utilisateur->nom;
            $row[] = $utilisateur->prenom;
            $row[] = $utilisateur->date_creation;
            $row[] = $utilisateur->nom_groupe;

            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="edit_utilisateur(' . "'" . $utilisateur->idutilisateur . "'" . ')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="delete_utilisateur(' . "'" . $utilisateur->idutilisateur . "'" . ')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->utilisateur->count_all(),
            "recordsFiltered" => $this->utilisateur->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_edit($id) {
        $data = $this->utilisateur->get_by_id($id);
        $data->date_creation = ($data->date_creation == '0000-00-00') ? '' : $data->date_creation; // if 0000-00-00 set tu empty for datepicker compatibility
        echo json_encode($data);
    }

    public function ajax_add() {
        $this->_validate();

        $insert = $this->utilisateur->save($this->input->post('email'),$this->input->post('password'),$this->input->post('type'),
                $this->input->post('nom'),$this->input->post('prenom'),$this->input->post('date_creation'),$this->input->post('nom_groupe'));
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_update() {
        $this->_validate();

        $this->utilisateur->update($this->input->post('email'), $this->input->post('password'), 
                $this->input->post('type'), $this->input->post('nom'), $this->input->post('prenom'),
                $this->input->post('date_creation'), $this->input->post('nom_groupe'), $this->input->post('idutilisateur'));
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete($id) {
        $this->utilisateur->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

    private function _validate() {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($this->input->post('email') == '') {
            $data['inputerror'][] = 'email';
            $data['error_string'][] = 'L\'email est requis';
            $data['status'] = FALSE;
        }

        if ($this->input->post('password') == '') {
            $data['inputerror'][] = 'password';
            $data['error_string'][] = 'Le mot de passe est requis';
            $data['status'] = FALSE;
        }
        if ($this->input->post('type') == '') {
            $data['inputerror'][] = 'type';
            $data['error_string'][] = 'veuillez s.v.p. choisir un type';
            $data['status'] = FALSE;
        }
        if ($this->input->post('nom') == '') {
            $data['inputerror'][] = 'nom';
            $data['error_string'][] = 'Le nom est requis';
            $data['status'] = FALSE;
        }

        if ($this->input->post('prenom') == '') {
            $data['inputerror'][] = 'prenom';
            $data['error_string'][] = 'Le prenom est requis';
            $data['status'] = FALSE;
        }

        if ($this->input->post('date_creation') == '') {
            $data['inputerror'][] = 'date_creation';
            $data['error_string'][] = 'La date d\'ajout est requisw';
            $data['status'] = FALSE;
        }
        if ($this->input->post('nom_groupe') == '') {
            $data['inputerror'][] = 'nom_groupe';
            $data['error_string'][] = 'nom_groupe est requis';
            $data['status'] = FALSE;
        }




        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }

    public function create_user($username, $email, $password) {

        $data = array(
            'username' => $username,
            'email' => $email,
            'password' => $this->hash_password($password),
            'created_at' => date('Y-m-j H:i:s'),
        );

        return $this->db->insert('users', $data);
    }

}
