<?php

namespace JennosGroup\Larables\Actions;

use JennosGroup\Larables\Table;

class GetCheckboxColumnContent
{
	/**
	 * Get the checkbox column title.
	 */
	public static function execute(mixed $item, Table $table): string
	{
		if (! $table->itemHasCheckbox($item)) {
			return '';
		}

		$containerAttributes = $table->getCheckboxChildContainerAttributesHtml();

        $checkboxAttributes = $table->getCheckboxInputChildAttributesHtml($item);

        $content = "<div ".$containerAttributes.">";
        $content .= "<input ".$checkboxAttributes.">";
        $content .= "</div>";

        return $content;
	}
}
