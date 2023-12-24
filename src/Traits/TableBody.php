<?php

namespace JennosGroup\Laratables\Traits;

use Illuminate\Support\Str;

Trait TableBody
{
    /**
     * The no items message.
     */
    protected string $noItemsMessage = 'There is nothing to display.';

    /**
     * Get the no items message.
     */
    public function getNoItemsMessage(): string
    {
        return $this->noItemsMessage;
    }

    /**
     * Get the row content.
     */
    public function getColumnContent(mixed $item, string $columnId, int $columnNumber, int $rowNumber): ?string
    {
        // Allows filtering of a specific column content
        if (method_exists($this, $method = 'filter'.Str::studly($columnId).'ColumnContent')) {
            return $this->$method($item, $columnNumber, $rowNumber);
        }

        // Allows filtering of any column
        if (method_exists($this, $method = 'filterColumnContent')) {
            return $this->$method($item, $columnId, $columnNumber, $rowNumber);
        }

        return $item->{$columnId}
            ? $this->output($item->{$columnId})
            : ($item[$columnId] ? $this->output($item[$columnId]) : null);
    }
}
