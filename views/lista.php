<?php
    require_once 'libs/model.php';
    require_once 'config/config.php';
    $model = new Model();
    $query = "SELECT * FROM TABLA_REPORTES WHERE ESTADO <> 'FINALIZADO' AND USUARIO_CREACION = '" . constant('CONECTADO') . "'";
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
        <?php include 'style/estilo.css' ?>
    </style>

    <nav>
        <script>
            function crear_pro2(){
                window.location.href = "./history.php";
            };
        </script>
        <!--<img src="img/logo.png" width="32" height="32"/>-->
        Itaú - Sistema de gestión IMA
        <a style="position:absolute;  left: 85%">USUARIO: <?php echo constant('CONECTADO')?></a>

        <a class="boton" style="color: yellow" href="#" data-bs-toggle="modal" data-bs-target="#myModal3">CREAR NUEVO</a>

        <a class="boton" style="color: yellow; left: 30%;" href="#" onclick="crear_pro2();return false;">VER HISTORIAL</a>
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
                    <!--<th scope="col">ENTREGA</th>-->
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($result as $value){ ?>
                    <tr id=<?php echo $value['ID']; ?>>
                        <td><?php echo $value['FECHA']->format('Y-m-d'); ?></td>
                        <td><?php echo $value['SOLICITANTE']; ?></td>
                        <td><?php echo $value['ASUNTO']; ?></td>
                        <td><?php echo $value['ESTADO']; ?></td>
                        <td><?php echo $value['DIFICULTAD']; ?></td>
                        <td><?php
                                if (is_null($value['TIEMPO_ESTIMADO'])){
                                    echo "";
                                }else{
                                    echo $value['TIEMPO_ESTIMADO'] -> format('Y-m-d');
                                    //echo date_format($value['TIEMPO_ESTIMADO'], "d-m-Y");
                                   
                                }
                            ?>
                        </td>
                        <td></td>
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
                    },
                    columns:[
                        {a: "a"},
                        {b: "b"},
                        {c: "c"},
                        {d: "d"},
                        {e: "e"},
                        {f: "f"},
                        {
                            title: 'Controles',
                            orderable: false,
                            searchable: false,
                            wrap: true, 
                            render: function (data, type, row) {
                                ed = '<button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#myModal">Editar</button>';
                                el = '<button type="button" class="btn btn-danger">Eliminar</button>';
                                es = '<button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#myModal2">Estado</button>'; 

                                return ed + es + el;
                            }
                        }
                    ]
                });
            });

            $(document).ready(function(){
                $(".btn-warning").click(function(){
                    var valor1 = $(this).parents("tr").find("td").eq(1).html();
                    var valor2 = $(this).parents("tr").find("td").eq(2).html();
                    var valor4 = $(this).parents("tr").find("td").eq(4).html();
                    var valor5 = $(this).parents("tr").find("td").eq(5).html();

                    var id_us = $(this).parents("tr")[0].id;

                    document.getElementById("solicitante").value = valor1;
                    document.getElementById("asunto").value = valor2;

                    if(valor4 == 'BAJA'){
                        document.getElementById("inputGroupSelect01").selectedIndex = 1;
                    }else{
                        if(valor4 == 'MEDIA'){
                            document.getElementById("inputGroupSelect01").selectedIndex = 2;
                        }else{
                            document.getElementById("inputGroupSelect01").selectedIndex = 3;
                        }
                    }
                    
                    document.getElementById("estimado").value = valor5.trim();
                    document.getElementById("id_us").value = id_us;
                });
            });

            $(document).ready(function(){
                $(".btn-info").click(function(){
                    var valor = $(this).parents("tr").find("td").eq(3).html();
                    var ac = $(this).parents("tr")[0].id

                    if(valor == 'FINALIZADO'){
                        document.getElementById("inputGroupSelect02").selectedIndex = 1;
                    } else if (valor == 'PENDIENTE'){
                        document.getElementById("inputGroupSelect02").selectedIndex = 2;
                    } else if( valor == 'CANCELADO'){
                        document.getElementById("inputGroupSelect02").selectedIndex = 3;
                    } else {
                        document.getElementById("inputGroupSelect02").selectedIndex = 4;
                    }

                    document.getElementById('act').value = ac;
                });
            });

            $(document).ready(function(){
                $(".btn-danger").click(function(){
                    var valor = $(this).parents("tr").find("td").eq(2).html();
                    var id_us = $(this).parents("tr")[0].id
                    swal( 
                        {
                            title: "Eliminar",
                            text: "¿Desea realmente eliminar " + "\"" + valor + "\"?",
                            icon :'warning',                                                       
                            dangerMode: true,
                            buttons: true
                        }
                        ).then(okay => { 
                            if (okay) {
                                const form = document.createElement('form');
                                form.method = "POST";
                                form.action = "./views/eliminar.php";

                                const hiddenField = document.createElement('input');
                                hiddenField.type = 'hidden';
                                hiddenField.name = 'id';
                                hiddenField.value = id_us;

                                form.appendChild(hiddenField);
                                document.body.appendChild(form);
                                form.submit();
                            }
                        });
                    });
                });
        </script>
    </div>

    <!-- The Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Modificar pedido de Reporte</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="./views/obtener.php" method="POST" autocomplete="off">
                    <input style="display: none;" name="id_us" id="id_us">
                <!-- Modal body -->
                    <div class="modal-body">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default">Nombre del solicitante</span>
                            </div>
                            <input type="text" id="solicitante" name="solicitante" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" required>
                        </div>
                        
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default">Asunto</span>
                            </div>
                            <input type="text" id="asunto" name="asunto" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" required>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">Nivel dificultad reporte</label>
                            </div>
                            <select class="custom-select" id="inputGroupSelect01" name="dificultad">
                                <option selected disabled="disabled">Elige una opción</option>
                                <option value="1">BAJA</option>
                                <option value="2">MEDIA</option>
                                <option value="3">ALTA</option>
                            </select>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">Fecha estimada de envio</label>
                            </div>
                            <input class="entrada" id="estimado" name="estimado" type="date" min=<?php date_default_timezone_set('America/Asuncion'); echo date("Y-m-d");?>>
                        </div>
                    </div>
                
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Modificar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal" id="myModal2">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Modificar Estado del Reporte</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="./views/modificar.php" method="POST" autocomplete="off">
                    <input style="display: none;" name="act" id="act">
                <!-- Modal body -->
                    <div class="modal-body">
                    <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect02">ESTADO DEL REPORTE</label>
                            </div>
                            <select class="custom-select" id="inputGroupSelect02" name="estado">
                                <option selected disabled="disabled">Elige una opción</option>
                                <option value="1">FINALIZADO</option>
                                <option value="2">PENDIENTE</option>
                                <option value="3">CANCELADO</option>
                                <option value="4">EN PAUSA</option>
                            </select>
                        </div>
                    </div>
                
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Modificar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--CREAR HISTORIA -->
    <div class="modal" id="myModal3">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Registrar pedido</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="./views/registrar.php" method="POST" autocomplete="off">
                <!-- Modal body -->
                    <div class="modal-body">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default">Nombre del solicitante</span>
                            </div>
                            <input type="text" id="solicitante" name="solicitante" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" required>
                        </div>
                        
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default">Asunto</span>
                            </div>
                            <input type="text" id="asunto" name="asunto" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" required>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend" style="width: 40.3%;">
                                <label class="input-group-text" for="inputGroupSelect05">Tipo</label>
                            </div>
                            <select class="custom-select" id="inputGroupSelect05" name="tipo">
                                <option disabled="disabled">Elige una opción</option>
                                <option selected value="REPORTE">REPORTE</option>
                                <option value="AUTOMATIZACION">AUTOMATIZACION</option>
                            </select>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">Nivel dificultad reporte</label>
                            </div>
                            <select class="custom-select" id="inputGroupSelect01" name="dificultad">
                                <option disabled="disabled">Elige una opción</option>
                                <option select value="BAJA">BAJA</option>
                                <option value="MEDIA">MEDIA</option>
                                <option value="ALTA">ALTA</option>
                            </select>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">Fecha estimada de envio</label>
                            </div>
                            <input class="entrada" id="estimado" name="estimado" type="date" min=<?php date_default_timezone_set('America/Asuncion'); echo date("Y-m-d");?>>
                        </div>
                    </div>
                
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</html> 