<h4 class="fw-bold mb-4">

    <i class="bi bi-lightning-charge-fill text-warning me-2"></i>

    Actividad del Día

</h4>

<div class="row g-4 mb-5">

    {{-- Check In --}}
    <div class="col-lg-3">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body text-center">

                <div class="rounded-circle bg-success bg-opacity-10 d-inline-flex p-4 mb-3">

                    <i class="bi bi-box-arrow-in-right fs-2 text-success"></i>

                </div>

                <h1 class="fw-bold">

                    {{ $checkInHoy }}

                </h1>

                <p class="text-muted mb-0">

                    Check-In Hoy

                </p>

            </div>

        </div>

    </div>

    {{-- Check Out --}}
    <div class="col-lg-3">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body text-center">

                <div class="rounded-circle bg-danger bg-opacity-10 d-inline-flex p-4 mb-3">

                    <i class="bi bi-box-arrow-right fs-2 text-danger"></i>

                </div>

                <h1 class="fw-bold">

                    {{ $checkOutHoy }}

                </h1>

                <p class="text-muted mb-0">

                    Check-Out Hoy

                </p>

            </div>

        </div>

    </div>

    {{-- Reservas --}}
    <div class="col-lg-3">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body text-center">

                <div class="rounded-circle bg-primary bg-opacity-10 d-inline-flex p-4 mb-3">

                    <i class="bi bi-calendar-check fs-2 text-primary"></i>

                </div>

                <h1 class="fw-bold">

                    {{ $reservasHoy }}

                </h1>

                <p class="text-muted mb-0">

                    Reservas Hoy

                </p>

            </div>

        </div>

    </div>

    {{-- Ingresos Año --}}
    <div class="col-lg-3">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body text-center">

                <div class="rounded-circle bg-warning bg-opacity-10 d-inline-flex p-4 mb-3">

                    <i class="bi bi-graph-up-arrow fs-2 text-warning"></i>

                </div>

                <h4 class="fw-bold">

                    ${{ number_format($ingresosAnio,0,',','.') }}

                </h4>

                <p class="text-muted mb-0">

                    Ingreso del Año

                </p>

            </div>

        </div>

    </div>

</div>