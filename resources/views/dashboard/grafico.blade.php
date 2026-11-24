<div class="row g-4 mb-5">

    {{-- Gráfico de ingresos --}}
    <div class="col-lg-8">

        <div class="card border-0 shadow h-100">

            <div class="card-header bg-white border-0 py-3">

                <h5 class="fw-bold mb-0">

                    <i class="bi bi-graph-up-arrow text-success me-2"></i>

                    Ingresos de los últimos 12 meses

                </h5>

                <small class="text-muted">

                    Evolución de los ingresos del hotel

                </small>

            </div>

            <div class="card-body">

                <canvas id="ingresosChart" height="110"></canvas>

            </div>

        </div>

    </div>

    {{-- Estado habitaciones --}}
    <div class="col-lg-4">

        <div class="card border-0 shadow h-100">

            <div class="card-header bg-white border-0 py-3">

                <h5 class="fw-bold mb-0">

                    <i class="bi bi-pie-chart-fill text-primary me-2"></i>

                    Estado de habitaciones

                </h5>

                <small class="text-muted">

                    Distribución actual

                </small>

            </div>

            <div class="card-body d-flex align-items-center">

                <canvas id="habitacionesChart"></canvas>

            </div>

        </div>

    </div>

</div>