<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;
use Livewire\Component;

class CategoriesCreate extends Component {

    public $team, $category;
    public $categories;

    public function mount() {
        $this->categories = $this->team->categories;
    }

    public function createCategory() {
        $this->validate([
            'category' => ['required', Rule::unique('categories', 'name')->where(fn ($query) => $query->where('team_id', $this->team->id))]
        ]);

        Category::create([
            'name' => $this->category,
            'team_id' => $this->team->id
        ]);

        $this->categories = $this->team->categories;

        $this->emit('saved');
    }

    public function render() {
        return view('livewire.categories-create');
    }
}
