<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class PostComments extends Component {
    use WithPagination;

    public Post $post;

    protected $listeners = ['commentCreated' => '$refresh',
                            'commentDeleted'];

    public function commentDeleted() {
        $this->post->refresh();
        $this->gotoPage(1);
    }
    
    public function render() {
        return view('livewire.post-comments', ['comments' => $this->post->comments()->with(['user'])->orderBy('updated_at', 'desc')->paginate(5)]);
    }
}
