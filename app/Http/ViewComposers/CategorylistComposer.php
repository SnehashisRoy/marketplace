<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;


class CategorylistComposer
{
	/**
	 * Bind data to the view.
	 *
	 * @param  View  $view
	 * @return void
	 */
	public function compose(View $view)
	{
	    $view->with('categories', \App\Category::all());
	}
}
   