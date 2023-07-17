<x-app-layout>
    <x-slot:title>
        Dashboard
    </x-slot:title>

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

    <div class="row">
        @include('sidebar')

        <div class="col-md-10 mt-5">
            <h1>Meus eventos</h1>
            <div class="row">
                @if (count($events) == 0)
                    <p>Você não possui eventos criados, <a href="{{ route('event.create') }}"> criar evento?</a></p>
                @else
                    <div class="table-responsive-md mt-4">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Participantes</th>
                                    <th scope="col">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($events as $event)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>
                                            <a href="{{ route('event.show', $event) }}">{{ $event->title }}</a>
                                        </td>
                                        <td>{{ count($event->users) }}</td>
                                        <td>
                                            {{-- edit event --}}
                                            <a href="{{ route('event.edit', $event) }}" class="btn btn-info"><i
                                                    class="fa-solid fa-pencil"></i>
                                                Editar</a>

                                            {{-- delete event --}}
                                            <form class="delete_form" action="{{ route('event.destroy', $event) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Deseja mesmo apagar essa tarefa?')">
                                                    <i class="fa-solid fa-trash-can"></i> Apagar
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                @endif
            </div>
        </div>

        <div class="col-md-12 mt-4">
            @if (count($event_as_attendee) == 0)
                <p>Você não está participando de nenhum evento. <a href="{{ route('event.index') }}">Ver eventos.</a>
                </p>
            @else
                <div class="table-responsive-md">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Participantes</th>
                                <th scope="col">Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($event_as_attendee as $event)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td><a href="{{ route('event.show', $event) }}">{{ $event->title }}</a></td>
                                    <td>{{ count($event->users) }}</td>
                                    <td>
                                        <form action="{{ route('event.unattend', $event) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Deseja mesmo sair do evento?')"><i
                                                    class="fa-regular fa-circle-xmark fa-lg"></i> Sair</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

</x-app-layout>
