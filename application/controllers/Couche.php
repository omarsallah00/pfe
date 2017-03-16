<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Couche extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('couche_model', 'couche');
    }

    public function index() {
        //$this->load->helper('url');


        $this->load->view('couche_view');
    }

    public function ajax_list() {
        $list = $this->couche->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $couche) {
            $no++;
            //`idcouche`, `type`, `url`, `title`, `idgroupe`
            $row = array();
            $row[] = $couche->type;
            $row[] = $couche->url;
            $row[] = $couche->title;
            $row[] = $couche->nom_groupe;



            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="edit_couche(' . "'" . $couche->idcouche . "'" . ')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="delete_couche(' . "'" . $couche->idcouche . "'" . ')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->couche->count_all(),
            "recordsFiltered" => $this->couche->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_edit($id) {
        $data = $this->couche->get_by_id($id);
        echo json_encode($data);
    }

//    public function ajax_add() {
//        $this->_validate();
//        //`idcouche`, `type`, `url`, `title`, `idgroupe`
//
//        $data = array(
//            'type' => $this->input->post('type'),
//            'url' => $this->input->post('url'),
//            'title' => $this->input->post('title'),
//            'idgroupe' => $this->input->post('idgroupe'),
//        );
//        $insert = $this->couche->save($data);
//        echo json_encode(array("status" => TRUE));
//    }

    public function ajax_add() {
        $this->_validate();
//save($type, $url, $title, $nom_groupe)
        $insert = $this->couche->save($this->input->post('type'), $this->input->post('url'), $this->input->post('title'), $this->input->post('nom_groupe'));
        echo json_encode(array("status" => TRUE));
    }

//    public function ajax_update() {
//        $this->_validate();
//        $data = array(
//            'type' => $this->input->post('type'),
//            'url' => $this->input->post('url'),
//            'title' => $this->input->post('title'),
//            'idgroupe' => $this->input->post('idgroupe'),
//        );
//        $this->couche->update(array('idcouche' => $this->input->post('idcouche')), $data);
//        echo json_encode(array("status" => TRUE));
//    }
    public function ajax_update() {
        $this->_validate();
//update($type, $url, $title, $nom_groupe, $idcouche)
        $this->couche->update($this->input->post('type'), $this->input->post('url'), $this->input->post('title'),  $this->input->post('nom_groupe'), $this->input->post('idcouche'));
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete($id) {
        $this->couche->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

    private function _validate() {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
//`idcouche`, `type`, `url`, `title`, `idgroupe`
        if ($this->input->post('type') == '') {
            $data['inputerror'][] = 'type';
            $data['error_string'][] = 'Le type est requis';
            $data['status'] = FALSE;
        }

        if ($this->input->post('url') == '') {
            $data['inputerror'][] = 'url';
            $data['error_string'][] = 'L\'URL est requis';
            $data['status'] = FALSE;
        }
        if ($this->input->post('title') == '') {
            $data['inputerror'][] = 'title';
            $data['error_string'][] = 'Le title est requis';
            $data['status'] = FALSE;
        }
        if ($this->input->post('nom_groupe') == '') {
            $data['inputerror'][] = 'nom_groupe';
            $data['error_string'][] = 'L\'ID groupe est requis';
            $data['status'] = FALSE;
        }





        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }

}
