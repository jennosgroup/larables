<tbody {!! $table->getTbodyAttributesHtml() !!}>
    @if ($table->hasData())
        @foreach ($table->getData() as $item)
            <tr {!! $table->getTbodyTrAttributesHtml($item, $loop->iteration) !!}>
                @foreach ($table->getColumns() as $columnId => $columnTitle)
                    <td {!! $table->getTbodyTdAttributesHtml($item, $columnId, $loop->iteration, $loop->parent->iteration) !!}>
                        {!! $table->getColumnContent($item, $columnId, $loop->iteration, $loop->parent->iteration) !!}
                    </td>
                @endforeach
            </tr>
        @endforeach
    @else
        <tr {!! $table->getTbodyTrNoItemsAttributesHtml() !!}>
            <td {!! $table->getTbodyTdNoItemsAttributesHtml() !!} colspan="{{ $table->getColumnsCount() }}">
                {!! $table->getNoItemsMessage() !!}
            </td>
        </tr>
    @endif
</tbody>
