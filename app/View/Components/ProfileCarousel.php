<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Collection;

class ProfileCarousel extends Component
{
    public function __construct(
        public string $id,
        public Collection $movies,
        public string $empty,
        public mixed $subtitleCallback = null,
    ) {}

    public function render()
    {
        return view('profile.profile-carousel');
    }
}
