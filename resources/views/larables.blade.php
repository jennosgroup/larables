<div {!! $table->getWrapperAttributesHtml() !!}>
    <div {!! $table->getTopBarContainerAttributesHtml() !!}>
        @include(Larables::viewsId().'::partials.top-bar')
    </div>

    @include(Larables::viewsId().'::partials.table')

    <div {!! $table->getBottomBarContainerAttributesHtml() !!}>
        @if ($table->shouldDisplayPagination())
            {!! $table->displayPagination() !!}
        @endif    
    </div>
</div>
