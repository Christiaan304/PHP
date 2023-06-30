<x-app-layout>
    <x-slot:title>
        Tarefas escondidas
    </x-slot:title>

    <div class="table-responsive-md">
        <table class="table mt-4">
            <thead>
                <tr>
                    <th scope="col">Tarefa</th>
                    <th scope="col">Data</th>
                    <th scope="col">Status</th>
                    <th scope="col">Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($hidden_tasks as $task)
                    <tr>
                        <td>{{ $task->text }}</td>
                        <td>{{ $task->created_at }}</td>
                        <td>#</td>
                        <td>
                            {{-- unhide task --}}
                            <a class="btn btn-primary" href="{{ route('unhide', ['id' => $task->id]) }}"><i class="fa-solid fa-eye fa-lg"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
