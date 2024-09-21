<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

try {
    session_destroy();
    header("Location: index.html");
    exit();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
    exit();
}
?>
