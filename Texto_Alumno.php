<?php
// Conexión a Microsoft SQL Server
$serverName = "localhost"; // o IP del servidor SQL
$connectionOptions = array(
    "Database" => "DB_SENATI",
    "Uid" => "Usuario",       // Cambiar por el usuario SQL
    "PWD" => "123",    // Cambiar por la contraseña SQL
    "CharacterSet" => "UTF-8"
);

$conn = sqlsrv_connect($serverName, $connectionOptions);

// Comprobar conexión
if (!$conn) {
    die(print_r(sqlsrv_errors(), true));
}

// Procesar el formulario si se ha enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dni = $_POST["dni"];
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $fecha = $_POST["fecha"];
    $direccion = $_POST["direccion"];
    $telefono = $_POST["telefono"];
    $genero = $_POST["genero"];

    $sql = "INSERT INTO Alumnos (AlumDNI, AlumNombre, AlumApellido, AlumFecNac, AlumDireccion, AlumTelefono, AlumGenero)
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    $params = array($dni, $nombre, $apellido, $fecha, $direccion, $telefono, $genero);

    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt === false) {
        echo "Error al insertar datos:<br>";
        die(print_r(sqlsrv_errors(), true));
    } else {
        echo "<p style='color: green;'>Datos insertados correctamente.</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Insertar Alumno</title>
    <meta charset="UTF-8">
</head>
<body>
    <h2>Formulario de Registro de Alumno</h2>
    <form method="POST" action="">
        DNI: <input type="text" name="dni" maxlength="8" required><br><br>
        Nombre: <input type="text" name="nombre" maxlength="30" required><br><br>
        Apellido: <input type="text" name="apellido" maxlength="50" required><br><br>
        Fecha de Nacimiento: <input type="date" name="fecha" required><br><br>
        Dirección: <input type="text" name="direccion" maxlength="100"><br><br>
        Teléfono: <input type="number" name="telefono"><br><br>
        Género: 
        <select name="genero">
            <option value="M">Masculino</option>
            <option value="F">Femenino</option>
        </select><br><br>
        <input type="submit" value="Registrar">
    </form>
</body>
</html>