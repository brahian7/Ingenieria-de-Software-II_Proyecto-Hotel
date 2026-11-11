<div class="card shadow border-0 mb-4">

    <div class="card-header bg-primary text-white">

        <h5 class="mb-0">

            <i class="bi bi-person-vcard-fill me-2"></i>

            Información Personal

        </h5>

    </div>

    <div class="card-body">

        <div class="row">

            <div class="col-md-6 mb-3">

                <label class="form-label fw-semibold">

                    Tipo de documento

                </label>

                <select
                    name="tipo_documento"
                    class="form-select @error('tipo_documento') is-invalid @enderror">

                    <option value="">Seleccione...</option>

                    @foreach(['CC','TI','CE','Pasaporte'] as $tipo)

                        <option
                            value="{{ $tipo }}"
                            @selected(old('tipo_documento',$huesped->tipo_documento ?? '')==$tipo)>

                            {{ $tipo }}

                        </option>

                    @endforeach

                </select>

                @error('tipo_documento')

                    <div class="invalid-feedback">

                        {{ $message }}

                    </div>

                @enderror

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label fw-semibold">

                    Número de documento

                </label>

                <input
                    type="text"
                    name="numero_documento"
                    class="form-control @error('numero_documento') is-invalid @enderror"
                    value="{{ old('numero_documento',$huesped->numero_documento ?? '') }}">

                @error('numero_documento')

                    <div class="invalid-feedback">

                        {{ $message }}

                    </div>

                @enderror

            </div>

        </div>

        <div class="row">

            <div class="col-md-6 mb-3">

                <label class="form-label fw-semibold">

                    Nombres

                </label>

                <input
                    type="text"
                    name="nombres"
                    class="form-control @error('nombres') is-invalid @enderror"
                    value="{{ old('nombres',$huesped->nombres ?? '') }}">

                @error('nombres')

                    <div class="invalid-feedback">

                        {{ $message }}

                    </div>

                @enderror

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label fw-semibold">

                    Apellidos

                </label>

                <input
                    type="text"
                    name="apellidos"
                    class="form-control @error('apellidos') is-invalid @enderror"
                    value="{{ old('apellidos',$huesped->apellidos ?? '') }}">

                @error('apellidos')

                    <div class="invalid-feedback">

                        {{ $message }}

                    </div>

                @enderror

            </div>

        </div>

        <div class="row">

            <div class="col-md-6 mb-3">

                <label class="form-label fw-semibold">

                    Teléfono

                </label>

                <input
                    type="text"
                    name="telefono"
                    class="form-control @error('telefono') is-invalid @enderror"
                    value="{{ old('telefono',$huesped->telefono ?? '') }}">

                @error('telefono')

                    <div class="invalid-feedback">

                        {{ $message }}

                    </div>

                @enderror

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label fw-semibold">

                    Correo electrónico

                </label>

                <input
                    type="email"
                    name="correo"
                    class="form-control @error('correo') is-invalid @enderror"
                    value="{{ old('correo',$huesped->correo ?? '') }}">

                @error('correo')

                    <div class="invalid-feedback">

                        {{ $message }}

                    </div>

                @enderror

            </div>

        </div>

    </div>

</div>
<div class="card shadow border-0">

    <div class="card-header bg-success text-white">

        <h5 class="mb-0">

            <i class="bi bi-geo-alt-fill me-2"></i>

            Información de Contacto

        </h5>

    </div>

    <div class="card-body">

        <div class="row">

            <div class="col-md-6 mb-3">

                <label class="form-label fw-semibold">

                    Ciudad

                </label>

                <input
                    type="text"
                    name="ciudad"
                    class="form-control @error('ciudad') is-invalid @enderror"
                    value="{{ old('ciudad', $huesped->ciudad ?? '') }}">

                @error('ciudad')

                    <div class="invalid-feedback">

                        {{ $message }}

                    </div>

                @enderror

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label fw-semibold">

                    Fecha de registro

                </label>

                <input
                    type="date"
                    name="fecha_registro"
                    class="form-control @error('fecha_registro') is-invalid @enderror"
                    value="{{ old('fecha_registro', isset($huesped) ? $huesped->fecha_registro?->format('Y-m-d') : now()->format('Y-m-d')) }}">

                @error('fecha_registro')

                    <div class="invalid-feedback">

                        {{ $message }}

                    </div>

                @enderror

            </div>

        </div>

        <div class="mb-3">

            <label class="form-label fw-semibold">

                Dirección

            </label>

            <textarea
                name="direccion"
                rows="3"
                class="form-control @error('direccion') is-invalid @enderror">{{ old('direccion', $huesped->direccion ?? '') }}</textarea>

            @error('direccion')

                <div class="invalid-feedback">

                    {{ $message }}

                </div>

            @enderror

        </div>

    </div>

</div>

<div class="d-flex justify-content-end gap-2 mt-4">

    <a href="{{ route('huespedes.index') }}"
       class="btn btn-secondary px-4">

        <i class="bi bi-arrow-left-circle me-1"></i>

        Cancelar

    </a>

    <button
        type="submit"
        class="btn btn-success px-4">

        <i class="bi bi-save-fill me-1"></i>

        Guardar Huésped

    </button>

</div>