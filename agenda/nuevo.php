<?php
// Comprobamos si recibimos datos por POST 
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    // Recogemos variables
    $nombres = isset($_POST['nombres']) ? $_POST['nombres'] : null; 
    $apaterno = isset($_POST['apaterno']) ? $_POST['apaterno'] : null;
    $amaterno = isset($_POST['amaterno']) ? $_POST['amaterno']: null;
    $genero = isset($_POST['genero']) ? $_POST['genero']: null;
    $fecha_nacimiento = isset($_POST['fecha_nacimiento']) ? $_POST['fecha_nacimiento']: null;
    $telefono = isset($_POST['telefono']) ? $_POST['telefono']: null;
    $email = isset($_POST['email']) ? $_POST['email']: null;
    $linkedin = isset($_POST['linkedin']) ? $_POST['linkedin']: null;

    // Variables
    $hostDB = 'localhost';
    $nombreDB = 'bdagenda';
    $usuarioDB = 'root';
    $contrasenyaDB = '123456'; 

    try {
        // Conecta con base de datos
        $hostPDO = "mysql:host=$hostDB;dbname=$nombreDB;"; 
        $miPDO = new PDO($hostPDO, $usuarioDB, $contrasenyaDB);

        // Convertimos género a M o F
        $genero = ($genero == 'Masculino') ? 'M' : 'F';

        // Prepara INSERT 
        $miInsert = $miPDO->prepare('INSERT INTO contacto (nombres, apaterno, amaterno, genero, fecha_nacimiento, telefono, email, linkedin) VALUES (:nombres, :apaterno, :amaterno, :genero, :fecha_nacimiento, :telefono, :email, :linkedin)'); 
        
        // Ejecuta INSERT con los datos
        $miInsert->execute(array(
                'nombres' => $nombres, 
                'apaterno' => $apaterno,
                'amaterno' => $amaterno,
                'genero' => $genero,
                'fecha_nacimiento' => $fecha_nacimiento,
                'telefono' => $telefono,
                'email' => $email,
                'linkedin' => $linkedin
            )    
        );

        // Redireccionamos a Leer 
        header('Location: listar.php');
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        die();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Contacto - Agenda</title>
</head>
<body> 
    <h2>Crear Nuevo Contacto</h2>
    <form action="" method="post">
        <p>
            <label for="nombres">Nombres</label>
            <input id="nombres" type="text" name="nombres">
        </p>
        <p>
            <label for="apaterno">Apellido Paterno</label>
            <input id="apaterno" type="text" name="apaterno">
        </p>
        <p>
            <label for="amaterno">Apellido Materno</label>
            <input id="amaterno" type="text" name="amaterno">
        </p>
        <p>
            <label for="genero">Género</label>
            <select id="genero" name="genero">
                <option value="Masculino">Masculino</option>
                <option value="Femenino">Femenino</option>
            </select>
        </p>
        <p>
            <label for="fecha_nacimiento">Fecha de Nacimiento</label>
            <input id="fecha_nacimiento" type="date" name="fecha_nacimiento">
        </p>
        <p>
            <label for="telefono">Teléfono</label>
            <input id="telefono" type="text" name="telefono">
        </p>
        <p>
            <label for="email">Email</label>
            <input id="email" type="email" name="email">
        </p>
        <p>
            <label for="linkedin">LinkedIn</label>
            <input id="linkedin" type="text" name="linkedin">
        </p>
        <p> 
            <input type="submit" value="Guardar">
        </p>
    </form>
</body>
</html>

