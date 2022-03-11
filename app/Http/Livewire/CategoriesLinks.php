<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CategoriesLinks extends Component {

    public $category;

    public function mount() {
        $this->category = request()->category;
    }

    public function setCategory($category) {
        $this->category = $category;
        $this->emit('queryStringUpdatedCategory', $this->category);
    }

    public function render() {
        return view('livewire.categories-links');
    }
}
