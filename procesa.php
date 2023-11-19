<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "
http://www.w3.org/TR/html4/loose.dtd">
<!-- Desarrollo Web en Entorno Servidor -->
<!-- Tema 2 : Características del Lenguaje PHP -->
<!-- Ejemplo: Procesar datos post -->
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Ficha alquiler</title>
    <style>
        body {
            background-color: blue;
            font-weight: bold;
            font-size: large;
        }

        #resul {
            background-color: white;
            height: 20px;
            width: 350px;
        }

        #categ {
            color: white;
        }

        input {
            height: 20px;
            width: 250px;
        }

        h2 {
            color: white
        }
    </style>
</head>

<body>

    <h2>FICHA DE ALQUILER</h2>
    <?php

    //Comprobamos que todos los campos se han rellenado
    $obligatorios = ["Nombre", "Apellido", "Fecha_nacimiento", "Libro", "Mail", "Fecha_alquiler", "DNI"];
    $errores = [];

    foreach ($obligatorios as $campo) {
        if (!isset($_POST[$campo]) || empty($_POST[$campo])) {
            $errores[] = $campo . " es un campo obligatorio";
        }
    }

    // Si hay errores, mostrarlos y no procesar el formulario
    if (!empty($errores)) {
        echo "<h2>CON ERRORES</h2>";
        foreach ($errores as $mensaje) {
            echo "<p style='color:white;'>$mensaje</p>";
        }
    }

    //Si todos los campo estan completos procedemos a las validaciones
    else {
        $nombre = $_POST['Nombre'];
        $apellido = $_POST['Apellido'];
        $nacimiento = $_POST["Fecha_nacimiento"];
        $libro = $_POST['Libro'];
        $mail = $_POST['Mail'];
        $fecha = $_POST['Fecha_alquiler'];
        $dni = $_POST['DNI'];
        $error  = "CORRECTA";

        //VALIDACIONES MAIL
        if (filter_var($mail, FILTER_VALIDATE_EMAIL) == false) {
            $error = "CON ERRORES";
            $errores[] = "Formato del email incorrecto";
        }
        //VALIDACIONES FECHA
        $fechaHoy = new DateTime();
        $fechaComparar = new DateTime($fecha);

        if ($fechaComparar < $fechaHoy) {
            $error = "CON ERRORES";
            $errores[] = "Debes introducir una fecha de alquiler valida";
        }
        //Si es correcta, calculamos la fecha de devolución 10 dias después
        else {
            $fechaComparar->modify('+10 days');
            $fecha = $fechaComparar->format('d-m-Y');
        }

        //VALIDACIONES DNI
        $numerosDni = intval($dni);
        $letraDni = strtoupper(substr($dni, -1));

        $letras = ["T", "R", "W", "A", "G", "M", "Y", "F", "P", "D", "X", "B", "N", "J", "Z", "S", "Q", "V", "H", "L", "C", "K", "E"];

        $letraDivision = $letras[$numerosDni % 23];
        if (strlen($dni) != 9) {
            $error = "CON ERRORES";
            $errores[] = "ERROR. El DNI debe tener ocho números y una letra";
        } elseif ($letraDni != $letraDivision) {
            $error = "CON ERRORES";
            $errores[] = "La letra del DNI no es correcta. Deberia ser la letra: " . $letraDivision;
        }

        //VALIDACION FECHA NACIMIENTO
        $fechaEdad = new DateTime($nacimiento);

        if ($fechaEdad->diff($fechaHoy)->y < 15) {
            $error = "CON ERRORES";
            $errores[] = "No tienes 15 años. No puedes alquilar un libro";
        }

    ?>
        <form name="input" action="index.php" method="post">
            <h2><?php echo $error ?></h2>
            <br />
        <?php
        if ($error == "CORRECTA") {
            echo "<p id='categ'>Nombre completo</p><p id='resul'>$nombre $apellido</p><br />";
            echo "<p id='categ'>DNI</p><p id='resul'>$dni</p><br />";
            echo "<p id='categ'>Fecha de devolución</p><p id='resul'>$fecha</p><br />";
        } else {
            foreach ($errores as $mensaje) {
                echo "<p style='color:white;'>$mensaje</p>";
            }
        }
    }
        ?>
        <br />
        <input type="submit" value="Volver" />
        </form>


</body>

</html>