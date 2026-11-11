document.addEventListener('DOMContentLoaded', () => {

    /*
    =====================================
    CONTADORES
    =====================================
    */

    const contadores = document.querySelectorAll('.contador');

    contadores.forEach(contador => {

        const objetivo = parseInt(contador.dataset.target);

        let valor = 0;

        const incremento = Math.ceil(objetivo / 50);

        const animar = () => {

            valor += incremento;

            if (valor >= objetivo) {

                contador.innerText = objetivo;

                return;

            }

            contador.innerText = valor;

            requestAnimationFrame(animar);

        };

        animar();

    });


    /*
    =====================================
    GRÁFICO
    =====================================
    */

    const canvas = document.getElementById('graficoHabitaciones');

    if (canvas) {

        new Chart(canvas, {

            type: 'doughnut',

            data: {

                labels: [

                    'Disponibles',

                    'Ocupadas',

                    'Reservadas',

                    'Mantenimiento'

                ],

                datasets: [{

                    data: [

                        Number(canvas.dataset.disponibles),

                        Number(canvas.dataset.ocupadas),

                        Number(canvas.dataset.reservadas),

                        Number(canvas.dataset.mantenimiento)

                    ],

                    backgroundColor: [

                        '#198754',

                        '#dc3545',

                        '#ffc107',

                        '#6c757d'

                    ],

                    borderWidth: 0

                }]

            },

            options: {

                responsive: true,

                plugins: {

                    legend: {

                        position: 'bottom'

                    }

                }

            }

        });

    }

});