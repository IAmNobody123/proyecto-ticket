(async () => {
    try {
        // Obtener los datos del servidor
        const respuestaRaw = await fetch("controladores/datos.php");
        const respuesta = await respuestaRaw.json();
        
        // Seleccionar todos los canvas con la clase 'grafica'
        const $grafica = document.querySelectorAll(".grafica");

        // Extraer etiquetas y datos de la respuesta
        var etiquetas = respuesta.datos.map(item => item.nombreProblema);
        var datos = respuesta.datos.map(item => item.cantidad);

        // Configuración de los datos para el gráfico
        const datosAtencion = {
            label: "Atención por tipo de problema",
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
