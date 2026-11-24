<div class="row mb-5">

    <div class="col-12">

        <div class="card border-0 shadow-lg">

            <div class="card-header bg-white border-0 py-4">

                <h3 class="fw-bold mb-1">

                    <i class="bi bi-lightning-charge-fill text-warning me-2"></i>

                    Acciones rápidas

                </h3>

                <p class="text-muted mb-0">

                    Accede rápidamente a los módulos principales del sistema.

                </p>

            </div>

            <div class="card-body">

                <div class="row g-4">

                    {{-- Habitaciones --}}
                    <div class="col-lg-3 col-md-6">

                        <a href="{{ route('habitaciones.index') }}"
                           class="text-decoration-none">

                            <div class="card accion-card border-0 shadow-sm h-100">

                                <div class="card-body text-center p-4">

                                    <div class="icono bg-success-subtle text-success">

                                        <i class="bi bi-door-open-fill"></i>

                                    </div>

                                    <h5 class="fw-bold mt-4">

                                        Habitaciones

                                    </h5>

                                    <p class="text-muted mb-0">

                                        Administrar habitaciones del hotel.

                                    </p>

                                </div>

                            </div>

                        </a>

                    </div>

                    {{-- Huéspedes --}}
                    <div class="col-lg-3 col-md-6">

                        <a href="{{ route('huespedes.index') }}"
                           class="text-decoration-none">

                            <div class="card accion-card border-0 shadow-sm h-100">

                                <div class="card-body text-center p-4">

                                    <div class="icono bg-warning-subtle text-warning">

                                        <i class="bi bi-people-fill"></i>

                                    </div>

                                    <h5 class="fw-bold mt-4">

                                        Huéspedes

                                    </h5>

                                    <p class="text-muted mb-0">

                                        Registrar y consultar huéspedes.

                                    </p>

                                </div>

                            </div>

                        </a>

                    </div>

                    {{-- Reservas --}}
                    <div class="col-lg-3 col-md-6">

                        <a href="{{ route('reservas.index') }}"
                           class="text-decoration-none">

                            <div class="card accion-card border-0 shadow-sm h-100">

                                <div class="card-body text-center p-4">

                                    <div class="icono bg-danger-subtle text-danger">

                                        <i class="bi bi-calendar-check-fill"></i>

                                    </div>

                                    <h5 class="fw-bold mt-4">

                                        Reservas

                                    </h5>

                                    <p class="text-muted mb-0">

                                        Gestionar reservas del hotel.

                                    </p>

                                </div>

                            </div>

                        </a>

                    </div>

                    {{-- Perfil --}}
                    <div class="col-lg-3 col-md-6">

                        <a href="{{ route('profile.edit') }}"
                           class="text-decoration-none">

                            <div class="card accion-card border-0 shadow-sm h-100">

                                <div class="card-body text-center p-4">

                                    <div class="icono bg-primary-subtle text-primary">

                                        <i class="bi bi-person-circle"></i>

                                    </div>

                                    <h5 class="fw-bold mt-4">

                                        Mi Perfil

                                    </h5>

                                    <p class="text-muted mb-0">

                                        Configura tu información personal.

                                    </p>

                                </div>

                            </div>

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<style>

.accion-card{

    border-radius:20px;

    transition:all .30s ease;

    cursor:pointer;

}

.accion-card:hover{

    transform:translateY(-8px);

    box-shadow:0 20px 35px rgba(13,110,253,.18)!important;

}

.icono{

    width:90px;

    height:90px;

    border-radius:20px;

    display:flex;

    align-items:center;

    justify-content:center;

    margin:auto;

    font-size:40px;

    transition:.3s;

}

.accion-card:hover .icono{

    transform:scale(1.1);

}

</style>