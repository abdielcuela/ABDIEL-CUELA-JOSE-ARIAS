<?php
// app/Controllers/AdminController.php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\AutorModel;
use App\Models\LibroModel;
use App\Models\PrestamoModel;
use App\Models\UserModel;
use App\Models\SoporteModel;

class AdminController extends Controller
{
    public function index()
    {
        if (!session()->get('isLoggedIn') || session()->get('userRole') != 1) {
            return redirect()->to('/login')->with('error', 'Debes iniciar sesión para acceder a este panel');
        }

        return view('admin/dashboard_view');
    }

    public function logout()
    {
        // Destruir la sesión
        session()->destroy();
        return redirect()->to('/login')->with('success', 'Sesión cerrada exitosamente');
    }

// app/Controllers/AdminController.php

public function libros()
{
    if (!session()->get('isLoggedIn') || session()->get('userRole') != 1) {
        return redirect()->to('/login')->with('error', 'Debes iniciar sesión para acceder a este panel');
    }

    $libroModel = new LibroModel();
    $data['libros'] = $libroModel->getLibrosConAutores();
    return view('admin/libros_view', $data);
}


    public function addLibro()
    {
        if (!session()->get('isLoggedIn') || session()->get('userRole') != 1) {
            return redirect()->to('/login')->with('error', 'Debes iniciar sesión para acceder a este panel');
        }

        $autorModel = new AutorModel();
        $data['autores'] = $autorModel->findAll();
        return view('admin/add_libro_view', $data);
    }

    public function saveLibro()
    {
        if (!session()->get('isLoggedIn') || session()->get('userRole') != 1) {
            return redirect()->to('/login')->with('error', 'Debes iniciar sesión para acceder a este panel');
        }

        $libroModel = new LibroModel();
        $data = [
            'titulo' => $this->request->getPost('titulo'),
            'anio' => $this->request->getPost('anio'),
            'id_autor' => $this->request->getPost('id_autor'),
            'editorial' => $this->request->getPost('editorial'),
            'cantidad' => $this->request->getPost('cantidad'),
        ];

        if ($libroModel->save($data)) {
            return redirect()->to('/admin/libros')->with('success', 'Libro agregado con éxito');
        } else {
            return redirect()->to('/admin/addLibro')->with('error', 'Error al agregar el libro');
        }
    }

    public function autores()
    {
        if (!session()->get('isLoggedIn') || session()->get('userRole') != 1) {
            return redirect()->to('/login')->with('error', 'Debes iniciar sesión para acceder a este panel');
        }
    
        $autorModel = new AutorModel();
        $data['autores'] = $autorModel->orderBy('nombre', 'ASC')->orderBy('apellido', 'ASC')->findAll();
        return view('admin/autores_view', $data);
    }
    

    public function addAutor()
    {
        if (!session()->get('isLoggedIn') || session()->get('userRole') != 1) {
            return redirect()->to('/login')->with('error', 'Debes iniciar sesión para acceder a este panel');
        }

        return view('admin/add_autor_view');
    }

    public function saveAutor()
    {
        if (!session()->get('isLoggedIn') || session()->get('userRole') != 1) {
            return redirect()->to('/login')->with('error', 'Debes iniciar sesión para acceder a este panel');
        }

        $autorModel = new AutorModel();
        $data = [
            'nombre' => $this->request->getPost('nombre'),
            'apellido' => $this->request->getPost('apellido'),
        ];

        if ($autorModel->save($data)) {
            return redirect()->to('/admin/autores')->with('success', 'Autor agregado con éxito');
        } else {
            return redirect()->to('/admin/addAutor')->with('error', 'Error al agregar el autor');
        }
    }

// app/Controllers/AdminController.php

public function deleteLibro($id_libro = null)
{
    if ($id_libro === null) {
        return redirect()->to('/admin/libros')->with('error', 'No se proporcionó el ID del libro');
    }

    if (!session()->get('isLoggedIn') || session()->get('userRole') != 1) {
        return redirect()->to('/login')->with('error', 'Debes iniciar sesión para acceder a este panel');
    }

    $libroModel = new LibroModel();
    if ($libroModel->delete($id_libro, false)) {
        return redirect()->to('/admin/libros')->with('success', 'Libro eliminado con éxito');
    } else {
        return redirect()->to('/admin/libros')->with('error', 'Error al eliminar el libro');
    }
}


public function deleteAutor($id_autor)
{
    if (!session()->get('isLoggedIn') || session()->get('userRole') != 1) {
        return redirect()->to('/login')->with('error', 'Debes iniciar sesión para acceder a este panel');
    }

    $autorModel = new AutorModel();
    if ($autorModel->delete($id_autor)) {
        return redirect()->to('/admin/autores')->with('success', 'Autor eliminado con éxito');
    } else {
        return redirect()->to('/admin/autores')->with('error', 'Error al eliminar el autor');
    }
}

public function prestamos()
    {
        if (!session()->get('isLoggedIn') || session()->get('userRole') != 1) {
            return redirect()->to('/login')->with('error', 'Debes iniciar sesión para acceder a este panel');
        }

        $prestamoModel = new PrestamoModel();
        $data['prestamos'] = $prestamoModel->getPrestamosConLibrosYUsuarios();
        return view('admin/prestamos_view', $data);
    }

