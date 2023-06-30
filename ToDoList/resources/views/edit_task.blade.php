<x-app-layout>
    <form action="{{ route('tasks.update', $task) }}" method="post">
        @csrf
        @method('PUT')
        <textarea class="form-control" name="text" rows="3">{{ old('text', $task->text) }}</textarea>
        <button type="submit" class="btn btn-primary mt-3">Editar</button>
    </form>
</x-app-layout>
