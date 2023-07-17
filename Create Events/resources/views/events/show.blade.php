<x-app-layout>
    <x-slot:title>
        {{ $event->title }}
    </x-slot:title>

    <div class="col-md-12 mt-5">
        <div class="row">
            <div id="img_container" class="col-md-6">
                <img src="/events/images/{{ $event->image }}" class="img-fluid" alt="{{ $event->image }}">
            </div>

            <div id="info_container" class="col-md-6 mt-2">
                <h1>{{ $event->title }}</h1>
                <p><i class="fa-solid fa-location-dot"></i> {{ $event->location }}</p>
                <p><i class="fa-solid fa-people-group fa-lg"></i> Participantes: {{ count($event->users) }} </p>
                <p><i class="fa-sharp fa-solid fa-star fa-lg"></i> Dono do evento: {{ $event->user->name }}</p>

                <p class="card-date"><i class="fa-regular fa-calendar-days"></i> Data início:
                    {{ date('d/m/Y H:i', strtotime($event->start_date)) }}</p>

                <p class="card-date"><i class="fa-regular fa-calendar-days"></i> Data final:
                    {{ date('d/m/Y H:i', strtotime($event->end_date)) }}</p>

                <h3>O envento conta com:</h3>

                <ul id="items_list">
                    @foreach ($event->items as $item)
                        <li><i class="fa-regular fa-circle-check fa-lg"></i> {{ $item }}</li>
                    @endforeach
                </ul>

                <form action="{{ route('event.attend', $event) }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-success mt-3">Confirmar presença</button>
                </form>
            </div>

            <div id="description_container" class="col-md-12 mt-4">
                <h2>Sobre o evento</h2>
                <p>{{ $event->description }}</p>
            </div>
        </div>
    </div>
</x-app-layout>
