<table {!! $table->getTableAttributesHtml() !!}>
    @include(Larables::viewsId().'::partials.thead')
    @include(Larables::viewsId().'::partials.tbody')
    @include(Larables::viewsId().'::partials.tfoot')
</table>
