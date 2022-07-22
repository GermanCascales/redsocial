<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;
use Symfony\Component\HttpFoundation\Response;

class CreatePost extends Component {
    use WithFileUploads;

    public $title, $description, $categories, $post_types;
    public $category_id = 1;
    public $post_type_id = 1;

    public $uploads = [];

    protected $rules = [
        'title' => 'required|min:3',
        'description' => 'required',
        'category_id' => 'required|exists:categories,id',
        'post_type_id' => 'required|exists:post_types,id'
    ];

    public function createPost() {
        if (auth()->check()) {
            $this->validate();

            $post = Post::create([
                'title' => $this->title,
                'description' => $this->description,
                'user_id' => auth()->id(),
                'category_id' => $this->category_id,
                'post_type_id' => $this->post_type_id
            ]);

            foreach ($this->uploads as $upload) {
                $path = $upload->store('public/uploads');
                $post->uploads()->create([
                    'user_id' => auth()->id(),
                    'file' => $path,
                    'name' => $upload->getClientOriginalName()
                ]);
            }

            session()->flash('ok_alert', 'El post fue publicado correctamente.');

            $this->reset();

            return redirect()->route('posts.index');
        }

        abort(Response::HTTP_FORBIDDEN);
    }

    public function render() {
        return view('livewire.create-post');
    }
}
