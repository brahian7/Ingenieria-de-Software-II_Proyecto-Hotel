<div class="row g-4 mb-5">

    {{-- Ocupación --}}
    <div class="col-md-6 col-xl-3">

        <div class="card border-0 shadow h-100">

            <div class="card-body">

                <div class="d-flex justify-content-between">

                    <div>

                        <small class="text-muted text-uppercase">

                            Ocupación

                        </small>

                        <h2 class="fw-bold text-primary">

                            {{ $ocupacion }}%

                        </h2>

                        <small class="text-success">

                            <i class="bi bi-arrow-up"></i>

                            Habitaciones ocupadas

                        </small>

                    </div>

                    <div class="bg-primary bg-opacity-10 rounded-circle p-3">

                        <i class="bi bi-building text-primary fs-2"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- Ingreso mensual --}}

    <div class="col-md-6 col-xl-3">

        <div class="card border-0 shadow h-100">

            <div class="card-body">

                <div class="d-flex justify-content-between">

                    <div>

                        <small class="text-muted text-uppercase">

                            Ingreso del mes

                        </small>

                        <h2 class="fw-bold text-success">

                            ${{ number_format($ingresosMes,0,',','.') }}

                        </h2>

                        <small class="text-success">

                            <i class="bi bi-cash-stack"></i>

                            Mes actual

                        </small>

                    </div>

                    <div class="bg-success bg-opacity-10 rounded-circle p-3">

                        <i class="bi bi-currency-dollar text-success fs-2"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- Check-In --}}

    <div class="col-md-6 col-xl-3">

        <div class="card border-0 shadow h-100">

            <div class="card-body">

                <div class="d-flex justify-content-between">

                    <div>

                        <small class="text-muted text-uppercase">

                            Check-In Hoy

                        </small>

                        <h2 class="fw-bold text-warning">

                            {{ $checkInHoy }}

                        </h2>

                        <small class="text-muted">

                            Entradas programadas

                        </small>

                    </div>

                    <div class="bg-warning bg-opacity-10 rounded-circle p-3">

                        <i class="bi bi-box-arrow-in-right text-warning fs-2"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- Check-Out --}}

    <div class="col-md-6 col-xl-3">

        <div class="card border-0 shadow h-100">

            <div class="card-body">

                <div class="d-flex justify-content-between">

                    <div>

                        <small class="text-muted text-uppercase">

                            Check-Out Hoy

                        </small>

                        <h2 class="fw-bold text-danger">

                            {{ $checkOutHoy }}

                        </h2>

                        <small class="text-muted">

                            Salidas programadas

                        </small>

                    </div>

                    <div class="bg-danger bg-opacity-10 rounded-circle p-3">

                        <i class="bi bi-box-arrow-right text-danger fs-2"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>