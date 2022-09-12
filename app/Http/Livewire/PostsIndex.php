<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Like;
use App\Models\Post;
use App\Models\PostType;
use Livewire\Component;
use Livewire\WithPagination;

class PostsIndex extends Component {

    use WithPagination;

    public $category, $postType, $search;
    public $categories = [];

    protected $queryString = ['category', 'postType', 'search'];
    protected $listeners = ['queryStringUpdatedCategory'];

    public function mount() {
        $this->categories = Category::where('team_id', auth()->user()->currentTeam->id)->orderBy('name')->get();
    }

    public function queryStringUpdatedCategory($category) {
        $this->category = $category;

        $this->resetPage(); // resetea la paginación si se cambia de categoría
    }

    public function updateCategoryLink() {
        $this->emitTo('categories-links', 'update_category_link', $this->category);
    }

    public function render() {
        $categories = Category::pluck('id', 'name');

        return view('livewire.posts-index', [
            'posts' => Post::with('user', 'category', 'type')
                            ->when($this->category != null, function($query) use ($categories) {
                                return $query->where('category_id', $this->category);
                            })
                            ->when($this->postType != null, function($query) {
                                return $query->where('post_type_id', $this->postType);
                            })
                            ->when(strlen($this->search) >= 2, function($query) use ($categories) {
                                return $query->where(function ($query) {
                                    $query->where('title', 'like', '%'.$this->search.'%')
                                          ->orWhere('description', 'like', '%'.$this->search.'%');
                                });
                            })
                            ->whereRelation('category', 'team_id', auth()->user()->currentTeam->id)
                            ->addSelect(['liked_by_user' => Like::select('id')
                                                                ->where('user_id', auth()->id())
                                                                ->whereColumn('post_id', 'posts.id')])
                            ->withCount('likes')
                            ->withCount('comments')
                            ->orderBy('pinned', 'desc')
                            ->latest()
                            ->paginate(10),
            'postTypes' => PostType::all()
        ]);
    }
}
