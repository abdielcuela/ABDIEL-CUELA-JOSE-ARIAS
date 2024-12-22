<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Repositorio de Juegos</title>
    <!-- Agregar Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #003366;
            font-family: 'Press Start 2P', cursive;
            color: #fff;
        }

        .btn-container {
            display: flex;
            justify-content: flex-start;
            gap: 10px;
            margin-bottom: 20px;
        }

        table {
            background: rgba(0, 0, 0, 0.8);
            border: 2px solid #ffcc00;
            color: #fff;
        }

        th, td {
            text-align: center;
            padding: 10px;
        }

        th {
            background-color: #333;
            border-bottom: 2px solid #ffcc00;
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
    </style>
    <!-- Fuente temática de videojuegos -->
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="btn-container">
            <a href="#" class="btn btn-primary">Inicio</a>
            <a href="#" class="btn btn-primary">Juegos Populares</a>
            <a href="<?= site_url('auth/logout') ?>" class="btn btn-primary">Cerrar sesión</a>
            <a href="<?= site_url('chat') ?>" class="btn btn-primary">Chat</a> <!-- Botón para el chat -->
        </div>

        <h2 class="text-center">Bienvenido, <?= $username ?>!</h2>
        <p class="text-center">Has iniciado sesión correctamente. Explora nuestro repositorio de juegos.</p>

        <!-- Tabla de juegos -->
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Nombre del Juego</th>
                    <th>Categoría</th>
                    <th>Año de Lanzamiento</th>
                    <th>De Costo</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($games)): ?>
                    <?php foreach ($games as $game): ?>
                    <tr>
                        <td><?= $game['name'] ?></td>
                        <td><?= $game['category'] ?></td>
                        <td><?= $game['release_year'] ?></td>
                        <td><?= $game['is_paid'] ? 'Sí' : 'No' ?></td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">No hay juegos disponibles.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Agregar Bootstrap JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
