<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Symfony\Component\HttpFoundation\Response;

class CreatePost extends Component {
    public $title, $description, $categories, $post_types;
    public $category_id = 1;
    public $post_type_id = 1;

    protected $rules = [
        'title' => 'required|min:3',
        'description' => 'required',
        'category_id' => 'required|exists:categories,id',
        'post_type_id' => 'required|exists:post_types,id'
    ];

    public function createPost() {
        if (auth()->check()) {
            $this->validate();

            Post::create([
                'title' => $this->title,
                'description' => $this->description,
                'user_id' => auth()->id(),
                'category_id' => $this->category_id,
                'post_type_id' => $this->post_type_id
            ]);

            session()->flash('success_alert', 'El post fue publicado correctamente');

            $this->reset();

            return redirect()->route('posts.index');
        }

        abort(Response::HTTP_FORBIDDEN);
    }

    public function render() {
        return view('livewire.create-post');
    }
}
