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
    <title>Buscar Vuelos</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" href="png/logo-no-background-icon.png">
</head>

<body>
    <div class="container">
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
        <div class="wlcm-container">
            <h1>Buscar Vuelos</h1>
            <form id="searchForm">
                <label for="origin">Origen:</label>
                <input type="text" id="origin" name="origin" required><br><br>
                <label for="destination">Destino:</label>
                <input type="text" id="destination" name="destination" required><br><br>
                <div class="btn-container">
                    <input type="submit" class="btn" value="Buscar">
                </div>
            </form>
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

    <!-- Modal para mostrar los vuelos -->
    <div id="flightModal" class="modalfly">
        <div class="modalfly-content">
            <span id="closeModal" class="closemodalfly">&times;</span>
            <h2>Vuelos encontrados</h2>
            <div id="modalContent"></div>
        </div>
    </div>

    <script src="script_reservation.js"></script>
    <script src="scripts.js"></script>
</body>

</html>