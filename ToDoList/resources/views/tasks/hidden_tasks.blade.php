<x-layout>
    <x-slot:title>
        Tarefas Invisíveis
    </x-slot:title>

    @if ($hidden_tasks->count() === 0)
        <p>Não existem tarefas invisíveis</p>
    @else
        <table class="table table-striped caption-top">
            <caption>Tarefas invisíveis: {{ $hidden_tasks->count() }}</caption>
            <thead>
                <tr>
                    <th scope="col">Tarefa invisível</th>
                    <th scope="col">Data</th>
                    <th scope="col">Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($hidden_tasks as $task)
                    <tr>
                        <td style="width: 60%">{{ $task->task_text }}</td>
                        <td>{{ date('d-m-Y H:i:s', strtotime($task->created_at)) }}</td>
                        <td>
                            <a href="{{route('unhide_task', ['id' => $task->id])}}" class="btn btn-primary"><i class="fa-solid fa-eye fa-lg"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

</x-layout>
