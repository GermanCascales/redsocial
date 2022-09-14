<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class SearchUsers extends Component {
    public $search;
    public $showResults = false;
    public $results = [];

    public function updatedSearch() { // se lanza al modificarse la variable $search
        $this->results = User::when(strlen($this->search) >= 2, function($query) {
            return $query->where('name', 'like', '%'.$this->search.'%')->orderBy('name', 'asc')->take(5)->get();
        }, function() {
            return collect();
        });

        $this->showResults = count($this->results) > 0;
    }

    public function render() {
        return view('livewire.search-users');
    }
}