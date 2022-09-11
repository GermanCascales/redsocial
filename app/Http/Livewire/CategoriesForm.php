<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\FavoriteCategories;
use Livewire\Component;

class CategoriesForm extends Component {
    public $selectedCategories = [];

    protected $rules = [
        'selectedCategories' => 'max:5'
    ];

    public function mount() {
        $favoriteCategories = FavoriteCategories::firstWhere(['user_id' => auth()->id(), 'team_id' => auth()->user()->currentTeam->id]);
        if ($favoriteCategories) {
            $this->selectedCategories = explode(',', $favoriteCategories->categories);
        }
    }

    public function updateCategories() {
        $this->validate();

        FavoriteCategories::updateOrCreate(['user_id' => auth()->id(), 'team_id' => auth()->user()->currentTeam->id],
                                           ['categories' => implode(',', $this->selectedCategories)]);

        $this->emit('saved');
    }

    public function render() {
        return view('livewire.categories-form', ['categories' => Category::where('team_id', auth()->user()->currentTeam->id)->orderBy('name')->get()]);
    }
}
