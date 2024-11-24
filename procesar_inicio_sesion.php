<!-- proceso para inicio de sesion -->
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $contraseña = $_POST["contraseña"];

    
    $conn = new mysqli("localhost", "root", "", "cupcakes_bella_bel");

    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    
    $sql = "SELECT * FROM usuarios WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($contraseña, $row["contraseña"])) {
            echo "Inicio de sesión exitoso";
            
            header("Location: pagina_web/index.html");
            exit();
        } else {
            echo "Contraseña incorrecta";
        }
    } else {
        echo "Usuario no encontrado";
    }

    $conn->close();
}
?>
