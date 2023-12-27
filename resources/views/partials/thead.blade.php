<thead {!! $table->getTheadAttributesHtml() !!}>
    <tr {!! $table->getTheadTrAttributesHtml() !!}>
        @foreach ($table->getColumns() as $columnId => $title)
            <th {!! $table->getTheadThAttributesHtml($columnId, $loop->iteration) !!}>
                <div {!! $table->getColumnTitleContainerAttributesHtml() !!}>
                    <div {!! $table->getColumnTitleAttributesHtml() !!}>
                        {!! $table->getTitleForColumn($columnId, $title, $loop->iteration, 'head') !!}
                    </div>
                    @if ($table->isColumnSortable($columnId))
                        <button {!! $table->getSortButtonAttributesHtml() !!}>
                            @if ($table->getColumnOrderValue($columnId) == 'asc')
                                {!! $table->getDescSortIconHtml() !!}
                            @else
                                {!! $table->getAscSortIconHtml() !!}
                            @endif
                        </button>
                    @endif
                    <form style="display: none;" method="get">
                        @foreach ($table->getArgsForSortRequest($columnId) as $key => $value)
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endforeach
                    </form>
                </div>
            </th>
        @endforeach
    </tr>
</thead>
