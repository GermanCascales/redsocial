<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Post;
use App\Models\PostType;
use Livewire\Component;

class EditPost extends Component {
    public $post;

    public $title, $description, $category_id, $post_type_id;

    protected $rules = [
        'title' => 'required|min:3',
        'description' => 'required',
        'category_id' => 'required|exists:categories,id',
        'post_type_id' => 'required|exists:post_types,id'
    ];

    public function mount(Post $post) {
        $this->post = $post;
        $this->title = $post->title;
        $this->description = $post->description;
        $this->category_id = $post->category_id;
        $this->post_type_id = $post->post_type_id;
    }

    public function updatePost() {
        // Authorization

        $this->validate();

        $this->post->update([
            'title' => $this->title,
            'description' => $this->description,
            'category_id' => $this->category_id,
            'post_type_id' => $this->post_type_id
        ]);

        $this->emit('postUpdated');
    }

    public function render() {
        return view('livewire.edit-post', [
            'categories' => Category::all(),
            'post_types' => PostType::all()
        ]);
    }
}
