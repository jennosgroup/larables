<div {!! $table->getWrapperAttributesHtml() !!}>
    @include(Larables::viewsId().'::top-bar')
    @include(Larables::viewsId().'::table')
    @include(Larables::viewsId().'::bottom-bar')
</div>
