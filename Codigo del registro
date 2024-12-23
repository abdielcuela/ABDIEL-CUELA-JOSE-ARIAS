<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Gamer</title>
    <!-- Agregar Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #2c3e50, #3498db);
            font-family: 'Press Start 2P', cursive;
            color: #fff;
        }

        .card {
            background: rgba(0, 0, 0, 0.8);
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        .card-header {
            background: #1abc9c;
            color: #fff;
        }

        .btn-primary {
            background: #e74c3c;
            border-color: #e74c3c;
        }

        .btn-primary:hover {
            background: #c0392b;
            border-color: #c0392b;
        }

        .form-control {
            background-color: #34495e;
            border: none;
            color: #fff;
            font-family: 'Press Start 2P', cursive;
        }

        .form-control:focus {
            border-color: #1abc9c;
            background-color: #2c3e50;
        }

        a {
            color: #1abc9c;
        }

        a:hover {
            color: #16a085;
        }

        .text-center p {
            font-size: 14px;
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>Registrarse - Gamer</h4>
                    </div>
                    <div class="card-body">
                        <!-- Formulario de registro -->
                        <form action="<?= site_url('auth/process_register') ?>" method="POST">
                            <div class="mb-3">
                                <label for="username" class="form-label">Nombre de usuario</label>
                                <input type="text" class="form-control" name="username" required>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" name="password" required>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Registrarse</button>
                        </form>

                        <!-- Enlace para ir al inicio de sesión -->
                        <div class="mt-3 text-center">
                            <p>¿Ya tienes cuenta? <a href="<?= site_url('auth/login') ?>">Inicia sesión aquí</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Agregar Bootstrap JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
