<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Post;
use App\Models\PostType;
use App\Models\Upload;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class EditPost extends Component {
    use AuthorizesRequests;
    use WithFileUploads;

    public Post $post;

    public $title, $description, $category_id, $post_type_id;

    public $uploads = [];
    public $uploadsToDelete;

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
        
        $this->uploadsToDelete = collect();
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

        foreach ($this->uploadsToDelete as $uploadId) {
            $uploadToDelete = Upload::findOrFail($uploadId);
            $this->authorize('delete', $uploadToDelete);
            Storage::delete($uploadToDelete->file);
            $uploadToDelete->delete();
        }
        
        foreach ($this->uploads as $upload) {
            $path = $upload->store('public/uploads');
            $this->post->uploads()->create([
                'user_id' => auth()->id(),
                'file' => $path,
                'name' => $upload->getClientOriginalName()
            ]);
        }

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
                        'name' => $upload->name,
                        'size' => Storage::size($upload->file),
                        'type' => Storage::mimeType($upload->file),
                    ],
                    'metadata' => [
                        'poster' => Storage::url($upload->file)
                    ]
                ]
            ]]);
        }
        
        return $filesParams->toJson();
    }

    public function setUploadToDelete($upload) {
        $this->uploadsToDelete = $this->uploadsToDelete->concat([$upload]);
    }

    public function render() {
        return view('livewire.edit-post', [
            'categories' => Category::all(),
            'post_types' => PostType::all()
        ]);
    }
}
