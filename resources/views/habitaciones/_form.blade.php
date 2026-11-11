<div class="row">

    {{-- Columna izquierda --}}
    <div class="col-lg-6">

        <div class="mb-4">

            <label class="form-label fw-semibold">

                <i class="bi bi-hash text-primary me-2"></i>

                Número de habitación

            </label>

            <input
                type="text"
                name="numero"
                class="form-control @error('numero') is-invalid @enderror"
                placeholder="Ej: 101"
                value="{{ old('numero', $habitacion->numero ?? '') }}">

            @error('numero')

                <div class="invalid-feedback">

                    {{ $message }}

                </div>

            @enderror

        </div>


        <div class="mb-4">

            <label class="form-label fw-semibold">

                <i class="bi bi-door-open text-primary me-2"></i>

                Tipo de habitación

            </label>

            <select
                name="tipo"
                class="form-select @error('tipo') is-invalid @enderror">

                <option value="">Seleccione...</option>

                @foreach(['Sencilla','Doble','Suite','Familiar'] as $tipo)

                    <option
                        value="{{ $tipo }}"
                        @selected(old('tipo',$habitacion->tipo ?? '')==$tipo)>

                        {{ $tipo }}

                    </option>

                @endforeach

            </select>

            @error('tipo')

                <div class="invalid-feedback">

                    {{ $message }}

                </div>

            @enderror

        </div>


        <div class="mb-4">

            <label class="form-label fw-semibold">

                <i class="bi bi-people text-primary me-2"></i>

                Capacidad

            </label>

            <input
                type="number"
                name="capacidad"
                class="form-control @error('capacidad') is-invalid @enderror"
                placeholder="Cantidad de personas"
                value="{{ old('capacidad',$habitacion->capacidad ?? '') }}">

            @error('capacidad')

                <div class="invalid-feedback">

                    {{ $message }}

                </div>

            @enderror

        </div>

    </div>


    {{-- Columna derecha --}}
    <div class="col-lg-6">

        <div class="mb-4">

            <label class="form-label fw-semibold">

                <i class="bi bi-cash-stack text-success me-2"></i>

                Precio por noche

            </label>

            <input
                type="number"
                step="0.01"
                name="precio_noche"
                class="form-control @error('precio_noche') is-invalid @enderror"
                placeholder="Ej: 180000"
                value="{{ old('precio_noche',$habitacion->precio_noche ?? '') }}">

            @error('precio_noche')

                <div class="invalid-feedback">

                    {{ $message }}

                </div>

            @enderror

        </div>


        <div class="mb-4">

            <label class="form-label fw-semibold">

                <i class="bi bi-check-circle text-success me-2"></i>

                Estado

            </label>

            <select
                name="estado"
                class="form-select @error('estado') is-invalid @enderror">

                @foreach(['Disponible','Ocupada','Reservada','Mantenimiento'] as $estado)

                    <option
                        value="{{ $estado }}"
                        @selected(old('estado',$habitacion->estado ?? '')==$estado)>

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


        <div class="mb-4">

            <label class="form-label fw-semibold">

                <i class="bi bi-card-text text-primary me-2"></i>

                Descripción

            </label>

            <textarea
                name="descripcion"
                rows="5"
                class="form-control @error('descripcion') is-invalid @enderror"
                placeholder="Descripción de la habitación...">{{ old('descripcion',$habitacion->descripcion ?? '') }}</textarea>

            @error('descripcion')

                <div class="invalid-feedback">

                    {{ $message }}

                </div>

            @enderror

        </div>

    </div>

</div>

<hr class="my-4">

<div class="d-flex justify-content-end gap-2">

    <a href="{{ route('habitaciones.index') }}"
       class="btn btn-secondary">

        <i class="bi bi-arrow-left-circle me-2"></i>

        Cancelar

    </a>

    <button type="submit"
            class="btn btn-success">

        <i class="bi bi-check-circle-fill me-2"></i>

        Guardar Habitación

    </button>

</div>
