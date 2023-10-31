<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between mb-5" style="display: flex;
                                                  justify-content: space-between;
                                                  align-items: center;">
        <nav id="navbar-example2" class="navbar navbar-light bg-light px-3">
            <div class="card text-center">
                <div class="card-header">
                    <ul class="nav nav-pills card-header-pills">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('my-text') || request()->is('/') ? 'active' : null }}"
                               href="{{route('my-text')}}">
                                {{ __('Мои тексты') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('new-text') ? 'active' : null }}"
                               href="{{route('new-text')}}">
                                {{ __('Новый текст') }}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div>
            <h2 class="font-medium text-base text-gray-800">Имя: {{ Auth::user()->name }}</h2>
            <h3 class="font-medium text-sm text-gray-500">Email: {{ Auth::user()->email }}</h3>
            <!-- Authentication -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <a class="btn btn-danger" href="{{route('logout')}}"
                   onclick="event.preventDefault();
                                        this.closest('form').submit();">
                    {{ __('Выйти') }}
                </a>
            </form>
        </div>
    </div>
</div>
<hr>
