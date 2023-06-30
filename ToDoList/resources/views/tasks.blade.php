<x-app-layout>
    <div class="table-responsive-md">
        @if ($tasks->count() == 0)
            <p>Não existem tarefas</p>
        @else
            <caption>
                Tarefas: {{ $tasks->count() }}
                @if ($hidden_tasks > 0)
                    - <a href="{{ route('hidden_tasks') }}">Tarefas invisíveis: {{ $hidden_tasks }}</a>
                @endif
            </caption>

            <table class="table mt-4">
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
                            <td>{{ $task->text }}</td>
                            <td>{{ $task->created_at }}</td>
                            <td>
                                {{-- done button --}}
                                @if ($task->done == null)
                                    <a href="{{ route('done', ['id' => $task->id]) }}" class="btn btn-success"><i
                                            class="fa-solid fa-check fa-lg"></i></a>
                                @else
                                    <a href="{{ route('undone', ['id' => $task->id]) }}" class="btn btn-danger"><i
                                            class="fa-solid fa-rotate-left fa-lg"></i></a>
                                @endif

                                {{-- hide task --}}
                                <a class="btn btn-primary" href="{{ route('hide', ['id' => $task->id]) }}"><i
                                        class="fa-solid fa-eye-slash fa-lg"></i></a>

                                {{-- edit button --}}
                                <a type="button" href="{{ route('tasks.edit', $task) }}" class="btn btn-primary"><i
                                        class="fa-solid fa-pen-to-square fa-lg"></i> Editar</a>

                                {{-- delete task --}}
                                <form action="{{ route('tasks.destroy', $task) }}" method="post"
                                    style="display: inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Deseja mesmo apagar essa tarefa?')"
                                        class="btn btn-danger"><i class="fa-solid fa-trash-can fa-lg"></i>
                                        Apagar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</x-app-layout>
