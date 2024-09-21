<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

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
    echo json_encode(['success' => false, 'message' => 'Usuario no autenticado']);
    exit;
}

$user_id = $_SESSION['user_id']; 

// Acción para realizar la reserva
$action = $_POST['action'];

if ($action === 'reserve_flight') {
    $flight_id = $_POST['flight_id'];

    // Insertar en la tabla Reservations
    $sql = "INSERT INTO Reservations (user_id, flight_id) VALUES ('$user_id', '$flight_id')";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(['success' => true, 'message' => 'Reserva exitosa']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error en la reserva: ' . $conn->error]);
    }
}

$conn->close();
?>