    public function addPrestamo()
    {
        if (!session()->get('isLoggedIn') || session()->get('userRole') != 1) {
            return redirect()->to('/login')->with('error', 'Debes iniciar sesión para acceder a este panel');
        }

        $libroModel = new LibroModel();
        $userModel = new UserModel();
        $data['libros'] = $libroModel->findAll();
        $data['users'] = $userModel->findAll();
        return view('admin/add_prestamo_view', $data);
    }

    public function savePrestamo()
    {
        if (!session()->get('isLoggedIn') || session()->get('userRole') != 1) {
            return redirect()->to('/login')->with('error', 'Debes iniciar sesión para acceder a este panel');
        }

        $prestamoModel = new PrestamoModel();
        $data = [
            'id_libro' => $this->request->getPost('id_libro'),
            'id_usuario' => $this->request->getPost('id_usuario'),
            'fecha_prestamo' => $this->request->getPost('fecha_prestamo'),
            'fecha_devolucion' => $this->request->getPost('fecha_devolucion'),
        ];

        if ($prestamoModel->save($data)) {
            return redirect()->to('/admin/prestamos')->with('success', 'Préstamo agregado con éxito');
        } else {
            return redirect()->to('/admin/addPrestamo')->with('error', 'Error al agregar el préstamo');
        }
    }

    public function editPrestamo($id_prestamo)
    {
        if (!session()->get('isLoggedIn') || session()->get('userRole') != 1) {
            return redirect()->to('/login')->with('error', 'Debes iniciar sesión para acceder a este panel');
        }
    
        $prestamoModel = new PrestamoModel();
        $libroModel = new LibroModel();
        $userModel = new UserModel();
    
        $data['prestamo'] = $prestamoModel->find($id_prestamo);
        $data['libros'] = $libroModel->findAll();
        $data['users'] = $userModel->getUsersWithNames();
    
        return view('admin/edit_prestamo_view', $data);
    }
    
    public function savePrestamoEdit($id_prestamo)
    {
        if (!session()->get('isLoggedIn') || session()->get('userRole') != 1) {
            return redirect()->to('/login')->with('error', 'Debes iniciar sesión para acceder a este panel');
        }
    
        $prestamoModel = new PrestamoModel();
        $validation = \Config\Services::validation();
    
        $data = [
            'id_libro' => $this->request->getVar('id_libro'),
            'id_usuario' => $this->request->getVar('id_usuario'),
            'fecha_prestamo' => $this->request->getVar('fecha_prestamo'),
            'fecha_devolucion' => $this->request->getVar('fecha_devolucion'),
        ];
    
        if (!$this->validate($validation->getRuleGroup('prestamo'))) {
            return redirect()->to('/admin/editPrestamo/' . $id_prestamo)->withInput()->with('validation', $validation);
        }
    
        if ($prestamoModel->update($id_prestamo, $data)) {
            return redirect()->to('/admin/prestamos')->with('success', 'Préstamo actualizado con éxito');
        } else {
            return redirect()->to('/admin/editPrestamo/' . $id_prestamo)->with('error', 'Error al actualizar el préstamo');
        }
    }
    

