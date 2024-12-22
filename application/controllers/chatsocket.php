<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat extends CI_Controller {

    // Método para cargar la vista del chat
    public function index() {
        // Cargar la vista que contiene el chat en tiempo real
        $this->load->view('chat_view');
    }
}
