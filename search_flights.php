<?php
session_start(); // Para usar la sesión y el user_id

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

// Buscar vuelos
$origin = $_POST['origin'];
$destination = $_POST['destination'];
$sql = "SELECT * FROM Flights WHERE origin='$origin' AND destination='$destination'";
$result = $conn->query($sql);

$flights = [];
while ($row = $result->fetch_assoc()) {
    // Verificar si el vuelo ya ha sido reservado por el usuario
    $flight_id = $row['flight_id'];
    $reservationCheck = "SELECT * FROM Reservations WHERE user_id='$user_id' AND flight_id='$flight_id'";
    $reservationResult = $conn->query($reservationCheck);

    $row['reserved'] = $reservationResult->num_rows > 0; // Marcar si el usuario ya reservó este vuelo
    $flights[] = $row;
}

$conn->close();

echo json_encode(['success' => true, 'flights' => $flights]);
?>
