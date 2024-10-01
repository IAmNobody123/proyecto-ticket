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
            'rgba(111, 99, 132, 1)', // Color para el primer dato
            'rgba(54, 162, 235, 1)', // Color para el segundo dato
            'rgba(255, 206, 86, 1)', // Color para el tercer dato
            'rgba(75, 192, 192, 1)', // Color para el cuarto dato
            'rgba(153, 102, 255, 1)', // Color para el quinto dato
            'rgba(255, 159, 64, 1)'   // Color para el sexto dato
        ];

        // Crear un array de colores para cada barra
        const backgroundColors = colores.map((color, index) => {
            return color; // Asignar el color correspondiente
        });
        function darkenColor(color, factor = 0.2) {
            // Extraer los valores RGBA
            const rgba = color.match(/[\d.]+/g).map(Number);
            // Reducir los valores RGB
            const darkened = rgba.slice(0, 3).map(value => Math.max(0, value - (value * factor)));
            // Retornar el nuevo color RGBA
            return `rgba(${darkened[0]}, ${darkened[1]}, ${darkened[2]}, ${rgba[3]})`;
        }

        // Configuración de los datos para el gráfico
        const datosAtencion = {
            label: "Atención por tipo de problema",
            data: datos,
            backgroundColor: backgroundColors, // Asignar colores específicos
            borderColor: 'rgba(0, 0, 0, 1)', // Oscurecer el borde
            borderWidth: 1.5,
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