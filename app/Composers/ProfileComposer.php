<?php

namespace App\Composers;

use Illuminate\View\View;

class ProfileComposer
{
    /**
     * Create a new profile composer.
     */
    public function __construct()
    {
    }

    /**
     * Bind data to the view.
     */
    public function compose(View $view)
    {
        $view->with('hsname', 'Hussein Saad, from composer');
    }
}
