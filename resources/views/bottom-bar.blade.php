@if ($table->shouldDisplayBottomBar())
    <div {!! $table->getBottomBarContainerAttributesHtml() !!}>
        {!! $table->displayPagination() !!}   
    </div>
@endif
