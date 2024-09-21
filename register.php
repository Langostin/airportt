<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "flight_reservation";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => "Connection failed: " . $conn->connect_error]);
    exit;
}

// Recibir y sanitizar los datos del formulario
if (isset($_POST['username'], $_POST['password'], $_POST['email'])) {
    $user = $conn->real_escape_string($_POST['username']);
    $pass = $conn->real_escape_string($_POST['password']);
    $email = $conn->real_escape_string($_POST['email']);

    // Verificar si el nombre de usuario o el correo ya existen
    $checkUserQuery = "SELECT * FROM Users WHERE username='$user' OR email='$email'";
    $result = $conn->query($checkUserQuery);

    if ($result->num_rows > 0) {
        // Si el usuario o correo ya existen, devolver un mensaje de error
        echo json_encode(['success' => false, 'message' => 'El nombre de usuario o el correo ya existen']);
    } else {
        // Si no existen, insertar el nuevo usuario
        $hashed_password = password_hash($pass, PASSWORD_BCRYPT); // Encriptar la contraseña
        $sql = "INSERT INTO Users (username, password, email) VALUES ('$user', '$hashed_password', '$email')";

        if ($conn->query($sql) === TRUE) {
            // Registro exitoso
            echo json_encode(['success' => true, 'message' => 'Registro exitoso']);
        } else {
            // Si hubo un error al insertar los datos
            echo json_encode(['success' => false, 'message' => "Error al registrar: " . $conn->error]);
        }
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
}


$conn->close();
