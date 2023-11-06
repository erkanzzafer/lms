<?php

namespace App\Livewire;

use Livewire\Component;

class Deneme extends Component
{
    public $butonName="asd";
    public $butonName2="";
    public function render()
    {
        return view('livewire.deneme');
    }

    public function deneme(){
        $this->butonName2="ASD";

    }
}
