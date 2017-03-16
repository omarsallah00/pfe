<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Groupe extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('groupe_model', 'groupe');
    }

    public function index() {
        //$this->load->helper('url');
                $this->load->view('includes/header_view');
        $this->load->view('groupe_view');
        $this->load->view('includes/footer_view');
    }

    public function ajax_list() {
        $list = $this->groupe->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $groupe) {
            $no++;

            $row = array();


            $row[] = $groupe->nom_groupe;


            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="edit_groupe(' . "'" . $groupe->idgroupe . "'" . ')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="delete_groupe(' . "'" . $groupe->idgroupe . "'" . ')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->groupe->count_all(),
            "recordsFiltered" => $this->groupe->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
// select nom_groupe from groupe
        public function select_groupe() {
        $data = $this->groupe->select_groupe();

        echo json_encode($data);
    }
    
    
    public function ajax_edit($id) {
        $data = $this->groupe->get_by_id($id);

        echo json_encode($data);
    }

    public function ajax_add() {
        $this->_validate();


        $data = array(
            'nom_groupe' => $this->input->post('nom_groupe'),
        );
        $insert = $this->groupe->save($data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_update() {
        $this->_validate();
        $data = array(
            'nom_groupe' => $this->input->post('nom_groupe'),
        );
        $this->groupe->update(array('idgroupe' => $this->input->post('idgroupe')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete($id) {
        $this->groupe->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

    private function _validate() {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($this->input->post('nom_groupe') == '') {
            $data['inputerror'][] = 'nom_groupe';
            $data['error_string'][] = 'Le nom de groupe est requis';
            $data['status'] = FALSE;
        }





        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }

}
