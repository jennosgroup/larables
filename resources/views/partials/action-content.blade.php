@if ($table->getActionContentType() == 'icon')
    {!! $table->getActionIconHtml($action) !!}
@elseif ($table->getActionContentType() == 'text')
    {{ $table->getActionText($action) }}
@endif

{{-- Add the form so we can submit values with the request --}}
<form style="display: none;" method="{{ ($method == 'get') ? 'get' : 'post' }}" action="{{ $route }}">

    {{-- CSRF Token --}}
    @if ($method != 'get')
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    @endif

    {{-- Method Spoofing --}}
    @if (! in_array($method, ['get', 'post']))
        <input type="hidden" name="_method" value="{{ strtoupper($method) }}">
    @endif

    {{-- Add query args so that they are submitted with the request --}}
    @foreach ($table->getActionQueryArgs($action, $route) as $key => $value)
        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
    @endforeach
</form>
