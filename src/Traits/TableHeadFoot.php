<?php

namespace JennosGroup\Larables\Traits;

use Illuminate\Support\Str;

Trait TableHeadFoot
{
    /**
     * Indicate whether the table footer should be displayed.
     */
    protected bool $displayTfoot = false;

    /**
     * Check if we should display the table footer.
     */
    public function shouldDisplayTfoot(): bool
    {
        return $this->displayTfoot;
    }

    /**
     * Get the column th title.
     */
    public function getColumnTitle(string $columnId, string $columnTitle = null, int $columnNumber, string $position): ?string
    {
        // Allows filtering the title of a specific column
        if (method_exists($this, $method = 'filter'.Str::studly($columnId).'ColumnTitle')) {
            return $this->$method($columnTitle, $columnNumber, $position);
        }

        // Allow general filtering for all columns
        if (method_exists($this, $method = 'filterColumnTitle')) {
            return $this->$method($columnId, $columnTitle, $columnNumber, $position);
        }

        return $this->output($columnTitle);
    }
}
