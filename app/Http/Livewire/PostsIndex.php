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

    public $category;
    public $search;

    protected $queryString = ['category', 'search'];
    protected $listeners = ['queryStringUpdatedCategory'];

    public function queryStringUpdatedCategory($category) {
        $this->category = $category;

        $this->resetPage(); // resetea la paginación si se cambia de categoría
    }

    public function render() {
        $categories = Category::pluck('id', 'name');

        return view('livewire.posts-index', [
            'posts' => Post::with('user', 'category')
                            ->when($this->category !== null, function($query) use ($categories) {
                                return $query->where('category_id', $categories->get($this->category));
                            })
                            ->when(strlen($this->search) >= 2, function($query) use ($categories) {
                                return $query->where('title', 'like', '%'.$this->search.'%')
                                             ->orWhere('description', 'like', '%'.$this->search.'%');
                            })
                            ->addSelect(['liked_by_user' => Like::select('id')
                                                                ->where('user_id', auth()->id())
                                                                ->whereColumn('post_id', 'posts.id')])
                            ->withCount('likes')
                            ->withCount('comments')
                            ->latest('id')
                            ->paginate(10),
            'categories' => Category::all(),
            'post_types' => PostType::all()
        ]);
    }
}
