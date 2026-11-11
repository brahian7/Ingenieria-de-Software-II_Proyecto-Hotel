<div class="row g-4 mb-5">

    @php

        $estados = [

            ['Disponible',$disponibles,'success','check-circle-fill'],

            ['Ocupada',$ocupadas,'danger','door-closed-fill'],

            ['Reservada',$reservadas,'warning','calendar-check-fill'],

            ['Mantenimiento',$mantenimiento,'secondary','tools']

        ];

    @endphp

    @foreach($estados as $estado)

    <div class="col-lg-3 col-md-6">

        <div class="card border-0 shadow-sm">

            <div class="card-body text-center">

                <i class="bi bi-{{ $estado[3] }} text-{{ $estado[2] }} fs-1"></i>

                <h2 class="contador fw-bold mt-3"

                    data-target="{{ $estado[1] }}">

                    0

                </h2>

                <p class="text-muted mb-0">

                    {{ $estado[0] }}

                </p>

            </div>

        </div>

    </div>

    @endforeach

</div>