<?php
$serverName = "DESARROLLO-NOTE";
$connectionOptions = array(
    "Database" => "DB_Senati",
    "UID" => "sa",
    "PWD" => "sa"
);

$conn = sqlsrv_connect($serverName, $connectionOptions);
if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}

// Captura de datos
$dni        = $_POST['dni'];
$nombres    = $_POST['nombres'];
$apellidos  = $_POST['apellidos'];
$fec_nac    = $_POST['fec_nac'];
$direccion  = $_POST['direccion'];
$telefono   = $_POST['telefono'];
$genero     = $_POST['genero'];

$sql = "INSERT INTO Alumno (AlumDNI, AlumNombres, AlumApellidos, AlumFecNac, AlumDireccion, AlumTelefono, AlumGenero)
        VALUES (?, ?, ?, ?, ?, ?, ?)";

$params = array($dni, $nombres, $apellidos, $fec_nac, $direccion, $telefono, $genero);

$stmt = sqlsrv_query($conn, $sql, $params);

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

echo "✅ Alumno registrado exitosamente.";

sqlsrv_close($conn);
?>
