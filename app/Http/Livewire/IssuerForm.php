<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Issuer;

class IssuerForm extends Component
{
    public function render()
    {
        $data = [
            'title' => 'Issuer',
            'issuers' => Issuer::with(['badges' => function($q){
                $q->withCount('awarded');
            }])->paginate(),
        ];
        return view('livewire.issuer-form', $data)
        ->layout('layouts.app');
    }
}
