<x-app-layout>
    <x-slot:title>
        Lista de eventos
    </x-slot:title>

    @if (count($public_events) == 0)
        <p class="mt-5">Não existe eventos, <a href="{{ route('event.index') }}">voltar</a></p>
    @else
        <div id="events_container" class="col-md-12 mt-5">
            @if (session()->get('success'))
                <div class="row mt-4">
                    <div class="col-md-4">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session()->get('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
            @endif

            @if ($search)
                <h2><i class="fa-solid fa-magnifying-glass"></i> Procurando por: {{ $search }}</h2>
            @else
                <h2>Próximos eventos</h2>
            @endif

            <div id="cards_container" class="row">
                @foreach ($public_events as $event)
                    <div class="card mt-3 me-4" style="width: 18rem;">
                        <img src="/events/images/{{ $event->image }}" class="card-img-top"
                            alt="imagem {{ $event->title }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $event->title }}</h5>
                            <p>{{ $event->description }}</p>
                            <p>Participantes: {{ count($event->users) }}</p>
                            <p class="card-date">Data início: {{ date('d/m/Y H:i', strtotime($event->start_date)) }}</p>
                            <p class="card-date">Data final: {{ date('d/m/Y H:i', strtotime($event->end_date)) }}</p>
                            <a href="{{ route('event.show', $event) }}" class="btn btn-primary">Saber
                                mais</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

</x-app-layout>
