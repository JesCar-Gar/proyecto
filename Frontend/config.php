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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>libreria de musica</title>
    <fieldset>
        <legend>musica :D</legend>
        <h2 style="color: blue;">algo que le interese?</h2>
        
        <form action="backend.php" method="post">
            
            <input type="radio" id="msc1" name="genero" value="musica1">
            <label for="msc1">Musica1</label><br>
            <input type="radio" id="msc2" name="genero" value="musica2">
            <label for="msc2">Musica2</label><br><br>
            <input type="radio" id="msc3" name="genero" value="musica3">
            <label for="msc3">Musica3</label><br><br>
            <input type="radio" id="msc4" name="genero" value="musica4">
            <label for="msc4">Musica4</label><br><br>
            <input type="radio" id="msc5" name="genero" value="musica5">
            <label for="msc5">Musica5</label><br><br>
            
            <input type="submit" value="enviar :D">
        </form>
    </fieldset>
</head>
<body>
    
</body>
</html>