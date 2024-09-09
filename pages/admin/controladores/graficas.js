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

        // Definir colores para cada barra
        const colores = [
            'rgba(111, 99, 132, 0.2)', // Color para el primer dato
            'rgba(54, 162, 235, 0.2)', // Color para el segundo dato
            'rgba(255, 206, 86, 0.2)', // Color para el tercer dato
            'rgba(75, 192, 192, 0.2)', // Color para el cuarto dato
            'rgba(153, 102, 255, 0.2)', // Color para el quinto dato
            'rgba(255, 159, 64, 0.2)'  // Color para el sexto dato
        ];

        // Crear un array de colores para cada barra
        const backgroundColors = colores.map((color, index) => {
            return color; // Asignar el color correspondiente
        });

        // Configuración de los datos para el gráfico
        const datosAtencion = {
            label: "Atención por tipo de problema",
            data: datos,
            backgroundColor: backgroundColors, // Asignar colores específicos
            borderColor: backgroundColors.map(color => color.replace('0.2', '1')), // Cambiar la opacidad para el borde
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