<?php

namespace JennosGroup\Larables\Traits;

trait Columns
{
    /**
     * The visible table columns.
     *
     * These should be key => value pairs, with the key being an identifier for
     * the column, while the value being the column title.
     */
    protected array $columns = [];

    /**
     * Get the table columns.
     */
    public function getColumns(): array
    {
        $columns = $this->columns;

        if ($this->hasCheckbox()) {
            $columns = array_merge(['checkbox' => ''], $columns);
        }

        if ($this->hasActions()) {
            $columns = array_merge($columns, ['actions' => '']);
        }

        return $columns;
    }

    /**
     * Get the total number of visible columns.
     */
    public function getColumnsCount(): int
    {
        return count($this->getColumns());
    }
}
