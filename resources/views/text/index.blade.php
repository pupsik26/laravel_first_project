@extends('layouts.app')
@section('content')
{{--    {{ dd($texts) }}--}}
    @foreach($texts as $idTitle => $items)
        <div data-target-title-id="{{$idTitle}}">
            <x-list :items="$items"></x-list>
            <x-icons.pdf/>
            <x-icons.world/>
            <x-icons.zip/>
        </div>
        <hr>
    @endforeach

@stop

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/devicons/devicon@v2.15.1/devicon.min.css">
@endpush


