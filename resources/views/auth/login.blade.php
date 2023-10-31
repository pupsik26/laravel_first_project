@extends('layouts.app')
@section('content')
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="col-sm-3">
            <label for="nameInput">Имя</label>
            <input type="name" name="name" class="form-control" id="nameInput">
        </div>
        <div class="col-sm-3">
            <label for="password">Пароль</label>
            <input type="password" name="password" class="form-control" id="password">
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                       class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                       name="remember">
                <span class="ml-2 text-sm text-gray-600">{{ __('Запомнить меня') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900"
                   href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <button class="btn btn-success">
                {{ __('Войти') }}
            </button>
        </div>
    </form>

@stop
