<?php

namespace Takshak\Ametas\View\Components\Ametas;

use Illuminate\View\Component;
use Illuminate\Support\Facades\View;

class AdminSidebarLinks extends Component
{
    public function __construct()
    {
    }

    public function render()
    {
        return View::first([
            'components.ametas.admin-sidebar-links',
            'ametas::components.ametas.admin-sidebar-links'
        ]);
    }
}
