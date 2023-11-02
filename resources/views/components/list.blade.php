@foreach($items as $key => $allInfoText)
    <h3>Title: {{ $key }}</h3>
    <h4>Author: {{ $allInfoText['author'] ?? \Illuminate\Support\Facades\Auth::user()->name }}</h4>
    <h5>Created_at: {{ $allInfoText['created_at'] ?? date('Y-m-d H:m:s', time()) }}</h5>
    @php
        unset($allInfoText['author']);
        unset($allInfoText['created_at']);
    @endphp
        @foreach($allInfoText as $k => $text)
            {!! $text !!}
            <br/>
        @endforeach
@endforeach
