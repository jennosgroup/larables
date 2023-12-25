<?php

namespace JennosGroup\Larables\Traits;

use Illuminate\Support\Str;

trait AttributesHtml
{
	/**
	 * Get the table attributes html.
	 */
	public function getTableAttributesHtml(): string
	{
		$attributes = $this->getElementAttributes('table');

		if (method_exists($this, $method = 'filterTableAttributes')) {
			$attributes = $this->$method($attributes);
		}

		return $this->parseAttributesToString($attributes);
	}

	/**
	 * Get the thead attributes html.
	 */
	public function getTheadAttributesHtml(): string
	{
		$attributes = $this->getElementAttributes('thead');

		if (method_exists($this, $method = 'filterTheadAttributes')) {
			$attributes = $this->$method($attributes);
		}

		return $this->parseAttributesToString($attributes);
	}

	/**
	 * Get the thead tr attributes html.
	 */
	public function getTheadTrAttributesHtml(): string
	{
		$tableTrAttributes = $this->getElementAttributes('table_tr');
		$theadTrAttributes = $this->getElementAttributes('thead_tr');

		if (method_exists($this, $method = 'filterTableTrAttributes')) {
			$tableTrAttributes = $this->$method($tableTrAttributes);
		}

		$attributes = $this->mergeAttributes($theadTrAttributes, $tableTrAttributes);

		if (method_exists($this, $method = 'filterTheadTrAttributes')) {
			$attributes = $this->$method($attributes);
		}

		return $this->parseAttributesToString($attributes);
	}

	/**
	 * Get the thead th attributes html.
	 */
	public function getTheadThAttributesHtml(string $columnId, int $columnNumber): string
	{
		$tableThAttributes = $this->getElementAttributes('table_th');
		$theadThAttributes = $this->getElementAttributes('thead_th');

		if (method_exists($this, $method = 'filterTableThAttributes')) {
			$tableThAttributes = $this->$method($tableThAttributes, $columnId, $columnNumber);
		}

		$attributes = $this->mergeAttributes($theadThAttributes, $tableThAttributes);

		if (method_exists($this, $method = 'filterTheadThAttributes')) {
			$attributes = $this->$method($attributes, $columnId, $columnNumber);
		}

		if (method_exists($this, $method = 'filter'.Str::studly($columnId).'TheadThAttributes')) {
			$attributes = $this->$method($attributes, $columnNumber);
		}

		return $this->parseAttributesToString($attributes);
	}

	/**
	 * Get the tbody attributes html.
	 */
	public function getTbodyAttributesHtml(): string
	{
		$method = 'filterTbodyAttributes';
		$attributes = $this->getElementAttributes('tbody');

		if (method_exists($this, $method)) {
			$attributes = $this->$method($attributes);
		}

		return $this->parseAttributesToString($attributes);
	}

	/**
	 * Get tbody tr attributes.
	 */
	public function getTbodyTrAttributesHtml(mixed $item, int $rowNumber): string
	{
		$tbodyTrAttributes = $this->getElementAttributes('tbody_tr');
		$tableTrAttributes = $this->getElementAttributes('table_tr');

		if (method_exists($this, $method = 'filterTableTrAttributes')) {
			$tableTrAttributes = $this->$method($tableTrAttributes);
		}

		$attributes = $this->mergeAttributes($tbodyTrAttributes, $tableTrAttributes);

		if (method_exists($this, $method = 'filterTbodyTrAttributes')) {
			$attributes = $this->$method($attributes);
		}

		return $this->parseAttributesToString($attributes);
	}

	/**
	 * Get the tbody td attributes html.
	 */
	public function getTbodyTdAttributesHtml(mixed $item, string $columnId, int $columnNumber, int $rowNumber): string
	{
		$attributes = $this->getElementAttributes('tbody_td');

		if (method_exists($this, $method = 'filterTbodyTdAttributes')) {
			$attributes = $this->$method($attributes, $item, $columnId, $columnNumber, $rowNumber);
		}

		if (method_exists($this, $method = 'filter'.Str::studly($columnId).'TbodyTdAttributes')) {
			$attributes = $this->$method($attributes, $item, $columnNumber, $rowNumber);
		}

		return $this->parseAttributesToString($attributes);
	}

