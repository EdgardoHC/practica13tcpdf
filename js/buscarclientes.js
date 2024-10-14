$(document).ready(function () {

//Gestión de cookies
//--------------------------------------------------------------------------------------------------------------
    $("#spinnerEsperaAplicar").hide();
    //pais
    if (checkCookie("pais")) {
        $("#pais").val((getCookie("pais")));
    }
//--------------------------------------------------------------------------------------------------------------


    $("#divTabla").show();

    $("#btnAplicar").click(function () {
//Obtener valores de los parámetros:
        let pais = $("#pais").val().trim();

//Si el campo de búsqueda está vacío
        if (pais == "") {
            //  console.log("entró: " + pais);
            swal({
                title: 'Campo obligatorio',
                text: 'Por favor, complete el campo',
                type: 'warning',
                confirmButtonText: "Cerrar"
            });
            return;

        }
//setee la cookie       
        setCookie("pais", pais, 1);

//Llame la búsqueda del cliente:
          cargarClientes(pais);
    });


});

// your custom ajax request here

function cargarClientes(pais) {

    $("#spinnerEsperaAplicar").show();
    //$("#btnAplicar").attr('disabled', 'disabled');

    var data = {
        "pais": pais
    };

    $.ajax({
        type: 'post',
        data: data,
        url: "includes/procesarbuscarclientes.php"
    })
            .done(function (msg) {
                $("#spinnerEsperaAplicar").hide();
        //depurar
                //   console.log(msg);
                //Mediante siguiente funcion indicamos a bootstap table que cargue los datos obtenidos por la peticion ajax
                //datos es un arreglo en formato json
                $("#tablaClientes").bootstrapTable("load", msg.datos);

            })
            .fail(function (jqXHR, textStatus, error) {
                console.log("Post error: " + error);

            });
}

function operateFormatter(value, row, index) {
    return [
        '<a class="btn btn-primary btn-sm btnReducido seleccionar" role="button" href="gestion_de_cuenta.php?icl=' + row.unicodespacho + '&ncg=' + row.numeroUnicoCuscatlan + '" title="Gestionar esta cuenta">',
        'Seleccionar',
        '</a>  ',
    ].join('')
}
//Este evento viene unido con la funcion operateFormatter de bootstrap table
window.operateEvents = {
    'click .seleccionar': function (e, value, row, index) {
        // $("#no").val(row.no);
        // $("#usuario").val(row.usuario);
        //$("#chkTodos").prop("checked", false);
        //validar(true);
        // obtenerRoles($("#no").val(), $("#selModulo").val());
    }

}
