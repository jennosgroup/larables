# Larables

## Table of Contents

1. [About](#about)
2. [Installation](#installation)
3. [Setup](#setup)
4. [Getting Started](#getting-started)
5. [Columns](#columns)
6. [Customizing Column Title](#customizing-column-title)
7. [Customizing Column Content](#customizing-column-content)
8. [Sorting Columns](#sorting-columns)
9. [Multiple Sorting](#multiple-sorting)
10. [Bulk Request and Checkbox](#bulk-request-and-checkbox)
11. [Items Per Page](#items-per-page)
12. [Search](#search)
13. [Row Actions](#row-actions)

### About

Larables is a laravel package that allows you to seemlessly generate html tables entirely using PHP classes.

### Installation

Install with composer via command `composer require jennosgroup/larables`.

### Setup

Publish the package assets with the artisan command `php artisan vendor:publish --tag=larables-assets`.

Then include the `larables.js` script in your html markup as features such as bulk request, per page options, searching and sorting columns relies on it.

`<script src="{{ asset('vendor/larables/js/larables.js') }}" defer></script>`

### Getting Started

NOTE:: If you are going to create numerous html tables across different pages of your site that will share similar styles and features, we highly recommend that you create an abstract class and let all your other tables extend it. This is because all configuration for the look and feel of the table is class based. Only the content that is unique to a current page should be defined in your page table class.

Create your table class and extend the `JennosGroup\Larables\Table` class. Then define a `baseQuery` method which should return an instance of the Eloquent Builder. 

```php
<?php

namespace App\Tables;

use App\Models\Post;
use JennosGroup\Larables\Table;

class PostsTable extends Table
{
    /**
     * The base query for the table.
     * 
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function baseQuery()
    {
        return Post::query();
    }
}
```

Then in your controller, create an instance of the table by calling the static `make` method and pass it to your view. 

```php
<?php

namespace App\Http\Controllers;

use App\Tables\PostsTable;

class PostController extends Controller
{
    /**
     * Render the view for the posts listing.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $table = PostsTable::make();
        return view('posts.index', compact('table'));
    }
}
```

In your view file, include the `larables::larables` partial view, which is already setup to render your table based on your class definitions. It's that simple! The `laratables::larables` partial view requires the table instance to be passed in a variable named `$table`.

```html
@extends('layouts.app')

@section('title', 'All Posts')

@section('content')
    @include(Larables::viewsId().'::larables')
@endsection
```

### Columns

Define a `$columns` array property on your table class, which accepts key value pairs as follow:

```php
protected array $columns = [
    'title' => 'Title',
    'post_status' => 'Status',
    'published_at' => 'Publish Date',
];
```

The array value is the column title. If you need something other than text as your column title, leave the value as null and [customize the title](#customizing-column-title).

The array key is the identifier for the column. If the key is the same name as the database column, the content will automatically be displayed. We can [customize the column content](#customizing-column-content), which means the key does not have to match the database column name.

### Customizing Column Title

Define a public method following the camelCase naming convention, `get{ColumnKey}ColumnTitle`, which accepts 3 parameters and should return a value.

```php
public function getPostStatusColumnTitle($columnTitle, $columnNumber, $columnPosition)
{
    return 'Post Status';
}
```

You can return html code as well, such as font awesome snippets - reminder that you will have to add the font awesome stylesheet to your document head for it to render.

### Customizing Column Content

Define a public method following the camelCase naming convention, `get{ColumnKey}ColumnContent`, which accepts 3 parameters and should return a value.

```php
public function getPostStatusColumnContent($model, $columnNumber, $rowNumber)
{
    if ($model->status == 'draft') {
        return 'Draft';
    }

    return 'Published';
}
```

### Sorting Columns

Define a `$sortColumns` array property. Add the keys for the columns that you want to be sortable.

```php
/**
 * The columns that are sortable.
 */
protected array $sortColumns = ['title', 'post_status'];
```

Once the sort key matches a database column, the package will automatically sort by asc then desc order when the sort button is clicked.

If you have a column key that does not match a database column, you will have to provide custom sorting for all the columns by defining a `handleSortQuery` method.

```php
/**
 * Handle the sort query.
 */
protected function handleSortQuery(array $columns): void
{
    foreach ($columns as $column => $order) {
        $this->getQuery()->orderBy(htmlspecialchars($column), $order);
    }
}
```

You have to do the sorting through the `$this->getQuery()->orderBy()` method.

By default, the sort and order key in the GET request are `sort_by` and `order` respectively. To change this, update the `$sortKey` and `$orderKey` properties.

```php
/**
 * The sort by key.
 */
protected string $sortKey = 'sort_by';

/**
 * The order key.
 */
protected string $orderKey = 'order';
```

If you want to change the icon for asc and desc sorting, override the `getAscSortIconHtml` and `getDescSortIconHtml` method.

```php
/**
 * Get the asc sort icon markup.
 */
public function getAscSortIconHtml(): string
{
    return 'svg icon';
}

/**
 * Get the desc sort icon markup.
 */
public function getDescSortIconHtml(): string
{
    return 'svg icon';
}
```

### Multiple Sorting

By default, only one column is sorted at a time. To enable multiple sorting, set the `$allowMultipleSorting` property to true.

```php
/**
 * Whether to allow multiple sorting.
 */
protected bool $allowMultipleSorting = true;
```

Note that this feature can potentially by resource consuming if you have a lot of data working with.

### Bulk Request and Checkbox

To enable bulk options, set the `$displayBulkOptions` and `$hasCheckbox` property to true.

```php
/**
 * Whether bulk options should be displayed.
 */
protected bool $displayBulkOptions = true;

/**
 * Indicate whether checkboxes should be enabled at the start of the columns.
 */
protected bool $hasCheckbox = true;
```

Then, within the `getBulkOptions` public method, we define the array of options required.

```php
public function getBulkOptions(): array
{
    return [
        [
            'value' => 'restore',
            'title' => 'Restore',
            'route' => route('posts.restore'),
            'request_type' => 'post',
        ],
        [
            'value' => 'delete',
            'title' => 'Delete Permanently',
            'route' => route('posts.destroy'),
            'request_type' => 'delete',
        ],
    ];
}
````

The bulk request will be fired off to the defined route with the request method specified in the `request_type` key.

By default, the value(s) of the bulk request is submitted in the `bulk_action` name field. To change this, update the value of the `$bulkActionKey` property.

NOTE:: You will have to intercept the value of the bulk request submitted and carry out your own validation and actions, then return back to the main page.

```php
/**
 * The key for the bulk action.
 */
protected string $bulkActionKey = 'bulk_action';
```

The values submitted with the bulk request will correspond to the `id` key of the model selected. To customize which model key is used, set the value of the `$checkboxIdField` property.

```php
/**
 * The name of the item field, that is used to set the checkbox value.
 */
protected string $checkboxIdField = 'uuid';
```

If you want to customize the model value passed to each checkbox, feel free to override the `getItemCheckboxValue` method.

```php
/**
 * Get the checkbox value for an individual item.
 */
public function getItemCheckboxValue(mixed $item): mixed
{
    if (isset($item->{$this->getCheckboxIdField()})) {
        return $item->{$this->getCheckboxIdField()};
    }

    if (isset($item[$this->getCheckboxIdField()])) {
        return $item[$this->getCheckboxIdField()];
    }

    return null;
}
```

You can determine if an individual row should have a checkbox. Define an `itemHasCheckbox` function and perform your logics in it.

```php
/**
 * Filter if the individual row item has a checkbox.
 */
public function itemHasCheckbox(mixed $model): bool
{
    if (Auth::user()->can('destroy', $model)) {
        return true;
    }
    return false;
}
```

### Items Per Page

On the first page load, the default number of items displayed is `15`. To change this, change the `$perPageTotal` property.

```php
/**
 * The default number of items to display per page.
 */
protected int $perPageTotal = 15;
```

To enable the option to select the number of items per page, set the `$displayPerPageOptions` property to true.

```php
/**
 * Whether we should display the total number of items per page options.
 */
protected bool $displayPerPageOptions = true;
```

To customize the number of items per page we can select, define a `getPerPageOptions` function that returns an array.

```php
/**
 * Get the per page options.
 */
public function getPerPageOptions(): array
{
    return [
        15 => 15,
        25 => 25,
        50 => 50,
        100 => 100,
        250 => 250,
    ];
}
```

### Search

To enable the search feature, set the `$displaySearch` property to true.

```php
/**
 * Should display the search field.
 */
protected bool $displaySearch = false;
```

Define a `$searchColumns` array property, which will contain the keys for the columns that should be searched.

```php
/**
 * The columns that are searchable.
 *
 * A column does not have to be visible to be searchable.
 */
protected array $searchColumns = ['title', 'post_status'];
```

If you have a column key that does not match a database column, you will have to define your own search criteria within the `handleSearchQuery` method.

```php
/**
 * Handle the search query.
 */
public function handleSearchQuery(mixed $value): void
{
    $this->getQuery()->where(function ($query) use ($value) {
        foreach ($this->getSearchColumns() as $index => $column) {
            if ($index == 0) {
                $query = $query->where(htmlspecialchars($column), 'like', '%'.$value.'%');
            } else {
                $query = $query->orWhere(htmlspecialchars($column), 'like', '%'.$value.'%');
            }
        }
    });
}
```

The search value is submitted in the `search` name field. To change this, alter the `$searchKey` property.

```php
/**
 * The search key.
 */
protected string $searchKey = 'search';`
```

If you want to change the look of the search icon, override the `getSearchIconHtml` method.

```php
/**
 * Get the search icon markup.
 */
public function getSearchIconHtml(): string
{
    return 'svg icon';
}
```

### Row Actions

To enable support for row actions, set the `$hasActions` property to true.

```php
/**
 * If we should automatically handle the actions column.
 */
protected bool $hasActions = true;
```

Next, we define the actions we need in the `$actions` array property.

```php
/**
 * The list of action types that is needed by default.
 */
protected array $actions = [
    'view' => [
        'route_name' => 'posts.view',
        'pass_model' => false, // defaults to true. This option is for us to pass the model to the route.
        'args' => null, // useful for get method but can be excluded. If this is given, it will be passed to the route instead of the model.
        'method' => 'post', // defaults to get
        'url' => 'https://github.com', // if an explicit url is given, no other arguments are taken into consideration.
    ],
    'edit' => [
        'route_name' => 'posts.edit',
        'method' => 'delete',
    ],
    'trash' => [
        'route_name' => 'posts.trash',
        'method' => 'delete',
    ],
];
```

There is a possibility that you may want the actions to be unique to the rows. You can put your logics in the `getItemActions` method.

```php
/**
 * Get the actions for an individual item.
 */
public function getItemActions(mixed $item): array
{
    $actions = $this->getActions();

    if (Auth::user()->cannot('trash', $item)) {
        unset($actions['trash']);
    }

    return $actions;
}
```

By default, the action is displayed as a link style. If you want it to display as a button, change the `$actionDisplayType` property.

```php
/**
 * The action display type.
 *
 * Accepts 'button' or 'link'.
 */
protected string $actionDisplayType = 'button';
```

By default, the action content type is displayed as text. If you want to change it to an icon, change the `$actionContentType` property.

```php
/**
 * The type of content for the action.
 *
 * Accepts 'text' or 'icon'.
 */
protected string $actionContentType = 'icon';
```

There are icons by default for view, edit, trash, restore and delete actions. If you have another action apart from these, you can return the markup for an icon through a dynamic method with naming `get{ActionName)ActionIconHtml`. Let's use a download icon for example.

```php
/**
 * Get the action icon markup for the download action.
 */
public function getDownloadActionIconHtml(string $action): ?string
{
    return 'some icon html code';
}
```

### Active and Trash Section Icon

To turn on the active and trash section icon, set the `$displayActiveSection` and `$displayTrashSection` property to true.

```php
/**
 * Whether to display the active section.
 */
protected bool $displayActiveSection = true;

/**
 * Whether to display the active section.
 */
protected bool $displayTrashSection = true;
```

Once you have the active and trash section icon turned on, you have to make it known the route for the active and trash section, defined in the following `getActiveSectionRoute` and `getTrashSectionRoute` methods.

```php
/**
 * Get the route for the trash section.
 */
public function getActiveSectionRoute(): string
{
    return route('posts.index', ['section' => 'active']);
}

/**
 * Get the route for the trash section.
 */
public function getTrashSectionRoute(): string
{
    return return route('posts.index', ['section' => 'trash']);
}
```

If you notice, the key that holds the section value is defaulted to `section`. To change this, change the value of the `$sectionKey` property.

```php
/**
 * The key for the section used in the $_GET request..
 */
protected string $sectionKey = 'section';
```

Lastly, the system has to know which section is currently active. You can do this by changing the value of the `$currentSection` property.

```php
/**
 * The section that is current. 'active' and 'trash' is reserved by us.
 */
protected string $currentSection = 'active';
```

You can change the icons for both section by overriding the `getActiveSectionIconHtml` and `getTrashSectionIconHtml` method respectively.

```php
/**
 * Get the active section image markup.
 */
public function getActiveSectionIconHtml(): string
{
    return 'svg icon';
}

public function getTrashSectionIconHtml(): string
{
    return 'svg icon';
}
```

### Table Footer

By default, the table footer is not displayed. To turn it on, set the `displayTfoot` property to true.

```php
protected bool $displayTfoot = true;
```

### Miscellaneous

If there are no items to display for the table, by default, a `There is nothing to display.` message will appear. To customize this, define the following on your class and change it.

```php
/**
 * The no items message.
 */
protected string $noItemMessage = 'There is nothing to display.';
```

OR define a `getNoItemMessage` public function - this takes precedence.

```php
/**
 * Get the no items message.
 */
public function getNoItemMessage(): string
{
    return $this->noItemMessage;
}
```
