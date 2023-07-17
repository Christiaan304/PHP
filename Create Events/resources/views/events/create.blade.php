<x-app-layout>
    <x-slot:title>
        Criar eventos
    </x-slot:title>

    @if ($errors->any())
        <div class="row mt-4">
            <div class="col-md-4 mx-auto">
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <div class="row">
        @include('sidebar')
        <div class="col">
            <form action="{{ route('event.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mt-5">

                    <div class="row">
                        <div class="col-md-6">
                            <label for="event_title" class="form-label"><i class="fa-solid fa-pencil"></i> Título do
                                evento</label>
                            <input type="text" name="event_title" id="event_title" class="form-control"
                                value="{{ old('event_title') }}" required>
                        </div>

                        <div class="col-md-3">
                            <label for="event_start_date" class="form-label"><i class="fa-regular fa-calendar-days"></i>
                                Data de
                                início</label>
                            <input name="event_start_date" id="event_start_date" class="form-control"
                                value="{{ old('event_start_date') }}" required>
                        </div>

                        <div class="col-md-3">
                            <label for="event_end_date" class="form-label"><i class="fa-regular fa-calendar-days"></i>
                                Data do
                                término</label>
                            <input name="event_end_date" id="event_end_date" class="form-control"
                                value="{{ old('event_end_date') }}" required>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="event_location" class="form-label"><i class="fa-solid fa-location-dot"></i>
                                Local do
                                evento</label>
                            <input type="text" name="event_location" id="event_location" class="form-control"
                                value="{{ old('event_location') }}" required>
                        </div>

                        <div class="col-md-4">
                            <label for="event_image" class="form-label"><i class="fa-regular fa-image fa-lg"></i> Imagem
                                do
                                evento</label>
                            <input class="form-control" type="file" name="event_image" id="event_image"
                                value="{{ old('event_image') }}" required>
                            <div class="form-text">Tamanho e largura mínimo: 200 px - Tipos permitidos: jpg, jpeg e png
                            </div>
                        </div>

                        <div class="col-md-2">
                            <label for="event_private" class="form-label"><i class="fa-solid fa-lock"></i> Evento
                                privado?</label>
                            <select name="event_private" id="event_private" class="form-control"
                                value="{{ old('event_private') }}" required>
                                <option value="0">Não</option>
                                <option value="1">Sim</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label for="event_description" class="form-label"><i class="fa-regular fa-comment"></i>
                                Descrição do
                                evento</label>
                            <textarea class="form-control" name="event_description" id="event_description" rows="3" required>{{ old('event_description') }}</textarea>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <label for="" class="form-label"><i class="fa-solid fa-utensils fa-lg"></i> Adicione
                            itens de
                            infraestrutura</label>

                        <div class="col-md-6">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="cadeira"
                                    name="items[]" value="Cadeira">
                                <label class="form-check-label" for="cadeira"><i class="fa-solid fa-chair"></i>
                                    Cadeiras</label>
                            </div>

                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="palco"
                                    name="items[]" value="Palco">
                                <label class="form-check-label" for="palco"><i class="fa-solid fa-masks-theater"></i>
                                    Palco</label>
                            </div>

                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="cerveja_gratis"
                                    name="items[]" value="Cerveja gratis">
                                <label class="form-check-label" for="cerveja_gratis"><i
                                        class="fa-solid fa-beer-mug-empty"></i>
                                    Cerveja grátis</label>
                            </div>

                        </div>

                        <div class="col-md-6">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="open_food"
                                    name="items[]" value="Open Food">
                                <label class="form-check-label" for="open_food"><i
                                        class="fa-solid fa-pizza-slice"></i> Open
                                    Food</label>
                            </div>

                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="brinde"
                                    name="items[]" value="Brinde">
                                <label class="form-check-label" for="brinde"><i class="fa-solid fa-gift"></i>
                                    Brindes</label>
                            </div>

                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="internet"
                                    name="items[]" value="Internet">
                                <label class="form-check-label" for="internet"><i class="fa-solid fa-wifi"></i>
                                    Internet</label>
                            </div>
                        </div>

                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Criar evento</button>

                </div>
            </form>
        </div>
    </div>

    <script>
        flatpickr("#event_start_date", {
            altInput: true,
            enableTime: true,
            minDate: "today",
            altFormat: "F j, Y  H:i",
            dateFormat: "Y-m-d H:i:s",
        });

        flatpickr("#event_end_date", {
            altInput: true,
            enableTime: true,
            minDate: "today",
            altFormat: "F j, Y  H:i",
            dateFormat: "Y-m-d H:i:s",
        });
    </script>
</x-app-layout>
