<?php

namespace JennosGroup\Larables;

use Illuminate\Cache\ArrayStore;

abstract class Table
{
    use Traits\Actions,
    Traits\BulkOptions,
    Traits\Checkbox,
    Traits\Columns,
    Traits\Data,
    Traits\Id,
    Traits\Paginate,
    Traits\Query,
    Traits\Sanitize,
    Traits\Search,
    Traits\Sections,
    Traits\Sort,
    Traits\TableBody,
    Traits\TableHeadFoot,
    Traits\UrlQuery;

    /**
     * The cache store.
     */
    protected ArrayStore $cache;

    /**
     * Create an instance of the class.
     */
    public function __construct()
    {
        $this->cache = new ArrayStore;
        $this->url = new Url(url()->full());
        $this->id = $this->makeId();
    }

    /**
     * Make an instance of the table.
     */
    public static function make(): self
    {
        $table = new static;

        if ($table->hasSearchRequest()) {
            $table->handleSearchRequest();
        }

        if ($table->hasSortRequest()) {
            $table->handleSortRequest();
        }

        return $table;
    }
}
