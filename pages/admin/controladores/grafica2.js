(async () => {
    try {
        // Obtener los datos del servidor
        const respuestaRaw = await fetch("controladores/datosOficina.php");
        const respuesta = await respuestaRaw.json();
        
        // Seleccionar todos los canvas con la clase 'grafica'
        const $grafica = document.querySelectorAll(".grafica1");

        // Extraer etiquetas y datos de la respuesta
        var etiquetas = respuesta.datos.map(item => item.nombreOficina);
        var datos = respuesta.datos.map(item => item.cantidadOficina);

        // Configuración de los datos para el gráfico
        const datosAtencion = {
            label: "Atención por Oficina",
            data: datos,
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 3,
            maxBarThickness: 25,
            minBarLength: 3,
        };

        // Crear gráficos para cada canvas
        $grafica.forEach(canvas => {
            const ctx = canvas.getContext('2d');
            new Chart(ctx, {
                type: 'bar', // Tipo de gráfico
                data: {
                    labels: etiquetas,
                    datasets: [datosAtencion],
                },
                options : {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true,
                            }
                        }]

                    },
                    plugins: {
                        legend: {
                            display: false,
                        }
                    }
                },
            });
        });
    } catch (error) {
        console.error('Error al obtener los datos o crear el gráfico:', error);
    }
})();
