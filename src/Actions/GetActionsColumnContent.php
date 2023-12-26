<?php

namespace JennosGroup\Larables\Actions;

use Illuminate\Database\Eloquent\Model;
use JennosGroup\Larables\Larables;
use JennosGroup\Larables\Table;

class GetActionsColumnContent
{
	/**
	 * Get the actions column content.
	 */
	public static function execute(mixed $item, Table $table): string
	{
		$content = "<div ".$table->getActionContainerAttributesHtml($item).">";

        foreach ($table->getItemActions($item) as $action => $data) {

            $url = null;
            $route = $data['route'] ?? null;
            $routeName = $data['route_name'] ?? null;
            $passModel = $data['pass_model'] ?? true;
            $args = $data['args'] ?? null;
            $method = $data['method'] ?? 'get';

            if (! is_null($route)) {
                $url = $route;
            } else if (! is_null($routeName)) {
                if (! is_null($args)) {
                    $url = route($routeName, $args);
                } else if ($passModel && $item instanceof Model) {
                    $url = route($routeName, $item);
                } else {
                    $url = route($routeName);
                }
            }

            $options = [
                'route' => $url,
                'method' => strtolower($method),
                'action' => $action,
                'table' => $table,
                'item' => $item,
            ];

            if ($table->getActionDisplayType() == 'button') {
	            $content .= view(Larables::viewsId().'::partials.action-button', $options);
	        } else {
	        	$content .= view(Larables::viewsId().'::partials.action-link', $options);
	        }
        }

        $content .= "</div>";

        return $content;
	}
}
