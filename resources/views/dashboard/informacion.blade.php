<div class="card border-0 shadow">

    <div class="card-header bg-white">

        <h5 class="mb-0">

            <i class="bi bi-info-circle-fill text-info me-2"></i>

            Información del Sistema

        </h5>

    </div>

    <div class="card-body">

        <div class="row">

            <div class="col-md-6">

                <table class="table table-borderless">

                    <tr>

                        <td><strong>Hotel</strong></td>

                        <td>Central La Italia</td>

                    </tr>

                    <tr>

                        <td><strong>Usuario</strong></td>

                        <td>{{ Auth::user()->nombre }}</td>

                    </tr>

                    <tr>

                        <td><strong>Laravel</strong></td>

                        <td>{{ app()->version() }}</td>

                    </tr>

                </table>

            </div>

            <div class="col-md-6">

                <table class="table table-borderless">

                    <tr>

                        <td><strong>PHP</strong></td>

                        <td>{{ PHP_VERSION }}</td>

                    </tr>

                    <tr>

                        <td><strong>Reservas del mes</strong></td>

                        <td>{{ $reservasMes }}</td>

                    </tr>

                    <tr>

                        <td><strong>Estado</strong></td>

                        <td>

                            <span class="badge bg-success">

                                Operativo

                            </span>

                        </td>

                    </tr>

                </table>

            </div>

        </div>

    </div>

</div>