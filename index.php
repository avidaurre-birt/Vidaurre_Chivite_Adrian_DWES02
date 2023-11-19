<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "
http://www.w3.org/TR/html4/loose.dtd">

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Ficha alquier</title>
    <style>
        body {
            background-color: blue;
        }

        input {
            height: 20px;
            width: 250px;
        }
    </style>
</head>

<body>
    <form name="input" action="procesa.php" method="post">
        <p style=color:white>Nombre </p><input type="text" name="Nombre" /><br />
        <p style=color:white>Apellido </p> <input type="text" name="Apellido" /><br />
        <p style=color:white>Fecha de nacimiento </p> <input type="date" name="Fecha_nacimiento" /><br />
        <p style=color:white>Libro </p><input type="text" name="Libro" /><br />
        <p style=color:white>Email </p><input type="text" name="Mail" /><br />
        <p style=color:white>Fecha Alquiler </p><input type="date" name="Fecha_alquiler" /><br />
        <p style=color:white>DNI </p><input type="text" name="DNI" /><br />

        <br />
        <input type="submit" value="Enviar" />
    </form>
</body>

</html>