@extends('layouts.app')
@section('content')
    <form method="POST" action="{{ route('create-text') }}">
        @csrf
        <div class="create-title">
            <label for="title">Название текста</label>
            <input id="title" class="form-control" type="text" name="title" required autofocus/>
        </div>

        <div class="create-text">
            <div class="wrapper_textarea pt-5">
                <textarea type="text" name="text[]" class="editor-body"></textarea>
            </div>
            <div class="wrapper_textarea pt-5">
                <textarea type="text" name="text[]" class="editor-body"></textarea>
            </div>
            <div class="wrapper_textarea pt-5">
                <textarea type="text" name="text[]" class="editor-body"></textarea>
            </div>
        </div>
        <div class="flex-btn">
            <button class="btn btn-success mt-1">
                {{ __('Создать') }}
            </button>

            <button data-toggle="tooltip" data-placement="top" title="Предпросмотр" id="view-text" type="button" class="btn" data-toggle="modal" data-target="#exampleModal">
                <x-icons.eye/>
            </button>
        </div>
    </form>
    <x-modal.modal/>
@endsection

@push('styles')
    <link href="{{ asset('js/plugins/summernote/summernote-bs4.min.css') }}" rel="stylesheet">
    <style>
        .flex-btn {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    </style>
@endpush

@push('scripts')
    <script src="{{ asset('js/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('js/plugins/summernote/lang/summernote-ru-RU.min.js') }}"></script>
    <script>
        $(function () {
            $('.editor-body').summernote({
                lang: 'ru-RU',
                height: 100
            });
        });

        $('#view-text').click(function (event) {
            const serialize = $('form').serialize();
            fetch("{{ route('view-text') }}?" + serialize, {
                method: "get",
            }).then(response => {
                if (response.ok) {
                    return response.text();
                } else {
                    throw new Error('HTTP status ' + response.status);
                }
            }).then(html => {
                $('#modal-view-text').append(html);
            })
        });

        $('#exampleModal').on('hidden.bs.modal', function () {
            $('#modal-view-text').empty();
        })
    </script>
@endpush
