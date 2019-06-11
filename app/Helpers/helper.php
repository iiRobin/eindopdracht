<?php

use Illuminate\Support\Collection;
use Illuminate\Support\HtmlString;
use Illuminate\Pagination\Paginator;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Pagination\Paginator as PaginatorContract;

/**
 * Store flash message in session of user.
 *
 * @param string 	$message 	The message to be flashed.
 * @param string 	$class 		Class/style for messagebox.
 */
function setMessage($message, $class)
{
	Session::flash('message', $message);
	Session::flash('message_class', $class);
}

/**
 * Get flash message from session.
 *
 * @return void 	...			...
 */
function getMessage()
{
	// Get additional alert class.
	$class = Session::has('message_class') ? ' uk-alert-' . Session::get('message_class') : '';

	// Build alert box.
	$html  = '<div class="uk-alert' . $class . ' uk-text-center uk-text-large">';
	$html .= Session::get('message') . '</div>';

	return $html;
}

/**
 * Check for a message in the session.
 *
 * @return void 	...			...
 */
function hasMessage()
{
	return Session::has('message');
}

/**
  * Paginate items in a collection.
  *
  * @param array|Collection      $items
  * @param int   $perPage
  * @param int  $page
  * @param array $options
  *
  * @return LengthAwarePaginator
  */
function paginate($items, $perPage = 15, $page = null, $options = [])
{
		$page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
		$items = $items instanceof Collection ? $items : Collection::make($items);
		return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
}
