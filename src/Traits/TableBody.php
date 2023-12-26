<?php

namespace JennosGroup\Larables\Traits;

use Illuminate\Support\Str;

Trait TableBody
{
    /**
     * The no items message.
     */
    protected string $noItemMessage = 'There is nothing to display.';

    /**
     * Get the no items message.
     */
    public function getNoItemMessage(): string
    {
        return $this->noItemMessage;
    }

    /**
     * Get the row content.
     */
    public function getContentForColumn(mixed $item, string $columnId, int $columnNumber, int $rowNumber): ?string
    {
        if (method_exists($this, $method = 'get'.Str::studly($columnId).'ColumnContent')) {
            return $this->$method($item, $columnNumber, $rowNumber);
        }

        if (method_exists($this, $method = 'getColumnContent')) {
            return $this->$method($item, $columnId, $columnNumber, $rowNumber);
        }

        return $item->{$columnId}
            ? $this->output($item->{$columnId})
            : ($item[$columnId] ? $this->output($item[$columnId]) : null);
    }
}
