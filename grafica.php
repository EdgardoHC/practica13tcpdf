<?php
require "includes/encabezado.php";
require "includes/utils.php";
$hidden = "hidden";
?>


<!-- Fila primer gráfico -->
<div id="divTabla" class="row py-2 small">
    <!-- Espacio izquierda -->
    <div class="col-md-1">
    </div>
    <div class="col-md-10">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    Clientes por cada país                   
                    <div id="spinnerUsuarios" class="spinner-border spinner-border-sm float-right" role="status">
                        <span class="sr-only">Cargando...</span>
                    </div>
                </h5>

            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-3">
                        <div id="tablaclientesporpais">

                        </div>
                    </div>
                    <div class="col-sm-9">
                        <div id="canvasPais" class="col-md-12">
                            <canvas id="graficoPais" style="display: block; width: 848px; height: 374px;" width="848" height="374"></canvas>
                        </div>
                    </div>
                </div> <!--  fin row -->
            </div><!--  fin car body -->
        </div><!--  fin card usuario activos -->

    </div>

    <!-- Espacio derecha -->
    <div class="col-md-1">
    </div>
</div>





<?php
require_once("includes/pie.php");
?>
<script src="js/grafica.js?version=1" type="text/javascript"></script>
<script src="js/utils.js" type="text/javascript"></script>

</body>

</html>
<!------------------------------------------------------------------------------>