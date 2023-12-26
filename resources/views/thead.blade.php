<thead {!! $table->getTheadAttributesHtml() !!}>
    <tr {!! $table->getTheadTrAttributesHtml() !!}>
        @foreach ($table->getColumns() as $columnId => $title)
            <th {!! $table->getTheadThAttributesHtml($columnId, $loop->iteration) !!}>
                {!! $table->getTitleForColumn($columnId, $title, $loop->iteration, 'head') !!}
            </th>
        @endforeach
    </tr>
</thead>
