<html lang="es">
    <head>
        <title>SGIMA</title>
    </head>
    <style>
        <?php include 'style/estilo.css' ?>

        .contenedor{
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 15%;
        }
        .hijo {
            background: #525252;
            width: 600px;
            border-style: solid;
            font-family: Arial, Helvetica, sans-serif;
            border-color: black;
            color: white;
            font-size: 20px;
        }

        p {
            font-family: Arial, Helvetica, sans-serif;
            text-align: center;
            font-size: 30px;
            color: white;
        }

        a {
            color: orange;
        }
    </style>
    <nav>
        Itaú - Sistema de gestión IMA
    </nav>
    <div class="contenedor">
        <div class="hijo" style="text-align: center;">
            <p>Error: Acceso Denegado</p>
            Contactar con <a href="mailto:richard.cabrera@itau.com.py">richard.cabrera@itau.com.py</a> para acceder
            <p></p>
            ID Equipo: <?php echo gethostbyaddr($_SERVER['REMOTE_ADDR']) ?>
            <p></p>
        </div>
    </div>
</html>