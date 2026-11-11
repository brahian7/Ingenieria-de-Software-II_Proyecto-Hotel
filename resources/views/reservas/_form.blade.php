<div class="card shadow border-0 mb-4">

    <div class="card-header bg-primary text-white">

        <h5 class="mb-0">

            <i class="bi bi-person-fill me-2"></i>

            Información de la Reserva

        </h5>

    </div>

    <div class="card-body">

        <div class="row">

            {{-- Huésped --}}
            <div class="col-md-6 mb-3">

                <label class="form-label fw-semibold">

                    Huésped

                </label>

                <select
                    name="huesped_id"
                    class="form-select @error('huesped_id') is-invalid @enderror"
                    required>

                    <option value="">Seleccione un huésped...</option>

                    @foreach($huespedes as $huesped)

                        <option
                            value="{{ $huesped->id }}"
                            @selected(old('huesped_id',$reserva->huesped_id ?? '') == $huesped->id)>

                            {{ $huesped->nombres }}
                            {{ $huesped->apellidos }}
                            -
                            {{ $huesped->numero_documento }}

                        </option>

                    @endforeach

                </select>

                @error('huesped_id')

                    <div class="invalid-feedback">

                        {{ $message }}

                    </div>

                @enderror

            </div>

            {{-- Habitación --}}
            <div class="col-md-6 mb-3">

                <label class="form-label fw-semibold">

                    Habitación

                </label>

                <select
                    id="habitacion"
                    name="habitacion_id"
                    class="form-select @error('habitacion_id') is-invalid @enderror"
                    required>

                    <option value="">Seleccione una habitación...</option>

                    @foreach($habitaciones as $habitacion)

                        <option
                            value="{{ $habitacion->id }}"
                            data-precio="{{ $habitacion->precio_noche }}"
                            @selected(old('habitacion_id',$reserva->habitacion_id ?? '') == $habitacion->id)>

                            Habitación {{ $habitacion->numero }}

                            -

                            {{ $habitacion->tipo }}

                            -

                            ${{ number_format($habitacion->precio_noche,0,',','.') }}

                        </option>

                    @endforeach

                </select>

                @error('habitacion_id')

                    <div class="invalid-feedback">

                        {{ $message }}

                    </div>

                @enderror

            </div>

        </div>

        <div class="row">

            {{-- Fecha reserva --}}
            <div class="col-md-4 mb-3">

                <label class="form-label fw-semibold">

                    Fecha de reserva

                </label>

                <input
                    type="date"
                    name="fecha_reserva"
                    class="form-control @error('fecha_reserva') is-invalid @enderror"
                    value="{{ old('fecha_reserva', isset($reserva) ? $reserva->fecha_reserva?->format('Y-m-d') : now()->format('Y-m-d')) }}">

                @error('fecha_reserva')

                    <div class="invalid-feedback">

                        {{ $message }}

                    </div>

                @enderror

            </div>

            {{-- Fecha ingreso --}}
            <div class="col-md-4 mb-3">

                <label class="form-label fw-semibold">

                    Fecha ingreso

                </label>

                <input
                id="fecha_ingreso"
                type="date"
                name="fecha_ingreso"
                class="form-control @error('fecha_ingreso') is-invalid @enderror"
                value="{{ old('fecha_ingreso', isset($reserva) ? \Carbon\Carbon::parse($reserva->fecha_ingreso)->format('Y-m-d') : '') }}">

                @error('fecha_ingreso')

                    <div class="invalid-feedback">

                        {{ $message }}

                    </div>

                @enderror

            </div>

            {{-- Fecha salida --}}
            <div class="col-md-4 mb-3">

                <label class="form-label fw-semibold">

                    Fecha salida

                </label>

                <input
                id="fecha_salida"
                type="date"
                name="fecha_salida"
                class="form-control @error('fecha_salida') is-invalid @enderror"
                value="{{ old('fecha_salida', isset($reserva) ? \Carbon\Carbon::parse($reserva->fecha_salida)->format('Y-m-d') : '') }}">

                @error('fecha_salida')

                    <div class="invalid-feedback">

                        {{ $message }}

                    </div>

                @enderror

            </div>

        </div>
                <div class="row">

            {{-- Cantidad de personas --}}
            <div class="col-md-4 mb-3">

                <label class="form-label fw-semibold">

                    Cantidad de personas

                </label>

                <input
                    type="number"
                    min="1"
                    name="cantidad_personas"
                    class="form-control @error('cantidad_personas') is-invalid @enderror"
                    value="{{ old('cantidad_personas',$reserva->cantidad_personas ?? 1) }}">

                @error('cantidad_personas')

                    <div class="invalid-feedback">

                        {{ $message }}

                    </div>

                @enderror

            </div>

            {{-- Estado --}}
            <div class="col-md-4 mb-3">

                <label class="form-label fw-semibold">

                    Estado

                </label>

                <select
                    name="estado"
                    class="form-select @error('estado') is-invalid @enderror">

                    @foreach(['Pendiente','Confirmada','Cancelada','Finalizada'] as $estado)

                        <option
                            value="{{ $estado }}"
                            @selected(old('estado',$reserva->estado ?? 'Pendiente') == $estado)>

                            {{ $estado }}

                        </option>

                    @endforeach

                </select>

                @error('estado')

                    <div class="invalid-feedback">

                        {{ $message }}

                    </div>

                @enderror

            </div>

            {{-- Noches --}}
            <div class="col-md-4 mb-3">

                <label class="form-label fw-semibold">

                    Noches

                </label>

                <input
                    type="text"
                    id="noches"
                    class="form-control bg-light"
                    value="0"
                    readonly>

            </div>

        </div>

        <div class="mb-4">

            <label class="form-label fw-semibold">

                Observaciones

            </label>

            <textarea
                name="observaciones"
                rows="4"
                class="form-control @error('observaciones') is-invalid @enderror"
                placeholder="Observaciones adicionales...">{{ old('observaciones',$reserva->observaciones ?? '') }}</textarea>

            @error('observaciones')

                <div class="invalid-feedback">

                    {{ $message }}

                </div>

            @enderror

        </div>

    </div>

