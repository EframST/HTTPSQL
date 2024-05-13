<?php
$hostDB = 'localhost';
$nombreDB = 'bdagenda';
$usuarioDB = 'root';
$contrasenyaDB = '123456'; 

try {
    // Conecta con base de datos 
    $hostPDO = "mysql:host=$hostDB;dbname=$nombreDB;";
    $miPDO = new PDO($hostPDO, $usuarioDB, $contrasenyaDB);

    // Prepara SELECT
    $miConsulta = $miPDO->prepare('SELECT * FROM contacto;');
    // Ejecuta consulta 
    $miConsulta->execute();
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agenda de contactos</title> 
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        table td, table th {
            border: 1px solid orange;
            text-align: center;
            padding: 1.3rem;
        } 
        .button {
            border-radius: .5rem;
            color: white;
            background-color: orange;
            padding: 1rem;
            text-decoration: none;
        } 
    </style>
</head>
<body>
    <p><a class="button" href="nuevo.php">Agregar contacto</a></p>
    <table>
        <tr>
            <th>ID</th>
            <th>Nombres</th>
            <th>Apellido Paterno</th>
            <th>Apellido Materno</th>
            <th>Género</th>
            <th>Fecha de Nacimiento</th>
            <th>Teléfono</th>
            <th>Email</th>
            <th>LinkedIn</th>
            <td></td>
            <td></td>
        </tr>
    <?php foreach ($miConsulta as $valor): ?>
            <tr>
            <td><?= $valor['id']; ?></td>
            <td><?= $valor['nombres']; ?></td> 
            <td><?= $valor['apaterno']; ?></td>
            <td><?= $valor['amaterno']; ?></td>
            <td><?= $valor['genero']; ?></td>
            <td><?= $valor['fecha_nacimiento']; ?></td>
            <td><?= $valor['telefono']; ?></td>
            <td><?= $valor['email']; ?></td>
            <td><?= $valor['linkedin']; ?></td>
            <!-- Se utilizará más adelante para indicar si se quiere modificar o eliminar el registro -->
            <td><a class="button" href="modificar.php?id=<?= $valor['id'] ?>">Modificar</a></td> 
            <td><a class="button" href="borrar.php?id=<?= $valor['id'] ?>">Borrar</a></td>
        </tr>
    <?php endforeach; ?>
    </table>
</body>
</html>
