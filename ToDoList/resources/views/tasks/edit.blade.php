<x-layout>
    <x-slot:title>
        Editar tarefa
    </x-slot:title>

    <div class="d-flex justify-content-center align-items-center">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('edit_task_submit') }}" method="post" class="row">
            @csrf
            <input type="hidden" name="id_task" value="{{ $task->id }}">
            <div class="col-md-12 mt-3">
                <input class="form-control" name="task_text" id="task_text" rows="4" maxlength="255"
                    value="{{ $task->task_text }}" required>
            </div>

            <div class="col-6 mt-3">
                <button type="submit" class="btn btn-primary">Salvar</button>
                <a href="{{ route('index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</x-layout>
