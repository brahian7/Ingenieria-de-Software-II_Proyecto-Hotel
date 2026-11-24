document.addEventListener('DOMContentLoaded', () => {

    const formularios = document.querySelectorAll('.formulario-eliminar');

    formularios.forEach(formulario => {

        formulario.addEventListener('submit', function (e) {

            e.preventDefault();

            Swal.fire({

                title: '¿Está seguro?',

                text: 'Esta acción eliminará el registro permanentemente.',

                icon: 'warning',

                showCancelButton: true,

                confirmButtonColor: '#dc3545',

                cancelButtonColor: '#6c757d',

                confirmButtonText: 'Sí, eliminar',

                cancelButtonText: 'Cancelar'

            }).then((result) => {

                if (result.isConfirmed) {

                    formulario.submit();

                }

            });

        });

    });

});