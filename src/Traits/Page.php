<?php

namespace JennosGroup\Larables\Traits;

use Illuminate\Pagination\LengthAwarePaginator;

trait Page
{
	/**
	 * Whether we should display the top bar.
	 */
	protected bool $displayTopBar = true;

	/**
	 * Whether we should display the bottom bar.
	 */
	protected bool $displayBottomBar = true;

	/**
	 * Check if we should display the top bar.
	 */
	public function shouldDisplayTopBar(): bool
	{
		if (
			! $this->displayBulkOptions
			&& ! $this->displayPerPageOptions
			&& ! $this->displaySearch
			&& ! $this->displayActiveSection
			&& ! $this->displayTrashSection
		) {
			return false;
		}

		return $this->displayTopBar;
	}

	/**
	 * Whether we should display the bottom bar.
	 */
	public function shouldDisplayBottomBar(): bool
	{
		if (! $this->hasData()) {
			return false;
		}

		$data = $this->getData();

		if (! $data instanceof LengthAwarePaginator) {
			return $this->displayBottomBar;
		}

		return $data->currentPage() != $data->lastPage();
	}
}
