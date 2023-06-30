<x-app-layout>
    <x-slot:title>
        Nova tarefa
    </x-slot:title>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('tasks.store') }}" method="post">
        @csrf
        <label class="form-label">Texto:</label>
        <textarea class="form-control" name="text" rows="3">{{ old('text') }}</textarea>
        <button type="submit" class="btn btn-primary mt-3">Criar</button>
    </form>
</x-app-layout>
