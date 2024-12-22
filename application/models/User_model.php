<?php
class User_model extends CI_Model {

    // Constructor donde se carga la base de datos
    public function __construct() {
        parent::__construct();
        $this->load->database(); // Esto carga la base de datos
    }

    // Función para insertar un nuevo usuario
    public function register($username, $password) {
        // Encriptar la contraseña
        $encrypted_password = password_hash($password, PASSWORD_BCRYPT);

        // Insertar los datos en la base de datos
        $data = array(
            'username' => $username,
            'password' => $encrypted_password
        );

        return $this->db->insert('usuarios', $data);
    }

    // Función para verificar las credenciales de inicio de sesión
    public function login($username, $password) {
        // Buscar el usuario por nombre de usuario
        $this->db->where('username', $username);
        $query = $this->db->get('usuarios');

        if ($query->num_rows() == 1) {
            $user = $query->row();

            // Verificar la contraseña encriptada
            if (password_verify($password, $user->password)) {
                return $user;
            }
        }

        return false; // Si no se encuentra el usuario o la contraseña es incorrecta
    }
}
?>