</div>


{{-- Resumen de la reserva --}}
<div class="card shadow border-0 mb-4">

    <div class="card-header bg-success text-white">

        <h5 class="mb-0">

            <i class="bi bi-cash-stack me-2"></i>

            Resumen de la Reserva

        </h5>

    </div>

    <div class="card-body">

        <div class="row text-center">

            <div class="col-md-4">

                <h6 class="text-muted">

                    Precio por noche

                </h6>

                <h4 id="precioNoche">

                    $0

                </h4>

            </div>

            <div class="col-md-4">

                <h6 class="text-muted">

                    Noches

                </h6>

                <h4 id="cantidadNoches">

                    0

                </h4>

            </div>

            <div class="col-md-4">

                <h6 class="text-muted">

                    Total estimado

                </h6>

                <h3
                    id="totalReserva"
                    class="text-success fw-bold">

                    $0

                </h3>

            </div>

        </div>

    </div>

</div>


<div class="d-flex justify-content-end gap-2">

    <a href="{{ route('reservas.index') }}"
       class="btn btn-secondary">

        <i class="bi bi-arrow-left-circle me-2"></i>

        Cancelar

    </a>

    <button
        type="submit"
        class="btn btn-success">

        <i class="bi bi-save-fill me-2"></i>

        Guardar Reserva

    </button>

</div>


<script>

document.addEventListener('DOMContentLoaded', function () {

    const habitacion = document.getElementById('habitacion');
    const ingreso = document.getElementById('fecha_ingreso');
    const salida = document.getElementById('fecha_salida');

    const precio = document.getElementById('precioNoche');
    const noches = document.getElementById('cantidadNoches');
    const total = document.getElementById('totalReserva');
    const nochesInput = document.getElementById('noches');

    function calcularReserva(){

        let precioNoche = 0;

        if(habitacion.selectedIndex > 0){

            precioNoche = parseFloat(
                habitacion.options[habitacion.selectedIndex].dataset.precio
            );

        }

        precio.innerHTML = '$' + precioNoche.toLocaleString('es-CO');

        if(ingreso.value && salida.value){

            let inicio = new Date(ingreso.value);

            let fin = new Date(salida.value);

            let diferencia = (fin - inicio) / (1000 * 60 * 60 * 24);

            if(diferencia > 0){

                noches.innerHTML = diferencia;

                nochesInput.value = diferencia;

                total.innerHTML =
                    '$' + (precioNoche * diferencia).toLocaleString('es-CO');

            }else{

                noches.innerHTML = 0;

                nochesInput.value = 0;

                total.innerHTML = '$0';

            }

        }

    }

    habitacion.addEventListener('change', calcularReserva);

    ingreso.addEventListener('change', calcularReserva);

    salida.addEventListener('change', calcularReserva);

    calcularReserva();

});

</script>