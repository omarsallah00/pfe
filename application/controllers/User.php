<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User class.
 * 
 * @extends CI_Controller
 */
class User extends CI_Controller {

    /**
     * __construct function.
     * 
     * @access public
     * @return void
     */
    public function __construct() {

        parent::__construct();
        $this->load->library(array('session'));
        $this->load->helper(array('url'));
        $this->load->model('user_model');
    }

    public function index() {
        
    }

    //dashboard
    public function dashboard() {
        if (isset($_SESSION['email']) && ($_SESSION['type'] == 'Admin')) {
        $this->load->view('admin_view');
        }
              else{
           redirect('/'); 
        }
    }

    public function get_mes_couches() {
        $list = $this->user_model->get_couches($_SESSION['email']);

        $json_string = json_encode($list);
        $jsonStr = str_replace("\\", '', $json_string);
        echo $jsonStr;
    }
//     public function get_stations_ville($ville) {
//        $list= $this->user_model->get_stations_ville($ville);
//
//        $json_string = json_encode($list);
//        
//        echo $json_string ;
//    }
//         public function get_stations_categorie($categorie) {
//        $list= $this->user_model->get_stations_categorie($categorie);
//
//        $json_string = json_encode($list);
//        
//        echo $json_string ;
//    }

    public function sig() {
        if (isset($_SESSION['email'])) {
        $list = $this->user_model->get_couches($_SESSION['email']);

        $json_string = json_encode($list);
        $jsonStr = str_replace("\\", '', $json_string);


        $this->load->view('sig_view', $jsonStr);
        }
        else{
           redirect('/'); 
        }
    }

    public function register() {

        // create the data object
        $data = new stdClass();

        // load form helper and validation library
        $this->load->helper('form');
        $this->load->library('form_validation');

        // set validation rules
        //public function create_user($email, $password, $nom, $prenom)
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[utilisateur.email]', array('is_unique' => 'L\'Email existe deja veuillez choisir un autre', 'required' => 'L\'@ Mail est obligatoire'));
        $this->form_validation->set_rules('password', 'Password', 'trim|required', array('required' => 'Le mot de passe est obligatoire'));
        $this->form_validation->set_rules('password_confirm', 'Confirm Password', 'trim|required|matches[password]', array('required' => 'La confirmation est obligatoire'));
        $this->form_validation->set_rules('nom', 'Nom', 'required|alpha', array('required' => 'Le nom est obligatoire'));
        $this->form_validation->set_rules('prenom', 'Prenom', 'required|alpha', array('required' => 'Le prenom est obligatoire'));

        if ($this->form_validation->run() === false) {

            // validation not ok, send validation errors to the view
            $this->load->view('header');
            $this->load->view('user/register/register', $data);
            $this->load->view('footer');
        } else {

            // set variables from the form
//			$username = $this->input->post('username');
            //public function create_user($email, $password, $nom, $prenom)
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $nom = $this->input->post('nom');
            $prenom = $this->input->post('prenom');

            if ($this->user_model->create_user($email, $password, $nom, $prenom)) {

                // user creation ok
                $this->load->view('header');
                $this->load->view('user/register/register_success', $data);
                $this->load->view('footer');
            } else {

                // user creation failed, this should never happen
                $data->error = 'There was a problem creating your new account. Please try again.';

                // send error to the view
                $this->load->view('header');
                $this->load->view('user/register/register', $data);
                $this->load->view('footer');
            }
        }
    }

    public function login() {

        // create the data object
        $data = new stdClass();

        // load form helper and validation library
        $this->load->helper('form');
        $this->load->library('form_validation');

        // set validation rules
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {

            // validation not ok, send validation errors to the view
            $this->load->view('header');
            $this->load->view('user/login/login');
            $this->load->view('footer');
        } else {

            // set variables from the form
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            if ($this->user_model->resolve_user_login($email, $password)) {

                $user_id = $this->user_model->get_user_id_from_username($email);
                $user = $this->user_model->get_user($user_id);

                // set session user datas
//                                `idutilisateur`, `email`, `password`, `type`, `nom`, `prenom`, `date_creation`, `idgroupe`
                $_SESSION['idutilisateur'] = (int) $user->idutilisateur;
                $_SESSION['email'] = (string) $user->email;
                $_SESSION['type'] = (string) $user->type;
                $_SESSION['nom'] = (string) $user->nom;
                $_SESSION['prenom'] = (string) $user->prenom;
                $_SESSION['idgroupe'] = (int) $user->idgroupe;

                $list = $this->user_model->get_couches($_SESSION['email']);

                $json_string = json_encode($list);
                $jsonStr = str_replace("\\", '', $json_string);
                $file = 'layers.json';
                file_put_contents($file, $jsonStr);


                if ($_SESSION['type'] == 'Admin') {
                    $this->load->view('admin_view');
                } else {
                    $this->load->view('sig_view');
                }
            } else {

                // login failed
                $data->error = 'Email ou Mot de passe invalide.';

                // send error to the view
                $this->load->view('header');
                $this->load->view('user/login/login', $data);
                $this->load->view('footer');
            }
        }
    }

    /**
     * logout function.
     * 
     * @access public
     * @return void
     */
    public function logout() {

        // create the data object
        $data = new stdClass();

        if (isset($_SESSION['email'])) {

            // remove session datas
            foreach ($_SESSION as $key => $value) {
                unset($_SESSION[$key]);
            }

            // user logout ok
            redirect('/');
        } else {

            // there user was not logged in, we cannot logged him out,
            // redirect him to site root
            redirect('/');
        }
    }

}
