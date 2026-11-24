@push('scripts')

<script>

document.addEventListener('DOMContentLoaded', () => {

    /*
    |--------------------------------------------------------------------------
    | Animación de contadores
    |--------------------------------------------------------------------------
    */

    document.querySelectorAll('.contador').forEach(contador => {

        let numero = 0;

        const objetivo = parseInt(contador.dataset.target) || 0;

        const incremento = Math.max(1, Math.ceil(objetivo / 60));

        const intervalo = setInterval(() => {

            numero += incremento;

            if(numero >= objetivo){

                numero = objetivo;

                clearInterval(intervalo);

            }

            contador.innerText = numero.toLocaleString();

        },20);

    });

    /*
    |--------------------------------------------------------------------------
    | Gráfico Estado Habitaciones
    |--------------------------------------------------------------------------
    */

    const habitaciones = document.getElementById('habitacionesChart');

    if(habitaciones){

        new Chart(habitaciones,{

            type:'doughnut',

            data:{

                labels:[
                    'Disponibles',
                    'Ocupadas',
                    'Reservadas',
                    'Mantenimiento'
                ],

                datasets:[{

                    data:[
                        {{ $disponibles }},
                        {{ $ocupadas }},
                        {{ $reservadas }},
                        {{ $mantenimiento }}
                    ],

                    backgroundColor:[
                        '#198754',
                        '#dc3545',
                        '#ffc107',
                        '#6c757d'
                    ],

                    borderWidth:0,

                    hoverOffset:15

                }]

            },

            options:{

                responsive:true,

                plugins:{

                    legend:{
                        position:'bottom'
                    }

                },

                cutout:'70%'

            }

        });

    }

    /*
    |--------------------------------------------------------------------------
    | Gráfico Ingresos
    |--------------------------------------------------------------------------
    */

    const ingresos = document.getElementById('ingresosChart');

    if(ingresos){

        new Chart(ingresos,{

            type:'line',

            data:{

                labels:[

                    'Ene',
                    'Feb',
                    'Mar',
                    'Abr',
                    'May',
                    'Jun',
                    'Jul',
                    'Ago',
                    'Sep',
                    'Oct',
                    'Nov',
                    'Dic'

                ],

                datasets:[{

                    label:'Ingresos',

                    data:[

                        1200000,
                        1800000,
                        1500000,
                        2400000,
                        2100000,
                        3200000,
                        2800000,
                        3500000,
                        3100000,
                        2700000,
                        3900000,
                        {{ $ingresosMes }}

                    ],

                    borderColor:'#198754',

                    backgroundColor:'rgba(25,135,84,.15)',

                    fill:true,

                    tension:.35,

                    pointRadius:5,

                    pointHoverRadius:8

                }]

            },

            options:{

                responsive:true,

                plugins:{

                    legend:{
                        display:false
                    }

                },

                scales:{

                    y:{

                        beginAtZero:true,

                        ticks:{

                            callback:function(value){

                                return '$'+value.toLocaleString();

                            }

                        }

                    }

                }

            }

        });

    }

});

</script>

@endpush