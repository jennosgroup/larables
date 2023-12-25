<?php

namespace JennosGroup\Larables\Traits;

trait ElementAttributes
{
    /**
     * The elements attributes.
     */
    protected array $elementAttributes = [
        'table' => [],
        'thead' => [],
        'thead_tr' => [],
        'thead_th' => [],
        'tbody' => [],
        'tbody_tr' => [],
        'tbody_td' => [],
        'tfoot' => [],
        'tfoot_tr' => [],
        'tfoot_th' => [],
        'table_tr' => [],
        'table_th' => [],
        'tbody_tr_no_items' => [],
        'tbody_td_no_items' => [],
    ];

    /**
     * Get the element attributes.
     */
    public function getElementAttributes(string $element): array
    {
        $attributes = [];
        $elements = func_get_args();
        
        foreach ($elements as $element) {
            foreach ($this->elementAttributes[$element] ?? [] as $attribute => $value) {
                $attributes[$attribute][] = $value;
            }
        }

        return $attributes;
    }

    /**
     * Merge a list of attributes.
     */
    public function mergeAttributes(array $primary, array $secondary): array
    {
        foreach ($secondary as $attribute => $value) {
            $primary[$attribute] = implode(
                ' ', array_unique(array_merge($primary[$attribute] ?? [], $value))
            );
        }

        return $primary;
    }

	/**
     * Parse a list of attributes for output as one string.
     */
    public function parseAttributesToString(array $attributes): string
    {
        $results = [];

        foreach ($attributes as $attribute => $value) {
            $results[] = $this->parseAttributeToString($attribute, $value);
        }

        return implode(' ', $results);
    }

    /**
     * Parse an attribute pair for output.
     */
    public function parseAttributeToString(string $attribute, $value): string
    {
        if (is_array($value)) {
            $value = implode(' ', array_unique($value));
        } else {
            $value = implode(' ', array_unique(explode(' ', $value)));
        }

        return $attribute."='".$value."'";
    }
}
