<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class fetchConvesations extends Component
{
    /**
     * Create a new component instance.
     */
    public $chats;
    public $userId;
    public function __construct($chats, $userId)
    {
        $this->chats = $chats;
        $this->userId = $userId;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.fetch-convesations');
    }
}