	/**
	 * Get the tbody tr no items attributes html.
	 */
	public function getTbodyTrNoItemsAttributesHtml(): string
	{
		$tableTrAttributes = $this->getElementAttributes('table_tr');
		$tbodyTrattributes = $this->getElementAttributes('tbody_tr');
		$noItemsAttributes = $this->getElementAttributes('tbody_tr_no_items');

		if (method_exists($this, $method = 'filterTableTrAttributes')) {
			$tableTrAttributes = $this->$method($tableTrAttributes);
		}

		if (method_exists($this, $method = 'filterTbodyTrAttributes')) {
			$tbodyTrAttributes = $this->$method($tbodyTrAttributes);
		}

		$attributes = $this->mergeAttributes($tbodyTrAttributes, $tableTrAttributes);
		$attributes = $this->mergeAttributes($attributes, $noitemsttributes);

		if (method_exists($this, $method = 'filterTbodyTrNoItemsAttributes')) {
			$attributes = $this->$method($attributes);
		}

		return $this->parseAttributesToString($attributes);
	}

	/**
	 * Get the tbody td no items attributes html.
	 */
	public function getTbodyTdNoItemsAttributesHtml(): string
	{
		$tbodyTdAttributes = $this->getElementAttributes('tbody_td');
		$noItemsAttributes = $this->getElementAttributes('tbody_td_no_items');

		if (method_exists($this, $method = 'filterTbodyTdAttributes')) {
			$tbodyTdAttributes = $this->$method($tbodyTdAttributes);
		}

		$attributes = $this->mergeAttributes($tbodyTdAttributes, $noItemsAttributes);

		if (method_exists($this, $method = 'filterTbodyTdNoItemsAttributes')) {
			$attributes = $this->$method($attributes);
		}

		if (array_key_exists('colspan', $attributes)) {
			unset($attributes['colspan']);
		}

		return $this->parseAttributesToString($attributes);
	}

	/**
	 * Get the tfoot attributes html.
	 */
	public function getTfootAttributesHtml(): string
	{
		$attributes = $this->getElementAttributes('tfoot');

		if (method_exists($this, $method = 'filterTfootAttributes')) {
			$attributes = $this->$method($attributes);
		}

		return $this->parseAttributesToString($attributes);
	}

	/**
	 * Get the tfoot tr attributes html.
	 */
	public function getTfootTrAttributesHtml(): string
	{
		$tableTrAttributes = $this->getElementAttributes('table_tr');
		$tfootTrAttributes = $this->getElementAttributes('tfoot_tr');

		if (method_exists($this, $method = 'filterTableTrAttributes')) {
			$tableTrAttributes = $this->$method($tableTrAttributes);
		}

		$attributes = $this->mergeAttributes($tableTrAttributes, $tfootTrAttributes);

		if (method_exists($this, $method = 'filterTfootTrAttributes')) {
			$attributes = $this->$method($attributes);
		}

		return $this->parseAttributesToString($attributes);
	}

	/**
	 * Get the tfoot th attributes html.
	 */
	public function getTfootThAttributesHtml(string $columnId, int $columnNumber): string
	{
		$tableThAttributes = $this->getElementAttributes('table_th');
		$tfootThAttributes = $this->getElementAttributes('tfoot_th');

		if (method_exists($this, $method = 'filterTableThAttributes')) {
			$tableThAttributes = $this->$method($tableThAttributes, $columnId, $columnNumber);
		}

		$attributes = $this->mergeAttributes($tfootThAttributes, $tableThAttributes);

		if (method_exists($this, $method = 'filterTfootThAttributes')) {
			$attributes = $this->$method($attributes, $columnId, $columnNumber);
		}

		if (method_exists($this, $method = 'filter'.Str::studly($columnId).'TfootThAttributes')) {
			$attributes = $this->$method($attributes, $columnNumber);
		}

		return $this->parseAttributesToString($attributes);
	}
}
