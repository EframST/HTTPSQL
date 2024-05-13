<?php
// Variables
$hostDB = 'localhost';
$nombreDB = 'bdagenda';
$usuarioDB = 'root';
$contrasenyaDB = '123456'; 
$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;
$nombres = isset($_REQUEST['nombres']) ? $_REQUEST['nombres'] : null;
$apaterno = isset($_REQUEST['apaterno']) ? $_REQUEST['apaterno'] : null;
$amaterno = isset($_REQUEST['amaterno']) ? $_REQUEST['amaterno'] : null;
$genero = isset($_REQUEST['genero']) ? $_REQUEST['genero'] : null;
$fecha_nacimiento = isset($_REQUEST['fecha_nacimiento']) ? $_REQUEST['fecha_nacimiento'] : null;
$telefono = isset($_REQUEST['telefono']) ? $_REQUEST['telefono'] : null;
$email = isset($_REQUEST['email']) ? $_REQUEST['email'] : null;
$linkedin = isset($_REQUEST['linkedin']) ? $_REQUEST['linkedin'] : null;

// Conecta con base de datos
$hostPDO = "mysql:host=$hostDB;dbname=$nombreDB;";
$miPDO = new PDO($hostPDO, $usuarioDB, $contrasenyaDB);

// Comprobamos si recibimos datos por POST 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Prepara UPDATE
    $miUpdate = $miPDO->prepare('UPDATE contacto SET nombres = :nombres, apaterno = :apaterno, amaterno = :amaterno, genero = :genero, fecha_nacimiento = :fecha_nacimiento, telefono = :telefono, email = :email, linkedin = :linkedin WHERE id = :id');
    //Ejecuta UPDATE con los datos
    $miUpdate->execute([
        'id' => $id,
        'nombres' => $nombres,
        'apaterno' => $apaterno,
        'amaterno' => $amaterno,
        'genero' => $genero,
        'fecha_nacimiento' => $fecha_nacimiento,
        'telefono' => $telefono,
        'email' => $email,
        'linkedin' => $linkedin
    ]);
    // Redireccionamos a Leer
    header('Location: listar.php');
} else {
    //Prepara SELECT
    $miConsulta = $miPDO->prepare('SELECT * FROM contacto WHERE id = :id');
    //Ejecuta consulta
    $miConsulta->execute(['id' => $id]);
}

//Obtiene un resultado
$contacto = $miConsulta->fetch();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificar Contacto - Agenda</title>
</head>
<body>
    <h2>Modificar Contacto</h2>
    <form method="post">
        <p>
            <label for="nombres">Nombres</label>
            <input id="nombres" type="text" name="nombres" value="<?= $contacto['nombres'] ?>">
        </p>
        <p>
            <label for="apaterno">Apellido Paterno</label>
            <input id="apaterno" type="text" name="apaterno" value="<?= $contacto['apaterno'] ?>">
        </p>
        <p>
            <label for="amaterno">Apellido Materno</label>
            <input id="amaterno" type="text" name="amaterno" value="<?= $contacto['amaterno'] ?>">
        </p>
        <p>
            <label for="genero">Género</label>
            <select id="genero" name="genero">
                <option value="Masculino" <?= $contacto['genero'] == 'M' ? 'selected' : '' ?>>Masculino</option>
                <option value="Femenino" <?= $contacto['genero'] == 'F' ? 'selected' : '' ?>>Femenino</option>
            </select>
        </p>
        <p>
            <label for="fecha_nacimiento">Fecha de Nacimiento</label>
            <input id="fecha_nacimiento" type="date" name="fecha_nacimiento" value="<?= $contacto['fecha_nacimiento'] ?>">
        </p>
        <p>
            <label for="telefono">Teléfono</label>
            <input id="telefono" type="text" name="telefono" value="<?= $contacto['telefono'] ?>">
        </p>
        <p>
            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="<?= $contacto['email'] ?>">
        </p>
        <p>
            <label for="linkedin">LinkedIn</label>
            <input id="linkedin" type="text" name="linkedin" value="<?= $contacto['linkedin'] ?>">
        </p>
        <p>
            <input type="hidden" name="id" value="<?= $id ?>">
            <input type="submit" value="Modificar">
        </p>
    </form>
</body>
</html>
