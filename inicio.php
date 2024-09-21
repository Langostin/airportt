<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['username'])) {
    header(header: "Location: index.html");
    die("No hay usuario logueado.");
}

$userName = $_SESSION['username'];
$userId = $_SESSION['user_id'];
$userEmail = $_SESSION['email'];
$userDate = $_SESSION['sesion_time'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" href="png/logo-no-background-icon.png">
</head>

<body>
    <div class="contenedor">
        <header>
            <div class="logo" onclick="window.location.href='inicio.php'">
                <img src="png/logo-no-background-icon.png" alt="logo" height="50px">
                <p>AirLuxe</p>
            </div>
            <div>
                <a href="#" id="userLink">Mi perfil</a>
                <a href="logout.php">Cerrar Sesion</a>
            </div>
        </header>
        <div class="btn-cont-inicio">
            <div class="cont cn1" onclick="window.location.href='search.html'">
                <h2>Buscar Vuelos</h2>
            </div>
            
        </div>
        <div class="btn-cont-inicio">
            <div class="cont cn2" onclick="window.location.href='reservations.php'">
                <h2>Ver reservaciones</h2>
            </div>
        </div>

        <div id="userModal" class="modal">
            <span class="close">&times;</span>
            <h2>Información del Usuario</h2>
            <p>ID: <?php echo htmlspecialchars($userId); ?></p>
            <p>Nombre: <?php echo htmlspecialchars($userName); ?></p>
            <p>Email: <?php echo htmlspecialchars($userEmail); ?></p>
            <p>Último inicio de sesión: <?php echo htmlspecialchars($userDate); ?></p>
        </div>
    </div>

    <script src="scripts.js"></script>
</body>

</html>