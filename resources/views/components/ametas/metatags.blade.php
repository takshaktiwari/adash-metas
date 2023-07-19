@foreach($metatag as $tag)
    @if($tag['name'] == 'title')
        <title>{{ $tag['content'] }}</title>
    @else
        <meta name="{{ $tag['name'] }}" content="{{ $tag['content'] }}">
    @endif
@endforeach
