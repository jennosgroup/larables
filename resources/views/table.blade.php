<table {!! $table->getTableAttributesHtml() !!}>
    @include(Larables::viewsId().'::thead')
    @include(Larables::viewsId().'::tbody')
    @include(Larables::viewsId().'::tfoot')
</table>
