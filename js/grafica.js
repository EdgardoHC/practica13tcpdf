$(function () {
    $.ajax({
        method: "POST",
        url: "includes/procesargraficaclientesporpais.php",
//            data: {param:param  }
    })
            .done(function (msg) {
             //  console.log(msg);
                //$("#datosGrupos").html("");
                var ejeX = [];
                var ejeY = [];
                for (var i in msg.datos) {
                    ejeX.push(msg.datos[i].country);
                    ejeY.push(msg.datos[i].conteo);
                }
                console.log(ejeX)
                mostrarGraficoBarra(ejeX, ejeY, "graficoPais", "canvasPais");

            });

    function mostrarGraficoBarra(x, y, selector, canvasSelector) {
        $('#' + selector).remove();
        $('#' + canvasSelector).append('<canvas id="' + selector + '" class="canvasChart"><canvas>'); // This would create new canvas element every time and removes the older one.
        var myChart = new Chart(selector, {
            type: 'bar',
            data: {
                labels: x,
                datasets: [{
                        label: 'Clientes por pais',
                        data: y,
                        fill: false,
                        backgroundColor: "rgb(255, 179, 179)",
                        borderColor: "rgb(255, 0, 0)",
                        // backgroundColor: [
                        //     'rgba(255, 99, 132, 0.2)',
                        //     'rgba(54, 162, 235, 0.2)',
                        //     'rgba(255, 206, 86, 0.2)',
                        //     'rgba(75, 192, 192, 0.2)',
                        //     'rgba(153, 102, 255, 0.2)',
                        //     'rgba(255, 159, 64, 0.2)'
                        // ],
                        // borderColor: [
                        //     'rgba(255, 99, 132, 1)',
                        //     'rgba(54, 162, 235, 1)',
                        //     'rgba(255, 206, 86, 1)',
                        //     'rgba(75, 192, 192, 1)',
                        //     'rgba(153, 102, 255, 1)',
                        //     'rgba(255, 159, 64, 1)'
                        // ],
                        borderWidth: 1
                    }]
            },

            options: {
                responsive: true,
                title: {
                    display: true,
                    text: ''
                },
                tooltips: {
                    mode: 'index',
                    intersect: false,
                },
                hover: {
                    mode: 'nearest',
                    intersect: true
                },
                scales: {
                    xAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: 'País'
                            }
                        }],
                    yAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: 'Clientes'
                            },
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                }
            },

        });
    }

});