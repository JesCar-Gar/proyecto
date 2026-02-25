<?php
$host = 'empanadas'; 
$dbname = 'radio_db';
$username = 'EmpanadasADescuento';
$password = 'EmpanadasADescuento';

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>