<button {!! $table->getActionButtonAttributesHtml($action, $item) !!}>
    @include(Larables::viewsId().'::partials.action-content')
</button>
