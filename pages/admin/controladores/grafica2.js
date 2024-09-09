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
         // Función para generar un color aleatorio en formato RGBA
         function generarColorAleatorio() {
            const r = Math.floor(Math.random() * 256);
            const g = Math.floor(Math.random() * 256);
            const b = Math.floor(Math.random() * 256);
            return `rgba(${r}, ${g}, ${b}, 0.2)`; // Color de fondo
        }
        // Función para generar un color de borde
        function generarColorBorde(r, g, b) {
            return `rgba(${r}, ${g}, ${b}, 1)`; // Color de borde
        }
        // Generar colores dinámicamente para cada dato
        const backgroundColors = datos.map(() => generarColorAleatorio());
        const borderColors = backgroundColors.map(color => {
            const rgba = color.match(/\d+/g); // Extraer valores RGB
            return generarColorBorde(rgba[0], rgba[1], rgba[2]);
        });

        // Configuración de los datos para el gráfico
        const datosAtencion = {
            label: "Atención por Sede",
            data: datos,
            backgroundColor: backgroundColors,
            borderColor: borderColors,
            borderWidth: 3,
            maxBarThickness: 20,
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
