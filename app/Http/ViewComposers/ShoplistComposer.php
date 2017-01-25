<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;


class ShoplistComposer
{
	/**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
         $view->with('users', \App\User::all());
    }
}
	