<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CategoriesLinks extends Component {

    public $category;

    protected $queryString = ['category'];

    public function render() {
        return view('livewire.categories-links');
    }
}
