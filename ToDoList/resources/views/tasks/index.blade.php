<x-layout>
    <x-slot:title>
        To Do List
    </x-slot:title>

    @if ($tasks->count() === 0)
        <p>Não existem tarefas disponíveis</p>
    @else
        <table class="table table-striped caption-top">
            <caption>
                Tarefas: {{ $tasks->count() }}
                @if ($hidden_tasks_count > 0)
                    - <a href="{{route('hidden_tasks')}}">Tarefas invisíveis: {{ $hidden_tasks_count }}</a>                
                @endif
            </caption>
            <thead>
                <tr>
                    <th scope="col">Tarefa</th>
                    <th scope="col">Data</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                    <tr>
                        <td style="width: 60%">{{ $task->task_text }}</td>
                        <td>{{ date('d-m-Y H:i:s', strtotime($task->created_at)) }}</td>
                        <td>
                            {{-- done / not done --}}
                            @if ($task->done == null)
                                <a href="{{ route('done', ['id' => $task->id]) }}" class="btn btn-success"><i
                                        class="fa-solid fa-check fa-lg"></i></a>
                            @else
                                <a href="{{ route('undone', ['id' => $task->id]) }}" class="btn btn-danger"><i
                                        class="fa-solid fa-rotate-left fa-lg"></i></a>
                            @endif

                            {{-- edit --}}
                            <a href="{{ route('edit_task', ['id' => $task->id]) }}" class="btn btn-primary"><i
                                    class="fa-solid fa-pen-to-square fa-lg"></i></a>

                            {{-- hide task --}}
                            <a href="{{ route('hide_task', ['id' => $task->id]) }}" class="btn btn-primary"><i
                                    class="fa-solid fa-eye-slash fa-lg"></i></a>

                            {{-- delete --}}
                            <a href="{{ route('delete', ['id' => $task->id]) }}" type="button"
                                class="btn btn-danger"><i class="fa-solid fa-trash fa-lg"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

</x-layout>
