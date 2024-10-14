<?php
require "includes/encabezado.php";
require "includes/utils.php";
$hidden = "hidden";
?>

<div class="container-fluid">
    <h3><a href="index.php" title="Inicio del módulo" aria-label="Regresar"><i class="fas fa-chevron-circle-left"></i></a>Buscar</h3>
    <?php
//    require './includes_mantenimiento/pills_mant.php';
    ?>
    <hr>
    <div class="row">
        <!--<div class="col-sm-1">
        
                        </div>-->
        <div class="col-sm-12">
            <br>    

            <div class="col-md-1">
            </div>
            <div class="col-md-10">

            </div>
            <div class="col-md-1">
            </div>           
            <div class="d-flex">
                <div id="parametros" class="form-inline" role="form">           
                    <div class="form-group px-1">
                        <span>Búsqueda:<span class="text-danger">*</span>
                            <select id="pais" class="form-control w70">
                                <?php
                                foreach ($arrPais as $pais) {
                                    echo "<option value=\"$pais\">$pais</option>\n";
                                }
                                ?>
                            </select>
                    </div>
                    <button class="btn btn-primary btn-sm" id="btnAplicar">Aplicar</button>
                    <div id="spinnerEsperaAplicar" class="spinner-border spinner-border-sm" role="status">
                        <span class="sr-only">Cargando...</span>
                    </div>
                </div>
               
            </div>
            <div id="divTabla" style="display: none">
                <div class="table-responsive">
                    <br>
                    <table id="tablaClientes" data-toggle="table" data-search="true" data-pagination="true" data-page-size="10" class="table-sm small table-striped small font-diez" data-cookie="true" data-cookie-id-table="saveId" style="width:100%">
                        <thead>
                            <tr>  
                                <th data-field="custId" >ID</th> 
                                <th data-field="companyName">Nombre</th> 
                                <th data-field="contactName">Contacto</th> 
                                <th data-field="address" >Dirección</th> 
                                <th data-field="operate" data-formatter="operateFormatter" data-events="operateEvents"  style="width: 20%;">ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--        <div class="col-sm-1">
        
                </div>-->
    </div>
</div>

<?php
require_once("includes/pie.php");
?>
<script src="js/buscarclientes.js?version=1" type="text/javascript"></script>
<script src="js/utils.js" type="text/javascript"></script>

</body>

</html>