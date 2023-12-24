<tfoot>
    <tr>
        @foreach ($table->getColumns() as $columnId => $columnTitle)
        <th>
            {!! $table->getColumnTitle($columnId, $columnTitle, $loop->iteration, 'foot') !!}
        </th>
        @endforeach
    </tr>
</tfoot>
