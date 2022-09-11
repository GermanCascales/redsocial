<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\FavoriteCategories;
use Livewire\Component;

class CategoriesLinks extends Component {

    public $selectedCategory;
    public $categories = [];

    protected $listeners = ['update_category_link'];

    public function mount() {
        $this->selectedCategory = request()->category;

        $favoriteCategories = FavoriteCategories::firstWhere(['user_id' => auth()->id(), 'team_id' => auth()->user()->currentTeam->id]);
        if ($favoriteCategories) {
            $categoriesIds = explode(',', $favoriteCategories->categories);
            $this->categories = Category::whereIn('id', $categoriesIds)->orderBy('name')->get();
        }
    }

    public function setCategory($category) {
        $this->selectedCategory = $category;
        $this->emit('queryStringUpdatedCategory', $this->selectedCategory);
    }

    public function update_category_link($category) {
        $this->selectedCategory = $category;
    }

    public function render() {
        return view('livewire.categories-links');
    }
}
