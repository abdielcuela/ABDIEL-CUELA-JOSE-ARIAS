<?php
namespace App\Controllers;

use App\Models\UsuarioModel;
use CodeIgniter\Controller;

class Auth extends Controller
{
    public function login()
    {
        // Mostrar la vista de login si es una solicitud GET
        if ($this->request->getMethod() === 'get') {
            return view('auth/login');
        }

        // Proceso de autenticación si es una solicitud POST
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $userModel = new UsuarioModel();
        $user = $userModel->getUserByUsername($username);

        if ($user && password_verify($password, $user['password'])) {
            // Configurar los datos de la sesión si la autenticación es exitosa
            session()->set([
                'isLoggedIn' => true,
                'user_id' => $user['idUsuarios'],
                'username' => $user['usuario'],
                'rol_id' => $user['rol_id'],
            ]);
            return redirect()->to('/dashboard');
        } else {
            // Redirigir a login con un mensaje de error
            return redirect()->back()->with('error', 'Credenciales incorrectas.');
        }
    }

    public function logout()
    {
        // Destruir la sesión y redirigir a la página de login
        session()->destroy();
        return redirect()->to('/auth/login');
    }
}
