<?php
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

// Obtener datos del formulario
$user = $_POST['username'];
$pass = $_POST['password'];

// Consulta para obtener la contraseña almacenada
$sql = "SELECT * FROM Users WHERE username='$user'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    
    // Verificar la contraseña
    if (password_verify($pass, $row['password'])) {
        // Iniciar sesión si las credenciales son correctas
        session_start();
        
        // Guardar información del usuario en la sesión
        $_SESSION['user_id'] = $row['user_id']; 
        $_SESSION['username'] = $row['username'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['sesion_time'] = date('d-m-Y H:i:s');
        
        // Enviar respuesta de éxito
        echo json_encode(['success' => true, 'message' => 'Inicio de sesión exitoso']);
    } else {
        // Contraseña incorrecta
        echo json_encode(['success' => false, 'message' => 'Credenciales inválidas']);
    }
} else {
    // El usuario no existe
    echo json_encode(['success' => false, 'message' => 'No se encontró el usuario']);
}

$conn->close();
?>
