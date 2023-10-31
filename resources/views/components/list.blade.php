@foreach($items as $key => $allInfoText)
    <h3>Название текста: {{ $key }}</h3>
    <h4>Автор: {{ $allInfoText['author'] ?? \Illuminate\Support\Facades\Auth::user()->name }}</h4>
    <h5>Дата создания: {{ $allInfoText['created_at'] ?? date('Y-m-d H:m:s', time()) }}</h5>
    @php
        unset($allInfoText['author']);
        unset($allInfoText['created_at']);
    @endphp
    <ol start="1">
        @foreach($allInfoText as $k => $text)
            <li>{!! $text !!}</li>
        @endforeach
    </ol>
@endforeach
