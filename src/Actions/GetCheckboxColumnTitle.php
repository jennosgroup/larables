<?php

namespace JennosGroup\Larables\Actions;

use JennosGroup\Larables\Table;

class GetCheckboxColumnTitle
{
	/**
	 * Get the checkbox column title.
	 */
	public static function execute(string $position, Table $table): string
	{
		$containerAttributes = $table->getCheckboxParentContainerAttributesHtml();

        $checkboxAttributes = $table->getCheckboxInputParentAttributesHtml();

        $content = "<div ".$containerAttributes.">";
        $content .= "<input ".$checkboxAttributes.">";
        $content .= "</div>";

        return $content;
	}
}
