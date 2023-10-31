@extends('layouts.app')
@section('content')
{{--    {{ dd($texts) }}--}}
    @foreach($texts as $idTitle => $items)
        <div data-target-title-id="{{$idTitle}}">
            <x-list :items="$items"></x-list>
            <span data-toggle="tooltip" data-placement="top" title="Скачать в PDF">
                <x-icons.pdf/>
            </span>
            <span data-toggle="tooltip" data-placement="top" title="Скачать в DOCX">
                <x-icons.world/>
            </span>
            <span data-toggle="tooltip" data-placement="top" title="Скачать ZIP">
                <x-icons.zip/>
            </span>
        </div>
        <hr>
    @endforeach

@stop

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/devicons/devicon@v2.15.1/devicon.min.css">
@endpush


