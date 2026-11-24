<div class="row mb-5">

    <div class="col-12">

        <div class="card border-0 shadow-lg">

            <div class="card-header bg-white py-4 border-0 d-flex justify-content-between align-items-center">

                <div>

                    <h4 class="fw-bold mb-1">

                        <i class="bi bi-clock-history text-success me-2"></i>

                        Últimas Reservas

                    </h4>

                    <small class="text-muted">

                        Últimas reservas registradas en el sistema.

                    </small>

                </div>

                <a href="{{ route('reservas.index') }}"
                   class="btn btn-outline-primary rounded-pill">

                    <i class="bi bi-list-ul me-2"></i>

                    Ver todas

                </a>

            </div>

            <div class="card-body p-0">

                @if($ultimasReservas->count())

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light">

                        <tr>

                            <th class="ps-4">Código</th>

                            <th>Huésped</th>

                            <th>Habitación</th>

                            <th>Check In</th>

                            <th>Check Out</th>

                            <th>Total</th>

                            <th>Estado</th>

                            <th class="text-center">Acciones</th>

                        </tr>

                        </thead>

                        <tbody>

                        @foreach($ultimasReservas as $reserva)

                            @php

                                $color='secondary';
                                $icon='question-circle';

                                if($reserva->estado=='Pendiente'){
                                    $color='warning';
                                    $icon='clock-history';
                                }

                                if($reserva->estado=='Activa'){
                                    $color='success';
                                    $icon='check-circle-fill';
                                }

                                if($reserva->estado=='Finalizada'){
                                    $color='primary';
                                    $icon='flag-fill';
                                }

                                if($reserva->estado=='Cancelada'){
                                    $color='danger';
                                    $icon='x-circle-fill';
                                }

                            @endphp

                            <tr>

                                <td class="ps-4 fw-bold">

                                    {{ $reserva->codigo_reserva }}

                                </td>

                                <td>

                                    <div class="fw-semibold">

                                        {{ $reserva->huesped->nombre }}
                                        {{ $reserva->huesped->apellido }}

                                    </div>

                                    <small class="text-muted">

                                        {{ $reserva->cantidad_personas }}
                                        huésped(es)

                                    </small>

                                </td>

                                <td>

                                    <span class="badge bg-light text-dark border px-3 py-2">

                                        <i class="bi bi-door-open me-1"></i>

                                        {{ $reserva->habitacion->numero }}

                                    </span>

                                </td>

                                <td>

                                    <i class="bi bi-box-arrow-in-right text-success me-1"></i>

                                    {{ $reserva->fecha_ingreso->format('d/m/Y') }}

                                </td>

                                <td>

                                    <i class="bi bi-box-arrow-right text-danger me-1"></i>

                                    {{ $reserva->fecha_salida->format('d/m/Y') }}

                                </td>

                                <td class="fw-bold text-success">

                                    $

                                    {{ number_format($reserva->total,0,',','.') }}

                                </td>

                                <td>

                                    <span class="badge bg-{{ $color }} px-3 py-2">

                                        <i class="bi bi-{{ $icon }} me-1"></i>

                                        {{ $reserva->estado }}

                                    </span>

                                </td>

                                <td class="text-center">

                                    <div class="btn-group" role="group">

                                        <a href="{{ route('reservas.show', $reserva->id) }}"
                                           class="btn btn-sm btn-outline-primary"
                                           title="Ver reserva">

                                            <i class="bi bi-eye-fill"></i>

                                        </a>

                                        <a href="{{ route('reservas.edit', $reserva->id) }}"
                                           class="btn btn-sm btn-outline-warning"
                                           title="Editar reserva">

                                            <i class="bi bi-pencil-fill"></i>

                                        </a>

                                    </div>

                                </td>

                            </tr>

                        @endforeach

                        </tbody>

                    </table>

                </div>

                @else

                <div class="text-center py-5">

                    <i class="bi bi-calendar-x display-3 text-secondary"></i>

                    <h5 class="mt-3">

                        No existen reservas registradas

                    </h5>

                    <p class="text-muted mb-0">

                        Cuando registres reservas aparecerán aquí.

                    </p>

                </div>

                @endif

            </div>

        </div>

    </div>

</div>