    public function deletePrestamo($id_prestamo)
    {
        if (!session()->get('isLoggedIn') || session()->get('userRole') != 1) {
            return redirect()->to('/login')->with('error', 'Debes iniciar sesión para acceder a este panel');
        }

        $prestamoModel = new PrestamoModel();
        if ($prestamoModel->deletePrestamo($id_prestamo)) {
            return redirect()->to('/admin/prestamos')->with('success', 'Préstamo eliminado con éxito');
        } else {
            return redirect()->to('/admin/prestamos')->with('error', 'Error al eliminar el préstamo');
        }
    }

// app/Controllers/AdminController.php

public function estadisticas()
{
    if (!session()->get('isLoggedIn') || session()->get('userRole') != 1) {
        return redirect()->to('/login')->with('error', 'Debes iniciar sesión para acceder a este panel');
    }

    $libroModel = new LibroModel();
    $prestamoModel = new PrestamoModel();
    $autorModel = new AutorModel();

    $data['librosPorAnio'] = $libroModel->getLibrosPorAnio();
    $data['prestamosPorMes'] = $prestamoModel->getPrestamosPorMes();
    $data['autoresConMasLibros'] = $autorModel->getAutoresConMasLibros();

    return view('admin/estadisticas_view', $data);
}

public function soporte()
{
    if (!session()->get('isLoggedIn') || session()->get('userRole') != 1) {
        return redirect()->to('/login')->with('error', 'Debes iniciar sesión para acceder a este panel');
    }

    $soporteModel = new SoporteModel();
    $data['mensajesSoporte'] = $soporteModel->getMensajesSoporte();

    return view('admin/soporte_view', $data);
}

public function saveMensajeSoporte()
{
    if (!session()->get('isLoggedIn') || session()->get('userRole') != 1) {
        return redirect()->to('/login')->with('error', 'Debes iniciar sesión para acceder a este panel');
    }

    $soporteModel = new SoporteModel();
    $data = [
        'id_usuario' => $this->request->getPost('id_usuario'),
        'id_admin' => session()->get('userId'),
        'asunto' => $this->request->getPost('asunto'),
        'mensaje' => $this->request->getPost('mensaje'),
    ];

    if ($soporteModel->save($data)) {
        return redirect()->to('/admin/soporte')->with('success', 'Mensaje de soporte agregado con éxito');
    } else {
        return redirect()->to('/admin/soporte')->with('error', 'Error al agregar el mensaje de soporte');
    }
}


public function saveMensajeSoporteAjax()
{
    $soporteModel = new SoporteModel();
    $data = [
        'id_usuario' => $this->request->getPost('id_usuario'),
        'id_admin' => session()->get('userId'),
        'asunto' => $this->request->getPost('asunto'),
        'mensaje' => $this->request->getPost('mensaje'),
    ];

    if ($soporteModel->save($data)) {
        return json_encode(['success' => true, 'message' => 'Mensaje de soporte agregado con éxito']);
    } else {
        return json_encode(['success' => false, 'message' => 'Error al agregar el mensaje de soporte']);
    }
}

public function getMensajesSoporteAjax()
{
    $soporteModel = new SoporteModel();
    $mensajes = $soporteModel->getMensajesSoporte();
    return json_encode($mensajes);
}

// app/Controllers/AdminController.php

public function saveMensajeSoporteUser()
{
    if (!session()->get('isLoggedIn') || session()->get('userRole') != 2) {
        return redirect()->to('/login')->with('error', 'Debes iniciar sesión para acceder a este panel');
    }

    $soporteModel = new SoporteModel();
    $data = [
        'id_usuario' => $this->request->getPost('id_usuario'),
        'id_admin' => 1, // ID del administrador por defecto
        'asunto' => $this->request->getPost('asunto'),
        'mensaje' => $this->request->getPost('mensaje'),
    ];

    if ($soporteModel->save($data)) {
        return json_encode(['success' => true, 'message' => 'Mensaje de soporte enviado con éxito']);
    } else {
        return json_encode(['success' => false, 'message' => 'Error al enviar el mensaje de soporte']);
    }
}

}
