<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class inputArea extends Component
{
    /**
     * Create a new component instance.
     */
    public $emotes;
    public function __construct($emotes)
    {
        $this->emotes = $emotes;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input-area');
    }
}
