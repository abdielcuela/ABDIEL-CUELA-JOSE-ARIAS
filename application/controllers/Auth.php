<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('session');
    }

    // Página de registro
    public function register() {
        // Cargar la vista de registro
        $this->load->view('register');
    }

    // Procesar el registro
    public function process_register() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        // Registrar al usuario
        $this->User_model->register($username, $password);

        // Redirigir a la página de inicio de sesión
        redirect('auth/login');
    }

    // Página de inicio de sesión
    public function login() {
        // Cargar la vista de inicio de sesión
        $this->load->view('login');
    }

    // Procesar el inicio de sesión
    public function process_login() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        // Intentar iniciar sesión
        $user = $this->User_model->login($username, $password);

        if ($user) {
            // Si el inicio de sesión es exitoso, redirigir a la página de bienvenida
            $this->session->set_userdata('username', $user->username);
            redirect('auth/welcome');
        } else {
            // Si falla el inicio de sesión, mostrar mensaje de error
            $this->load->view('login', ['error' => 'Usuario o contraseña incorrectos']);
        }
    }

    // Página de bienvenida
    public function welcome() {
        // Verificar si el usuario está logueado
        if ($this->session->userdata('username')) {
            // Cargar la vista de bienvenida y pasar el nombre de usuario
            $data['username'] = $this->session->userdata('username');
            $this->load->view('welcome', $data);
        } else {
            // Si no está logueado, redirigir al inicio de sesión
            redirect('auth/login');
        }
    }

    // Página de cierre de sesión
    public function logout() {
        // Destruir la sesión
        $this->session->sess_destroy();
        // Redirigir a la página de inicio de sesión
        redirect('auth/login');
    }
}
?>
