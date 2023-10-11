<?php

// importar la conexion
require 'includes/config/database.php';
$db = conectarDB();

// crear un email y password
$email = "correo@correo.com";
$password = "1234567";


$passwordHash = password_hash($password, PASSWORD_DEFAULT);


// query para crear el usuario
$query = " INSERT INTO usuarios (email, password) VALUES ( '${email}', '${passwordHash}'); ";

echo $query;
// agregarlo a la base de datos

mysqli_query($db, $query);