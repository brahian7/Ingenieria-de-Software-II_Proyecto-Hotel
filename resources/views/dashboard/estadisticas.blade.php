<style>

.dashboard-card{

    border:none;
    border-radius:20px;
    transition:.35s;
    overflow:hidden;

}

.dashboard-card:hover{

    transform:translateY(-6px);
    box-shadow:0 18px 35px rgba(0,0,0,.12);

}

.dashboard-icon{

    width:78px;
    height:78px;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:34px;

}

.dashboard-number{

    font-size:34px;
    font-weight:700;

}

.dashboard-sub{

    color:#6c757d;
    font-size:14px;

}

</style>

<div class="row g-4 mb-5">

    {{-- Habitaciones --}}
    <div class="col-xl-3 col-md-6" data-aos="zoom-in">

        <div class="card dashboard-card shadow-sm h-100">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <small class="text-uppercase text-muted">

                            Habitaciones

                        </small>

                        <div class="dashboard-number contador"
                             data-target="{{ $habitaciones }}">

                            0

                        </div>

                        <div class="dashboard-sub">

                            Habitaciones registradas

                        </div>

                    </div>

                    <div class="dashboard-icon bg-primary bg-opacity-10">

                        <i class="bi bi-door-open-fill text-primary"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- Huéspedes --}}
    <div class="col-xl-3 col-md-6" data-aos="zoom-in" data-aos-delay="100">

        <div class="card dashboard-card shadow-sm h-100">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <small class="text-uppercase text-muted">

                            Huéspedes

                        </small>

                        <div class="dashboard-number contador"
                             data-target="{{ $huespedes }}">

                            0

                        </div>

                        <div class="dashboard-sub">

                            Clientes registrados

                        </div>

                    </div>

                    <div class="dashboard-icon bg-warning bg-opacity-10">

                        <i class="bi bi-people-fill text-warning"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- Reservas --}}
    <div class="col-xl-3 col-md-6" data-aos="zoom-in" data-aos-delay="200">

        <div class="card dashboard-card shadow-sm h-100">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <small class="text-uppercase text-muted">

                            Reservas

                        </small>

                        <div class="dashboard-number contador"
                             data-target="{{ $reservas }}">

                            0

                        </div>

                        <div class="dashboard-sub">

                            Historial de reservas

                        </div>

                    </div>

                    <div class="dashboard-icon bg-danger bg-opacity-10">

                        <i class="bi bi-calendar-check-fill text-danger"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- Ingresos --}}
    <div class="col-xl-3 col-md-6" data-aos="zoom-in" data-aos-delay="300">

        <div class="card dashboard-card shadow-sm h-100">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <small class="text-uppercase text-muted">

                            Ingresos

                        </small>

                        <div class="fw-bold fs-3 text-success">

                            ${{ number_format($ingresos,0,',','.') }}

                        </div>

                        <div class="dashboard-sub">

                            Ingreso acumulado

                        </div>

                    </div>

                    <div class="dashboard-icon bg-success bg-opacity-10">

                        <i class="bi bi-cash-stack text-success"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>