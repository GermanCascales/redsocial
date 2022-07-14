<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Notifications\CommentPosted;
use Livewire\Component;

class ShowPost extends Component {

    public $post, $likedPost, $likes, $comment;

    protected $listeners = ['postUpdated' => '$refresh',
                            'commentCreated' => '$refresh',
                            'commentDeleted' => '$refresh'];
    protected $rules = ['comment' => 'required|min:3'];

    public function mount($post) {
        $this->likedPost = $post->user_liked(auth()->user());
        $this->likes = $post->likes()->count();
    }

    public function like_button() {
        if (!auth()->check()) {
            return redirect(route('login'));
        }

        if ($this->likedPost) {
            $this->post->delete_like(auth()->user());
            $this->likedPost = false;
            $this->likes--;
        } else {
            $this->post->create_like(auth()->user());
            $this->likedPost = true;
            $this->likes++;
        }
    }

    public function create_comment() {
        $this->validate();

        $newComment = Comment::create([
            'user_id' => auth()->id(),
            'post_id' => $this->post->id,
            'message' => $this->comment
        ]);

        $this->reset('comment');

        $this->post->user->notify(new CommentPosted($newComment));

        $this->emit('commentCreated', $newComment->id);
        $this->emit('alertOkVisible', 'El comentario fue publicado correctamente.');
    }

    public function render() {
        return view('livewire.show-post');
    }
}
