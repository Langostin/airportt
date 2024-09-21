<?php
session_start(); 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "flight_reservation";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => "Connection failed: " . $conn->connect_error]));
}

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Usuario no autenticado']);
    exit;
}

$user_id = $_SESSION['user_id'];

// Acción para cancelar la reserva
$action = $_POST['action'];

if ($action === 'cancel_flight') {
    $flight_id = $_POST['flight_id'];

    // Eliminar de la tabla Reservations
    $sql = "DELETE FROM Reservations WHERE user_id='$user_id' AND flight_id='$flight_id'";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(['success' => true, 'message' => 'Reserva cancelada exitosamente']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al cancelar la reserva: ' . $conn->error]);
    }
}

$conn->close();
?>
