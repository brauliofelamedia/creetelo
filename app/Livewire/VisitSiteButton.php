<?php

namespace App\Livewire;

use Livewire\Component;

class VisitSiteButton extends Component
{
    public function visitSite()
    {
        return redirect()->route('front.home');
    }
    
    public function render()
    {
        return view('livewire.visit-site-button');
    }
}
