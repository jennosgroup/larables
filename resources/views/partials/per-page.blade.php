<div {!! $table->getPerPageContainerAttributesHtml() !!}>
    <select {!! $table->getPerPageSelectAttributesHtml() !!}>
        <option value="">Entries</option>

        @foreach ($table->getPerPageOptions() as $value => $text)
            @if ($table->getPerPageTotal() == $value)
                <option value="{{ $value }}" selected>{{ $text }}</option>
            @else
                <option value="{{ $value }}">{{ $text }}</option>
            @endif
        @endforeach
    </select>

    <form style="display: none;" method="get" larables-id="per-page-form">
        @foreach ($table->getArgsForPerPageRequest() as $key => $value)
            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
        @endforeach
    </form> 
</div>
