<?php

namespace JennosGroup\Larables\Traits;

trait AttributesHtml
{
	/**
	 * Get the table attributes html.
	 */
	public function getTableAttributesHtml(): string
	{
		$attributes = $this->getElementAttributes('table');
		return $this->parseAttributesToString($attributes);
	}

	/**
	 * Get the thead attributes html.
	 */
	public function getTheadAttributesHtml(): string
	{
		$attributes = $this->getElementAttributes('thead');
		return $this->parseAttributesToString($attributes);
	}

	public function getTheadTrAttributesHtml(): string
	{
		$attributes = $this->getElementAttributes('thead_tr');
		return $this->parseAttributesToString($attributes);
	}

	public function getTheadThAttributesHtml(string $columnId, int $columnNumber): string
	{
		$attributes = $this->getElementAttributes('thead_th', 'table_th');
		return $this->parseAttributesToString($attributes);
	}

	public function getTbodyAttributesHtml(): string
	{
		$attributes = $this->getElementAttributes('tbody');
		return $this->parseAttributesToString($attributes);
	}

	public function getTbodyTrAttributesHtml(mixed $item, int $rowNumber): string
	{
		$attributes = $this->getElementAttributes('tbody_tr', 'table_tr');
		return $this->parseAttributesToString($attributes);
	}

	public function getTbodyTdAttributesHtml(mixed $item, string $columnId, int $columnNumber, int $rowNumber): string
	{
		$attributes = $this->getElementAttributes('tbody_td');
		return $this->parseAttributesToString($attributes);
	}

	public function getTbodyTrNoItemsAttributesHtml(): string
	{
		$attributes = $this->getElementAttributes('tbody_tr', 'table_tr');
		return $this->parseAttributesToString($attributes);
	}

	public function getTbodyTdNoItemsAttributesHtml(): string
	{
		$attributes = $this->getElementAttributes('tbody_td');
		return $this->parseAttributesToString($attributes);
	}

	public function getTfootAttributesHtml(): string
	{
		$attributes = $this->getElementAttributes('tfoot');
		return $this->parseAttributesToString($attributes);
	}

	public function getTfootTrAttributesHtml(): string
	{
		$attributes = $this->getElementAttributes('tfoot_tr');
		return $this->parseAttributesToString($attributes);
	}

	public function getTfootThAttributesHtml(string $columnId, int $columnNumber): string
	{
		$attributes = $this->getElementAttributes('tfoot_th', 'table_th');
		return $this->parseAttributesToString($attributes);
	}
}
