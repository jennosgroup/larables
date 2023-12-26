<div {!! $table->getWrapperAttributesHtml() !!}>
    @if ($table->shouldDisplayTopBar())
        <div {!! $table->getTopBarContainerAttributesHtml() !!}>
            @include(Larables::viewsId().'::partials.top-bar')
        </div>
    @endif

    @include(Larables::viewsId().'::partials.table')

    @if ($table->shouldDisplayBottomBar())
        <div {!! $table->getBottomBarContainerAttributesHtml() !!}>
            @if ($table->shouldDisplayPagination())
                {!! $table->displayPagination() !!}
            @endif    
        </div>
    @endif
</div>
