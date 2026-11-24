import Alpine from 'alpinejs';
import Swal from 'sweetalert2';
import Chart from 'chart.js/auto';
import AOS from 'aos';

import 'aos/dist/aos.css';

// Dashboard
import './dashboard/dashboard';

// Alertas SweetAlert
import './alerts';

window.Alpine = Alpine;
window.Swal = Swal;
window.Chart = Chart;

Alpine.start();

AOS.init({

    duration: 700,

    once: true

});


/* 
   modulo de reservas
 */

document.addEventListener('DOMContentLoaded', () => {

    const habitacion = document.getElementById('habitacion');

    if (!habitacion) return;

    const numero = document.getElementById('numeroHabitacion');
    const tipo = document.getElementById('tipoHabitacion');
    const capacidad = document.getElementById('capacidadHabitacion');
    const precio = document.getElementById('precioHabitacion');
    const estado = document.getElementById('estadoHabitacion');

    const personas = document.getElementById('cantidadPersonas');

    const ingreso = document.getElementById('fechaIngreso');
    const salida = document.getElementById('fechaSalida');

    const noches = document.getElementById('cantidadNoches');
    const precioResumen = document.getElementById('precioResumen');
    const total = document.getElementById('totalReserva');

    function formatoPesos(valor) {

        return Number(valor).toLocaleString('es-CO');

    }

    function actualizarHabitacion() {

        const opcion = habitacion.options[habitacion.selectedIndex];

        if (!opcion.value) {

            numero.textContent = "-";
            tipo.textContent = "-";
            capacidad.textContent = "-";
            precio.textContent = "0";
            estado.textContent = "-";

            personas.innerHTML = '<option value="">Seleccione</option>';

            calcular();

            return;

        }

        numero.textContent = opcion.dataset.numero;

        tipo.textContent = opcion.dataset.tipo;

        capacidad.textContent = opcion.dataset.capacidad + " personas";

        precio.textContent = formatoPesos(opcion.dataset.precio);

        estado.textContent = opcion.dataset.estado;

        personas.innerHTML = '<option value="">Seleccione</option>';

        for (let i = 1; i <= Number(opcion.dataset.capacidad); i++) {

            personas.innerHTML += `<option value="${i}">${i}</option>`;

        }

        calcular();

    }

    function calcular() {

        const opcion = habitacion.options[habitacion.selectedIndex];

        if (!opcion.value) {

            noches.textContent = "0";
            precioResumen.textContent = "$0";
            total.textContent = "$0";

            return;

        }

        if (!ingreso.value || !salida.value) {

            noches.textContent = "0";

            precioResumen.textContent =
                "$ " + formatoPesos(opcion.dataset.precio);

            total.textContent = "$0";

            return;

        }

        const fechaIngreso = new Date(ingreso.value);
        const fechaSalida = new Date(salida.value);

        const diferencia =
            (fechaSalida - fechaIngreso) / (1000 * 60 * 60 * 24);

        if (diferencia <= 0) {

            noches.textContent = "0";
            total.textContent = "$0";

            return;

        }

        noches.textContent = diferencia;

        const precioNoche = Number(opcion.dataset.precio);

        precioResumen.textContent =
            "$ " + formatoPesos(precioNoche);

        total.textContent =
            "$ " + formatoPesos(precioNoche * diferencia);

    }

    habitacion.addEventListener('change', actualizarHabitacion);

    ingreso.addEventListener('change', calcular);

    salida.addEventListener('change', calcular);

    actualizarHabitacion();

});