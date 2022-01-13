<?php
    require_once './libs/model.php';
    require_once './config/config.php';
    $model = new Model();
    $query = "SELECT * FROM TABLA_REPORTES WHERE ESTADO = 'FINALIZADO' AND USUARIO_CREACION = '" . constant('CONECTADO') . "'";
    $result = $model -> query($query); 
?>
<html lang="es">
    <head>
        <title>REPORTES</title>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <!--DATATABLE-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.dataTables.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    </head>

    <style>
        <?php include './views/style/estilo.css' ?>
    </style>

    <nav>
        <script>
            function crear_pro(){
                window.location.href = "./";
            };
        </script>
        <!--<img src="img/logo.png" width="32" height="32"/>-->
        Itaú - Sistema de gestión IMA
        <a style="position:absolute;  left: 85%">USUARIO: <?php echo constant('CONECTADO')?></a>

        <a class="boton" style="color: yellow" href="#" onclick="crear_pro();return false;">INICIO</a>
    </nav>
    <div>
        <!--DATATABLE JAVASCRIPT-->
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>

        <table id="tabla" class="table table-bordered table-striped table-hover" style="text-align: center; width:100%;">
            <thead>
                <tr>
                    <th scope="col">FECHA</th>
                    <th scope="col">SOLICITANTE</th>
                    <th scope="col">ASUNTO</th>
                    <th scope="col">ESTADO</th>
                    <th scope="col">DIFICULTAD</th>
                    <th scope="col">TIEMPO ESTIMADO</th>
                    <th scope="col">ENTREGA</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($result as $value){ ?>
                    <tr id=<?php echo $value['ID']; ?>>
                        <td><?php echo $value['FECHA']->format('d/m/Y'); ?></td>
                        <td><?php echo $value['SOLICITANTE']; ?></td>
                        <td><?php echo $value['ASUNTO']; ?></td>
                        <td><?php echo $value['ESTADO']; ?></td>
                        <td><?php echo $value['DIFICULTAD']; ?></td>
                        <td><?php
                                if (is_null($value['TIEMPO_ESTIMADO'])){
                                    echo "";
                                }else{
                                    echo $value['TIEMPO_ESTIMADO'] -> format('d/m/Y');
                                   
                                }
                            ?>
                        </td>
                        <td><?php
                                if (is_null($value['ENTREGA'])){
                                    echo "";
                                }else{
                                    echo $value['ENTREGA'] -> format('d/m/Y');
                                   
                                }
                            ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <script>
            $(document).ready(function() {
                $('#tabla').DataTable({
                    pageLength: 10,
                    bFilter: true,
                    language: {
                        url: "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
                    }
                });
            });
        </script>
    </div>
</html> 