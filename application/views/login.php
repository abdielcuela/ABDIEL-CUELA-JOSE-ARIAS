<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión - Juego</title>
    <!-- Agregar Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #87CEEB; /* Color celeste */
            font-family: 'Press Start 2P', cursive;
            color: #fff;
        }

        .card {
            background: rgba(0, 0, 0, 0.8);
            border: 2px solid #ffcc00;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(255, 204, 0, 0.8);
        }

        .card-header {
            background-color: #333;
            border-bottom: 2px solid #ffcc00;
            color: #ffcc00;
        }

        .btn-primary {
            background: linear-gradient(90deg, #ffcc00, #ff9900);
            border: none;
            color: #000;
            font-weight: bold;
            transition: transform 0.2s ease;
        }

        .btn-primary:hover {
            transform: scale(1.1);
        }

        a {
            color: #ffcc00;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.1);
            border: 2px solid #ffcc00;
            color: #fff;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.2);
            border-color: #ff9900;
            box-shadow: none;
        }
    </style>
    <!-- Fuente temática de videojuegos -->
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>Iniciar sesión</h4>
                    </div>
                    <div class="card-body">
                        <!-- Mensaje de error si existe -->
                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger text-center" role="alert">
                                <?= $error ?>
                            </div>
                        <?php endif; ?>

                        <!-- Formulario de inicio de sesión -->
                        <form action="<?= site_url('auth/process_login') ?>" method="POST">
                            <div class="mb-3">
                                <label for="username" class="form-label">Nombre de usuario</label>
                                <input type="text" class="form-control" name="username" required>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" name="password" required>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Iniciar sesión</button>
                        </form>

                        <!-- Enlace para ir al registro -->
                        <div class="mt-3 text-center">
                            <p>¿No tienes cuenta? <a href="<?= site_url('auth/register') ?>">Regístrate aquí</a></p>
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
