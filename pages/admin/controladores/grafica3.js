(async () => {
    try {
        // Obtener los datos del servidor
        const respuestaRaw = await fetch("controladores/sedeCantidad.php");
        const respuesta = await respuestaRaw.json();
        
        // Seleccionar todos los canvas con la clase 'grafica'
        const $grafica = document.querySelectorAll(".grafica2");

        // Extraer etiquetas y datos de la respuesta
        var nombres = respuesta.datos.map(item => item.nombreSede);
        var oficinas = respuesta.datos.map(item => item.cantidad);

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
        const backgroundColors = oficinas.map(() => generarColorAleatorio());
        const borderColors = backgroundColors.map(color => {
            const rgba = color.match(/\d+/g); // Extraer valores RGB
            return generarColorBorde(rgba[0], rgba[1], rgba[2]);
        });

        // Configuración de los datos para el gráfico
        const datosAtencion = {
            label: "Atención por Sede",
            data: oficinas,
            backgroundColor: backgroundColors,
            borderColor: borderColors,
            borderWidth: 3,
            maxBarThickness: 25,
            minBarLength: 3,
        };
        // Crear gráficos para cada canvas
        $grafica.forEach(canvas => {
            const ctx = canvas.getContext('2d');
            new Chart(ctx, {
                type: 'doughnut', // Tipo de gráfico
                data: {
                    labels: nombres,
                    datasets: [datosAtencion],
                },
                options : {
                    plugins: {
                        legend: {
                            display: false,
                            title:{
                                    text:"hola"
                            }
                        }
                    }
                },
            });
        });
    } catch (error) {
        console.error('Error al obtener los datos o crear el gráfico:', error);
    }
})();
