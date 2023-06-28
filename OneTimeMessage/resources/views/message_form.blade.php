<x-layout>
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('confirm'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('confirm') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="{{ route('message_submit') }}" method="post">
        @csrf
        <div class="row">
            <div class="col">
                <label for="input_email_from" class="form-label">De:</label>
                <input type="email" class="form-control" name="input_email_from" id="input_email_from"
                    placeholder="test@mail.com" value="{{ old('input_email_from') }}" required>
            </div>

            <div class="col">
                <label for="input_email_to" class="form-label">Para:</label>
                <input type="email" class="form-control" name="input_email_to" id="input_email_to"
                    placeholder="test@mail.com" value="{{ old('input_email_to') }}" required>
            </div>

            <div class="my-3">
                <label for="email_message" class="form-label">Menssagem:</label>
                <textarea class="form-control" name="email_message" id="email_message" rows="3">{{ old('email_message') }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Enviar One Time Message</button>
        </div>
    </form>
</x-layout>
