@extends('layouts.app')
@section('content')
    @foreach($texts as $idTitle => $items)
        <div data-target-title-id="{{$idTitle}}">
            <x-list :items="$items"></x-list>
            <span data-toggle="tooltip" data-placement="top" title="Скачать в PDF">
                <a class="link-icons" href="{{ route('download', ['titleId' => $idTitle, 'type' => 'pdf']) }}">
                    <x-icons.pdf/>
                </a>
            </span>
            <span data-toggle="tooltip" data-placement="top" title="Скачать в DOCX">
                <a class="link-icons" href="{{ route('download', ['titleId' => $idTitle, 'type' => 'docx']) }}">
                    <x-icons.world/>
                </a>
            </span>
            <span data-toggle="tooltip" data-placement="top" title="Скачать ZIP">
                <a class="link-icons" href="{{ route('download', ['titleId' => $idTitle, 'type' => 'zip']) }}">
                    <x-icons.zip/>
                </a>
            </span>
        </div>
        <hr>
    @endforeach

@stop

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/devicons/devicon@v2.15.1/devicon.min.css">
    <style>
        .link-icons {
            text-decoration: none;
        }
    </style>
@endpush


