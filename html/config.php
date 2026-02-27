<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="reporte.py, initial-scale=1.0">
    <title>Proyecto Radio</title>
</head>
<body>
    <header>
        <H1>RADIO EN VIVO UNIVERSIDAD DE ORIENTE</H1>
    </header>    

<form action="reporte.py" method="POST">
        <fieldset>
        <legend>informacion del oyente</legend>
        <label for="estudiante">Estudiante: </label> 
            <input type="text" name="oyente" placeholder="USUARIO" id="estudiante">
        
            <br>
        <label for="artista">Artista:  </label>
            <input type="text" name="Artista" placeholder="Escribe tu Artista" id="artista">
           
            <br>
        <label for="Cancion">Cancion:  </label>
        <input type="text" name="cancion" placeholder="Solicita tu Cancion" id="cancion">
        </fieldset>
        
    </form>





</body>
</html>



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