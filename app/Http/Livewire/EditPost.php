<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Post;
use App\Models\PostType;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;

class EditPost extends Component {
    use AuthorizesRequests;

    public Post $post;

    public $title, $description, $category_id, $post_type_id;

    protected $rules = [
        'title' => 'required|min:3',
        'description' => 'required',
        'category_id' => 'required|exists:categories,id',
        'post_type_id' => 'required|exists:post_types,id'
    ];

    public function mount(Post $post) {
        $this->title = $post->title;
        $this->description = $post->description;
        $this->category_id = $post->category_id;
        $this->post_type_id = $post->post_type_id;
    }

    public function updatePost() {
        $this->authorize('update', $this->post);

        $this->validate();

        $this->post->update([
            'title' => $this->title,
            'description' => $this->description,
            'category_id' => $this->category_id,
            'post_type_id' => $this->post_type_id
        ]);

        $this->emit('postUpdated');
        $this->emit('alertOkVisible', 'El post fue editado correctamente.');
    }

    public function uploadedFiles() {
        // $filesParams = "";
        // foreach ($this->post->uploads()->get() as $upload) {
        //     $filesParams = $filesParams . "{
        //         // the server file reference
        //         source: '12345',

        //         // set type to local to indicate an already uploaded file
        //         options: {
        //             type: 'local',

        //             // mock file information
        //             file: {
        //                 name: 'my-file.png',
        //                 size: 3001025,
        //                 type: 'image/png',
        //             },
        //         },
        //     },";
        // }

        $filesParams = collect();
        foreach ($this->post->uploads()->get() as $upload) {
            $filesParams = $filesParams->concat([[
                'source' => $upload->id,
                'options' => [
                    'type' => 'local',
                    'file' => [
                        'name' => basename($upload->file),
                        'size' => Storage::size($upload->file),
                        'type' => Storage::mimeType($upload->file),
                    ]
                ]
            ]]);
        }
        
        return $filesParams->toJson();
    }

    public function render() {
        return view('livewire.edit-post', [
            'categories' => Category::all(),
            'post_types' => PostType::all()
        ]);
    }
}
