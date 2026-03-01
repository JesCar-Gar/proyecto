<?php
$host = 'db';
$dbname = 'radio_db';
$username = 'empanadasDescuento';
$password = 'empanadasDescuento';
$creadores = [];
$peticiones = [];

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $pdo->query("SELECT * FROM creadores ORDER BY id");
    $creadores = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $stmt2 = $pdo->query("SELECT * FROM peticiones ORDER BY fecha_peticion DESC");
    $peticiones = $stmt2->fetchAll(PDO::FETCH_ASSOC);
    
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
    <button onclick="togglePeticiones()">Ver Peticiones</button>

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

    <div id="peticionesSection" style="display:none;">
        <h3>Peticiones:</h3>
        <?php if (!empty($peticiones)): ?>
            <?php foreach ($peticiones as $p): ?>
                <hr>
                <p><strong>ID:</strong> <?php echo $p['id']; ?></p>
                <p><strong>Oyente:</strong> <?php echo htmlspecialchars($p['oyente']); ?></p>
                <p><strong>Artista:</strong> <?php echo htmlspecialchars($p['artista']); ?></p>
                <p><strong>Canción:</strong> <?php echo htmlspecialchars($p['cancion_artista']); ?></p>
                <p><strong>Fecha:</strong> <?php echo $p['fecha_peticion']; ?></p>
                <p><strong>Reproducida:</strong> <?php echo $p['reproducida'] ? 'Sí' : 'No'; ?></p>
                <form action="/cgi-bin/borrar.py" method="POST" style="display:inline;">
                    <input type="hidden" name="id" value="<?php echo $p['id']; ?>">
                    <button type="submit" onclick="return confirm('¿Seguro que quieres borrar esta petición?')">Borrar</button>
                </form>
                <hr>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No hay peticiones registradas</p>
        <?php endif; ?>
    </div>

    <script>
    function toggleCreadores() {
        var x = document.getElementById('creadoresSection');
        x.style.display = x.style.display === 'none' ? 'block' : 'none';
    }
    
    function togglePeticiones() {
        var x = document.getElementById('peticionesSection');
        x.style.display = x.style.display === 'none' ? 'block' : 'none';
    }
    </script>
</body>
</html>