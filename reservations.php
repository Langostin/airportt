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

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "flight_reservation";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    die("Usuario no autenticado");
}

$user_id = $_SESSION['user_id']; // Obtener el ID del usuario

// Consulta para obtener las reservaciones del usuario
$sql = "
    SELECT f.flight_id, f.origin, f.destination, f.departure_date, f.return_date, f.price
    FROM Reservations r
    JOIN Flights f ON r.flight_id = f.flight_id
    WHERE r.user_id = '$user_id'
";
$result = $conn->query($sql);

$reservations = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $reservations[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Reservaciones</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container content">
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
        <div class="reservs"> 
            <h1>Mis Reservaciones</h1>
            <?php if (count($reservations) > 0): ?>
                <table border="1">
                    <tr>
                        <th>ID del Vuelo</th>
                        <th>Origen</th>
                        <th>Destino</th>
                        <th>Fecha de Ida</th>
                        <th>Fecha de Vuelta</th>
                        <th>Precio</th>
                    </tr>
                    <?php foreach ($reservations as $reservation): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($reservation['flight_id']); ?></td>
                            <td><?php echo htmlspecialchars($reservation['origin']); ?></td>
                            <td><?php echo htmlspecialchars($reservation['destination']); ?></td>
                            <td><?php echo htmlspecialchars($reservation['departure_date']); ?></td>
                            <td><?php echo htmlspecialchars($reservation['return_date']); ?></td>
                            <td><?php echo htmlspecialchars($reservation['price']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php else: ?>
                <p>No tienes reservaciones actualmente.</p>
            <?php endif; ?>
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
    <script src="scripts.js"></script>
</body>

</html>