<?php

    require 'includes/config/database.php';
    $db = conectarDB();


    $errores = []; 
    // auntenticar el usuario  
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
        $password = mysqli_real_escape_string($db, $_POST['password']);

        if(!$email) {
            $errores[] = "El email es obligatorio o no es válido";
        }
        
        if(!$password) {
            $errores[] = "El password es obligatorio o no es válido";
        }

        if(empty($errores)) {
            // revisar si el usuario existe
            $query = "SELECT * FROM usuarios WHERE email = '${email}' ";
            $resultado = mysqli_query($db, $query);
        

            if( $resultado->num_rows ) {
                // revisar si el password es correcto
                $usuario = mysqli_fetch_assoc($resultado);

                // revisar si el password es correcto o no

           
                // $auth = password_verify($password,   )
               
                $auth = password_verify($password, $usuario['password']);
                
                if($auth) {
                    // El usuario esta autenticado
                    session_start();

                    // llenar el arreglo de la sesion 

                    $_SESSION['usuario'] = $usuario['email'];
                    $_SESSION['login'] = true;

                    header('Location: /admin');


                } else {
                    $errores[] = "El password es incorrecto";
                }
            } else {
                $errores[] = "El usuario no existe";
            }
        }
    }

    require 'includes/funciones.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Iniciar sesión </h1>

        <?php foreach($errores as $error): ?>
            <div class="alerta error"> 
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <form class="formulario" method ="POST" novalidate>
            <fieldset>
                <legend>Email y Password</legend>

                <label for="email">E-mail</label>
                <input type="email" name="email" placeholder="Tu Email" id="email">

                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Tu password" id="password" >
            </fieldset>

            <input type="submit" value="Iniciar Sesión" class="boton boton-verde">
        </form>
    </main>

<?php
    incluirTemplate('footer');
?>
