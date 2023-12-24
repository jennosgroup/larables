<thead>
    <tr>
        @foreach ($table->getColumns() as $columnId => $title)
        <th>
            {!! $table->getColumnTitle($columnId, $title, $loop->iteration, 'head') !!}
        </th>
        @endforeach
    </tr>
</thead>
