<?php
$host = 'db';
$dbname = 'radio_db';
$username = 'empanadasDescuento';
$password = 'empanadasDescuento';
$creadores = [];

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $pdo->query("SELECT * FROM creadores ORDER BY id");
    $creadores = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
} catch (PDOException $e) {
    $error = $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto Radio</title>
</head>
<body>
    <?php if (isset($error)): ?>
        <p>Error de conexión: <?php echo $error; ?></p>
    <?php else: ?>
        <p>Conexión exitosa a la base de datos</p>
    <?php endif; ?>
    
    <form action="/cgi-bin/reporte.py" method="POST">
        <label for="oyente">Oyente:</label>
        <input type="text" name="oyente" placeholder="Tu nombre" id="oyente" required>
        <br/>
        <label for="artista">Artista:</label>
        <input type="text" name="artista" placeholder="Escribe tu Artista" id="artista" required>
        <br/>
        <label for="cancion">Canción:</label>
        <input type="text" name="cancion" placeholder="Solicita tu Canción" id="cancion" required>
        <br/>
        <button type="submit">Enviar Petición</button>
    </form>

    <button onclick="toggleCreadores()">Ver Creadores del Proyecto</button>

    <div id="creadoresSection" style="display:none;">
        <h3>Creadores del Proyecto:</h3>
        <?php if (!empty($creadores)): ?>
            <?php foreach ($creadores as $c): ?>
                <hr>
                <?php if (!empty($c['foto_url'])): ?>
                    <img src="<?php echo $c['foto_url']; ?>" width="50" height="50" />
                <?php endif; ?>
                <p><strong>ID:</strong> <?php echo $c['id']; ?></p>
                <p><strong>Nombre:</strong> <?php echo $c['nombre'] . ' ' . $c['apellido']; ?></p>
                <p><strong>Biografía:</strong> <?php echo $c['biografia']; ?></p>
                <p><strong>Habilidades:</strong> <?php echo $c['habilidades']; ?></p>
                <hr>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No hay creadores registrados</p>
        <?php endif; ?>
    </div>

    <script>
    function toggleCreadores() {
        var x = document.getElementById('creadoresSection');
        if(x.style.display === 'none') {
            x.style.display = 'block';
        } else {
            x.style.display = 'none';
        }
    }
    </script>
</body>
</html>