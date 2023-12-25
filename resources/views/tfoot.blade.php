@if ($table->shouldDisplayTfoot())
    <tfoot {!! $table->getTfootAttributesHtml() !!}>
        <tr {!! $table->getTfootTrAttributesHtml() !!}>
            @foreach ($table->getColumns() as $columnId => $columnTitle)
                <th {!! $table->getTfootThAttributesHtml($columnId, $loop->iteration) !!}>
                    {!! $table->getColumnTitle($columnId, $columnTitle, $loop->iteration, 'foot') !!}
                </th>
            @endforeach
        </tr>
    </tfoot>
@endif
