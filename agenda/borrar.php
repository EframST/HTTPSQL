<?php
// Variables
$hostDB = '10.0.2.16';
$nombreDB = 'bdagenda';
$usuarioDB = 'root';
$contrasenyaDB = '123456'; 

// Conecta con base de datos
$hostPDO = "mysql:host=$hostDB; dbname=$nombreDB;"; 
$miPDO = new PDO ($hostPDO, $usuarioDB, $contrasenyaDB);

// Obtiene codigo del libro a borrar
$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : null; 

// Prepara DELETE
$miConsulta = $miPDO->prepare('DELETE FROM contacto WHERE id = :id'); 

// Ejecuta la sentencia SQL
$miConsulta->execute([
    'id' => $id
]);

// Redireccionamos al PHP con todos los datos
header('Location: listar.php');
?>
