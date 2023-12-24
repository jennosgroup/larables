<?php

namespace JennosGroup\Laratables\Traits;

trait BulkOptions
{
    /**
     * Whether bulk options should be displayed.
     */
    protected bool $displayBulkOptions = false;

    /**
     * The key for the bulk action.
     */
    protected string $bulkActionKey = 'bulk_action';

    /**
     * Whether bulk options should be displayed.
     */
    public function shouldDisplayBulkOptions(): bool
    {
        return $this->displayBulkOptions;
    }

    /**
     * Get the bulk action key.
     */
    public function getBulkActionKey(): string
    {
        return $this->bulkActionKey;
    }

    /**
     * Get the bulk options.
     *
     * Expected results is an array of associated arrays i.e:
     * [
     *      'value' => 'trash',
     *      'title' => 'Trash',
     *      'route' => route('users.index'),
     *      'request_type' => 'post',
     * ]
     *
     * Only value and title are required.
     * Route and request type is only needed if you want us to fire off the bulk request.
     *
     * The 'route' will contain the route that the request should be fired off to.
     * The 'request_type' will contain the request method.
     */
    public function getBulkOptions(): array
    {
        return [];
    }
}
