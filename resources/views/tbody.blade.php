<tbody>
    @if ($table->hasData())
        @foreach ($table->getData() as $item)
        <tr>
            @foreach ($table->getColumns() as $columnId => $columnTitle)
            <td>
                {!! $table->getColumnContent($item, $columnId, $loop->iteration, $loop->parent->iteration) !!}
            </td>
            @endforeach
        </tr>
        @endforeach
    @else
        <tr>
            <td colspan="{{ $table->getColumnsCount() }}">
                {!! $table->getNoItemsMessage() !!}
            </td>
        </tr>
    @endif
</tbody>
