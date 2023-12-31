<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AppLayout extends Component
{
    public $title;
    public function __construct($title = 'My Blog')
    {
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $categories = \App\Models\Category::query()
            ->select('name', 'slug')
            ->whereHas('articles')
            ->get();
        return view('layouts.app', compact('categories'));
    }
}
