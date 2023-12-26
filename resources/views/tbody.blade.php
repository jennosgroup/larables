<tbody {!! $table->getTbodyAttributesHtml() !!}>
    @if ($table->hasData())
        @foreach ($table->getData() as $item)
            <tr {!! $table->getTbodyTrAttributesHtml($item, $loop->iteration) !!}>
                @foreach ($table->getColumns() as $columnId => $columnTitle)
                    <td {!! $table->getTbodyTdAttributesHtml($item, $columnId, $loop->iteration, $loop->parent->iteration) !!}>
                        {!! $table->getContentForColumn($item, $columnId, $loop->iteration, $loop->parent->iteration) !!}
                    </td>
                @endforeach
            </tr>
        @endforeach
    @else
        <tr {!! $table->getTbodyTrNoItemAttributesHtml() !!}>
            <td {!! $table->getTbodyTdNoItemAttributesHtml() !!} colspan="{{ $table->getColumnsCount() }}">
                {!! $table->getNoItemMessage() !!}
            </td>
        </tr>
    @endif
</tbody>
